<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            :root {
                --color-scheme-background: #333;
                --color-scheme-background-light: #333;
                --color-scheme-background-diff: #333;
                --color-scheme-text-color: white;
                --color-scheme-text-color-diff: #404040;
                --color-scheme-text-color-invert: #000;

            }
            /*
            ** Light-theme : Set variables **
            */
            @media (prefers-color-scheme: light) {
                :root {
                    --color-scheme-background: #fff;
                    --color-scheme-background-alt: #efefef;
                    --color-scheme-background-diff: #dbdbdb;
                    --color-scheme-text-color: #000;
                    --color-scheme-text-color-diff: #404040;
                    --color-scheme-text-color-invert: #fff;
                }
            }
            /*
            ** Dark-theme : Set variables **
            */
            @media (prefers-color-scheme: dark) {
                :root {
                    --color-scheme-background: #1A1A1A;
                    --color-scheme-background-alt: #343434;
                    --color-scheme-background-diff: #474747;
                    --color-scheme-text-color: #fff;
                    --color-scheme-text-color-diff: #bfbfbf;
                    --color-scheme-text-color-invert: #000;
                }
            }
            @font-face
            {
                font-family: 'Comfortaa', 'Raleway', sans-serif !important;
                src: url('https://fonts.googleapis.com/css?family=Comfortaa|Raleway');
            }

            a
            {
                color: #00C851;
                text-decoration: none;
            }
            a:hover
            {
                color: #ffbb33;
                text-decoration: none;
            }

            h3
            {
                margin-bottom: 5px;
            }

            hr
            {
                width: 70%;
                margin: 0 auto;
                color: #363839;
            }

            body
            {
                width: 70%;
                margin: 20px auto;
            }

            @media screen and (max-width: 768px)
            {
                body
                {
                    width: 100%;
                    margin: 20px auto;
                }
            }

            .wrapper
            {
                border-radius: 10px;
            }

            header
            {
                background-color: #fff;
                padding: 20px 0;
                width: 100%;
                text-align: center;
                border-top-left-radius: 4px;
                border-top-right-radius: 4px;
            }

            header h1
            {
                color: #00C851;
            }

            .main
            {
                width: 100%;
                padding: 40px 20px;
            }

            footer
            {
                padding: 20px 0;
                border-bottom-left-radius: 4px;
                border-bottom-right-radius: 4px;
                width: 100%;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <header>
                <h1>{{ env( 'APP_NAME' ) }}</h1>
                <p>{{ env( 'APP_SLOGAN' ) }}</p>
            </header>

            <div class="main">
                <div class="container">
                    @yield( 'content' )
            </div>

            <footer>
                <h3>{{ env( 'APP_NAME' ) }}</h3>
                <a href="{{ env( 'APP_URL' ) }}">{{ env( 'APP_URL' ) }}</a>
                <br>
                <a href="mailto:{{ env('MAIL_TO_ADDRESS') }}">{{ env('MAIL_TO_ADDRESS') }}</a>
            </footer>
        </div>
    </body>
</html>
