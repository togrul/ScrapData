<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Web scrapping</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<!-- navigation -->
<nav class="flex items-center justify-between flex-wrap bg-purple-800 p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <a href="/">
            <span class="font-semibold text-xl tracking-tight">Product scrap</span>
        </a>
    </div>
    <div class="block lg:hidden">
        <button class="flex items-center px-3 py-2 border rounded text-purple-200 border-purple-400 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </button>
    </div>
    <div class="w-full block  lg:flex lg:items-center lg:w-auto justify-end">
        <div class="text-sm lg:flex-grow">
            <a class="text-sm px-4 py-2 leading-none rounded text-white border border-white hover:border-transparent hover:text-purple-500 hover:bg-white mt-4 lg:mt-0"
               href="{{ route('sync') }}" onclick="event.preventDefault();document.getElementById('sync-form').submit();">
                Sync
            </a>
            <form id="sync-form" action="{{ route('sync') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</nav>
<!-- navigation -->

<!-- container -->
<div class="container mx-auto py-16">

    @yield('content')

</div>
<!-- container -->
</body>
</html>
