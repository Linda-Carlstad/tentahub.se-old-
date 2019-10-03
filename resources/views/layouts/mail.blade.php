<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <style>
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
                <h1>Tentahub</h1>
                <p>Din personliga central för gamla tentor</p>
            </header>

            <div class="main">
                @yield( 'content' )
            </div>

            <footer>
                <hr>
                <h3>Tentahub</h3>
                <a href="https://tentahub.se">https://tentahub.com</a>
                <br>
                <a href="mailto:info@lindacarlstad.se">info@lindacarlstad.se</a>
            </footer>
        </div>
    </body>
</html>
