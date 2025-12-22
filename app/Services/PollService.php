<?php

namespace App\Services;

use App\Events\VoteEvent;

readonly class PollService
{
    public function __construct(private GuestService $guestService)
    {}

    public function userVoted($poll): bool{
        $guestId = $this->guestService->getGuestId();
        return $poll->votes()->where('user_id', $guestId)->exists();
    }

    public function getRemainingTime($poll): float{
        $diffHours = $poll->created_at->diffInHours(\Carbon\Carbon::now(), false);
        return round($poll->time_limit - $diffHours);
    }

    public function vote($alternative): void{
        $guestId = $this->guestService->getGuestId();
        $poll = $alternative->poll;

        broadcast(new VoteEvent($alternative))->toOthers();
        $alternative->increment('votes_count');

        $poll->votes()->create(['user_id' => $guestId]);
    }

}
