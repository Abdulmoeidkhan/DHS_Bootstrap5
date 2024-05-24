<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{

    protected function basicRolesAndTeams($user)
    {
        $team = Team::where('name', 'user')->first();
        $role = Role::where('name', 'user')->first();
        $permission = Permission::where('name', 'read')->first();
        $user->addRole($role, $team);
        $user->givePermission($permission, $team);
        // $user->addRole('admin', 'admin');
        // $user->givePermissions(['read', 'create', 'update', 'delete'], 'admin');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $sociouser = Socialite::driver('google')->user();
            $finduser = User::where('provider_id', $sociouser->id)->first();
            if ($finduser) {
                Auth::login($finduser);

                return redirect()->route('pages.dashboard');
            } else {
                //  return $user;
                $uid = (string) Str::uuid();
                $user = new User();
                $user->uid = $uid;
                $user->name = $sociouser->name;
                $user->email = $sociouser->email;
                $user->provider_id = $sociouser->id;
                $user->avatar = $sociouser->getAvatar();

                $savedUser = $user->save();
                try {
                    if ($savedUser) {
                        $this->basicRolesAndTeams($user);
                        Auth::login($user);
                        session()->put('user', $user);
                        return redirect()->route('pages.dashboard');
                    }
                } catch (\Illuminate\Database\QueryException $exception) {
                    if ($exception->errorInfo[2]) {
                        return  redirect()->route('signIn')->with('error', 'Email Address already Exist error : ' . $exception->errorInfo[2]);
                    } else {
                        return  redirect()->route('signIn')->with('error', $exception->errorInfo[2]);
                    }
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
