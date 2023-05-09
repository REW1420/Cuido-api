<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $users;
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
    public function store(Request $request)
    {
        $user = new User();
        $user->user_id = $request->user_id;
        $user->profile_photo = $request->profile_photo;
        $user->first_name = $request->first_name;
        $user->second_name = $request->second_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'message' => 'User created',
            'user' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::where('user_id', $id)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }


        $user->first_name = $request->first_name;
        $user->second_name = $request->second_name;

        $user->phone_number = $request->phone_number;

        $user->save();
        $user->touch();

        return response()->json(['message' => 'User update', 'user' => $user]);
    }

    public function updateEmail(Request $request, $id)
    {
        $user = User::where('user_id', $id)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->email = $request->email;
        $user->save();
        $user->touch();

        return response()->json(['message' => 'User email updated', 'user' => $user]);
    }


    public function code($user_id)
    {
        $user = User::where('user_id', $user_id)->get();
        return $user;
    }
    /**show
     *show users by role
     */
    public function role($role)
    {
        $user = User::where('role', $role)->get();
        return $user;
    }

    /** 
     *Delete user by user_id
     */
    public function delete_user_id($user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(["message" => "user_id not found"]);
        } else {
            $user->delete();
            return response()->json([
                "message" => "User delete"
            ]);
        }
    }

    public function getUserRoleByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(["role", "none"], 200);
        }

        return response()->json([
            'role' => $user->role,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);

        if (!$users) {
            return response()->json([
                "message" => "id not found"
            ]);
        } else {

            $users->delete();

            return response()->json([
                "message" => "User detele"
            ]);
        }


    }
}