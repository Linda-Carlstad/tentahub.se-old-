<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Verification extends Model
{
    public static function run( Request $request, $model )
    {
        switch( $model )
        {
            case 'recapthca':
                $result = Verification::recaptcha( $request );
                break;

            case 'exam':
                $result = Verification::exam( $request );
                break;

            case 'course':
                $result = Verification::course( $request );
                break;

            case 'association':
                $result = Verification::association( $request );
                break;

            case 'university':
                $result = Verification::university( $request );
                break;

            case 'user new':
                $result = Verification::userNew( $request );
                break;

            case 'user info':
                $result = Verification::userInfo( $request );
                break;

            case 'user security':
                $result = Verification::userSecurity( $request );
                break;

            default:
                $result = false;
                break;
        }

        return $result;
    }

    private static function recaptcha( Request $request )
    {
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
            return false;
        }

        return true;
    }

    private static function exam( Request $request )
    {
        return $request->validate( [
            'name' => 'required|string',
            'grade' => 'nullable|string',
            'points' => 'nullable|numeric',
            'exam' => 'mimetypes:application/pdf',
            'recaptcha' => 'required',
            'type' => 'required|string',
            'date' => 'nullable|string',
            'created_from' => 'required|ip',
            'changed_from' => 'nullable|ip'
        ] );
    }

    private static function course( Request $request )
    {
        return $request->validate( [
            'name'           => 'required|string',
            'code'           =>  $request->method() === 'PATCH' ? 'required|string|unique:courses,code,' . $request->id : 'required|string|unique:courses',
            'association_id' => 'required|integer',
            'university_id'  => 'required|integer',
            'url'            => 'nullable|string',
            'description'    => 'nullable|string',
            'points'         => 'required|numeric',
        ] );
    }

    private static function association( Request $request )
    {
        return $request->validate(
        [
            'name'          => 'required|string',
            'university_id' => 'required|integer',
            'url'           => 'nullable|string',
            'description'   => 'nullable|string'
        ] );
    }

    private static function university( Request $request )
    {
        return $request->validate(
        [
            'name'        => 'required|string',
            'nickname'    => 'required|string|max:20',
            'city'        => 'required|string',
            'country'     => 'required|string',
            'description' => 'nullable|string',
            'url'         => 'nullable|string'
        ] );
    }

    private static function userNew( Request $request )
    {
        return $request->validate(
        [
            'name'           => 'required',
            'role'           => 'required|in:super,admin,moderator',
            'email'          => 'required|email',
            'association_id' => 'required|integer',
        ] );
    }

    private static function userInfo( Request $request )
    {
        return $request->validate(
        [
            'name'           => 'required|string',
            'email'          => 'required|email',
            'association_id' => 'required|integer',
        ] );
    }

    private static function userSecurity( Request $request )
    {
        return $request->validate(
        [
            'password'        => 'required',
            'newPassword'     => 'required|min:6|different:password',
            'confirmPassword' => 'required|same:newPassword',
        ] );
    }
}
