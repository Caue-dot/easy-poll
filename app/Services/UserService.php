<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class UserService
{

    public function getGuestId(): string | null{
        return request()->cookie('guest-id');
    }
    public function generateGuestIdIfDoesntExist(): void{
        $guestId = $this->getGuestId();

        if(!$guestId && !Auth::id()){
            Cookie::queue(Cookie::make('guest-id', Str::uuid()->toString(), 60 * 24 * 30));
        }
    }

    public function getUserId(): string | null{
        if(Auth::id()){
            return Auth::id();
        }

        return $this->getGuestId();
    }
}
