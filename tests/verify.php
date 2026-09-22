<?php

declare(strict_types=1);

$root = dirname(__DIR__);

$fail = static function (string $message): never {
    fwrite(STDERR, $message.PHP_EOL);
    exit(1);
};

$required = [
    'composer.json',
    'docs/package-standard.md',
    'docs/development-flow.md',
    'docs/releasing.md',
    'resources/boost/skills/developing-filament-packages/SKILL.md',
    'resources/boost/skills/developing-filament-packages/references/api-review.md',
    'resources/boost/skills/developing-filament-packages/references/release-checklist.md',
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
    'mortalkiller/filament-package-standard',
    'resources/boost/skills/developing-filament-packages',
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
if (! str_contains($standard, 'mortalkiller/filament-package-standard')) {
    $fail('Canonical standard does not identify the standard package as its owner.');
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

$summary = (string) file_get_contents($root.'/resources/boost/skills/developing-filament-packages/references/standard-summary.md');
if (! str_contains($summary, 'Contents must stay synchronized')) {
    $fail('Quick reference must include the README synchronization rule.');
}

$release = (string) file_get_contents($root.'/docs/releasing.md');
if (! str_contains($release, 'Packagist versions are immutable once observed')) {
    $fail('Release guidance must document Packagist version immutability.');
}

echo "filament-package-standard verification passed".PHP_EOL;
