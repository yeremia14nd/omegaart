<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardCustomerController extends Controller
{

    public function index()
    {
        return view('dashboard.customers.index', [
            'customers' => User::where('role_id', '5')->get(),
        ]);
    }

    public function create()
    {
        return view('dashboard.customers.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'userName' => 'required|unique:users',
            'imageAssets' => 'image|file|max:2048',
            'email' => 'required|email',
            'address' => 'required',
            'phoneNumber' => 'required',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt('password');
        $validatedData['role_id'] = 5; // number 5 is customer role

        $validatedData['imageAssets'] = $request->file('imageAssets')->store('product-images');

        User::create($validatedData);

        return redirect('/dashboard/customers')->with('success', 'Data customer sudah ditambah');
    }

    public function show(User $user)
    {

        return view('dashboard.customers.show', [
            'customer' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return view('dashboard.customers.edit', [
            'customer' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            // 'userName' => 'required|unique',
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
            $validatedData['imageAssets'] = $request->file('imageAssets')->store('customer-images');
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect('/dashboard/customers')->with('success', 'Data customer sudah diubah!');
    }

    public function destroy(User $user)
    {
        if ($user->imageAssets) {
            Storage::delete($user->imageAssets);
        }
        User::destroy($user->id);

        return redirect('/dashboard/customers')->with('success', 'Data customer sudah dihapus!');
    }
}
