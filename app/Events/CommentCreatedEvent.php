<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channelName;

    public function __construct(string $channelName)
    {
        $this->channelName = $channelName;
        logger('Broadcast adress: public.social-app.'.$this->channelName.'.comment');
    }

    public function broadcastOn(): array
    {
        logger('Broadcast adress: public.social-app.'.$this->channelName.'.comment');
        return [
            new Channel('public.social-app.'.$this->channelName.'.comment')
        ];
    }

    public function broadcastAs(): string
    {
        return 'comment.updated';
    }

    public function broadcastWith(): array
    {
        return [
            "message" => "New comment created!"
        ];
    }
}
