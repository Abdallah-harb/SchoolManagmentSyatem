<?php

namespace App\Http\Controllers\Api\public\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResendverificationCodeRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Interface\Public\AuthInterface;
use App\Mail\VerifyEmail;
use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $repository;

    public function __construct(AuthInterface $repository){
        $this->repository = $repository;
    }

    final public function register(RegisterRequest $request){
         return $this->repository->register($request->validated());
     }

     final public function verifyEmail(VerifyEmailRequest $request){
            return $this->repository->verifyEmail($request->validated());
     }

     final public function resendCode(ResendverificationCodeRequest $request){
        return $this->repository->resendCode($request->validated());
     }

     final public function login(LoginRequest $request){
        return $this->repository->login($request->validated());
     }

     final public function logout(){
        return $this->repository->logout();
     }

}
