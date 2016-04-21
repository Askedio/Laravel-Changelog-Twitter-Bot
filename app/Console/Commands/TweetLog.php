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

      $log = \App\Log::where('tweeted', '=', '0')->limit(5)->orderBy('id', 'DESC')->get();
      foreach ($log as $lg) {
          $lg->tweeted = 1;
          $lg->save();

          $post = $lg->version.' '. $lg->content;

          if (strlen($lg->content) < 130) {
              $post = '#laravel ' . $post;
          }

          if (strlen($lg->content) < 120) {
              $post .= ' #changelog';
          }

          try {
              \Twitter::postTweet(['status' => substr($post,0, 130), 'format' => 'json']);
          } catch(\Exception $exc) {
          }
      }
    }
}
