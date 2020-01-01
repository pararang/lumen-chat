<?php

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    public $apiResponseStructure = ['code', 'message', 'data'];
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}
