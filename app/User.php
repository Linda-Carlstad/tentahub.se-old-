<?php

namespace App;

use Auth;

use App\Mail\NewUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'association_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [
        'role',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function association()
    {
        return $this->belongsTo( 'App\Association' );
    }

    public function university()
    {
        return $this->belongsTo( 'App\University' );
    }

    public static function updateInfo( Request $request, User $user )
    {
        User::validateInfo( $request, $user );
        $user->name           = $request->name;
        $user->association_id = $request->association_id;
        $user->save();

        return true;
    }

    public static function updateSecurity( Request $request, User $user )
    {
        User::validateSecurity( $request, $user );

        if( Hash::check( $request->password, $user->password ) )
        {
            $user->password = Hash::make( $request->newPassword );
            $user->valid = true;
            $user->save();
        }

        return true;
    }

    public static function validateInfo( Request $request )
    {
        $request->validate( [
            'name'           => 'required|string',
            'association_id' => 'required|integer',
        ] );
    }

    public static function validateSecurity( Request $request )
    {
        $request->validate( [
            'password'        => 'required',
            'newPassword'     => 'required|min:6|different:password',
            'confirmPassword' => 'required|same:newPassword',
        ] );
    }

    public static function validateNewUser( Request $request )
    {
        $request->validate( [
            'name'           => 'required',
            'role'           => 'required|in:super,admin,moderator',
            'email'          => 'required|email',
            'association_id' => 'required|integer',
        ] );
    }

    public static function createNew( Request $request )
    {
        $randomString = md5( uniqid( time(), true ) );

        User::validateNewUser( $request );

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make( $randomString );
        $user->role = $request->role;
        $user->association_id = $request->association_id;
        $user->save();

        Mail::to( $user->email )
            ->send( new NewUser( $user, $randomString ) );
    }
}
