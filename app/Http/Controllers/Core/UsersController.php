<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Models\Core\User;

use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

use Hash;
use Auth;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $users = User::latest()->paginate(50);

        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request) 
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $usr = $user->create(array_merge($request->validated(), [
            'password' => Hash::make('Poliwangi123'),
			'unit'	=> 0,
			'staff'	=> 0,
			'status'	=> 2,
        ]));
		
		$usr->syncRoles(2);

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Edit user profile data
     * 
     * 
     * @return \Illuminate\Http\Response
     */
    public function editProfile() 
    {
        $user=Auth::user();
        return view('users.editprofile', [
            'user' => $user,
        ]);
    }

    /**
     * Update profile user data
     * 
     * @param User $user
     * @param UpdateProfileRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(User $user, UpdateProfileRequest $request) 
    {
        $validator=$request->validated();
        if($validator){
            $user->nip=$request->nip;
            $user->asal_instansi=$request->asal_instansi;
            $user->jabatan_fungsional=$request->jabatan_fungsional;
            $user->pangkat_gol=$request->pangkat_gol;
            $user->bidang_ilmu=$request->bidang_ilmu;
            if($request->avatar){
                $newname=$user->id.".".$request->file('avatar')->getClientOriginalExtension();
                $user->avatar=$newname;
                if(!Storage::disk('public_avatar')->putFileAs('/', $request->file('avatar'), $newname)) {
                    return redirect()->route('users.editprofile')
                        ->withSuccess(__('User updated successfully.'));
                }
            }
            if($request->password){
                $user->password= Hash::make($request->password);
            }
            $user->update();

            return redirect()->route('users.editprofile')
                ->withSuccess(__('User updated successfully.'));
        }else{
            return redirect()->route('users.editprofile')
                ->withErrors($validator);
        }
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request) 
    {
        $user->update($request->validated());

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }
	
	public function tukaruser(User $user){
		$users  =   User::where(['id' => $user->id])->first();
        if($users){
			\Illuminate\Support\Facades\Session::flush();        
			\Auth::logout();		
			\Auth::login($user,true);
			return redirect()->route('home.index')->with('success_message', 'Sukses beralih user');
		}
		return redirect()->route('home.index')->with('warning_message', 'Gagal beralih user');
	}

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}
