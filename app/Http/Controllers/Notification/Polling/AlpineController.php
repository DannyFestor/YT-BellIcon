<?php

namespace App\Http\Controllers\Notification\Polling;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class AlpineController extends Controller
{
    public function index()
    {
        return view('polling.alpine');
    }

    public function show(Request $request)
    {
        \Auth::login(User::find(1));

        $public = Notification::query()
            ->whereNull('user_id')
            ->whereNull('seen_at')
            ->get();

        $private = Notification::query()
            ->where('user_id', $request->user()->id)
            ->whereNull('seen_at')
            ->get();

        return response()->json([
            'public' => $public,
            'private' => $private,
        ]);
    }

    public function store(Request $request) {
        Notification::query()
            ->whereIn('id', $request->get('ids'))
            ->update(['seen_at' => now()]);

        return response()->json();
    }
}
