<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Tentahub') }} - @yield( 'title', 'Studentens samlingsplats för tentor' )</title>

<!-- Styles -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" rel="stylesheet" type="text/css">
<link href="{{ mix('css/app.css') }}" rel="stylesheet">

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
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
<script src="https://www.google.com/recaptcha/api.js?render={{ env( 'GOOGLE_RECAPTCHA_KEY' ) }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute( '{{ env( 'GOOGLE_RECAPTCHA_KEY' ) }}', { action: 'homepage' } ).then( function( token )
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
