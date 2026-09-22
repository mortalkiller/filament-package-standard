# Scaffolding and Standard v2 migration

Use this reference before creating a package, changing its runtime scaffold, adopting template v2, or migrating an existing package to Standard v2.

## Choose a profile

Use the narrowest runtime dependency that matches real behavior:

- `plugin`: panel-level integration → `filament/filament` and a Filament `Plugin`;
- `theme`: panel theme integration → `filament/filament`, a Filament `Plugin`, and assets;
- `forms`: Forms-focused package → `filament/forms`, no panel plugin;
- `tables`: Tables-focused package → `filament/tables`, no panel plugin;
- `library`: support/shared abstractions → `filament/support`, no panel plugin.

Do not depend on the full Filament package at runtime solely because a demo needs a panel. Workbench may use `filament/filament` in `require-dev`.

## Choose capabilities

Only add capabilities owned by the package:

- config;
- database migrations/factories;
- views;
- translations;
- stubs;
- frontend assets/build;
- Workbench;
- browser tests;
- Rector.

Browser tests imply Workbench. Themes imply assets. A package without browser-visible behavior does not need Playwright.

## Provider and plugin

New runtime packages should prefer a small `spatie/laravel-package-tools` `PackageServiceProvider`.

Use a Filament `Plugin` class only when the package registers/configures panel behavior. Keep the public API small and fluent.

For existing packages, do not refactor a working service provider or invent a plugin class just to resemble the template. Runtime migrations need a behavior reason and tests.

## Migrate Standard v1 → v2

Tooling-only adoption can stay on the current package major.

Apply, as relevant:

1. `.editorconfig`;
2. Larastan level 6+ instead of raw PHPStan;
3. strict randomized PHPUnit/Pest;
4. Zizmor;
5. minimum/latest compatibility CI;
6. Windows only for cross-platform-sensitive tooling;
7. reviewed template `2.x` workflow SHA;
8. direct `mortalkiller/filament-package-standard:^2.0` dependency after release;
9. Standard v2 docs/skill references.

Do not lower security or disable Composer advisory blocking to keep an old dependency claim green.

A consumer package needs a new major only when the actual migration also introduces an incompatible API, runtime behavior or support-range change.
