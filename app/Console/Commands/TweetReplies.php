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
            if (preg_match('/latest version/s', $comment->text)) {
                if (\App\Comment::where('tweetid', $comment->id)->first()) {
                    continue;
                }

                $version = \App\Log::distinct('version')->select('version')->first();
                $post = '@'.$comment->user->screen_name.' The latest version of #laravel is: '.$version->version.' released '.$version->date;
                \Twitter::postTweet(['status' => substr($post, 0, 140), 'format' => 'json']);
                \App\Comment::create(['tweetid' => $comment->id]);
            }
        }
    }
}
