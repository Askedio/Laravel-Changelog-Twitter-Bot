<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TweetReplies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweetlog:replies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tweet Replies';

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
        $mentions = \Twitter::getMentionsTimeline(['count' => 20, 'format' => 'json']);


        foreach (json_decode($mentions) as $comment) {
            if (\App\Comment::where('tweetid', $comment->id)->first()) {
                continue;
            }

            if (preg_match('/meaning of life/s', $comment->text)) {
              $meanings = [
                'The meaning of life can be found while writing #laravel #php code.',
                'I think if you keep coding with #laravel #php you\'ll find the answer.',
              ];
              $this->tweet($comment->user->screen_name, $meanings[array_rand($meanings, 1)], $comment->id);
            }

            if (preg_match('/latest version/s', $comment->text) || preg_match('/current version/s', $comment->text)) {
                $version = \App\Version::first();
                $post = 'The latest version of #laravel is: '.$version->number.' released '.$version->date;
                $this->tweet($comment->user->screen_name, $post, $comment->id);
            }

            if (preg_match('/thank you/s', $comment->text)) {
              die('a');
                $post = 'Your\'re welcome.';
                $this->tweet($comment->user->screen_name, $post, $comment->id);
            }

            \App\Comment::create(['tweetid' => $comment->id]);
        }
    }

    private function tweet($user, $message, $reply_id){
      if(env('APP_ENV') == 'production'){
        \Twitter::postTweet([
          'status' => substr('@'.$user. ' '. $message, 0, 140),
          'in_reply_to_status_id' => $reply_id,
          'format' => 'json'
        ]);
      }
    }
}
