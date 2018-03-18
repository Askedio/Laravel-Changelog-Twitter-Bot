<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TweetLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweetlog:tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tweet Laravel Changelog';

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
        $log = \App\Log::where('tweeted', '=', '0')->limit(1)->orderBy('id', 'DESC')->get();
        foreach ($log as $lg) {
            $lg->tweeted = 1;
            $lg->save();

            $link = $lg->links();

            $base_post = $lg->version->number.' '.$lg->content;

            $post = !empty($link[0])
              ? $base_post.' '.$link[0]
              : $base_post;

            if (strlen($post) < 100) {
                $post = '#laravel '.$post;
            }

            if (strlen($post) < 265) {
                $post .= ' #changelog';
            }

            if(env('APP_ENV') == 'production'){
                try {
                    \Twitter::postTweet(['status' => substr($post, 0, 280), 'format' => 'json']);
                } catch (\Exception $exc) {
                }
            } else {
              dd(['status' => substr($post, 0, 140), 'format' => 'json']);
            }
        }
    }
}
