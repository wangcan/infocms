<?php

namespace App\Observers;

use App\Models\Token;
use App\Models\User;

class DemoObserver
{
    /**
     * Listen to the User creating event.
     */
    public function creating(User $user): void
    {
        $user->registered_at = now();
        $user->api_token = Token::generate();
    }
}
