<?php

namespace App\Http\Controllers;

use App\Helpers\ImageFileHelper;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin_only');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin-pelatih.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->user_nama = $request->user_nama;
        $user->user_username = $request->user_username;
        $user->password = Hash::make($request->password);
        $user->user_no_hp = $request->user_no_hp;
        $user->user_email = $request->user_email;
        $user->user_alamat = $request->user_alamat;
        $user->role = $request->role;
        $user->user_status = $request->user_status;
        $user->user_gambar =  ImageFileHelper::instance()->upload($request->user_gambar, 'user_images');
        $user->save();

        toast('Berhasil menambahkan data user', 'success');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        ImageFileHelper::instance()->delete($user->user_gambar);
        $user->delete();
        toast('Berhasil menghapus data', 'success');
        return redirect()->route('user.index');
    }

    public function role(Request $request, $user)
    {
        User::where('id', $user)
            ->update([
                'role' => $request->role,
                'user_status' => $request->user_status
            ]);

        toast('Berhasil merubah data', 'success');
        return redirect()->route('user.index');
    }
}
