'use strict';

$( document ).on( 'click', '.notification > button.delete', function()
{
    $( this ).parent().fadeOut( 'slow', function ()
    {
        $( this ).addClass( 'is-hidden' );
        return false;
    } );
} );
