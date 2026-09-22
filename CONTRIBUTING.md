# Contributing

Work on temporary branches targeting the maintained major branch.

For Standard v2, target `2.x`. Update the canonical documentation, migration guidance and the `developing-filament-packages` skill together when a rule affects them.

Before merging, run:

```bash
composer validate --strict
composer test
```

CI also validates PHP 8.2–8.5, tracked PHP syntax, the distribution archive and GitHub Actions with Zizmor.

Do not add Laravel or Filament runtime dependencies to this package. It exists only to distribute development guidance and the Laravel Boost skill.
