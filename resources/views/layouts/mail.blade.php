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

            body {
                background-color: var( --color-scheme-background );
                margin: 0;
                font-family: 'Comfortaa', 'Raleway', sans-serif !important;
            }

            a
            {
                color: #ff3f34;
                text-decoration: none;
            }
            a:hover
            {
                color: #cd0b00;
                text-decoration: underline;
            }

            h3
            {
                margin-bottom: 5px;
            }

            body
            {
                width: 80%;
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
                background: linear-gradient(170deg, #ff3f34, #f7b731);
                color: #fff;
                padding: 20px 0;
                width: 100%;
                text-align: center;
                border-top-left-radius: 4px;
                border-top-right-radius: 4px;
            }

            .main
            {
                width: 100%;
                background-color: #fff;
                color: #000;
            }

            .main .container {
                padding: 30px 30px;
            }

            footer
            {
                border-top: 10px solid var(--color-scheme-background-diff);
                background-color: var(--color-scheme-background-alt);
                color: var( --color-scheme-text-color );
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
                <h1>{{ config( 'app.name' ) }}</h1>
                <p>{{ config( 'app.slogan' ) }}</p>
            </header>

            <div class="main">
                <div class="container">
                    @yield( 'content' )
                </div>
            </div>

            <footer>
                <h3>{{ config( 'app.name' ) }}</h3>
                <a href="{{ config( 'app.url' ) }}">{{ config( 'app.url' ) }}</a>
                <br>
                <a href="mailto:{{ config( 'mail.to.address' ) }}">{{ config( 'mail.to.address' ) }}</a>
            </footer>
        </div>
    </body>
</html>
