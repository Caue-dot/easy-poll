<?php

namespace App\Http\Controllers;

use App\Events\VoteEvent;
use App\Models\Alternative;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class PollController extends Controller
{
    public function showCreatePoll(){
        return view('poll-store');
    }
    public function get(Request $request, Poll $poll){
        $guestId = $request->cookie('guest-id');
        $userVoted = $poll->votes()->where('user_id', $guestId)->exists();

        return view('poll', ['poll' => $poll->load('alternatives'), 'voted' => $userVoted]);
    }
    public function store(Request $request){
//        Redis::append()
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'time_limit' => ['required', 'integer', 'min:1'],
            'alternatives' => ['required', 'array', 'min:2', 'max:10'],
            'alternatives.*' => ['required', 'string', 'max:255'],
        ]);

        $poll = Poll::create($data);
        foreach ($data['alternatives'] as $alternative){
            $poll->alternatives()->create(['title' => $alternative]);
        }

        return redirect("/polls/$poll->id");
    }
    public function vote(Request $request, Alternative $alternative){
        abort_if($alternative->poll->status === 'unactive', 403, 'Essa enquete não está ativa.');
        $poll = $alternative->poll;

        $guestId = $request->cookie('guest-id');
        $newUser = false;
        if(!$guestId){
            $guestId = Str::uuid()->toString();
            $newUser = true;
        }

        if($poll->votes()->where('user_id', $guestId)->exists()){
            abort(403, 'Você já votou nessa enquete!');
        }
        broadcast(new VoteEvent($alternative))->toOthers();
        $alternative->increment('votes_count');
        $poll->votes()->create(['user_id' => $guestId]);

        if($newUser){
            return response()->json()->cookie("guest-id", $guestId, 60 * 24 * 30);
        }

    }
}
