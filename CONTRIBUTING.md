# Contributing

Work on temporary branches targeting the maintained major branch.

For Standard v1, target `1.x`. Update the canonical documentation and the `developing-filament-packages` skill together when a rule affects both.

Before merging, run:

```bash
composer validate --strict
composer test
```

Do not add Laravel or Filament runtime dependencies to this package. It exists only to distribute development guidance and the Laravel Boost skill.
