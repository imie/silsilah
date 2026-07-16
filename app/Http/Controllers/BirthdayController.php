<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;

class BirthdayController extends Controller
{
    public function index()
    {
        $users = $this->getUpcomingBirthdays();

        return view('birthdays.index', compact('users'));
    }

    private function getUpcomingBirthdays()
    {
        $users = User::whereNotNull('dob')->get();

        return $users->filter(function ($user) {
            return $user->birthday_remaining !== null && $user->birthday_remaining <= 60;
        })->sortBy('birthday_remaining')->values();
    }
}
