<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\User;
use App\Models\Booking;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-event', function (User $user, Event $event) {
            return $user->id == $event->user_id;
        });

        Gate::define('cancel-booking', function (User $user,  Booking $booking) {
            // dd($user->id, $booking->user_id);
            return $user->id == $booking->user_id;
        });
    }
}
