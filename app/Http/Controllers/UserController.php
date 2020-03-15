<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('success_message')) {
            Alert::success('success', session('success_message'))->showConfirmButton('Close', '#0f9b0f');
        } elseif (session('error_message')) {
            Alert::error('error', session('error_message'))->showConfirmButton('Close', '#b92b53');
        }
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $this->authorize('create', $user);

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, User $user)
    {
        $this->authorize('create', $user);
        if ($request->has('admin')) {
            $admin = true;
        } else {
            $admin = false;
        }
        User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'admin' => $admin
        ]);
        return redirect()->route('users')->withSuccessMessage("User Successfully Created");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        if ($request->password == null) {
            $password = $user->password;
        } else {
            $password =Hash::make($request->input('password'));
        }
        if ($request->has('admin', 'cashier')) {
            $admin = true;
            $cashier = true;
        } elseif ($request->has('cashier')) {
            $cashier = true;
            $admin = false;
        } elseif ($request->has('admin')) {
            $admin = true;
            $cashier = false;
        } else {
            $cashier = true;
            $admin = false;
        }
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password,
            'cashier' => $cashier,
            'admin' => $admin,
        ]);
        return redirect()->route('users')->withSuccessMessage("User Successfully Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        if ($user->name == auth()->user()->name) {
            return redirect()->route('users')->withErrorMessage("You cannot remove your current logged in profile");
        }
        User::query()->where('id', $user->id)->delete();
        return redirect()->route('users')->withSuccessMessage("User Successfully Removed");
    }
}
