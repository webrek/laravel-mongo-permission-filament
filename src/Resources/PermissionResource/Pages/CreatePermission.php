<?php

namespace Webrek\MongoPermissionFilament\Resources\PermissionResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Webrek\MongoPermissionFilament\Resources\PermissionResource;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
}
