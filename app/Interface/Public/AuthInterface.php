<?php

namespace App\Interface\Public;

use Illuminate\Http\Request;

interface AuthInterface
{
    public function register(array $data);
    public function login(array $data);
    public function changePassword(array $data);
    public function forgetPassword(array $data);
    public function verifyEmail(array  $data);
    public function resendCode(array $data);

}
