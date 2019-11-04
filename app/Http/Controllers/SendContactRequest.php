<?php

namespace App\Http\Controllers;

use Mail;

use Illuminate\Http\Request;

use App\Mail\Info;
use App\Mail\Support;

class SendContactRequest extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke( Request $request )
    {
        $request->validate( [
            'name' => 'required|string',
            'email' => 'required|string',
            'subject' => 'required|string',
            'text' => 'required',
            'type' => 'required|string',
            'policy' => 'required|accepted'
        ] );

        if( !$request->policy )
        {
            return redirect()->back()->with( 'error', 'Ni måste godkänna avtalet, vänligen försök igen.' );
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
