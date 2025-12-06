<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Person;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $popularPeople = Person::withCount(['likes'])
        ->having('likes_count', '>', 50)
        ->get();

    foreach ($popularPeople as $person) {
        Mail::raw(
            "{$person->name} has been liked more than 50 times!",
            function ($msg) {
                $msg->to('alfiansuwandi.as@gmail.com')->subject('Popularity Alert');
            }
        );
    }
    Log::info('Scheduler run at ' . now());
})->everyMinute();