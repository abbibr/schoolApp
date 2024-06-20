<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;

class AdminController extends Controller
{
    public function logout() {
        auth()->logout();

        return redirect()->route('login');
    }
}
