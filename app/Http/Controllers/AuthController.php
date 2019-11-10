<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\RegistersUsers;

class AuthController extends Controller{

    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function login(Request $request){
        if (Auth::attempt($request->all(),true)){
            $user = Auth::user();
            $this->guard()->login($user);

            return response()->json(['logged'=>true,'redirect'=>route('home')]);
        }
        return response()->json([
            'logged' => false,
            'errors' => [
                'email' => ['Wrong email or password'],
                'password' => ['Wrong email or password']
            ]
        ]);
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function register(Request $request){
        $validator = $this->validator($request->all());
        if ($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->getMessages(),'passed'=>false]);
        }

        $user = $this->createUser($request->all());
        $this->guard()->login($user);
        return response()->json([
            'passed' => true,
            'redirect' => route('home')
        ]);
    }

    public function showRegisterForm(){
        return view('auth.register')->render();
    }

    public function checkEmail(Request $request){
        if (User::where('email',htmlspecialchars($request->post('email'),3))->count()){
            return response()->json([
                'checked' => false,
                'message' => 'This email is already used'
            ]);
        }
        return response()->json([
            'checked' => true,
            'message' => 'Email is ok'
        ]);
    }

    protected function createUser($data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'email', Rule::unique('users', 'email'), 'string'],
            'password' => ['required', 'confirmed', 'string' ,'regex: /^(?=.*\d)(?=.*[A-z]).{8,}/'],
            'name' => ['required', 'string', 'regex:/^(?=.*[A-z]).{3,}/'],
        ]);
    }
}
