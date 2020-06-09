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

    public static function updateInfo( Request $request, User $user )
    {
        $result = Verification::run( $request, 'user info' );
        if( $result )
        {
            $user->name = $request->name;
            $user->save();

            return [ 'success', 'Användare uppdaterad.' ];
        }
        return [ 'error', 'Något gick fel, försök igen.' ];
    }

    public static function updateSecurity( Request $request, User $user )
    {
        $result = Verification::run( $request, 'user security' );
        if( $result )
        {
            if( Hash::check( $request->password, $user->password ) )
            {
                $user->password = Hash::make( $request->newPassword );
                $user->valid = true;
                $user->save();

                return [ 'success', 'Säkerhetsinformation uppdaterad, nice!' ];
            }
            return [ 'error', 'Lösenordet är felaktigt. Dubbelkolla informationen och försök igen.' ];
        }
        return [ 'error', 'Något gick fel, försök igen.' ];
    }

    public static function updateAdmin( Request $request, User $user )
    {

        $result = Verification::run( $request, 'user new' );

        if( $result )
        {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->valid = $request->valid;
            $user->association_id = $request->association_id;
            $user->save();
            return [ 'success', 'Användare uppdaterad, bra jobbat!' ];
        }
        return [ 'error', 'Något gick fel, försök igen.' ];
    }

    public static function createNew( Request $request )
    {
        $randomString = md5( uniqid( time(), true ) );

        $result = Verification::run( $request, 'user new' );
        if( $result )
        {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make( $randomString );
            $user->role = $request->role;
            $user->association_id = $request->association_id;
            $user->save();

            Mail::to( $user->email )
                ->send( new NewUser( $user, $randomString ) );

            return [ 'success', 'Ny användare skapad, bra jobbat!' ];
        }
        return [ 'error', 'Något gick fel, försök igen.' ];
    }
}
