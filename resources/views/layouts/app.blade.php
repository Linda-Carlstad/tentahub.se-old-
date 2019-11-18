<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include( 'partials.layouts.head' )
</head>
<body>
    <div id="app">
        @include( 'partials.layouts.navbar' )

        <main class="container">
            @include( 'partials.layouts.flash-messages' )
            @yield( 'content' )
        </main>
        @include( 'partials.layouts.footer' )
    </div>


</body>
</html>
