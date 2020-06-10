@php
    Carbon\Carbon::setLocale( 'sv' );
@endphp

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- CSRF Token -->
<title>{{ config('app.name', 'Tentahub') }} - @yield( 'title', 'Studentens samlingsplats för tentor' )</title>

<meta name="keywords" content="Utbildning, Utbildningar, Förening, Föreningar, Studentförening, Studentföreningar,
            Webbutvecklare, Webbutveckling, Data, Dataingenjör, IT-design, Datateknink, Teknik, Utbildningsförening,
            Karlstad, Universitet, Karlstads universitet, KAU, Linda, Tentahub, Carlstad, HHK, Handels,
            Högskolan, Handelshögskolan">
<meta name="description" content="Tentahub | Studentens samlingsplats för tentor skapad av Linda Carlstad - @yield( 'title')">
<meta name="subject" content="Social">
<meta name="image" content="{{ config( 'app.url' ) }}/img/logo.png">
<meta name="copyright" content="Tentahub">
<meta name="language" content="{{ str_replace( '_', '-', app()->getLocale()) }}">
<meta name="robots" content="index, follow">
<meta name="Classification" content="Business">
<meta name="author" content="Linda Carlstad">
<meta name="designer" content="Linda Carlstad">
<meta name="copyright" content="Linda Carlstad">
<meta name="reply-to" content="info@lindacarlstad.se">
<meta name="owner" content="Linda Carlstad">
<meta name="url" content="{{ config( 'app.url' ) }}">
<meta name="identifier-URL" content="{{ config( 'app.url' ) }}">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta name="revisit-after" content="7 days">

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="canonical" href="{{ Request::url() }}">
<link rel="home" href="{{ Request::url() }}">
<link rel="alternate" hreflang="x-default" href="{{ Request::url() }}">

<!-- Schema.org for Google -->
<meta itemprop="name" content="Tentahub">
<meta itemprop="description" content="Tentahub | Studentens samlingsplats för tentor skapad av Linda Carlstad - @yield( 'title')">
<meta itemprop="image" content="{{ config( 'app.url' ) }}/img/logo.png">
<!-- Twitter -->
<meta property="twitter:card" content="Tentahub | Studentens samlingsplats för tentor skapad av Linda Carlstad - @yield( 'title')">
<meta property="twitter:title" content="Tentahub">
<meta property="twitter:description" content="Tentahub | Studentens samlingsplats för tentor skapad av Linda Carlstad - @yield( 'title')">
<meta property="twitter:image" content="{{ config( 'app.url' ) }}/img/logo.png">
<!-- Open Graph general (Facebook, Pinterest & Google+) -->
<meta property="og:title" content="Tentahub">
<meta property="og:description" content="Tentahub | Studentens samlingsplats för tentor skapad av Linda Carlstad - @yield( 'title')">
<meta property="og:image" content="{{ config( 'app.url' ) }}/img/logo.png">
<meta property="og:url" content="{{ config( 'app.url' ) }}">
<meta property="og:site_name" content="Tentahub">
<meta property="og:locale" content="{{ str_replace( '_', '-', app()->getLocale()) }}">
<meta property="og:type" content="website">

<!-- Styles -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" rel="stylesheet" type="text/css">
<link href="{{ mix('css/app.css') }}" rel="stylesheet">

<!-- Scripts -->
<script defer src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script defer src="https://kit.fontawesome.com/b63a56719c.js" crossorigin="anonymous"></script>
<script defer src="{{ mix('js/app.js') }}"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script defer src="https://www.googletagmanager.com/gtag/js?id=UA-136489552-2"></script>
<script defer>
    window.dataLayer = window.dataLayer || [];
    function gtag(){ dataLayer.push( arguments ); }
    gtag( 'js', new Date() );

    gtag( 'config', 'UA-136489552-2' );
</script>

<script defer src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script defer>
    window.addEventListener("load", function(){
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": "#1a1a1a"
                },
                "button": {
                    "background": "#ff3f34",
                    "color": "#fff"
                }
            },
            "content": {
                "message": "Den här webbplatsen använder kakor för att du ska få den bästa upplevelsen på vår hemsida.",
                "dismiss": "Uppfattat!",
                "link": "Läs mer"
            },
            "position": "top"
        })
    });
</script>
<script src="https://www.google.com/recaptcha/api.js?render={{ config( 'services.recaptcha.key' ) }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute( '{{ config( 'services.recaptcha.key' ) }}', { action: 'contact' } ).then( function( token )
        {
            if( token )
            {
                if( document.getElementById( 'recaptcha' ) )
                {
                    document.getElementById( 'recaptcha' ).value = token;
                }
            }
        });
    });

    // Manual exam upload
    grecaptcha.ready(function() {
        grecaptcha.execute( '{{ config( 'services.recaptcha.key' ) }}', { action: 'examManual' } ).then( function( token )
        {
            if( token )
            {
                if( document.getElementById( 'recaptcha-manual' ) )
                {
                    document.getElementById( 'recaptcha-manual' ).value = token;
                }
            }
        });
    });

    // Automatic exam upload
    grecaptcha.ready(function() {
        grecaptcha.execute( '{{ config( 'services.recaptcha.key' ) }}', { action: 'examAutomatic' } ).then( function( token )
        {
            if( token )
            {
                if( document.getElementById( 'recaptcha-automatic' ) )
                {
                    document.getElementById( 'recaptcha-automatic' ).value = token;
                }
            }
        });
    });
</script>
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1621399,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
