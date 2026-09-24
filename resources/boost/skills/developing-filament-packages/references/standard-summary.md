# MortalKiller Filament Package Standard v2 — quick reference

The canonical complete standard is `docs/package-standard.md` in `mortalkiller/filament-package-standard`. See `docs/development-flow.md` for workflow and `docs/migrating-to-v2.md` for migration.

## SemVer and branches

Permanent branches are package majors (`1.x`, `2.x`, `3.x`), without a stable-promotion branch. The default is the newest stable package major. A Standard or template major does not itself require a new package major. Release immutable `vX.Y.Z` tags directly from verified package-major commits.

## Repository and scaffold

Keep `.editorconfig`, repository/CI metadata, docs, `src/`, tests, README/security/contributing files and Composer metadata. Choose the narrowest runtime profile: `plugin`, `theme`, `forms`, `tables`, or `library`. Add config, database, views, translations, stubs, assets, Workbench, browser tests and Rector only when needed.

New runtime packages prefer `spatie/laravel-package-tools`. Panel `Plugin` classes belong only to panel-oriented packages. Do not refactor existing runtime code solely for template conformity.

## CI and analysis

Require Composer validation, Pint, tracked PHP syntax, strict PHP behavior tests, minimum/latest compatibility boundaries, Starlight docs build and Zizmor. Larastan is the default for Laravel/Filament runtime packages at level 6 or higher. New packages do not start with analysis baselines. Test Windows when filesystem/initializer/shell behavior is cross-platform-sensitive. External actions/workflows use full SHA references.

## Documentation

The README is the quick start; Starlight is the complete guide; source and tests are runtime authority. A maintained README includes value proposition, early `Why`, Documentation links, accurate Contents, Features, compatibility/requirements, installation and useful first-use/configuration guidance. Contents must stay synchronized. Add screenshots and extra sections only when relevant. Stable releases publish exact-tag docs; older majors/prereleases/stale reruns cannot replace Latest. Release builds may be reusable, but the consuming repository owns the local `docs-production` deploy job and its `DOCS_*` environment secrets.

## Privacy

Never publish private customers/applications, real infrastructure, hosts/IPs/SSH details, internal container names or paths, credentials/tokens/session/MFA secrets, private screenshots or personal data. Use synthetic examples.

## Lifecycle

Roadmap → issue → temporary branch → PR to package major → CI/review → squash merge → roadmap cleanup → immutable tag/release → issue closing record. Fix the oldest supported affected line first and forward-port relevant changes with tests.

## Maintenance

Dependabot runs weekly for Composer/GitHub Actions and npm where applicable. Declared compatibility must be tested. Actively maintained public packages require fresh PlumbPHP 100 in Ecosystem, Maintenance, Security and Composite before release completion.
