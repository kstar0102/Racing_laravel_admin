<?php

namespace App\Http\Controllers;

use Auth;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pasture;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.content.user', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $this->validate($request, [
            'login_id' => 'required',
            'password' => 'required',
        ]);
        // Attempt to log in the user
        $credentials = $request->only('login_id', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('dashboard');
        } else {
            // Authentication failed...
            return back()->withErrors(['login_id' => 'Invalid login credentials.']);
        }

    }

    /**
     * login for mobile
     */

    public function login()
    {
        $data = request()->input('data');
        \Log::info($data);
        $login_id = $data['login_id'];
        $password = $data['password'];
        $credentials = [
            'login_id' => $login_id,
            'password' => $password
        ];

        $token = JWT::encode($credentials, env("JWT_SECRET"), 'HS256');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = User::where('login_id', $credentials['login_id'])->first();
            $pasture = Pasture::where('user_id', $user['id'])->first();
            return response()->json([
                'token' => $token,
                'user' => Auth::user(),
                'pasture' => $pasture
            ]);
        }

        else{
            return response()->json(['token' => null]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        $this->index();
    }

    public function getUser(Request $request){
        $data = $request->input('data');
        $data = User::where('id', $data['user_id'])->get();
        dd("hh");
        return response()->json(['data' => $data]);
    }
}