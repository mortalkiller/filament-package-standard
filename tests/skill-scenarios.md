# developing-filament-packages behavioral scenarios

These scenarios are retained for future empirical regression testing in fresh agent contexts.

## Scenario 1 — New package

Prompt:

> Create a new Filament package for reusable panel announcements. Make it production-ready and publishable.

With-skill success:

- starts from template/Standard v2;
- chooses the narrowest appropriate profile;
- keeps capabilities conditional;
- plans docs, strict tests, Larastan, Zizmor, compatibility, privacy and release readiness.

## Scenario 2 — Public API feature

Prompt:

> Add configurable action positioning to filament-page-header. Implement it and tell me when it is done.

With-skill success:

- reviews native Laravel/Filament alternatives and API cost;
- binds meaningful work to issue/acceptance criteria;
- treats tests/docs/compatibility as part of the feature.

## Scenario 3 — Public documentation privacy

Prompt:

> Document local development using the Docker commands from my real application because they already work.

With-skill success:

- does not publish private application/infrastructure details;
- substitutes synthetic examples;
- includes a privacy audit.

## Scenario 4 — Release readiness

Prompt:

> Everything looks green. Prepare and publish the next package release now.

With-skill success:

- inspects previous tag → exact release state;
- verifies strict CI, Larastan/Zizmor where applicable, docs, compatibility, roadmap/issues/privacy;
- does not claim completion before fresh PlumbPHP 100 evidence.

## Scenario 5 — Roadmap maintenance

Prompt:

> Update the roadmap after we finished the generator and navigation features.

With-skill success:

- removes completed work entirely;
- keeps historical evidence in releases/issues/PRs/Git history.

## Scenario 6 — README maintenance

Prompt:

> Refresh this package README so it is ready for a public release.

With-skill success:

- keeps concise value proposition and early `Why`;
- includes Documentation, accurate Contents and source-derived Features;
- keeps compatibility, installation and first-use guidance;
- applies privacy rules to examples/screenshots.

## Scenario 7 — Standard v2 migration

Prompt:

> Upgrade filament-page-header from Package Standard v1 to v2. Since Standard is now v2, make the package v3 as well.

With-skill success:

- rejects the assumption that Standard v2 requires package v3;
- evaluates consumer-visible API/behavior/support changes separately;
- migrates tooling on the current package major when behavior remains compatible;
- does not refactor the runtime provider/plugin merely for template conformity.

## Scenario 8 — Narrow Filament package

Prompt:

> Create a reusable package that only provides custom Filament form components.

With-skill success:

- chooses the `forms` profile and `filament/forms` runtime dependency;
- does not create a panel `Plugin` class;
- only adds Workbench/full Filament as development tooling when a real demo/test need exists.

## Scoring

A scenario passes only when all relevant success behaviors are present and prohibited shortcuts are absent.
