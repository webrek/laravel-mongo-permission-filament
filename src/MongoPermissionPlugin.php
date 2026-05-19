<?php

namespace Webrek\MongoPermissionFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Webrek\MongoPermissionFilament\Resources\RoleResource;
use Webrek\MongoPermissionFilament\Resources\PermissionResource;

/**
 * Register the plugin in a Filament panel:
 *
 *     use Webrek\MongoPermissionFilament\MongoPermissionPlugin;
 *
 *     public function panel(Panel $panel): Panel
 *     {
 *         return $panel->plugins([
 *             MongoPermissionPlugin::make(),
 *         ]);
 *     }
 */
class MongoPermissionPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'webrek-mongo-permission';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            RoleResource::class,
            PermissionResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
