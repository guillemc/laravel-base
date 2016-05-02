<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        if (Schema::hasColumn($user->getTable(), 'last_login')) {
            DB::table($user->getTable())
                    ->where('id', $user->id)
                    ->update(['last_login' => $user->freshTimestamp()]);
        }
    }
}
