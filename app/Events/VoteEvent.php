<?php

namespace App\Events;

use App\Models\Alternative;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Alternative $alternative)
    {}

    public function broadcastOn(): array
    {
        return [
            new Channel('vote-cast')
        ];
    }

    public function broadcastAs(): string
    {
        return 'user.voted';
    }

    public function broadcastWith(): array
    {
        return
            [
                'id' => $this->alternative->id,
                'votesCount' => $this->alternative->votes_count,
            ];
    }
}
