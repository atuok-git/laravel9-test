<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Services\TweetService;
use Illuminate\Http\Request;
use App\Models\Tweet;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TweetService $tweetServeice)
    {
        $tweets = $tweetServeice->getTweet();
        // dump($tweets);
        // app(\App\Exceptions\Handler::class)->render(request(), throw new \Error('dumpreport.'));
        return view('tweet.index')->with('tweets', $tweets);
    }
}
