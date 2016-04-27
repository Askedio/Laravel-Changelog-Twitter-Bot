<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GrahamCampbell\GitHub\Facades\GitHub;

class TweetLogFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweetlog:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch new data, store in sqlite.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        $releases = array_map(function($tag){
          $version = ltrim($tag['name'], 'v');
          if(!\App\Tag::where('number', $version)->first()){
            \App\Tag::create(['number' => $version]);
            if(env('APP_ENV') == 'production'){
                \Twitter::postTweet(['status' => 'Version ' . $version . ' has been tagged for #laravel #php', 'format' => 'json']);
            }
          }
        }, GitHub::repo()->tags('laravel', 'framework'));

        $read = GitHub::repo()->contents()->show('laravel', 'framework', 'CHANGELOG.md');
        $contents = explode(PHP_EOL, base64_decode($read['content']));

        array_shift($contents);
        $contents = array_filter($contents);

        $version = [];
        $opt = false;

        /*
         * Regexp makes more sense but ya, to lazy - and I'm not regexp pro.
         */
        foreach ($contents as $content) {
            if (substr($content, 0, 3) == '## ') {
                $version = array_map('trim', explode(' ', str_replace(['## v', '(', ')'], '', $content)));
                if(!$vers = \App\Version::where('number', $version[0])->first()){
                  $vers = \App\Version::create(['number' => $version[0], 'date' => $version[1]]);
                  if(env('APP_ENV') == 'production'){
                      \Twitter::postTweet(['status' => '#laravel Changelog updated for version ' . $version[0] . ' ' . $version[1] . ' #changelog https://cruddy.io/laravel-changelog/' . $version[0], 'format' => 'json']);
                  }
                }

            } elseif (substr($content, 0, 4) == '### ') {
                $opt = str_replace('### ', '', trim($content));
            } elseif (!empty($version) && !empty($opt)) {
                $line = str_replace('- ', '', $content);
                $link = preg_match_all('/\[([^]]*)\] *\(([^)]*)\)/s', $line, $replace);
                $links = [];

                if ($link) {
                    foreach ($replace[2] as $lin) {
                        $links[] = $lin;
                    }
                    foreach ($replace[0] as $lin) {
                        $line = str_replace($lin, '', $line);
                        $line = preg_replace('/\s\(([^)]*)\)/s', '', $line);
                    }
                }

                \App\Log::firstOrCreate([
                'type'    => $opt,
                'content' => $line.'.',
                'version_id' => $vers->id,
                'link'    => implode(',', $links),
              ]);
            }
        }




    }
}
