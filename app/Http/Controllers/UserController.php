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
    public function loginMobile()
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

            $user = User::where('login_id', $credentials['login_id'])->first();
            if ($user->login_type !== 1) {
                $pasture = Pasture::where('user_id', $user['id'])->first();
                return response()->json([
                    'token' => $token,
                    'user' => Auth::user(),
                    'pasture' => $pasture,
                ]);
            }else {
                return response()->json(['token' => null]);
            }

        }

        else{
            return response()->json(['token' => null]);
        }
    }

    public function loginHp()
    {
        $data = request()->input('data');

        $email = $data['user_email'];
        $password = $data['password'];
        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        $token = JWT::encode($credentials, env("JWT_SECRET"), 'HS256');

        if (Auth::attempt($credentials)) {

            $user = User::where('email', $credentials['email'])->first();
            if ($user->login_type !== 0) {
                $pasture = Pasture::where('user_id', $user['id'])->first();
                return response()->json([
                    'token' => $token,
                    'user' => Auth::user(),
                    'pasture' => $pasture,
                ]);
            }else{
                return response()->json(['token' => null]);
            }

        }

        else{
            return response()->json(['token' => null]);
        }
    }

    public function registerMobile()
    {
        $data = request()->input('data');

        $login_id = $data['login_id'];
        $password = $data['password'];
        $email = $data['user_email'];

        $existingUser = User::where('login_id', $login_id)->first();
        $existingEmail = User::where('email', $email)->first();
        if ($existingUser) {
            return response()->json(['message' => 'ログインIDはすでに存在します。']);
        }else if ($existingEmail) {
            return response()->json(['message' => 'ユーザーメールはすでに存在します。']);
        }else {
            $user = new User();

            $user->name = "";
            $user->email = $email;
            $user->login_id = $login_id;
            $user->password = bcrypt($password);
            $user->user_pt = 10000;
            $user->level = 0;
            $user->role = 0;
            $user->login_type = 0;
            $user->image_url = "default.jpg";

            $user->save();

            $credentials = [
                'login_id' => $login_id,
                'password' => $password
            ];

            $token = JWT::encode($credentials, env("JWT_SECRET"), 'HS256');

            $users = User::where('login_id', $credentials['login_id'])->first();
            $pasture = Pasture::where('user_id', $user['id'])->first();
            return response()->json([
                'token' => $token,
                'user' => $users,
                'pasture' => $pasture,
                'message' => ""
            ]);
        }
    }

    public function registerHp()
    {
        $data = request()->input('data');

        $name = $data['login_id'];
        $password = $data['password'];
        $email = $data['user_email'];

        $existingUser = User::where('name', $name)->first();
        $existingEmail = User::where('email', $email)->first();
        if ($existingUser) {
            return response()->json(['message' => 'ログインIDはすでに存在します。'], 401);
        }else if ($existingEmail) {
            return response()->json(['message' => 'ユーザーメールはすでに存在します。'], 402);
        }else {
            $user = new User();

            $user->name = $name;
            $user->email = $email;
            $user->login_id = $name;
            $user->password = bcrypt($password);
            $user->user_pt = 10000;
            $user->level = 0;
            $user->role = 0;
            $user->login_type = 1;
            $user->image_url = "default.jpg";

            $user->save();

            $credentials = [
                'email' => $email,
                'password' => $password
            ];
           
            $token = JWT::encode($credentials, env("JWT_SECRET"), 'HS256');

            $users = User::where('email', $credentials['email'])->first();
            $pasture = Pasture::where('user_id', $user['id'])->first();
            return response()->json([
                'token' => $token,
                'user' => $users,
                'pasture' => $pasture,
            ]);

        }
    }

    public function unionUserRegister()
    {
        $data = request()->input('data');

        $login_id = $data['login_id'];
        $password = $data['password'];
        $email = $data['user_email'];
        $type = $data['type'];

        if ($type == 'mobile') {
            $credentialsHp = [
                'email' => $email,
                'password' => $password
            ];

            if (Auth::attempt($credentialsHp)) {
                
                $existingUserBothStatus = User::where('email', $email)->where('login_type', 2)->first();
                $existingUserHpStatus = User::where('email', $email)->where('login_type', 1)->first();
                $existingUserIpStatus = User::where('login_id', $login_id)->first();

                if ($existingUserBothStatus) {
                    return response()->json(['message' => 'このアカウントはすでに提携しています。', 'unionState' => 1, 'token' => null]);
                }else if($existingUserHpStatus) {
                    if (!$existingUserIpStatus) {
                        User::where('email', $email)->update([
                            'login_type' => 2,
                            'login_id' => $login_id,
                        ]);
            
                        $credentials = [
                            'login_id' => $login_id,
                            'password' => $password
                        ];
            
                        $token = JWT::encode($credentials, env("JWT_SECRET"), 'HS256');
            
                        $user = User::where('login_id', $credentials['login_id'])->first();
                        $pasture = Pasture::where('user_id', $user['id'])->first();
    
                        return response()->json([
                            'token' => $token,
                            'user' => Auth::user(),
                            'pasture' => $pasture,
                            'message' => "",
                            'unionState' => 1
                        ]);
                    }else {

                        if ($existingUserIpStatus->email == $email) {
                            User::where('email', $email)->update([
                                'login_type' => 2,
                                'login_id' => $login_id,
                            ]);
                
                            $credentials = [
                                'login_id' => $login_id,
                                'password' => $password
                            ];
                
                            $token = JWT::encode($credentials, env("JWT_SECRET"), 'HS256');
                
                            $user = User::where('login_id', $credentials['login_id'])->first();
                            $pasture = Pasture::where('user_id', $user['id'])->first();
        
                            return response()->json([
                                'token' => $token,
                                'user' => Auth::user(),
                                'pasture' => $pasture,
                                'message' => "",
                                'unionState' => 1
                            ]);
                        }else {
                            return response()->json(['message' => 'ユーザーIDはすでに存在します。', 'unionState' => 1, 'token' => null]);
                        }

                    }
                }else {
                    return response()->json(['unionState' => null, 'token' => null]);
                }
            }else {
                return response()->json(['unionState' => null, 'token' => null]);
            }
        }else if ($type == 'hp') {
            $credentialsMobile = [
                'login_id' => $login_id,
                'password' => $password
            ];

            if (Auth::attempt($credentialsMobile)) {
                $existingUserBothStatus = User::where('login_id', $login_id)->where('login_type', 2)->first();
                $existingUserHpStatus = User::where('login_id', $login_id)->where('login_type', 0)->first();
                $existingUserMailStatus = User::where('email', $email)->first();

                if ($existingUserBothStatus) {

                    return response()->json(['message' => 'このアカウントはすでに提携しています。'], 401);

                }else if($existingUserHpStatus) {

                    if (!$existingUserMailStatus) {
                        User::where('login_id', $login_id)->update([
                            'login_type' => 2,
                            'email' => $email,
                            'name' => $login_id,
                        ]);
            
                        $credentials = [
                            'email' => $email,
                            'password' => $password
                        ];
            
                        $token = JWT::encode($credentials, env("JWT_SECRET"), 'HS256');
            

                        $user = User::where('email', $credentials['email'])->first();
                        $pasture = Pasture::where('user_id', $user['id'])->first();

                        return response()->json([
                            'token' => $token,
                            'user' => Auth::user(),
                            'pasture' => $pasture,
                        ]);
                    }else {
                        if ($existingUserMailStatus->login_id == $login_id) {
                            User::where('login_id', $login_id)->update([
                                'login_type' => 2,
                                'email' => $email,
                                'name' => $login_id,
                            ]);
                
                            $credentials = [
                                'email' => $email,
                                'password' => $password
                            ];
                
                            $token = JWT::encode($credentials, env("JWT_SECRET"), 'HS256');
                
    
                            $user = User::where('email', $credentials['email'])->first();
                            $pasture = Pasture::where('user_id', $user['id'])->first();
    
                            return response()->json([
                                'token' => $token,
                                'user' => Auth::user(),
                                'pasture' => $pasture,
                            ]);
                        }else{
                            return response()->json(['message' => 'ユーザーメールはすでに存在します。'], 402);
                        }
                    }


                }else {
                    return response()->json(['message' => '育成ゲーム情報が正確ではありません。'], 404);
                }
            }else {
                return response()->json(['message' => '育成ゲーム情報が正確ではありません。'], 403);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

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
            'user_name' => 'required',
            'old_password' => 'required',
            'new_password' => 'required',
            // 'imageUrl' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust the validation rules as per your requirements
        ]);
        
        $userData = [
            'name' => $request->input('user_name'),
            'password' => bcrypt($request->input('new_password')),
        ];

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }else if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json(['message' => 'Incorrect old password'], 400);
        }
        
        if ($request->hasFile('imageUrl')) {
            $image = $request->file('imageUrl');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move('img/user_images', $imageName);
            $userData['image_url'] = $imageName;
        }
        
        $user->update($userData);
        
        $credentials = [
            'email' => $user->email,
            'password' => $request->input('new_password')
        ];

        $token = JWT::encode($credentials, env("JWT_SECRET"), 'HS256');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = User::where('email', $credentials['email'])->first();
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