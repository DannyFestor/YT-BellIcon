<?php

namespace App\Http\Controllers\Notification\SSE;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AlpineController extends Controller
{
    public function index()
    {
        return view('sse.alpine');
    }

    public function show(Request $request): StreamedResponse
    {
        \Auth::login(User::find(1));

        $start = time();
        $maxExecution = ini_get('max_execution_time');
        $response = new StreamedResponse(function() use ($request, $start, $maxExecution) {
            while(true) {
                if(time() >= $start + $maxExecution) {
                    exit(200);
                }

                $public = Notification::query()
                    ->whereNull('user_id')
                    ->whereNull('seen_at')
                    ->get();

                $private = Notification::query()
                    ->where('user_id', $request->user()->id)
                    ->whereNull('seen_at')
                    ->get();

                echo 'data: ' . json_encode([
                        'public' => $public,
                        'private' => $private,
                    ]) . "\n\n";
                ob_flush();
                flush();
//                usleep(200000);
                sleep(3);
            }
        });
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Cach-Control', 'no-cache');
        return $response;
    }

    public function store(Request $request)
    {
        Notification::query()
            ->whereIn('id', $request->get('ids'))
            ->update(['seen_at' => now()]);

        return response()->json();
    }
}
