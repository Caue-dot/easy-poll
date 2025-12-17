<?php

namespace App\Http\Controllers;

use App\Events\VoteEvent;
use App\Models\Alternative;
use App\Models\Poll;
use Illuminate\Http\Request;
use PHPUnit\Util\Test;

class PollController extends Controller
{
    public function showCreatePoll(){
        return view('poll-store');
    }
    public function get(Poll $poll){
//        abort_if($poll->status === 'unactive', 403);
        return view('poll', ['poll' => $poll->load('alternatives')]);
    }
    public function store(Request $request){
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
        $pollId = $alternative->poll->id;
        if($request->cookie("voted_$pollId")){
            abort(403, 'Você já votou nessa enquete!');
        }
        broadcast(new VoteEvent($alternative))->toOthers();
        $alternative->increment('votes_count');
        return response()->json()->cookie("voted_$pollId", true, 60 * 24 * 30);

    }
}
