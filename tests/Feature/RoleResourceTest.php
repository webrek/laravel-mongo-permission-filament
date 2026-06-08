<?php

namespace Webrek\MongoPermissionFilament\Tests\Feature;

use Livewire\Livewire;
use Webrek\MongoPermission\Models\Permission;
use Webrek\MongoPermission\Models\Role;
use Webrek\MongoPermissionFilament\Resources\RoleResource\Pages\CreateRole;
use Webrek\MongoPermissionFilament\Tests\TestCase;

class RoleResourceTest extends TestCase
{
    public function test_a_role_can_be_created_with_permissions(): void
    {
        $permission = Permission::create(['name' => 'edit-posts']);

        Livewire::test(CreateRole::class)
            ->fillForm([
                'name' => 'editor',
                'guard_name' => 'web',
                'permission_ids' => [(string) $permission->getKey()],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $role = Role::query()->where('name', 'editor')->first();
        $this->assertNotNull($role);
        $this->assertSame([(string) $permission->getKey()], $role->permission_ids);
    }
}
