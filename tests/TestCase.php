<?php

//namespace Tests;

use Andileong\Taggi\TaggiServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
//    use DatabaseTransactions;
//    use RefreshDatabase;


    protected function getPackageProviders($app)
    {
        return [
            TaggiServiceProvider::class,
        ];
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        // Code before application created.

        parent::setUp();

//        $this->artisan('migrate', [
//            '--database' => 'testbench',
//            '--realpath' => realpath(__DIR__ . '/../migrations' ),
//        ])->run();



//        $this->beforeApplicationDestroyed(function () {
//            $this->artisan('migrate:rollback', ['--database' => 'testbench'])->run();
//        });

        // Code after application created.
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function defineEnvironment($app)
    {

        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        // Setup default database to use sqlite :memory:
//        $app['config']->set('database.default', 'testbench');
//        $app['config']->set('database.connections.testbench', [
//            'driver'   => 'mysql',
//            'database' => 'testbench',
//            'host' => '127.0.0.1',
//            'port' => '3306',
//            'username' => 'root',
//            'password' => '',
//            'prefix'   => '',
//        ]);



    }


//    protected function defineDatabaseMigrations()
//    {
//        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
//    }
}
