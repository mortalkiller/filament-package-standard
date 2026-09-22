# Migrating a package to Standard v2

Standard v2 is primarily a maintainer/tooling upgrade. **Changing from Standard v1 to v2 does not by itself require a new major release of the package.**

Choose the package's Semantic Version from consumer-visible effects:

- no public API/runtime behavior/support change → normal maintenance release or include the tooling migration with the next compatible release;
- compatible runtime improvement → MINOR or PATCH according to the package change;
- incompatible API, behavior or supported-platform change → MAJOR.

## Migration sequence

1. Work from the package's existing maintained `N.x` branch on a temporary `chore/*` or `refactor/*` branch.
2. Add/update the root `.editorconfig`.
3. Move Laravel-aware static analysis to Larastan, level 6 or higher unless the repository has a documented exception.
4. Tighten PHPUnit/Pest so warnings, risky tests and empty suites fail; randomize order where supported.
5. Add Zizmor for GitHub Actions and keep every external action/workflow pinned to a full commit SHA.
6. Verify meaningful minimum/latest dependency combinations. Add Windows CI only when package tooling/filesystem behavior is cross-platform-sensitive.
7. Update shared workflow references to a validated template `2.x` commit in a separate, reviewable change where practical.
8. After Standard v2 is published, change the direct development dependency to `mortalkiller/filament-package-standard:^2.0`.
9. Update `AGENTS.md`, contributing guidance and docs references to Standard v2.
10. Run package CI, privacy/public-content checks and the package-standard checker before merging.

## Runtime scaffold migration

Do not refactor an existing working package merely to look like template v2.

Adopt `spatie/laravel-package-tools` when it makes package-owned config, migrations, translations, views, install commands or bootstrapping simpler without changing behavior. Keep an existing native service provider when a migration would be churn-only.

Add a Filament `Plugin` class only for packages that actually integrate at panel level. Forms-only, tables-only or support/library packages should keep the narrowest runtime dependency and should not manufacture a panel plugin abstraction.

Workbench, assets, browser tests, Rector, config, database, views, translations and stubs remain capabilities, not mandatory folders.

## PHP compatibility

Standard v2 itself supports PHP 8.2+, matching the template v2 minimum runtime boundary. This removes the Standard v1 mismatch where maintainer tooling required PHP 8.3 even when a package runtime could support PHP 8.2.

A package may still choose a higher minimum PHP version when its own runtime code or dependencies require it. Declare only what CI proves.

## Completion

The migration is complete when the package retains its existing consumer behavior (unless a separately documented change intentionally modifies it), Standard v2 checks pass, compatibility claims are evidence-based, and no unnecessary runtime dependency or scaffold was introduced.
