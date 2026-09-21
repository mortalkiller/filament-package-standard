# Agent instructions

This repository is the canonical source for MortalKiller Filament Package Standard v1 and the `developing-filament-packages` Laravel Boost skill.

Read `docs/package-standard.md`, `docs/development-flow.md`, `docs/releasing.md`, and `resources/boost/skills/developing-filament-packages/SKILL.md` before changing the standard or skill.

Keep the package runtime-free: no Laravel or Filament service provider, no runtime framework dependency, and no application behavior.

Changes to public maintenance rules or skill behavior must update tests and keep the Boost-distributed skill aligned with the canonical docs.
