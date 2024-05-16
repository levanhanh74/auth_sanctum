<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Users;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AuthController extends Controller
{
    protected $user;
    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );
            // IF validation Error display 1 message and that error
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error register',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            // Else create new user.
            $user = $this->user->store([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            // return
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error login',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
            $user = $this->user->getRecord($request->email); // get OneRecord

            return response()->json([
                'status' => true,
                'data' => $user,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    function logoutUser()
    {

        // Lấy token hiện tại của người dùng
        $user = Auth::user();

        // Xóa tất cả các token của người dùng hiện tại
        // Xóa tất cả các token của người dùng hiện tại
        $user->each->delete();
        dd($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User is logged out successfully'
        ], 200);
    }
    /**
     * Show the form for editing the specified resource.
     */
}
