@if( session()->has( 'success' ) )
    <div class="notification is-success">
        <button class="delete"></button>
        {{ session()->get( 'success' ) }}
    </div>
@endif

@if( session()->has( 'error' ) )
    <div class="notification is-danger">
        <button class="delete"></button>
        {{ session()->get( 'error' ) }}
    </div>
@endif

@if( session( 'resent' ) )
    <div class="notification is-info">
        <button class="delete"></button>
        Ett nytt verifieringsmail har skickats till din e-postadress.
    </div>
@endif
