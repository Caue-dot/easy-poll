<?php

namespace App\Services;

use App\Events\VoteEvent;
use Illuminate\Support\Facades\Auth;

readonly class PollService
{
    public function __construct(private UserService $userService)
    {}

    public function userVoted($poll): bool{
        $userId = $this->userService->getUserId();
        return $poll->votes()->where('user_id', $userId)->exists();
    }


    public function canGuestUserVote($poll): bool{
        return !Auth::user() && $poll->require_login;
    }

    public function isPollExpired($poll): bool{
        return $this->getRemainingTime($poll) <= 0;
    }

    public function getRemainingTime($poll): float{
        $diffHours = $poll->created_at->diffInHours(\Carbon\Carbon::now(), false);
        return round($poll->time_limit - $diffHours);
    }

    public function vote($alternative): void{
        $userId = $this->userService->getUserId();
        $poll = $alternative->poll;

        broadcast(new VoteEvent($alternative))->toOthers();
        $alternative->increment('votes_count');

        $poll->votes()->create(['user_id' => $userId]);
    }

}
