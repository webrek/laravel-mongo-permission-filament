<?php

namespace Webrek\MongoPermissionFilament\Tests\Feature;

use Livewire\Livewire;
use Webrek\MongoPermission\Models\Permission;
use Webrek\MongoPermissionFilament\Resources\PermissionResource\Pages\CreatePermission;
use Webrek\MongoPermissionFilament\Tests\TestCase;

class PermissionResourceTest extends TestCase
{
    public function test_a_permission_can_be_created(): void
    {
        Livewire::test(CreatePermission::class)
            ->fillForm(['name' => 'edit-posts', 'guard_name' => 'web'])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertNotNull(Permission::query()->where('name', 'edit-posts')->first());
    }
}
