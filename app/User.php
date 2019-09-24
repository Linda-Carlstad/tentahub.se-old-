<?php

namespace App;

use Auth;

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
            $user->password = Hash::make( $request->password );
            $user->save();
        }

        return true;
    }

    public static function validateInfo( Request $request, User $user )
    {
        $request->validate( [
            'name'           => 'required|string',
            'association_id' => 'required|integer',
        ] );
    }

    public static function validateSecurity( Request $request, User $user )
    {
        $request->validate( [
            'password'        => 'required',
            'newPassword'     => 'required|min:6|different:password',
            'confirmPassword' => 'required|same:newPassword',
        ] );
    }
}
