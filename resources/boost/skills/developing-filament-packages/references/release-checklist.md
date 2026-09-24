# Release checklist

- [ ] Identify the package major, its `N.x` branch and exact release commit; do not introduce a stable-promotion branch.
- [ ] Inspect the previous tag on this package major → release commit diff and choose PATCH, MINOR or MAJOR from consumer-visible compatibility, not the Standard/tooling version.
- [ ] Verify successful push CI on the exact commit: Composer validation, tests, Pint/quality, tracked PHP syntax and package-standard checks.
- [ ] Verify strict test-runner behavior, minimum/latest compatibility, Larastan when applicable, and Zizmor.
- [ ] Verify JavaScript/browser/Workbench tests when the package owns that behavior.
- [ ] Build documentation and verify README, guides, API reference, compatibility and migration instructions against source and tests.
- [ ] Remove completed roadmap work and record issue acceptance criteria.
- [ ] Audit public content for private customers, infrastructure and secrets.
- [ ] Prepare evidence-based release notes and required upgrade instructions.
- [ ] Verify the current PlumbPHP scan and all four 100 scores; record the scanned ref and disclose stale/unavailable results.
- [ ] Create a new immutable `vX.Y.Z` tag on a verified commit belonging to `X.x`, then publish the GitHub Release. Do not move, delete/recreate, or reuse a published tag.
- [ ] Mark RC/beta releases as prereleases; never promote them to stable documentation.
- [ ] Verify release documentation: source equals the tag, exact-commit CI passed, and package-major/Latest channels cannot regress.
- [ ] Confirm the release deploy job is local to the consuming repository, enters `docs-production` there, and reads only the required `DOCS_*` environment secrets without `secrets: inherit`.
- [ ] Confirm deployment configuration when applicable and verify the public major channel, canonical Latest URL, selector, assets and links.
- [ ] Change the default branch only after the first stable release of a newer package major is complete.
- [ ] Record the published release on relevant issues and update installed agent skills when tooling changed.

Packagist versions are immutable once observed. If Packagist has seen a tag, do not delete/recreate it on another commit. Correct the code and publish a new semantic version.

A release is not complete merely because CI is green. Resolve legitimate Plumb findings without weakening security, compatibility, tests or architecture.
