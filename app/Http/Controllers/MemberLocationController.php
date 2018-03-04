<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberLocationController extends Controller
{
    public function locations()
    {
        $users = User::where('latitude', '!=' , null)
                    ->where('longitude', '!=' , null)
                    ->get();

        $markers = [];
        foreach ($users as $key => $user) {
            $marker = [
                'position' => ['lat'=> $user->latitude, 'lng'=> $user->longitude  ],
                'info' => $user->name,
            ];
            array_push($markers , $marker);
        }
        $markers = collect($markers);

        return view('frontend.members.location', compact('markers'));
    }
}
