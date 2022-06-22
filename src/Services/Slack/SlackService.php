<?php

namespace App\Services\Slack;

use Illuminate\Notifications\Notifiable;
use App\Notifications\SlackNotification;

class SlackService {
    use Notifiable;

    public function send($message = null) {
        $this->notify(new SlackNotification($message));
    }

    public function routeNotificationForSlack() {
        return config('newsapi.slack_url');
    }
}