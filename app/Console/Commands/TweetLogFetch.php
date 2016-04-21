<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $laravelVersion = '5.2';
        $githubUrl = 'https://raw.githubusercontent.com/laravel/framework/'.$laravelVersion.'/CHANGELOG.md';
        $contents = explode(PHP_EOL, file_get_contents($githubUrl));
        array_shift($contents);
        $contents = array_filter($contents);

        $version = [];
        $opt = false;

        foreach ($contents as $content) {
            if (substr($content, 0, 3) == '## ') {
                $version = array_map('trim', explode(' ', str_replace(['## v', '(', ')'], '', $content)));
            } elseif (substr($content, 0, 4) == '### ') {
                $opt = str_replace('### ', '', trim($content));
            } elseif (!empty($version) && !empty($opt)) {
                $line = str_replace('- ', '', $content);
                $link = preg_match('/\(\[([^]]*)\] *\(([^)]*)\)\)/i', $line, $replace);
                if ($link) {
                    $line = str_replace($replace[0], $replace[2], $line);
                }

                \App\Log::firstOrCreate([
                'type'    => $opt,
                'content' => $line,
                'version' => $version[0],
                'date'    => $version[1],
              ]);
            }
        }
    }
}
