<div class="column is-half is-widescreen">
    <div class="list is-hoverable">
        <div class="list-item">
            <small>
                Uppladdad {{ Carbon\Carbon::parse( $exam->created_at )->diffForHumans() }}
                @if( $exam->points || $exam->grade )
                    |
                    @if( $exam->points )
                        Poäng: <span class="is-highlighted has-text-underline">{{ $exam->points }}</span>
                    @endif
                    @if( $exam->points && $exam->grade )
                        -
                    @endif
                    @if( $exam->grade )
                        Betyg: <span class="is-highlighted has-text-underline">{{ $exam->grade }}</span>
                    @endif
                @endif
            </small>
            <h4 class="title is-4">{{ $exam->name }} {{ $exam->name ? '- ' . $exam->date : '' }}</h4>
            <div class="field is-grouped">
                <p class="control">
                    <a class="button is-primary" target="_blank" href="{{ route( 'exams.show', $exam->slug ) }}">
                        Visa
                    </a>
                </p>
                <p class="control">
                    <a class="button is-primary" href="{{ route( 'exams.download', $exam->slug ) }}">
                        Ladda ner
                    </a>
                </p>
                <p class="control">
                    <a class="button is-text" href="{{ route( 'courses.show', $exam->course->slug ) }}">
                        {{ $exam->course->name }} ({{ $exam->course->code }})
                    </a>
                </p>
            </div>
            @auth
                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association->university->slug === $course->association->university->slug || Auth::user()->role === 'moderator' && Auth::user()->association->slug === $course->association->slug )
                    <hr>
                    <div class="field is-grouped">
                        <p class="control">
                            <a class="button is-primary" href="{{ route( 'exams.edit', $exam->slug ) }}">
                                Ändra
                            </a>
                        </p>
                        <form onsubmit="return confirm('Vill du verkligen ta bort den här tentan?');" class="control" action="{{ route( 'exams.destroy', $exam->slug ) }}" method="post">
                            @csrf
                            @method( 'DELETE' )
                            <button class="button is-link" type="submit">
                                Ta bort
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
