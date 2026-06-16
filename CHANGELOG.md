# Changelog

All notable changes to `webrek/laravel-mongo-permission-filament`
are documented here. The format follows
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this
project adheres to
[Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.1.0] - 2026-06-16

### Added
- Laravel 13 support. Filament 3 and `webrek/laravel-mongo-permission` 1.7 both
  run on Laravel 13; the package now installs on Laravel 12 and 13 (PHP 8.2+).

## [1.0.0] - 2026-06-08

### Added
- Test suite (Filament panel + Livewire) covering the Role and Permission
  resources: list pages render, records can be created, and edit pages load
  their existing data.
- GitHub Actions CI (PHP 8.2/8.3/8.4 against Laravel 12, with a MongoDB service)
  plus PHPStan (level 5).

### Changed
- Target **Laravel 12 / PHP 8.2+** and require
  `webrek/laravel-mongo-permission` `^1.5` (legacy flat-data fix + cache
  invalidation).

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

[Unreleased]: https://github.com/webrek/laravel-mongo-permission-filament/compare/v1.1.0...HEAD
[1.1.0]: https://github.com/webrek/laravel-mongo-permission-filament/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/webrek/laravel-mongo-permission-filament/compare/v0.1.0...v1.0.0
[0.1.0]: https://github.com/webrek/laravel-mongo-permission-filament/releases/tag/v0.1.0
