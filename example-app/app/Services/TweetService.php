<?php

namespace App\Services;

use App\Models\Tweet;

class TweetService
{
    public function getTweet()
    {
        return Tweet::orderBy('created_at', 'desc')->get();
    }

    public function checkOwnTweet(int $userId, int $tweetId): bool
    {
        $tweet = Tweet::where('id', $tweetId)->first();
        if (!$tweet) {
            return false;
        }
        return $tweet->user_id === $userId;
    }
}
