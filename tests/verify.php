<?php

declare(strict_types=1);

$root = dirname(__DIR__);

$fail = static function (string $message): never {
    fwrite(STDERR, $message.PHP_EOL);
    exit(1);
};

$required = [
    '.editorconfig',
    '.github/workflows/zizmor.yml',
    'composer.json',
    'docs/package-standard.md',
    'docs/migrating-to-v2.md',
    'docs/development-flow.md',
    'docs/releasing.md',
    'resources/boost/skills/developing-filament-packages/SKILL.md',
    'resources/boost/skills/developing-filament-packages/references/api-review.md',
    'resources/boost/skills/developing-filament-packages/references/release-checklist.md',
    'resources/boost/skills/developing-filament-packages/references/scaffolding-and-migration.md',
    'resources/boost/skills/developing-filament-packages/references/standard-summary.md',
];

foreach ($required as $path) {
    if (! is_file($root.'/'.$path)) {
        $fail('Missing required file: '.$path);
    }
}

$composer = json_decode((string) file_get_contents($root.'/composer.json'), true, flags: JSON_THROW_ON_ERROR);

if (($composer['name'] ?? null) !== 'mortalkiller/filament-package-standard') {
    $fail('Unexpected Composer package name.');
}

if (($composer['type'] ?? null) !== 'library') {
    $fail('Composer package type must be library.');
}

if (($composer['require']['php'] ?? null) !== '^8.2') {
    $fail('Standard v2 must support PHP 8.2+.');
}

$runtime = array_keys($composer['require'] ?? []);
if ($runtime !== ['php']) {
    $fail('The standard package must not have runtime dependencies other than PHP.');
}

if (isset($composer['extra']['laravel']['providers'])) {
    $fail('The standard package must not register a Laravel service provider.');
}

$skill = (string) file_get_contents($root.'/resources/boost/skills/developing-filament-packages/SKILL.md');

foreach ([
    'name: developing-filament-packages',
    'description:',
    'Standard v2',
    'references/scaffolding-and-migration.md',
    'Larastan',
    'Zizmor',
    'Ecosystem 100',
    'Maintenance 100',
    'Security 100',
    'Composite 100',
    '## README contract',
    '## Why',
    '## Contents',
] as $needle) {
    if (! str_contains($skill, $needle)) {
        $fail('Skill is missing required content: '.$needle);
    }
}

if (! preg_match('/^---\R.*?\R---\R/s', $skill)) {
    $fail('Skill frontmatter is missing or malformed.');
}

$attributes = (string) file_get_contents($root.'/.gitattributes');
if (str_contains($attributes, '/resources export-ignore') || str_contains($attributes, '/resources/boost export-ignore')) {
    $fail('Laravel Boost resources must be included in Composer dist archives.');
}

$standard = (string) file_get_contents($root.'/docs/package-standard.md');
foreach ([
    'MortalKiller Filament Package Standard v2',
    '## Package profiles and capabilities',
    'Larastan',
    'level 6 or higher',
    'Zizmor',
    '.editorconfig',
    'does not by itself require a new major',
    'mortalkiller/filament-package-standard:^2.0',
] as $needle) {
    if (! str_contains($standard, $needle)) {
        $fail('Canonical Standard v2 is missing required guidance: '.$needle);
    }
}

foreach ([
    '### README contract',
    '## Why',
    '## Documentation',
    '## Contents',
    '## Features',
] as $needle) {
    if (! str_contains($standard, $needle)) {
        $fail('Canonical standard is missing README guidance: '.$needle);
    }
}

$migration = (string) file_get_contents($root.'/docs/migrating-to-v2.md');
foreach (['does not by itself require a new major release', 'Larastan', 'Zizmor', 'Package Tools', 'PHP 8.2'] as $needle) {
    if (! str_contains($migration, $needle)) {
        $fail('Migration guidance is missing: '.$needle);
    }
}

$summary = (string) file_get_contents($root.'/resources/boost/skills/developing-filament-packages/references/standard-summary.md');
if (! str_contains($summary, 'Contents must stay synchronized')) {
    $fail('Quick reference must include the README synchronization rule.');
}

$release = (string) file_get_contents($root.'/docs/releasing.md');
if (! str_contains($release, 'Packagist versions are immutable once observed')) {
    $fail('Release guidance must document Packagist version immutability.');
}

$zizmor = (string) file_get_contents($root.'/.github/workflows/zizmor.yml');
if (! str_contains($zizmor, 'zizmorcore/zizmor-action@70fb788f84895a7701f5643d103d587e460b5c99')) {
    $fail('Zizmor action must be pinned to the reviewed full SHA.');
}

echo "filament-package-standard v2 verification passed".PHP_EOL;
