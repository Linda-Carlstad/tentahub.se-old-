<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include( 'layouts.partials.head' )
</head>
<body>
    <div id="app">
        @include( 'layouts.partials.navbar' )

        <main class="pb-4">
            @include( 'layouts.partials.flash-messages' )
            @yield('content')
        </main>
        @include( 'layouts.partials.footer' )
    </div>


</body>
</html>
