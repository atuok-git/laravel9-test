<?php

namespace App\Services;

use App\Models\Tweet;

class TweetService
{
    public function getTweet()
    {
        return Tweet::orderBy('created_at', 'desc')->get();
    }
}
