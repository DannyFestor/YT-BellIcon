<?php

namespace App\Console\Commands;

use App\Events\PrivateNotificationEvent;
use App\Events\PublicNotificationEvent;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;

class MakeNotificationCommand extends Command
{
    protected $signature = 'make:notification {num=1} {--user}';

    protected $description = 'Command description';

    public function handle(): void
    {
//        echo 'hello';
//        echo PHP_EOL;
//        echo $this->argument('num');
//        echo $this->option('user');

        $num = max((int)$this->argument('num'), 1);
        $isUser = (bool) $this->option('user');

        $notifications = Notification::factory($num)->create([
            'user_id' => $isUser ? 1 : null,
        ]);

        if ($isUser) {
            PrivateNotificationEvent::dispatch($notifications);
        } else {
            PublicNotificationEvent::dispatch($notifications);
        }
    }
}
