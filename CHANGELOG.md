# Changelog

All notable changes to `webrek/laravel-mongo-permission-filament`
are documented here. The format follows
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this
project adheres to
[Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.1.0] - 2026-05-18

### Added
- Initial alpha release.
- `MongoPermissionPlugin` — register the plugin on a Filament v3
  panel via `MongoPermissionPlugin::make()`.
- `RoleResource` with name / guard / team / permissions / parent
  inheritance form, searchable + filterable table.
- `PermissionResource` with name / guard / team form, searchable
  + filterable table that badges wildcard names.

### Known limitations
- No user-side relation manager yet — admins assign roles directly
  from the Role resource for now.
- No team-aware scope filter; multi-tenant panels need to set
  `setPermissionsTeamId()` themselves.
- No tests in the v0.1.0 cut.

[Unreleased]: https://github.com/webrek/laravel-mongo-permission-filament/compare/v0.1.0...HEAD
[0.1.0]: https://github.com/webrek/laravel-mongo-permission-filament/releases/tag/v0.1.0
