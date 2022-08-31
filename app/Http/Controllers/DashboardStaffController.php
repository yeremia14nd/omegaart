<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DashboardStaffController extends Controller
{

    public function index()
    {
        if (Gate::any(['superadmin', 'admin'])) {
            return view('dashboard.staffs.index', [
                'staffs' => User::whereIn('role_id', [2, 3, 4])->get(),
            ]);
        } else {
            return redirect('/dashboard');
        }
    }

    public function create()
    {
        return view('dashboard.staffs.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'userName' => 'required|unique:users',
            'imageAssets' => 'image|file|max:2048',
            'email' => 'required|email',
            'address' => 'required',
            'phoneNumber' => 'required',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt('password');
        $validatedData['role_id'] = $request->role_id;

        $validatedData['imageAssets'] = $request->file('imageAssets')->store('staff-images');

        User::create($validatedData);

        return redirect('/dashboard/staffs')->with('success', 'Staf baru sudah dibuat');
    }

    public function show(User $user)
    {
        if (Gate::any(['superadmin', 'admin', 'estimator', 'teknisi'])) {
            return view('dashboard.staffs.show', [
                'staff' => $user,
            ]);
        }
        return redirect('/dashboard');
    }

    public function edit(User $user)
    {
        return view('dashboard.staffs.edit', [
            'staff' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'role_id' => 'required',
        ];

        $validatedData = $request->validate($rules);

        User::where('id', $user->id)->update($validatedData);

        return redirect('/dashboard/staffs')->with('success', 'Role dari Staf sudah diubah');
    }

    public function destroy(User $user)
    {
        if ($user->imageAssets) {
            Storage::delete($user->imageAssets);
        }
        User::destroy($user->id);

        return redirect('/dashboard/staffs')->with('success', 'Staf sudah dihapus!');
    }
}
