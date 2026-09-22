# Package development and release flow

## Branches

Use one permanent branch per package major: `1.x`, `2.x`, and so on. There is no separate stable-promotion branch. The default branch is the latest stable package major, or `1.x` before the first stable release. Create the next package major only when incompatible consumer-facing work starts. A Standard/tooling major does not by itself require a new package major.

Start each change from the affected major, create a focused `feature/*`, `fix/*`, `docs/*`, `test/*`, `refactor/*`, or `chore/*` branch, and open a PR back to that same major. Require review and passing CI before merging. Squash temporary work branches and delete them after merge. Keep supported major branches; freeze unsupported lines rather than importing incompatible code into them.

A branch head may contain unreleased work. A tag identifies exactly what was released. Do not create branches for every minor or patch release.

## Version numbers

Use `vMAJOR.MINOR.PATCH` tags: compatible bug fixes increment PATCH; compatible functionality increments MINOR; incompatible public API, runtime behavior or supported-platform changes require a MAJOR review. Package majors are independent from Filament majors, template majors and Standard majors. Never move or overwrite a published tag.

Example: adopt Standard v2 tooling on an existing `2.x` package without changing its public API; the package remains on `2.x`. Develop an incompatible public API on `3.x` and release `v3.0.0` only when that consumer-facing change is ready.

Fix the oldest supported affected major first and forward-port the relevant change, with tests, to newer affected lines. Do not merge an old major wholesale into a different major. Release each affected line independently.

## Preparing a release

1. Choose the target package major and exact release commit, and inspect its diff from the previous tag on that major.
2. Complete code, tests, README, documentation, compatibility notes, upgrade instructions and release notes. Remove completed roadmap entries.
3. Wait for successful push CI on that exact commit: tests, code quality and package standard. Include PHP, minimum/latest dependency boundaries, Larastan and Zizmor where applicable, optional JavaScript/browser tests, and a documentation build.
4. Audit public content and verify PlumbPHP findings. Do not report 100 without a fresh scan; distinguish the scanned ref from the release commit when the service is stale.
5. Create the immutable `vX.Y.Z` tag at the verified commit on `X.x`, then publish its GitHub Release. There is no additional merge into another permanent branch.
6. Check release documentation/publication and record the release on the relevant issues. A successful tag creation alone does not mean publication is complete.

A prerelease may use a tag such as `v3.0.0-rc.1`, explicitly marked as a prerelease. It never replaces stable documentation or changes the default major automatically.

## Documentation

PRs and pushes build and validate documentation but never deploy stable docs. Publishing a stable GitHub Release builds the source from its exact tag, verifies that the commit belongs to the corresponding major and has successful required push workflows, and then publishes it through `docs-production`.

The canonical `https://docs.pedromonteiro.dev/<package>/` URL remains **Latest**. `/<package>/2.x/` presents the newest published documentation for package major 2. Only the greatest stable semantic version may update Latest; an old-major patch cannot replace a newer major. The publisher prevents rollback and preserves other major directories.

A version selector lists deployed channels, not branches or unreleased versions. Historical majors are not fabricated from current documentation. A historical tag lacking versioned-docs configuration must not be moved; introduce the configuration in a new release of a supported line.

Manual release-documentation verification/re-publication uses an existing stable tag and defaults to dry-run. Actual publication requires the configured environment and observes the same rollback and exact-commit checks as automatic publication.

## Repository setup and migration

For a new package, set the default branch to `1.x`; do not create an extra promotion branch. Configure protections on supported package-major branches, immutable release tags where available, required checks, and appropriate Dependabot targets. Keep secrets in GitHub configuration, never in source.

When adopting Standard v2 in an existing package, follow [Migrating to Standard v2](migrating-to-v2.md). Preserve published tags and consumer behavior unless a separate change intentionally alters them. Update Standard/template references without inventing a new package major solely for tooling.

When migrating branch topology, preserve exclusive commits before removing an old branch. Update default branches, PR targets, badges, edit links, explicit branch consumers, deployment rules and agent-skill configuration. Do not delete the old branch until those checks are complete.

## Shared workflow versions

External `uses:` references must use a full 40-character commit SHA. Pin checker/publication tooling to the same validated template commit using `standard-ref`. Moving template `2.x` does not update packages automatically; adopt a reviewed template commit in a separate PR and run CI. Local reusable workflow calls inside the template use relative paths and therefore share the caller commit.
