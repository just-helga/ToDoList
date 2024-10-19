<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function MainPage() {
        return view('welcome');
    }

    public function UserPage() {
        $tasks = Task::query()->where('user_id', Auth::id())->get();
        return view('user.main', ['tasks'=>$tasks]);
    }

    public function RegistrationPage() {
        return view('guest.registration');
    }
    public function AuthorizationPage() {
        return view('guest.authorization');
    }
}
