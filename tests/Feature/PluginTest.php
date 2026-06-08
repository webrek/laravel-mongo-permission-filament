<?php

namespace Webrek\MongoPermissionFilament\Tests\Feature;

use Filament\Facades\Filament;
use Webrek\MongoPermission\Models\Permission;
use Webrek\MongoPermission\Models\Role;
use Webrek\MongoPermissionFilament\MongoPermissionPlugin;
use Webrek\MongoPermissionFilament\Resources\PermissionResource;
use Webrek\MongoPermissionFilament\Resources\RoleResource;
use Webrek\MongoPermissionFilament\Tests\TestCase;

class PluginTest extends TestCase
{
    public function test_plugin_id(): void
    {
        $this->assertSame('webrek-mongo-permission', MongoPermissionPlugin::make()->getId());
    }

    public function test_resources_are_bound_to_the_mongo_models(): void
    {
        $this->assertSame(Role::class, RoleResource::getModel());
        $this->assertSame(Permission::class, PermissionResource::getModel());
    }

    public function test_plugin_registers_both_resources_on_the_panel(): void
    {
        $resources = Filament::getPanel('admin')->getResources();

        $this->assertContains(RoleResource::class, $resources);
        $this->assertContains(PermissionResource::class, $resources);
    }
}
