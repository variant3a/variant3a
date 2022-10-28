<?php

namespace App\Providers;

use App\Services\CalendarService;
use Google\Client;
use Google_Service_Calendar;
use Google_Service_Oauth2;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CalendarService::class, function () {
            $client = new Client([
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'redirect_uri' => config('services.google.redirect')
            ]);
            $oauth_service = new Google_Service_Oauth2($client);
            $calendar_service = new Google_Service_Calendar($client);
            return new CalendarService($client, $oauth_service, $calendar_service);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
