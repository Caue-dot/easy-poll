<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Poll;
use App\Services\GuestService;
use App\Services\PollService;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function __construct(private readonly PollService $pollService,
                                private readonly  GuestService $guestService)
    {}

    public function showCreatePoll(){
        $this->guestService->generateGuestIdIfDoesntExist();
        return view('poll-store');
    }
    public function get(Request $request, Poll $poll){
        $userVoted = $this->pollService->userVoted($poll);
        $this->guestService->generateGuestIdIfDoesntExist();

        return view('poll', ['poll' => $poll->load('alternatives'), 'voted' => $userVoted]);
    }

    public function showPolls(){
        $guestId = $this->guestService->getGuestId();

        $polls = Poll::where('user_id', $guestId)->get();

        foreach ($polls as $poll) {
            $poll['time_left'] =  $this->pollService->getRemainingTime($poll);
        }

        return view('polls', ['polls' => $polls]);
    }
    public function store(Request $request){
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'time_limit' => ['required', 'integer', 'min:1'],
            'alternatives' => ['required', 'array', 'min:2', 'max:10'],
            'alternatives.*' => ['required', 'string', 'max:255'],
        ]);
        $data['user_id'] = $this->guestService->getGuestId();
        $poll = Poll::create($data);
        foreach ($data['alternatives'] as $alternative){
            $poll->alternatives()->create(['title' => $alternative]);
        }

        return redirect("/polls/$poll->id");
    }
    public function vote(Alternative $alternative){
        abort_if($alternative->poll->status === 'unactive', 403, 'Essa enquete não está ativa.');

        $userVoted = $this->pollService->userVoted($alternative->poll);
        abort_if($userVoted, 403, 'Você já votou nessa enquete!');

        $this->pollService->vote($alternative);

        return response()->json(['message' => 'Voto realizado com sucesso!']);
    }
}
