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

            if (preg_match('/latest version/s', $comment->text) || preg_match('/current version/s', $comment->text)) {
                $version = \App\Version::orderBy('number', 'desc')->first();
                $post = 'The latest version of #laravel is: '.$version->number.' released '.$version->date;
                $this->tweet($comment->user->screen_name, $post, $comment->id);
            }

            if (preg_match('/thank you/s', $comment->text)) {
                $post = 'Your\'re welcome.';
                $this->tweet($comment->user->screen_name, $post, $comment->id);
            }

            if (preg_match('/update link/s', $comment->text) || preg_match('/my link is/s', $comment->text)) {
              $post = 'Sorry, I was not able to complete your request.';

              preg_match_all('/@(\w{1,15})\b/s', $comment->text, $matches);
              $link= $comment->entities->urls[0]->expanded_url;

              if(!empty($matches) && $comment->user->screen_name = 'asked_io'){
                $author = \App\Author::where('name', $matches[1][1])->first();
              } else {
                $author = \App\Author::where('name', $comment->user->screen_name)->first();
              }

              if($author){
                if($author->update([
                  'website' => $link,
                ])){
                  $post = 'You got it! I\'ve changed the link to ' . $link;
                }

              }

              $this->tweet($comment->user->screen_name, $post, $comment->id);
            }

            if (preg_match('/is really/s', $comment->text)) {
                $post = 'Sorry, I was not able to complete your request.';
                preg_match_all('/@(\w{1,15})\b/s', $comment->text, $matches);
                if(count($matches[1]) == 3 && $comment->user->screen_name = 'asked_io'){
                  $author = \App\Author::where('name', $matches[1][1])->first();

                  if($author){
                    if($author->update([
                      'twitter' => $matches[1][2],
                    ])){
                      $post = 'Thanks pal! I\'ve changed '. $matches[1][1] .' to '. $matches[1][2];
                    }

                  }
                }

                $this->tweet($comment->user->screen_name, $post, $comment->id);

            }


            \App\Comment::create(['tweetid' => $comment->id]);
        }
    }

    private function tweet($user, $message, $reply_id){
      $post = substr('@'.$user. ' '. $message, 0, 140);
      if(env('APP_ENV') == 'production'){
        \Twitter::postTweet([
          'status' => $post,
          'in_reply_to_status_id' => $reply_id,
          'format' => 'json'
        ]);
      } else echo $post.PHP_EOL;
    }
}
