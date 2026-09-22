# Changelog

All notable changes to Filament Package Standard are documented here.

The project follows Semantic Versioning.

## [Unreleased]

### Added

- Define MortalKiller Filament Package Standard v2.
- Align package profiles and conditional capabilities with `filament-package-template` v2.
- Make Larastan level 6+ the default Laravel-aware analysis policy for runtime packages.
- Require strict test-runner behavior, root `.editorconfig`, Zizmor and evidence-based compatibility boundaries.
- Add Standard v1 → v2 migration guidance and a scaffolding/migration skill reference.
- Clarify that a Standard/tooling major does not by itself require a consumer package major.

### Changed

- Lower the Standard package's own PHP requirement from 8.3 to 8.2.

## [1.0.1] - 2026-09-22

### Fixed

- Correct standalone package guidance: Testbench is not the Laravel Boost project root, so package repositories read the installed maintainer skill directly from the Standard dependency instead of relying on `vendor/bin/testbench boost:update`.

## [1.0.0] - 2026-09-22

### Added

- MortalKiller Filament Package Standard v1.
- Laravel Boost-discoverable `developing-filament-packages` skill.
- API review, release checklist, and quick-reference skill resources.
- Major-only development and immutable release guidance.
- Packagist version immutability guidance.
