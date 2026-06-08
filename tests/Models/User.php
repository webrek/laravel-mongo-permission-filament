<?php

namespace Webrek\MongoPermissionFilament\Tests\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use MongoDB\Laravel\Eloquent\Model;

class User extends Model implements AuthenticatableContract, FilamentUser
{
    use Authenticatable;

    protected $connection = 'mongodb';

    protected $collection = 'users';

    protected $guarded = [];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
