<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

use App\Mail\Info;
use App\Mail\Support;

class SendContactRequest extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke( Request $request )
    {
        $request->validate( [
            'name' => 'required|string',
            'email' => 'required|string',
            'subject' => 'required|string',
            'text' => 'required',
            'type' => 'required|string',
            'policy' => 'required|accepted',
            'recaptcha' => 'required'
        ] );

        if( !$request->policy )
        {
            return redirect()->back()->with( 'error', 'Ni måste godkänna avtalet, vänligen försök igen.' );
        }

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret'   => env( 'GOOGLE_RECAPTCHA_SECRET' ),
            'response' => $request->recaptcha
        ];

        $options = [
            'http' => [
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'method'  => 'POST',
                'content' => http_build_query( $data )
            ]
        ];

        $context = stream_context_create( $options );
        $result = file_get_contents( $url, false, $context );
        $json = json_decode( $result );

        if( $json->success != true )
        {
            return redirect()->back()->with( 'error', 'Capatcha fel!' );
        }

        switch( $request->type )
        {
            case 'support':
                Mail::to( 'support@lindacarlstad.se' )
                    ->send( new Support( $request ) );
                break;

            case 'info':
                Mail::to( 'info@lindacarlstad.se' )
                    ->send( new Info( $request ) );
                break;
            default:
                return redirect()->back()->with( 'error', 'Något gick fel, vänligen försök igen.' );
                break;
        }
        return redirect()->back()->with( 'success', 'Ditt meddelande har skickats.' );
    }
}
