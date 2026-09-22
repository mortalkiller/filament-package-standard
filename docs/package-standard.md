# MortalKiller Filament Package Standard v1

**Status:** Approved — major-only flow revision, 2026-09-21  
**Owner:** Pedro Monteiro / MortalKiller  
**Scope:** Public Filament packages maintained under the `mortalkiller` GitHub account.

## Purpose and principles

Maintain consistent, safe, documented packages without forcing unnecessary tooling on simple packages. Prefer native Laravel/Filament behavior, a small fluent public API, explicit opt-in, backwards compatibility within a major, tests that prove public behavior, and documentation derived from source and tests. Never publish private consumer or infrastructure information. Code, docs, compatibility, issues and releases must tell the same story. Roadmaps contain future work only.

A package without JavaScript does not need Playwright. A package without migrations does not need `database/`. Conditional tooling must solve a real package need.

## Repository baseline

Required: `.github/ISSUE_TEMPLATE/`, `.github/workflows/`, `docs/roadmap.md`, `docs-site/`, `src/`, `tests/`, `AGENTS.md`, `CONTRIBUTING.md`, `LICENSE.md`, `README.md`, `SECURITY.md`, `composer.json`, and `phpunit.xml.dist`.

Add config, migrations, resources, workbench, root Node tooling, Playwright and other integrations only where appropriate. Current packages also provide `docs/development-flow.md` and separate docs-validation and release-publication workflows. Consumer-facing Laravel Boost skills are optional and belong under `resources/boost/skills/<skill-name>/` when they materially improve correct package usage.

## Branching and versioning

Use permanent package-major branches (`1.x`, `2.x`, `3.x`) without a separate stable-promotion branch. New packages start on `1.x`. The default branch is the latest stable major, or `1.x` before the first release. Starting work on a future major does not change the default branch.

Use focused `feature/*`, `fix/*`, `docs/*`, `test/*`, `refactor/*`, and `chore/*` branches created from, and merged into, the affected major. Squash temporary work branches after review and successful CI. There is no extra promotion merge for a release.

Release immutable Semantic Versioning tags `vX.Y.Z` from verified commits belonging to `X.x`. A branch may include unreleased work; a tag identifies the exact published version. Compatible fixes increment PATCH, compatible functionality increments MINOR, and incompatible changes require a MAJOR review. Package majors are not Filament majors. Do not move published tags.

Fix the oldest supported affected line first and forward-port the relevant fix with tests. Do not merge an old major wholesale into another major. Supported lines are maintained independently; unsupported historical lines remain frozen.

See [Development and release flow](development-flow.md) for examples and the complete maintainer procedure.

## Public API

Prefer `::make()` where it matches Filament, fluent methods returning `static`, typed callbacks, enums for finite choices, and one canonical method instead of aliases. Use closures only for genuinely dynamic context, config for structural defaults, fluent plugin APIs for panel behavior, and contracts only for real substitution needs.

Before adding API, check whether Laravel or Filament already solves the problem, whether a native component can be reused, whether the method is predictable and necessary, and whether it can survive framework evolution. Keep invalid-configuration errors early and actionable. Public APIs remain compatible inside a stable major; document deprecations and replacements before removal.

## Migrations

The package may manage package-owned tables. Migrations touching application-owned structures such as `users` or `personal_access_tokens` must be defensive. Never remove columns or data that existed before the package.

## Testing and CI

Require Composer metadata validation, Laravel Pint, tracked PHP syntax, automated PHP behavior tests, declared minimum/latest compatibility boundaries and the documentation build. PHPUnit and Pest are both valid. PHPStan is the default for new packages unless there is a deliberate documented reason to exclude it. JavaScript, Playwright and workbench checks are conditional on owned browser behavior. Security-sensitive features require negative-path coverage.

A required CI failure means no merge. Check the exact release commit, not only an earlier PR commit. Preserve meaningful minimum and latest-allowed dependency combinations; do not weaken a test or constraint to make CI green.

Reusable workflows live in `mortalkiller/filament-package-template`. External actions/workflows are pinned to full 40-character commit SHAs. The checker and release tooling use the same validated commit via `standard-ref`. Local workflow calls inside the template use relative paths and share the caller commit. Review template updates deliberately and rerun package CI.

## Documentation

Use Astro + Starlight under `docs-site/`, with shared Pedro Monteiro branding and links to GitHub and `https://pedromonteiro.dev`. Keep Getting Started, Guides, API Reference, Development and Project sections. The README is the quick start; Starlight is the complete user documentation; source and tests are runtime authority. Never document APIs based solely on old README prose.

### README contract

Every maintained public Filament package must keep a clear, current README that can stand on its own as the package quick start. Use this structure unless a package-specific reason requires a nearby equivalent:

1. Optional showcase image when the package has visual behavior worth evaluating.
2. Package title, Packagist/CI/license badges and the required PlumbPHP badges.
3. A concise value proposition describing what the package does.
4. An early `## Why` section, before the main usage documentation, explaining the concrete problem the package solves, why the package exists instead of repeating application-specific implementations, and its scope or non-goals. Do not use the section for marketing-only claims or imply Laravel/Filament is deficient when the native behavior is intentionally simpler.
5. `## Documentation` with the canonical documentation URL and the most useful entry points.
6. `## Contents` with accurate links to the README's important top-level sections, including `Why`. Update it whenever headings change.
7. `## Features` with user-visible capabilities derived from source and tests.
8. Screenshots or demo guidance when visual behavior or a representative workbench exists.
9. Version compatibility or requirements, then installation.
10. A first useful example plus the package-specific configuration and task-oriented guidance needed to get value without reading the full docs site.
11. Roadmap, Security and license/credits information near the end.

