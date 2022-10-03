@extends('larasnap::layouts.app', ['class' => 'user-index'])
@section('title','User Management')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <head>
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">
        <meta property="og:url" content="https://twitter.com/intent/tweet?text=PayGiv%20App&url=https://paygiv.app/">
        <meta property="og:type" content="website">
        <meta property="og:title" content="I got certified on the NEAR blockchain!">
        <meta property="og:description" content="View NEAR University certificates of any .near account">

        <meta property="og:image" content="https://paygiv.org/wp-content/uploads/2021/01/paygiv-logo-h-1024x336.png">
        <meta property="twitter:site" content="@NEARProtocol">

        <meta name="twitter:card" content="summary">
        <meta property="twitter:domain" content="/">


        <meta property="twitter:url" content="https://paygiv.org/wp-content/uploads/2021/01/paygiv-logo-h-1024x336.png">
        <meta name="twitter:title" content="I got certified on the NEAR blockchain!">

        <meta property="linkedin:url" content="https://paygiv.org/wp-content/uploads/2021/01/paygiv-logo-h-1024x336.png">
        <meta name="linkedin:title" content="I got certified on the NEAR blockchain!">

        <meta name="twitter:description" content="View NEAR University certificates of any .near account">
        <meta name="twitter:image" content="https://paygiv.org/wp-content/uploads/2021/01/paygiv-logo-h-1024x336.png">
        <meta property="og:image:width" content="1080">

        <meta property="og:image:height" content="1080">
    </head>

</head>

<body>

    <a class="share-btn-twitter" data-dismiss="modal" rel="noopener" target="twitter" href="https://twitter.com/intent/tweet?text=PayGiv App&amp;url=https://paygiv.app/" role="button">
        Twitter <img class="ShareIcon" src="https://paygiv.app/frontend/images/twitter.svg" alt="">
    </a>

    <a class="share-btn-fb" href="https://www.facebook.com/sharer/sharer.php?s=hello&amp;app_id=351703733810094&amp;u=https://paygiv.app/&amp;display=popup&amp;&amp;redirect_uri=https://paygiv.app/" role="button">
        Facebook <img class="ShareIcon" src="https://paygiv.app/frontend/images/facebook_share.svg" alt="">
    </a>

    <a class="share-btn-linkedin" data-dismiss="modal" rel="noopener" target="linkedin" href="https://www.linkedin.com/sharing/share-offsite?text=PayGiv App&amp;url=https://paygiv.app/" role="button">
        Linkedin <img class="ShareIcon" src="https://paygiv.app/frontend/images/twitter.svg" alt="">
    </a>

</body>

</html>
@endsection