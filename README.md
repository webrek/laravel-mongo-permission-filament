# webrek/laravel-mongo-permission-filament

[Filament v3](https://filamentphp.com) panel resources for
[`webrek/laravel-mongo-permission`](https://github.com/webrek/laravel-mongo-permission).

## Status

**v0.1.0 — alpha.** The plugin ships working Role and Permission
resources for a Filament panel. Forms support name, guard, team
scope, attached permissions, and (for roles) parent-role
inheritance. Tables surface row counts and badge wildcard
permissions.

What is **not** in v0.1.0 yet:

- A relation manager on the User resource (assign roles/permissions
  to a user from the user edit page).
- A team-aware scope filter on the panel.
- Bulk wildcard warnings on permission creation.
- Tests against a real Filament panel.

Contributions welcome — see "Roadmap" below.

## Requirements

| Dependency | Version |
|---|---|
| PHP | 8.1+ |
| Laravel | 10.x / 11.x / 12.x |
| Filament | 3.x |
| `webrek/laravel-mongo-permission` | ^1.0 |

## Install

```bash
composer require webrek/laravel-mongo-permission-filament
```

Register the plugin on your Filament panel:

```php
use Webrek\MongoPermissionFilament\MongoPermissionPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            MongoPermissionPlugin::make(),
        ]);
}
```

The plugin adds two resources under an "Access control" navigation
group: **Roles** and **Permissions**.

## What the resources do

### Roles

- **Create / edit** a role with name, guard, optional `team_id`.
- **Attach permissions** via a multi-select pulling from the Mongo
  permissions collection.
- **Inheritance:** pick parent roles via a multi-select; the
  underlying package walks the chain at lookup time.
- **List:** searchable by name, sortable by guard. Permission and
  parent counts are shown inline.

### Permissions

- **Create / edit** with name, guard, optional `team_id`.
- Names containing `*` are visually badged so operators notice
  wildcard creation.
- **List:** searchable, sortable, filterable by guard.

## Roadmap

The plugin is intentionally minimal in v0.1.0. Future work:

1. **User relation manager** — a relation manager you can plug into
   your own `UserResource` so admins can attach / detach roles and
   permissions on a user without leaving the user record. Will
   honor team context and surface expiry on each grant.
2. **Team filter** — a panel-level filter that scopes all resource
   queries to the current team, integrating with the package's
   `setPermissionsTeamId` and `team-context` middleware.
3. **TTL grant UI** — assign-until widget in the relation manager
   for v1.1 expiring grants.
4. **Bulk-import** — UI wrapper around `permission:migrate-from-spatie`.
5. **Filament panel tests** with `pestphp/pest-plugin-laravel` or
   PHPUnit + Livewire test helpers.

Open an issue or PR with proposals.

## License

MIT
