<?php

namespace App\Http\Controllers\Notification\WS;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AlpineController extends Controller
{
    public function index(Request $request)
    {
        \Auth::login(User::find(1));

        return view('websocket.alpine', [
            'user' => $request->user(),
        ]);
    }

    public function store(Request $request)
    {
        Notification::query()
            ->whereIn('id', $request->get('ids'))
            ->update(['seen_at' => now()]);

        return response()->json();
    }
}
