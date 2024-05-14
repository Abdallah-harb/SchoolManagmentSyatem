<?php

namespace App\Repository;

use App\Http\Resources\Auth\UserResource;
use App\Trait\imageTrait;
use Illuminate\Http\Request;
use App\Interface\Public\AuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
class AuthRepository implements AuthInterface
{
    use imageTrait;

    private User $module;
    public function __construct(){
        $this->module = new (User::class);
    }

   final public function register(array $data)
    {
        $data['image'] = $this->image($data['image'],'users');
        $item =  $this->module->create($data);
        try {
            $sent = true;
            $item->sendEmailVerificationNotification();
        }catch (\Exception $e) {
            $sent = $e;
        }
        return jsonResponse(["item" => new UserResource($item),'code_sent' => $sent]);
    }
   final public function verifyEmail(array $data)
    {
        $user = $this->module->whereEmail($data['email'])->first();
        if (Hash::check($data['code'], $user->email_verification_code)) {
            $user->markEmailAsVerified();
            $token = $user->createToken($data['email'].'admin')->plainTextToken;
            $user->token = $token;
            return jsonResponse(["item" => new UserResource($user)]);
        }
        return jsonResponse( [],'these code not match',Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    final public function resendCode(array $data){
        $user = $this->module->whereEmail($data['email'])->first();
        try {
            $sent = true;
            $user->sendEmailVerificationNotification();
        } catch (\Exception $e) {
            $sent = false;
        }
        return jsonResponse(["item" => new UserResource($user),'code_sent' => $sent]);
    }

   final public function login(array $data)
    {
        if(!$user =Auth::attempt($data)){
            return jsonResponse(null,'the credential not match',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user = $this->module->whereEmail($data['email'])->first();
        $token = $user->createToken($data['email'].'admin')->plainTextToken;
        $user->token = $token;
        if (!$user->hasVerifiedEmail()) {
            auth('api')->logout();
            return jsonResponse([],'email Not verified',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return jsonResponse(["item" => new UserResource($user)]);
    }



    final public function logout(){

        auth('api')->User()->currentAccessToken()->delete();
        return jsonResponse(null,'logout successfully');
    }

    public function changePassword(array $data)
    {

    }

    public function forgetPassword(array $data)
    {
        // TODO: Implement forgetPassword() method.
    }


}
