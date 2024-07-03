<?php

use App\Jobs\ReportMailJob;
use App\Jobs\SendMailJob;
use App\Mail\ReportMail;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->call(function(){
            $infos=[
                "usersCount"=> User::count(),
                "postsCount"=> Post::count(),
                "categoriesCount"=> Category::count()
            ];
            ReportMailJob::dispatch("m.erenyilmaz2007@gmail.com", $infos);
        })->daily();
        $schedule->command("queue:work-daily")->daily();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
