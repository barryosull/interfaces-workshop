<?php

namespace Tests;

use Artisan;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    private static $db_was_reset = false;

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $this->prepareDB();

        return $app;
    }

    public function prepareDB()
    {
        if (self::$db_was_reset) {
            return;
        }
        Artisan::call("migrate:fresh");
        self::$db_was_reset = true;
    }
}
