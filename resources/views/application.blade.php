<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1" />
        <meta name="author" content="Hello Software" />
        <meta name="description" content="Simple AI platform" />
        <meta name="keywords" content="helloai, ai" />
        <!-- <link rel="icon" href="<%= BASE_URL %>favicon.ico"> -->

        <title>HelloAI</title>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset(mix('css/vuesax.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/main.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/iconfont.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/material-icons/material-icons.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/prism-tomorrow.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
    </head>
    <body>
        <noscript>
            <strong>We're sorry but HelloAI doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>
        <div id="app">
        </div>

        <!-- <script src="js/app.js"></script> -->
        <script src="{{ asset(mix('js/app.js')) }}"></script>
    </body>
</html>
