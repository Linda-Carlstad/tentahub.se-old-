@if( session()->has( 'success' ) )
    <div class="notification is-success">
        <button class="delete"></button>
        <div class="columns level">
            <div class="column is-1 has-text-centered level-item">
                <i class="far fa-check-circle fa-3x"></i>
            </div>
            <div class="column is-11 level-item">
                <h3 class="title is-4">Lyckat!</h3>
                {{ session()->get( 'success' ) }}
            </div>
        </div>
    </div>
@endif

@if( session()->has( 'error' ) )
    <div class="notification is-danger">
        <button class="delete"></button>
        <div class="columns level">
            <div class="column is-1 has-text-centered level-item">
                <i class="far fa-times-circle fa-3x"></i>
            </div>
            <div class="column is-11 level-item">
                <h3 class="title is-4">Attans!</h3>
                {{ session()->get( 'error' ) }}
            </div>
        </div>
    </div>
@endif

@if( session( 'resent' ) )
    <div class="notification is-info">
        <button class="delete"></button>
        <div class="columns level">
            <div class="column is-1 has-text-centered level-item">
                <i class="far fa-envelope fa-3x"></i>
            </div>
            <div class="column is-11 level-item">
                <h3 class="title is-4">Saker</h3>
                Ett nytt verifieringsmail har skickats till din e-postadress.
            </div>
        </div>
    </div>
@endif


<div class="notification is-success">
    <button class="delete"></button>
    <div class="columns level">
        <div class="column is-1 has-text-centered level-item">
            <i class="far fa-check-circle fa-3x"></i>
        </div>
        <div class="column is-11 level-item">
            <h3 class="title is-4">Lyckat!</h3>
            Ett nytt verifieringsmail har skickats till din e-postadress
        </div>
    </div>
</div>
