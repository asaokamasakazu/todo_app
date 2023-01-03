<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // 詳細画面の表示
    public function show($id) {
        $user = User::find($id);

        if (auth()->id() != $user->id) {
            return redirect('/');
        }

        return view('auth.show', compact('user'));
    }

    // 編集画面の表示
    public function edit($id) {
        $user = User::find($id);

        if (auth()->id() != $user->id) {
            return redirect('/');
        }

        return view('auth.edit', compact('user'));
    }

    // 登録情報の更新
    public function update(Request $request, $id) {
        $user = User::find($id);

        if (auth()->id() != $user->id) {
            return redirect('/');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $form = $request->all();
        unset($form['_token']);
        $user->fill($form)->save();
        return redirect()->route('user.show', $user);
    }

    // アカウントの削除
    public function destroy($id) {
        $user = User::find($id);

        if (auth()->id() != $user->id) {
            return redirect('/');
        }
 
        $user->delete();
        return redirect('/');
    }
}
