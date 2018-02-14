<?php

namespace Tests;

use Artisan;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $this->resetDB();
        
        return $app;
    }

    private static $has_reset_dB = false;

    public function resetDB()
    {
        if (self::$has_reset_dB) {
            return;
        }
        Artisan::call("migrate:fresh",  ["--seed"=>true]);
        self::$has_reset_dB = true;
    }
}
