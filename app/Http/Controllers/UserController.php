<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 詳細画面の表示
    public function show($id) {
        $user = User::find($id);
        return view('auth.show', compact('user'));
    }
}
