<?php

namespace App\Observers;

use App\Models\Token;
use App\Models\User;
use App\Repositories\Enums\CacheEnum;
use App\Repositories\Models\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    /**
     * Listen to the User creating event.
     */
    public function creating(User $user): void
    {
        $user->registered_at = now();
        $user->api_token = Token::generate();
    }
{
    public function updated(User $user)
    {
        Cache::forget(CacheEnum::getCacheKey(CacheEnum::AUTHORIZATION_USER));
    }

    public function deleted(User $user)
    {
        Cache::forget(CacheEnum::getCacheKey(CacheEnum::AUTHORIZATION_USER));
    }
}
