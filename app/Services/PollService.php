<?php

namespace App\Services;

use App\Events\VoteEvent;

readonly class PollService
{
    public function __construct(private GuestService $guestService)
    {}

    public function userVoted($poll): bool{
        $guestId = $this->guestService->getGuestId();
        return $poll->votes()->where('user_id', $guestId)->exists()
            || \Cache::get($poll->id) === request()->ip();
    }

    public function vote($alternative): void{
        $guestId = $this->guestService->getGuestId();
        $poll = $alternative->poll;

        broadcast(new VoteEvent($alternative))->toOthers();
        $alternative->increment('votes_count');

        $poll->votes()->create(['user_id' => $guestId]);
        \Cache::put($poll->id, request()->ip(), ttl:60*60);
    }

}
