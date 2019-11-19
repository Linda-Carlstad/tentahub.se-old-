'use strict';

$( document ).on( 'click', '.notification > button.delete', function()
{
    $( this ).parent().fadeOut( 'slow', function ()
    {
        $( this ).addClass( 'is-hidden' );
        return false;
    } );
} );

const fileInput = document.querySelector( '#file-upload input[type=file]' );
fileInput.onchange = () =>
{
    if( fileInput.files.length > 0 )
    {
        const fileName = document.querySelector( '#file-upload .file-name' );
        fileName.textContent = fileInput.files[ 0 ].name;
    }
};
