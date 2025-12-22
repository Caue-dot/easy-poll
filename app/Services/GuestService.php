<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class GuestService
{

    public function getGuestId(): string | null{
        return request()->cookie('guest-id');
    }
    public function generateGuestIdIfDoesntExist(): void{
        $guestId = $this->getGuestId();

        if(!$guestId){
            Cookie::queue(Cookie::make('guest-id', Str::uuid()->toString(), 60 * 24 * 30));
        }
    }
}
