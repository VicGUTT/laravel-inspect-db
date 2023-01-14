<?php

declare(strict_types=1);

namespace VicGutt\InspectDb\Tests;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as Orchestra;
use VicGutt\InspectDb\InspectDbServiceProvider;

abstract class TestCase extends Orchestra
{
    protected const DEFAULT_CONNECTION = 'mysql';

    protected static bool $migrationsLoaded = false;

    protected bool $runningInGithubCi = false;

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', self::DEFAULT_CONNECTION);
        config()->set('database.connections.sqlite.database', $this->getTestSupportDirectory('/database/database.sqlite'));
        config()->set('database.connections.mysql', [
            ...config('database.connections.mysql'),
            'database' => env('DB_MYSQL_DATABASE', 'laravel_inspect_db_testing'),
            'username' => env('DB_MYSQL_USER', 'root'),
            'password' => env('DB_MYSQL_PASSWORD', null),
        ]);
        config()->set('database.connections.pgsql', [
            ...config('database.connections.pgsql'),
            'database' => env('DB_POSTGRES_DATABASE', 'laravel_inspect_db_testing'),
            'username' => env('DB_POSTGRES_USER', 'postgres'),
            'password' => env('DB_POSTGRES_PASSWORD', 'root'),
        ]);
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            InspectDbServiceProvider::class,
        ];
    }

    protected function loadMigrations(): void
    {
        $connections = include $this->getTestDirectory('/Datasets/testable_connections.php');

        foreach ($connections as $connection) {
            $this->loadMigrationsFromConnection(DB::connection($connection));
        }

        self::$migrationsLoaded = true;
    }

    protected function loadMigrationsFromConnection(Connection $connection): void
    {
        $connection->getSchemaBuilder()->dropAllTables();

        foreach (File::files($this->getTestSupportDirectory('/database/migrations')) as $file) {
            config()->set('database.default', $connection->getName());

            (include $file->getRealPath())->up($connection->getName());
        }

        config()->set('database.default', self::DEFAULT_CONNECTION);
    }

    protected function getTestSupportDirectory(string $path = ''): string
    {
        return $this->getTestDirectory("/TestSupport/{$path}");
    }

    protected function getTestDirectory(string $path = ''): string
    {
        return str_replace(['\\', '//'], '/', realpath(__DIR__) . '/' . $path);
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->runningInGithubCi = env('GITHUB_CI', false);

        if (self::$migrationsLoaded) {
            return;
        }

        $this->loadMigrations();
    }
}
