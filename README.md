# Filament Package Standard

[![Package tests](https://github.com/mortalkiller/filament-package-standard/actions/workflows/tests.yml/badge.svg?branch=2.x)](https://github.com/mortalkiller/filament-package-standard/actions/workflows/tests.yml)
[![Code quality](https://github.com/mortalkiller/filament-package-standard/actions/workflows/quality.yml/badge.svg?branch=2.x)](https://github.com/mortalkiller/filament-package-standard/actions/workflows/quality.yml)
[![Zizmor](https://github.com/mortalkiller/filament-package-standard/actions/workflows/zizmor.yml/badge.svg?branch=2.x)](https://github.com/mortalkiller/filament-package-standard/actions/workflows/zizmor.yml)

Canonical engineering standard and Laravel Boost skill for maintaining MortalKiller Filament packages.

The `2.x` line aligns the maintainer standard with `filament-package-template` v2: profile-aware scaffolding, conditional capabilities, Larastan, strict test behavior, Zizmor and evidence-based compatibility boundaries.

This package is development tooling. It has no Laravel or Filament runtime integration and no service provider.

## Purpose

- Own MortalKiller Filament Package Standard v2.
- Distribute the `developing-filament-packages` skill through Laravel Boost.
- Keep package-maintenance guidance versioned independently from the package template.
- Prevent template/Standard tooling majors from being confused with consumer package SemVer.

## Installation

After Standard v2 is released, install it as a direct development dependency:

```bash
composer require --dev mortalkiller/filament-package-standard:^2.0
```

The Standard package itself supports PHP 8.2+.

In a standalone package repository, agents read the installed skill directly from:

```text
vendor/mortalkiller/filament-package-standard/resources/boost/skills/developing-filament-packages/SKILL.md
```

In a real Laravel application that also installs Laravel Boost, `php artisan boost:update` can discover the Standard as a direct Composer dependency and synchronize the skill to supported agents.

Transitive dependencies are intentionally not relied on for skill discovery.

## Documentation

- [Package Standard v2](docs/package-standard.md)
- [Migrating to Standard v2](docs/migrating-to-v2.md)
- [Development and release flow](docs/development-flow.md)
- [Release checklist](docs/releasing.md)

## Relationship to the template

`mortalkiller/filament-package-template` owns repository scaffolding, profiles/capabilities, the initializer, reusable GitHub Actions, documentation infrastructure and mechanical package checks.

Standard v2 aligns with template `2.x`. A generated package still starts on its own package branch `1.x`; template/Standard major numbers do not determine the package major.

This package owns maintainer policy and the agent skill.

## License

MIT. See [LICENSE.md](LICENSE.md).
