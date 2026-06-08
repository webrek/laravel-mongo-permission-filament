<?php

namespace Webrek\MongoPermissionFilament\Tests\Panel;

use Filament\Panel;
use Filament\PanelProvider;
use Webrek\MongoPermissionFilament\MongoPermissionPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->plugin(MongoPermissionPlugin::make());
    }
}
