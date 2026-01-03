<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollStoreRequest;
use App\Models\Alternative;
use App\Models\Poll;
use App\Services\UserService;
use App\Services\PollService;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function __construct(private readonly PollService  $pollService,
                                private readonly  UserService $guestService)
    {
        $this->guestService->generateGuestIdIfDoesntExist();
    }

    public function showCreatePoll(){
        return view('poll-store');
    }
    public function show(Poll $poll){
        $isExpired = $this->pollService->isPollExpired($poll);
        $userVoted = $this->pollService->userVoted($poll);
        $canVote = !($isExpired || $userVoted || $this->pollService->canGuestUserVote($poll));

        return view('poll',
            [
                'poll' => $poll->load('alternatives'),
                'canVote' => $canVote,
                'isExpired' => $isExpired,
                'userVoted' => $userVoted]);
    }

    public function showPolls(){
        $userId = $this->guestService->getUserId();

        $polls = Poll::where('user_id', $userId)->get();

        foreach ($polls as $poll) {
            $poll['time_left'] =  $this->pollService->getRemainingTime($poll);
        }

        return view('polls', ['polls' => $polls]);
    }
    public function store(PollStoreRequest $request){
        $data = $request->validated();
        $data['user_id'] = $this->guestService->getUserId();
        $poll = Poll::create($data);
        foreach ($data['alternatives'] as $alternative){
            $poll->alternatives()->create(['title' => $alternative]);
        }

        return redirect("/polls/$poll->id");
    }
    public function vote(Alternative $alternative){
        abort_if($alternative->poll->status === 'unactive', 403, 'Essa enquete não está ativa.');

        $poll = $alternative->poll;
        $userVoted = $this->pollService->userVoted($poll);
        $isPollExpired = $this->pollService->isPollExpired($poll);

        abort_if($userVoted, 403, 'Você já votou nessa enquete!');
        abort_if($isPollExpired, 403, 'Essa enquete está expirada');
        abort_if($this->pollService->canGuestUserVote($poll), 403, 'Essa enquete requer que você esteja logado!');

        $this->pollService->vote($alternative);

        return response()->json(['message' => 'Voto realizado com sucesso!']);
    }
}
