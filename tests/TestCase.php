<?php

namespace Webrek\MongoPermissionFilament\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Webrek\MongoPermissionFilament\MongoPermissionFilamentServiceProvider;
use Webrek\MongoPermissionFilament\Tests\Models\User;
use Webrek\MongoPermissionFilament\Tests\Panel\AdminPanelProvider;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->flushMongo();
        $this->actingAs(User::create(['name' => 'Admin']));
    }

    protected function getPackageProviders($app): array
    {
        return [
            \Livewire\LivewireServiceProvider::class,
            \BladeUI\Icons\BladeIconsServiceProvider::class,
            \BladeUI\Heroicons\BladeHeroiconsServiceProvider::class,
            \Filament\Support\SupportServiceProvider::class,
            \Filament\Actions\ActionsServiceProvider::class,
            \Filament\Forms\FormsServiceProvider::class,
            \Filament\Tables\TablesServiceProvider::class,
            \Filament\Notifications\NotificationsServiceProvider::class,
            \Filament\Infolists\InfolistsServiceProvider::class,
            \Filament\Widgets\WidgetsServiceProvider::class,
            \Filament\FilamentServiceProvider::class,
            \MongoDB\Laravel\MongoDBServiceProvider::class,
            \Webrek\MongoPermission\MongoPermissionServiceProvider::class,
            MongoPermissionFilamentServiceProvider::class,
            AdminPanelProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('app.key', 'base64:' . base64_encode(str_repeat('a', 32)));
        $app['config']->set('database.default', 'mongodb');
        $app['config']->set('database.connections.mongodb', [
            'driver' => 'mongodb',
            'host' => env('MONGO_DB_HOST', '127.0.0.1'),
            'port' => (int) env('MONGO_DB_PORT', 27017),
            'database' => env('MONGO_DB_DATABASE', 'permission_test'),
            'options' => [],
        ]);
        $app['config']->set('auth.providers.users.model', User::class);
    }

    protected function flushMongo(): void
    {
        $db = $this->app['db']->connection('mongodb')->getMongoDB();
        $name = $db->getDatabaseName();
        if (! str_ends_with($name, '_test')) {
            throw new \RuntimeException("flushMongo refuses to drop non-test database '{$name}'.");
        }
        foreach ($db->listCollectionNames() as $coll) {
            $db->dropCollection($coll);
        }
    }
}
