<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use DB;
use JWTAuthException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
// use VerifiesUsers;

use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;


class UserController extends Controller

{   
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    use VerifiesUsers;



    private $user;
    public function __construct(User $user){
        $this->user = $user;
        $this->middleware('guest',['except' => ['getVerification', 'getVerificationError']]);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'vil_code' => 'required|integer',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
     protected function create(array $data)
     {
         return User::create([
             'vil_code' => $data['vil_code'],
             'firstName' => $data['firstName'],
             'lastName' => $data['lastName'],
             'email' => $data['email'],
             'password' => bcrypt($data['password']),
         ]);
     }
   
    public function register(Request $request){

        try {
            // return response()->json([ 'Message: before user verification']);
            $validator=$this->validator($request->all())->validate();

            $user = $this->create($request->all());
            UserVerification::generate($user);
            UserVerification::send($user, 'Verification code Sthali user account!!!!');
            return response()->json(['status'=>true,'message'=>'Registered successfully, please verify your email.','data'=>true]);
        }
        catch(\Exception $e) {
            return response()->json(['status'=>false,'Message: ' .$e->getMessage() ,'data'=>false]);
        }
       
        
    }




    
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        //return $credentials;
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
    public function getUV(Request $request){
        $user = JWTAuth::toUser($request->token);
        
        $vil=DB::select('select * from `village_details` where `village_details`.`vil_code` ='.$user['vil_code'].' limit 1');
        unset(
            $user['verified'],
            $user['verification_token'],
            $user['vil_code'],
            $user['created_at'],
            $user['updated_at']
        );
        // $vil=DB::select('select `vil_name`,`pin_code`,`tot_geograph_area`,`tot_households` from `village_details` where `village_details`.`vil_code` ='.$user['vil_code'].' limit 1');
        return response()->json(['result' => $user,'vil' => $vil]);
        // return "This works"; 
    }
}  
