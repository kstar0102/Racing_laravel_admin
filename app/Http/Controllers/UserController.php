<?php

namespace App\Http\Controllers;

use Auth;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pasture;
use Illuminate\Support\Facades\Hash;

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
                'pasture' => $pasture,
            ]);
        }

        else{
            return response()->json(['token' => null]);
        }
    }

    public function register()
    {
        $data = request()->input('data');
        \Log::info($data);
        $login_id = $data['login_id'];
        $password = $data['password'];
        $email = $data['user_email'];
        $name = $data['user_name'];

        $user = new User();

        $user->name = $name;
        $user->email = $email;
        $user->login_id = $login_id;
        $user->password = bcrypt($password);
        $user->user_pt = 5000;
        $user->level = 0;
        $user->role = 0;
        
        $user->save();

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
        \Log::info($id);
        $userData = User::find($id);
        return response()->json(['user' => $userData]);
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
        $validatedData = $request->validate([
            'login_id' => 'required',
            'old_password' => 'required',
            'new_password' => 'required',
            // 'imageUrl' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust the validation rules as per your requirements
        ]);
        
        $userData = [
            'login_id' => $request->input('login_id'),
            'password' => bcrypt($request->input('new_password')),
        ];

        $user = User::find($id);

        if (!$user) {
            return response()->json(['maessage' => 'User not found'], 404);
        }else if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json(['maessage' => 'Incorrect old password'], 400);
        }
        
        if ($request->hasFile('imageUrl')) {
            $image = $request->file('imageUrl');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move('img/user_images', $imageName);
            $userData['image_url'] = $imageName;
        }
        
        $user->update($userData);
        
        $credentials = [
            'login_id' => $request->input('login_id'),
            'password' => $request->input('new_password')
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

        return response()->json(['data' => $data]);
    }

    public function format_password(Request $request){
        User::where('id', $request['id'])->update([
            'password' => bcrypt('12345')
        ]);
        return response()->json('success');
    }
}