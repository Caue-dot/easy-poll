<?php

use App\Models\Poll;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function (){
    $polls = Poll::where('status', 'active')->get();
    foreach($polls as $poll){
        $timePassed = $poll->created_at->diffInHours(\Carbon\Carbon::now(), false);
        if($timePassed >= $poll->time_limit){
            $poll->status = 'unactive';
            $poll->save();
        }
    }
})->hourly();