Add migration/upgrade guidance, troubleshooting, testing/contributing, changelog and sponsorship/support sections when they are relevant to that package. Do not create empty ceremonial sections merely to satisfy a template.

The README must remain shorter and more task-oriented than the full Starlight documentation, but linking to the docs site is not a reason to omit the `Why`, `Contents`, `Features`, compatibility or installation essentials. Examples and screenshots follow the same public-data and privacy rules as every other document.

PRs and major-branch pushes build and validate documentation without deploying or inheriting deployment secrets. Stable GitHub Releases publish the exact release-tag source after major-ancestry and exact-commit CI verification, through the `docs-production` environment and only with `DOCS_DEPLOY_ENABLED=true`. Prereleases do not replace stable documentation.

The canonical `https://docs.pedromonteiro.dev/<package>/` URL remains Latest. `/<package>/N.x/` contains the latest published documentation for that major. Choose versions semantically, not by publication date. An old-major release or stale re-run must not downgrade a channel or Latest. Publishing Latest must preserve every other major directory. The version selector lists deployed channels from `versions.json`.

Support manual verification/re-publication of an existing stable tag; dry-run defaults to true and does not access deployment secrets. Never silently build an older tag using a newer branch. Historical tags predating versioned docs require a new release on a supported line, not a moved tag. Verify subpath-safe assets, favicons, manifests, canonical URLs, edit links and existing public URLs.

## Privacy and security

Public repositories must not contain customer names/data, private application names/domains, production hosts/IPs, SSH details, actual internal container names or filesystem paths, credentials/API keys/tokens, session IDs/MFA secrets/recovery codes, or private screenshots.

Use fictional `Customer`, `Order`, `Product`, `Workspace`, `DemoUser`, `demo-filament-app`, `example.com`, `/var/www/app`, and `php`. Visibility is not authorization. Security-sensitive decisions stay server-side. Escape HTML by default; trusted raw HTML requires explicit opt-in.

Use GitHub private vulnerability reporting/advisories; do not disclose unpatched vulnerabilities in public issues/PRs. Claims about fail-closed behavior, isolation, authorization and protection require tests. Increase review depth for authentication, passwords, sessions, MFA, tokens, tenancy, middleware, uploads, raw HTML, external URLs and credentials.

## GitHub lifecycle and maintenance

Meaningful features, significant bugs, public API changes and security-sensitive work require issues with objective acceptance criteria and focused PRs. Supply standard issue/PR templates. Use lightweight Conventional Commit prefixes (`feat`, `fix`, `docs`, `test`, `refactor`, `chore`, `ci`, `style`).

Lifecycle: roadmap → issue → temporary branch → PR to major → CI/review → merge → roadmap cleanup → tag/release → issue closing record. Closed feature issues record implementation, documentation and release details where available.

Every runtime dependency is a maintenance commitment. Prefer native capabilities; use `require` for runtime, `require-dev` for tooling, and `suggest` with clear diagnostics for genuinely optional features. Declared compatibility must match test evidence.

Dependabot runs weekly for Composer and GitHub Actions, and npm where needed, with a seven-day cooldown, limited PR counts and no universal auto-merge. Configure targets for supported major lines. State whether each major is Active, Maintenance, Security-only, Unsupported or Archived.

## PlumbPHP quality gate

Every actively maintained public package must achieve and maintain Ecosystem 100, Maintenance 100, Security 100 and Composite 100. Expose the corresponding badges in the README. Before calling a release complete, verify the current scan at `https://plumbphp.dev/`; use manual evidence when reliable automation is unavailable.

When a score is below 100, identify the exact finding, assess validity, correct legitimate problems, rescan and confirm. Record the scanned ref and distinguish stale service results from the proposed commit. Never weaken security, compatibility, tests or architecture just to satisfy a scanner, and never claim 100 without evidence.

## Definition of Done

Verify applicable implementation/API/backwards-compatibility requirements; Composer, Pint, PHP syntax, PHP behavior, minimum/latest compatibility, optional static analysis and JS/browser tests; docs builds and source-derived API/upgrade guidance; future-only roadmap; privacy and credential audit; issue acceptance and passing PR checks; immutable correct-major release tags; evidence-based release notes; successful release-tag documentation publication; and a fresh PlumbPHP 100 result in all four categories.

A code change, a successful PR check, a tag and a live publication are separate facts. Report them separately when any stage could not be executed.

## Template and agent tooling

`mortalkiller/filament-package-template` owns repository scaffolding, issue/PR forms, docs branding, reusable workflows, mechanical checks and release tooling. `mortalkiller/filament-package-standard` owns this engineering standard and the maintainer `developing-filament-packages` skill. Mechanical rules belong in tested checks; the skill explains workflow and judgment.

The canonical skill uses Laravel Boost's third-party package convention at `resources/boost/skills/developing-filament-packages/`. Install `mortalkiller/filament-package-standard` as a **direct development dependency** in maintained package repositories. Agents in standalone package repositories read the installed skill directly from `vendor/mortalkiller/filament-package-standard/resources/boost/skills/developing-filament-packages/SKILL.md`. In real Laravel applications that also use Laravel Boost, `php artisan boost:update` can discover and synchronize the same skill. Do not rely on Testbench as the Boost project root.

Generated packages consume this maintainer skill through the dedicated standard package. Packages may additionally expose their own consumer-facing skill under `resources/boost/skills/<skill-name>/` when doing so helps users configure or extend that package correctly. Such a skill must describe package usage, not MortalKiller's internal maintainer workflow. Do not rely on transitive dependencies for Boost discovery.

The maintainer selected runtime/model-independent static skill validation and empirical refinement, rather than synthetic fresh-agent testing as a Standard v1 release gate. Keep behavioral scenarios for later regression testing when a suitable harness is available.
