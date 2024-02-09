<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@PSR12'                      => true,
    '@PHP80Migration'             => true,
    'strict_param'                => true,
    'array_syntax'                => [
        'syntax' => 'short',
    ],
    'binary_operator_spaces'      => [
        'operators' => [
            '='  => 'align_single_space_minimal',
            '=>' => 'align_single_space_minimal',
        ],
    ],
    'phpdoc_indent'               => true,
    'no_blank_lines_after_phpdoc' => true,
    'class_attributes_separation' => [
        'elements' => [
            'const'        => 'only_if_meta',
            'method'       => 'one',
            'property'     => 'one',
            'trait_import' => 'only_if_meta',
            'case'         => 'only_if_meta',
        ],
    ],
];

$finder = Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new Config();
return $config->setFinder($finder)
    ->setRules($rules)
    ->setRiskyAllowed(true)
    ->setUsingCache(true);