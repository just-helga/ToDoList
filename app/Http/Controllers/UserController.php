<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function Registration(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'fname' => ['required', 'regex:/[А-Яа-яЁё-]/u'],
            'lname' => ['required', 'regex:/[А-Яа-яЁё-]/u'],
            'email' => ['required', 'email:frs', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
            'rules' => ['required']
        ], [
            'fname.required' => 'Обязательное поле',
            'fname.regex' => 'Поле может содержать только кириллицу, пробел и тире',
            'lname.required' => 'Обязательное поле',
            'lname.regex' => 'Поле может содержать только кириллицу, пробел и тире',
            'email.required' => 'Обязательное поле',
            'email.email' => 'Поле должно содержать адрес электронной почты',
            'email.unique' => 'Пользователь с указанным адресом электронной почты уже зарегистрирован',
            'password.required' => 'Обязательное поле',
            'password.min' => 'Минимальная длина пароля 6 симоволов',
            'password.confirmed' => 'Пароли не совпадают',
            'rules.required' => 'Поставьте галочку для согласие обработки персональных данных',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = md5($request->password);
        $user->save();

        return redirect()->route('login');
    }

    public function Authorization(Request $request) {
        $validate = Validator::make($request->all(), [
            'email'=>['required'],
            'password'=>['required']
        ],[
            'email.required'=>'Обязательное поле',
            'password.required'=>'Обязательное поле'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $user = User::query()
            ->where('email', $request->email)
            ->where('password', md5($request->password))
            ->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('UserPage');
        } else {
            return response()->json('Неверный логин или пароль', 403);
        }
    }

    public function Exit() {
        Auth::logout();
        return redirect()->route('login');
    }
}
