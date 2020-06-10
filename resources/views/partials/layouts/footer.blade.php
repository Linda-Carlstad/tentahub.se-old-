<footer class="footer">
    <div class="container">
        <div class="columns">
            <div class="column is-3 is-hidden-touch">
                <a target="_blank" href="https://lindacarlstad.se">
                    <figure class="image">
                        <img alt="Linda Carlstad logo" src="{{ asset( 'img/logo.png' ) }}" />
                    </figure>
                </a>
            </div>
            <div class="column is-3">
                <h4 class="title is-4">{{ config( 'app.name' ) }}</h4>
                <hr>
                <p>
                    <a href="mailto:{{ config( 'mail.to.address' ) }}">
                        {{ config( 'mail.to.address' ) }}
                    </a>
                    <br>
                    Universitetsgatan 2
                    <br>
                    651 68 Karlstad
                </p>
            </div>
            <div class="column is-3">
                <h4 class="title is-4">Läs mer</h4>
                <hr>
                <p>
                    <a target="_blank" href="https://sv.wikipedia.org/wiki/Tentamen">
                        Wikipedia - Tentamen
                    </a>
                    <br>
                    <a target="_blank" href="https://www.kau.se/student/ar-student/mina-studier/anmalan/tentamen">
                        KAU - Tentamen
                    </a>
                    <br>
                    <a target="_blank" href="https://www.kau.se/student/ar-student/mina-studier/anmalan/tentamen/tentamensregler">
                        KAU - Tentamensregler
                    </a>
                    <br>
                    <a target="_blank" href="https://www.kau.se/student/ar-student/mina-studier/anmalan/tentamen/fusk-och-plagiat">
                        KAU - Fusk och plagiat
                    </a>
                </p>
            </div>
            <div class="column is-3">
                <h4 class="title is-4">Information</h4>
                <hr>
                <p>
                    <a href="{{ route( 'about' ) }}">
                        Om oss
                    </a>
                    <br>
                    <a href="{{ route( 'what-is' ) }}">
                        Vad är {{ config( 'app.name' ) }}?
                    </a>
                    <br>
                    <a href="{{ route( 'how-to-use' ) }}">
                        Hur funkar {{ config( 'app.name' ) }}?
                    </a>
                    <br>
                    <a href="{{ route( 'contacts.info' ) }}">
                        Kontakta oss
                    </a>
                    <br>
                    <a href="{{ route( 'contacts.support' ) }}">
                        Support
                    </a>
                    <br>
                </p>
            </div>
        </div>
    </div>
    <hr>
    <div class="content legal has-text-centered">
        <p>
            <strong>Tentahub</strong> by <a href="https://lindacarlstad.se">Linda Carlstad</a>.
            Källkoden är licensierad
            (<a href="https://www.gnu.org/licenses/gpl-3.0.en.html">GPL-3.0</a>) och kan hittas på
            <a href="https://github.com/Linda-Carlstad/tentahub.se">Github</a>
            (<a target="_blank" href="https://github.com/Linda-Carlstad">Linda Carlstad</a>).
        </p>
        <p>Copyright @ {{ date( 'Y' )  }} <a href="https://lindacarlstad.se">{{ config( 'app.name' ) }}</a></p>
    </div>
</footer>
