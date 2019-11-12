<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tentahub') }} - @yield( 'title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" rel="stylesheet" type="text/css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-136489552-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){ dataLayer.push( arguments ); }
        gtag( 'js', new Date() );

        gtag( 'config', 'UA-136489552-2' );
    </script>
</head>
<body>
    <div id="app">
        @include( 'layouts.partials.navbar' )

        <main class="pb-4">
            @include( 'layouts.partials.flash-messages' )
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script>
      window.addEventListener("load", function(){
        window.cookieconsent.initialise({
          "palette": {
            "popup": {
              "background": "#343a40"
            },
            "button": {
              "background": "#660023",
              "color": "#fff"
            }
          },
          "content": {
        		"message": "Den här webbplatsen använder kakor för att du ska få den bästa upplevelsen på vår hemsida.",
        		"dismiss": "Uppfattat!",
        		"link": "Läs mer"
      	  }
        })
      });
    </script>
</body>
</html>
