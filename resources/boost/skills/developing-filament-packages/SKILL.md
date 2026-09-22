---
name: developing-filament-packages
description: Use when creating, changing, documenting, testing, auditing, maintaining, migrating, or releasing a MortalKiller Filament package, including public API work, scaffolding/profile choices, GitHub issues, roadmaps, CI, compatibility, security-sensitive behavior, documentation sites, or PlumbPHP release readiness.
---

# Developing Filament Packages

## Core principle

Treat a public package as a maintained product. The canonical standard is Standard v2 in `docs/package-standard.md` from `mortalkiller/filament-package-standard`; read `references/standard-summary.md` for the runtime summary.

A Standard/tooling major is not automatically a package API major. Package SemVer follows consumer-visible API, behavior and support changes.

## Start here

1. Identify the repository and package major. Use permanent `*.x` package branches, temporary work branches and immutable release tags. Do not recreate a separate `main` promotion branch.
2. Read the issue, relevant source/tests, Composer constraints, README, docs and roadmap before changing behavior.
3. Create a focused temporary branch from the affected package major and target that same major in the PR. Meaningful work needs an issue and objective acceptance criteria.
4. Identify whether the task changes consumer behavior or only maintainer tooling. Do not invent a new package major for a Standard/template upgrade alone.

## New packages and scaffold changes

Choose the narrowest real Filament profile and only the capabilities the package owns.

**REQUIRED REFERENCE:** Read `references/scaffolding-and-migration.md` before creating a new package, changing its runtime scaffold, adopting template v2, or migrating an existing package to Standard v2.

Profiles are `plugin`, `theme`, `forms`, `tables`, and `library`. Panel plugin classes belong only to panel-oriented packages. Config, database, views, translations, stubs, assets, Workbench, browser tests and Rector are opt-in capabilities.

Prefer Package Tools for new package service providers. Do not churn an existing working provider solely for conformity.

## API changes

Prefer native Laravel/Filament behavior and a small fluent, predictable API. Preserve backwards compatibility inside a package major.

**REQUIRED REFERENCE:** Read `references/api-review.md` before adding or changing public API. Tests and source-derived documentation are part of the feature.

## Testing and compatibility

Use Larastan as the default Laravel-aware analysis layer for runtime packages, level 6 or higher. A fresh package should not start with a PHPStan baseline. Pure meta/tooling packages may document why Laravel analysis is not useful.

Make PHPUnit/Pest strict: warnings, risky tests and empty suites must fail; randomize order where supported. Use Zizmor for GitHub Actions. Keep external actions/workflows pinned to full commit SHAs.

Test meaningful minimum/latest dependency boundaries. Add intermediate framework combinations when they exercise genuinely different supported lines. Do not turn off Composer security-advisory blocking just to keep an obsolete compatibility claim. Test Windows when filesystem/initializer/shell tooling creates cross-platform risk.

## README contract

Every maintained public package needs a useful README quick start. When creating or materially changing one, preserve this structure unless the package has a concrete reason for a nearby equivalent:

- optional showcase image for visual packages;
- package title, package/CI/license badges and all required PlumbPHP badges;
- concise value proposition;
- an early `## Why` explaining the real problem, reason for the package and scope/non-goals without marketing-only claims;
- `## Documentation` with the canonical docs URL and key guides;
- `## Contents` that includes `Why` and accurately links important README sections;
- `## Features` based on source/tests;
- screenshots/demo guidance when meaningful visual behavior exists;
- version compatibility or requirements;
- installation;
- first useful example plus package-specific configuration/usage;
- Roadmap, Security and license/credits near the end.

Add migration/upgrade, troubleshooting, testing/contributing, changelog and sponsorship/support sections only when relevant. Keep Contents synchronized. The README is a quick start, not a duplicate of the full docs site.

## Documentation and privacy

Derive API docs from source and tests, not old README assumptions. Use fictional examples; never publish private consumers, infrastructure, credentials, tokens, hosts, SSH details, real container names, paths or screenshots. Keep the roadmap future-only.

PRs and pushes validate docs only. Stable releases publish the exact tag into its package-major channel and update Latest only when semantically newest. Prereleases, old majors and stale reruns cannot replace newer stable documentation. Manual publication defaults to a dry run of an existing release.

## Verification

Run CI-equivalent checks and test every declared compatibility boundary. Include JavaScript/browser/Workbench tests only where relevant. Run the package-standard checker. External workflow calls and their tooling must share a validated full template SHA; template branch updates are not adopted automatically.

## Releases

**REQUIRED REFERENCE:** Read `references/release-checklist.md` before preparing or publishing a release.

Inspect the previous tag on the same package major → exact release-commit diff. After review and successful exact-commit CI, create a new `vX.Y.Z` tag on `X.x` and publish its GitHub Release. Do not move or recreate a published tag. Keep the default branch on the newest stable package major; change it only when the next package major is stable.

Do not claim release completion without applicable checks, public docs verification and fresh PlumbPHP evidence:

- Ecosystem 100
- Maintenance 100
- Security 100
- Composite 100

Never weaken security, compatibility, tests or architecture to satisfy a scanner. Distinguish stale scans and unexecuted live publication from verified results.

## Laravel Boost distribution

This maintainer skill is published from `resources/boost/skills/developing-filament-packages`, the Laravel Boost third-party skill convention. When `mortalkiller/filament-package-standard` is a direct dependency of a real Laravel application and Laravel Boost is installed, `php artisan boost:update` can discover and sync it to configured skills-capable agents. In standalone package repositories, do not rely on Testbench for Boost discovery; read this skill directly from the installed vendor path referenced by `AGENTS.md`.

Public packages consume this maintainer skill through the dedicated Standard package rather than copying it. A package may additionally provide its own consumer-facing skill under `resources/boost/skills/<skill-name>/` when that improves correct package usage. Do not rely on transitive dependency discovery.
