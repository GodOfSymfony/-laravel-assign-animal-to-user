<?php
declare(strict_types=1);

namespace App\Services\Animals;

class CheckParametersService extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'checkParameters';
    }
}
