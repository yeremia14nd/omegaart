<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user()->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return view('profil.show', [
                'title' => 'Profil',
                'active' => 'profil',
                'userprofile' => $user,
            ]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return view('profil.edit', [
                'title' => 'Ubah Profil',
                'active' => 'profil',
                'user' => $user,
            ]);
        } else {
            return redirect('/');
        }
    }

    public function editPassword(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return view('profil.edit-password', [
                'title' => 'Ubah Password',
                'active' => 'profil',
                'user' => $user,
            ]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'imageAssets' => 'image|file|max:2048',
            'email' => 'required|email',
            'address' => 'required',
            'phoneNumber' => 'required',
        ];

        if ($request->userName != $user->userName) {
            $rules['userName'] = 'required|unique:users';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('imageAssets')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['imageAssets'] = $request->file('imageAssets')->store('product-images');
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect('/profil' . '/' . $user->userName)->with('success', 'Profil has been updated!');
    }

    public function updatePassword(Request $request, User $user)
    {
        $rules = [
            'oldPassword' => 'required',
            'password' => 'required|min:5',
            'newConfirmPassword' => 'required',

        ];

        if (!Hash::check($request->oldPassword, $request->user()->password)) {
            return back()->withErrors([
                'oldPassword' => ['Password lama salah!']
            ]);
        }

        if ($request->password !== $request->newConfirmPassword) {
            return back()->withErrors([
                'password' => ['Password baru dan konfirmasi password tidak sama!']
            ]);
        }


        $validatedData = $request->validate($rules);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('id', $user->id)->update([
            'password' => $validatedData['password']
        ]);

        return redirect('/profil' . '/' . $user->userName)->with('success', 'Password sudah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
