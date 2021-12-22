<?php
declare(strict_types=1);

namespace App\Services\Animals;

class CheckParametersServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->bind('checkParameters', 'App\Services\Animals\CheckParameters');
    }
}
