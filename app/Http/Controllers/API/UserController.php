<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Models\Offer; 
use App\UserAddress; 
use App\Models\Support; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Password;
use Validator;
use Lang;

class UserController extends Controller 
{
    public $successStatus = 200;
    
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    
    public function login(){ 
        $user = User::where('email','Like', request('email'))->orwhere('mobile_no','Like', request('email'))->with(['userAddress','userDetail'])->first();
        if(!empty($user) && $user->roles->pluck('id')[0]  == 4) {
            

            if(empty($user->email_verified_at)){
                if(is_numeric(request('email'))){
                    if(Auth::attempt(['mobile_no' => request('email'), 'password' => request('password')])){
                        User::where('email', request('email'))->update([
           'device_id' => request('device_id')]);
                        $user = Auth::user(); 
                        $user->token = $user->createToken('MyApp')-> accessToken;
                        $response['status'] = true;
                        $response['data'] =  $user; 
                        $response['message'] = Lang::get('auth.sign_in_success');
                        return response()->json($response, $this-> successStatus); 
                    } else{ 
                        $response['status'] = false;
                        $response['data'] =  ''; 
                        $response['message'] = Lang::get('auth.sign_in_fail');
                        return response()->json($response, 200); 
                    } 
                }
                elseif (filter_var(request('email'), FILTER_VALIDATE_EMAIL)) {
                    if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
                        User::where('email', request('email'))->update([
           'device_id' => request('device_id')]);
                        $user = Auth::user(); 
                        $response['status'] = true;
                        $user->token = $user->createToken('MyApp')-> accessToken;
                        $response['data'] =  $user; 
                        $response['message'] = Lang::get('auth.sign_in_success');
                        return response()->json($response, $this-> successStatus); 
                    } else{ 
                        $response['status'] = false;
                        $response['data'] =  ''; 
                        $response['message'] = Lang::get('auth.sign_in_fail');
                        return response()->json($response, 200); 
                    }  
                }
            } else {
                $otp = rand(pow(10, 4-1), pow(10, 4)-1);
                User::where('email', request('email'))->update([
           'otp' => $otp]);
                 $details = [
                    'title' => 'Mail from moozy.com',
                    'otp' => $otp,
                    'body' => 'Please use this otp for account verification.'
                ];
                \Mail::to(request('email'))->send(new \App\Mail\MyTestMail($details));
                $response['status'] = true;
                $response['data'] =  $user; 
                $response['message'] = Lang::get('auth.email_verification_fail');
                return response()->json($response, 200); 
            }
        } else {
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = Lang::get('auth.registration_issue');
            return response()->json($response, 200); 
        }
        
       
    }

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email|unique:users|max:255',
            'mobile_no' => 'required|max:12|unique:users',
            'password' => 'required'
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = $validator->errors();
            return response()->json($response, 200);            
        }
        $input = $request->all(); 
        $input['email_verified_at'] = time(); 
        $input['password'] = bcrypt($input['password']); 
        $input['role_id'] = 4;
        $input['otp'] = rand(pow(10, 4-1), pow(10, 4)-1);
        $input['status'] = 0;
        $user =User::create($input);
        $user->assignRole( $input['role_id']); 
        //$user->sendEmailVerificationNotification();
        // $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        // $success['name'] =  $user->name;
         $details = [
            'title' => 'Mail from moozy.com',
            'otp' => $input['otp'],
            'body' => 'Please use this otp for account verification.'
        ];
        \Mail::to($request->only('email'))->send(new \App\Mail\MyTestMail($details));
        $response['status'] = true;
        $response['data'] =  $user; 
        $response['message'] = Lang::get('auth.sign_up_success');
        return response()->json($response, $this-> successStatus); 
    }
    
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function details($id) 
    { 
        $user = User::with(['userAddress','userDetail'])->findOrFail($id); 
        $response['status'] = true;
        $response['data'] =  $user; 
        $response['message'] = "user detail";
        return response()->json($response, $this-> successStatus); 
    } 

    /** 
     * Account Verify api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function verify(){
        $user = User::where('otp',request('otp'))->where('email',request('email'))->first();
      
        if($user) {
            $input['email_verified_at'] = NULL;
            $input['otp'] = '';
            $input['status'] = 1;
            $user->update($input);
            $response['status'] = true;
            $response['data'] =  $user; 
            $response['message'] = "Your account verify successfully";

            return response()->json($response, $this-> successStatus); 
        } else {
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = "OTP Invalid";
            return response()->json($response, 200); 
        }
    }
     /** 
     * Resend OTP
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function resend_otp(){
        $user = User::where('email',request('email'))->orWhere('mobile_no',request('email'))->first();
      
        if($user) {
            $otp = rand(pow(10, 4-1), pow(10, 4)-1);
            $details = [
                'title' => 'Mail from moozy.com',
                'otp' => $otp,
                'body' => 'Please use this otp for account verification.'
            ];
                \Mail::to(request('email'))->send(new \App\Mail\MyTestMail($details));
            $input['otp'] = $otp;
            $user->update($input);
            $response['status'] = true;
            $response['data'] =  ''; 
            $response['message'] = "You have resent otp";

            return response()->json($response, $this-> successStatus); 
        } else {
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = "Invalid email or mobile no";
            return response()->json($response, 200); 
        }
    }
    /** 
     * Forgot Password api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => false, "message" => $validator->errors()->first(), "data" => array());
        } else {
            $user = User::where('email','Like', $request->only('email'))->first();
            if(!empty($user)) {
                $otp = rand(pow(10, 4-1), pow(10, 4)-1);
                $details = [
                    'title' => 'Mail from moozy.com',
                    'otp' => $otp,
                    'body' => 'Please use this otp for reset password.'
                ];
                \Mail::to($request->only('email'))->send(new \App\Mail\MyTestMail($details));
       
                $response = \Response::json(array("status" => true, "message" => "Reset password link has been send on your registered email.", "data" => array()));
            } else {
                $response = \Response::json(array("status" => false, "message" => trans(Password::INVALID_USER), "data" => array()));

            }
            return $response;
        }
        return \Response::json($arr);
    }


    /** 
     * Reset Password api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function change_password(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => false, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((\Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array("status" => false, "message" => "Check your old password.", "data" => array());
                } else if ((\Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("status" => false, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => \Hash::make($input['new_password'])]);
                    $arr = array("status" => true, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => false, "message" => $msg, "data" => array());
            }
        }
        return \Response::json($arr);
    }

    /** 
     * Social Login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function socialLogin(Request $request) {
        $requestAll = $request->all();
        $user = '';
        if($requestAll['social_type'] == 3) {
            $requestAll['name'] = $requestAll['fullName'];
            $requestAll['social_id'] = $requestAll['user'];
            $user = User::where('social_id',$requestAll['user'])->first();
        } else {
            $requestAll['social_id'] = $requestAll['id'];
            $user = User::where('social_id',$requestAll['id'])->first();
        }
        if(!empty($user)) {
            $response['status'] = true;
            $response['data'] =  $user; 
            $response['message'] = Lang::get('auth.sign_up_success');
            return response()->json($response, 200); 
        }
        $role_id=4;
        $requestAll['role_id']  =  $role_id;

        $user =User::create($requestAll);
        $user->assignRole( $role_id); 
        
        $response['status'] = true;
        $response['data'] =  $user; 
        $response['message'] = Lang::get('auth.sign_up_success');
        return response()->json($response, $this-> successStatus);
    }

    /**
     * Display a listing of the Offer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function offers(Request $request)
    {
        $offers = Offer::with('restaurants')->where('status',1)->get();

        $response['status'] = true;
        $response['data'] =  $offers; 
        $response['message'] = "List of offer";
        return response()->json($response, $this-> successStatus); 
    }

    /** 
     * Add Address api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function updateAddress(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'user_id' => 'required',
            'address' => 'required',
            'apt' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'landmark' => 'required',
        );
        //dd($input);
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $response = array("status" => false, "message" => $validator->errors()->first(), "data" => array());
        } else {
            $address= $input['address'].' . '.$input['apt'].' . '.$input['city'].' . '.$input['state'].' . '.$input['postcode'];
            $address = str_replace(" ", "+", $address);

            $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCSq0HU1qQHerls8ZPwugwzfOqHYkFHodA&address='.urlencode($address).'&sensor=false');

            $json = json_decode($json);
            // $input['latitude'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            // $input['longitude'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
            $input['latitude'] = 26.912434;
            $input['longitude'] = 75.787270;
            $input['is_default'] = 0;
            $user = User::where('id',$input['user_id'])->first();
            $user->userAddress()->create($input);
            $userInfo = User::where('id',$input['user_id'])->with(['userAddress', 'userDetail'])->first();
            $response['status'] = true;
            $response['data'] =  $userInfo; 
            $response['message'] = "Address Added successfully.";
        }

        return response()->json($response, $this-> successStatus);
    }

/** 
 * set Address as default api 
 * 
 * @return \Illuminate\Http\Response 
 */ 
    
    public function makeDefaultAddress(Request $request) {

        $input = $request->all();

        $rules = array(
            'user_id' => 'required',
            'id' => 'required',
            'is_default' => 'required'
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $response = array("status" => false, "message" => $validator->errors()->first(), "data" => array());
        } else {
            $user = User::where('id',$input['user_id'])->first();
            $req['user_id'] = $input['user_id'];
            $req['is_default'] = 0;
            UserAddress::where('user_id', $input['user_id'])->update(['is_default' => 0]);
           // $user->userAddress()->update($input);
            UserAddress::where('id', $input['id'])->update(['is_default' => $input['is_default']]);
            $userInfo = User::where('id',$input['user_id'])->with(['userAddress', 'userDetail'])->first();
            $response['status'] = true;
            $response['data'] =  $userInfo; 
            $response['message'] = "Make default address successfully.";
        }
        return response()->json($response, $this-> successStatus);
    }


    /** 
     * support api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function support() 
    { 
        $support = Support::all(); 
        $response['status'] = true;
        $response['data'] =  $support; 
        $response['message'] = "support list";
        return response()->json($response, $this-> successStatus); 
    } 
}
