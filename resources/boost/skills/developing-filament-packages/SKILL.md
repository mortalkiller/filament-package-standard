---
name: developing-filament-packages
description: Use when creating, changing, documenting, testing, auditing, maintaining, or releasing a MortalKiller Filament package, including public API work, GitHub issues, roadmaps, CI, compatibility, security-sensitive behavior, documentation sites, or PlumbPHP release readiness.
---

# Developing Filament Packages

## Core principle

Treat a public package as a maintained product. The canonical standard is `docs/package-standard.md` in `mortalkiller/filament-package-standard`; read `references/standard-summary.md` for the runtime summary.

## Start here

1. Identify the repository and package major. Use the major-only flow: permanent `*.x` branches, temporary work branches, and immutable release tags. Do not recreate a separate `main` promotion branch.
2. Read the issue, relevant source/tests, Composer constraints, README, docs and roadmap before changing behavior.
3. Create a focused temporary branch from the affected major and target that major in the PR. Meaningful work needs an issue and objective acceptance criteria.

## API changes

Prefer native Laravel/Filament behavior and a small fluent, predictable API. Preserve backwards compatibility inside a major.

**REQUIRED REFERENCE:** Read `references/api-review.md` before adding or changing public API. Tests and source-derived documentation are part of the feature.

## README contract

Every maintained public package needs a useful README quick start. When creating or materially changing one, preserve this structure unless the package has a concrete reason for a nearby equivalent:

- optional showcase image for visual packages;
- package title, package/CI/license badges and all required PlumbPHP badges;
- concise value proposition;
- an early `## Why` section explaining the real problem, the reason for the package, and its scope/non-goals without marketing-only claims;
- `## Documentation` with the canonical docs URL and key guides;
- `## Contents` that includes `Why` and accurately links the important README sections;
- `## Features` based on source/tests;
- screenshots/demo guidance when the package has meaningful visual behavior;
- version compatibility or requirements;
- installation;
- first useful example plus package-specific configuration/usage;
- Roadmap, Security and license/credits near the end.

Add migration/upgrade, troubleshooting, testing/contributing, changelog and sponsorship/support sections when relevant. Do not add empty sections only to satisfy a template. Keep Contents synchronized whenever headings change. The README is a quick start, not a duplicate of the full docs site, but the docs site does not replace these README essentials.

## Documentation and privacy

Derive API docs from source and tests, not old README assumptions. Use fictional examples; never publish private consumers, infrastructure, credentials, tokens, hosts, SSH details, real container names, paths or screenshots. Keep the roadmap future-only. Apply the same privacy rules to README examples and screenshots.

PRs and pushes validate docs only. Stable releases publish the exact tag into its major channel, and update Latest only when semantically newest. Prereleases, old majors and stale reruns cannot replace newer stable documentation. Manual publication defaults to a dry run of an existing release.

## Verification

Run CI-equivalent checks and test every declared compatibility boundary. Include browser/JavaScript tests only where relevant. Run the standard checker. External workflow calls and their tooling must share a validated full SHA; template branch updates are not adopted automatically.

## Releases

**REQUIRED REFERENCE:** Read `references/release-checklist.md` before preparing or publishing a release.

Inspect the previous tag on the same major → exact release-commit diff. After review and successful exact-commit CI, create a new `vX.Y.Z` tag on `X.x` and publish its GitHub Release. Do not move or recreate a published tag. Keep the default branch on the newest stable major; change it only when the next major is stable.

Do not claim release completion without the applicable checks, public docs verification and fresh PlumbPHP evidence:

- Ecosystem 100
- Maintenance 100
- Security 100
- Composite 100

Never weaken security, compatibility, tests or architecture to satisfy a scanner. Distinguish stale scans and unexecuted live publication from verified results.

## Laravel Boost distribution

This maintainer skill is published from `resources/boost/skills/developing-filament-packages`, the Laravel Boost third-party skill convention. When `mortalkiller/filament-package-standard` is a direct dependency of a real Laravel application and Laravel Boost is installed, `php artisan boost:update` can discover and sync it to configured skills-capable agents. In standalone package repositories, do not rely on Testbench for Boost discovery; read this skill directly from the installed vendor path referenced by `AGENTS.md`.

Public packages should consume this maintainer skill through the dedicated standard package rather than copying it. A package may instead provide its own consumer-facing skill under `resources/boost/skills/<skill-name>/` when that improves correct package usage. Do not rely on transitive dependency discovery.
