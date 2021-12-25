<?php

namespace App\Http\Controllers\api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $activities = $user->activity()->with('subject')->get();

        return [
            'profile_user' => $user,
            'threads' => $user->threads(),
            'activities' => $activities
        ];
    }
}
