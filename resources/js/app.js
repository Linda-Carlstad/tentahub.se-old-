import flatpickr from "flatpickr";
const Swedish = require( 'flatpickr/dist/l10n/sv.js' ).default.sv;

$( document ).on( 'click', '.notification > button.delete', function()
{
    $( this ).parent().fadeOut( 'slow', function ()
    {
        $( this ).addClass( 'is-hidden' );
        return false;
    } );
} );

if( document.querySelector( 'input[type=file]' ) )
{

    let fileInputManual, fileInputAutomatic, fileInput;

    if( document.querySelector( '#file-upload-manual input[type=file]' ) )
    {
        fileInputManual = document.querySelector( '#file-upload-manual input[type=file]' );
        fileInputManual.onchange = () =>
        {
            console.log( fileInputManual );
            if( fileInputManual.files.length > 0 )
            {
                const fileName = document.querySelector( '#file-upload-manual .file-name' );
                fileName.textContent = fileInputManual.files[ 0 ].name;
            }
        };
    }
    if( document.querySelector( '#file-upload-automatic input[type=file]' ) )
    {
        fileInputAutomatic = document.querySelector( '#file-upload-automatic input[type=file]' );
        fileInputAutomatic.onchange = () =>
        {
            if( fileInputAutomatic.files.length > 0 )
            {
                const fileName = document.querySelector( '#file-upload-automatic .file-name' );
                fileName.textContent = fileInputAutomatic.files[ 0 ].name;
            }
        };
    }
    if( document.querySelector( '#file-upload input[type=file]' ) )
    {
        fileInput = document.querySelector( '#file-upload input[type=file]' );
        fileInput.onchange = () =>
        {
            if( fileInput.files.length > 0 )
            {
                const fileName = document.querySelector( '#file-upload .file-name' );
                fileName.textContent = fileInput.files[ 0 ].name;
            }
        };
    }
}

flatpickr( '#date',
{
    dateFormat: "Y-m-d",
    weekNumbers: true,
    locale: Swedish
} );

const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

if ($navbarBurgers.length > 0) {

    $navbarBurgers.forEach( el => {
        el.addEventListener('click', () => {

            const target = el.dataset.target;
            const $target = document.getElementById(target);

            el.classList.toggle('is-active');
            $target.classList.toggle('is-active');

        });
    });
}
