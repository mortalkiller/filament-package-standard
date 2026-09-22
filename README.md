# Filament Package Standard

[![Package tests](https://github.com/mortalkiller/filament-package-standard/actions/workflows/tests.yml/badge.svg?branch=1.x)](https://github.com/mortalkiller/filament-package-standard/actions/workflows/tests.yml)
[![Code quality](https://github.com/mortalkiller/filament-package-standard/actions/workflows/quality.yml/badge.svg?branch=1.x)](https://github.com/mortalkiller/filament-package-standard/actions/workflows/quality.yml)

Canonical engineering standard and Laravel Boost skill for maintaining MortalKiller Filament packages.

This package is development tooling. It has no Laravel or Filament runtime integration and no service provider.

## Purpose

- Own MortalKiller Filament Package Standard v1.
- Distribute the `developing-filament-packages` skill through Laravel Boost.
- Keep package-maintenance guidance versioned independently from the package template.

## Installation

Install this package as a direct development dependency:

```bash
composer require --dev mortalkiller/filament-package-standard
```

In a standalone package repository, agents should read the installed skill directly from:

```text
vendor/mortalkiller/filament-package-standard/resources/boost/skills/developing-filament-packages/SKILL.md
```

In a real Laravel application that also installs Laravel Boost, `php artisan boost:update` can discover the Standard as a direct Composer dependency and synchronize the skill to supported agents.

The skill is distributed from:

```text
resources/boost/skills/developing-filament-packages/
```

Transitive dependencies are intentionally not relied on for skill discovery.

## Documentation

- [Package Standard v1](docs/package-standard.md)
- [Development and release flow](docs/development-flow.md)
- [Release checklist](docs/releasing.md)

## Relationship to the template

`mortalkiller/filament-package-template` owns repository scaffolding, the initializer, reusable GitHub Actions, documentation infrastructure, and mechanical package checks.

This package owns the maintainer standard and agent skill.

## License

MIT. See [LICENSE.md](LICENSE.md).
