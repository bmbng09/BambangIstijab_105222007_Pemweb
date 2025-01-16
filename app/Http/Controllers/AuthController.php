<?php

namespace App\Http\Controllers;

use App\Jawaban\NomorSatu;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(NomorSatu $authService) {
        $this->authService = $authService;
    }

    public function auth(Request $request) {
        return $this->authService->auth($request);
    }

    public function logout(Request $request) {
        return $this->authService->logout($request);
    }
}
