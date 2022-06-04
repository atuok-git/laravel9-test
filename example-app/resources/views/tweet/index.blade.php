<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>つぶやきアプリ</title>
</head>
<body>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
    <h1>つぶやきアプリ</h1>
    <div>
        @auth
            <p>投稿フォーム</p>
            @if (session('feedback.success'))
                <p style="color: green">{{ session('feedback.success')}}</p>
            @endif
            <form action="{{ route('tweet.create') }}" method="post">
                @csrf
                <label for="tweet-content">つぶやき</label>
                <span>140文字まで</span>
                <textarea name="tweet" id="tweet-content" type="text" placeholder="つぶやき入力" cols="30" rows="10"></textarea>
                @error('tweet')
                <p style="color: red;">{{ $message }}</p>

                @enderror
                <button type="submit">投稿</button>
            </form>
        @endauth
        @foreach ($tweets as $tweet)
            <details>
                <summary>
                    {{ $tweet->content }}
                    by
                    {{ $tweet->user->name }}
                </summary>
                @if (\Illuminate\Support\Facades\Auth::id() === $tweet->user_id)
                    <div>
                        <p>
                            <a href="{{ route('tweet.update.index', ['tweetId' => $tweet->id]) }}">編集</a>
                        </p>
                        <form action="{{ route('tweet.delete', ['tweetId' => $tweet->id]) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit">削除</button>
                        </form>
                    </div>
                @else
                    編集できません。
                @endif
            </details>
        @endforeach
    </div>
</body>
</html>
