<?php

/*
 * This file is part of the galette/smarty-gettext package.
 *
 * @copyright (c) 2017 Elan Ruusamäe
 * @copyright (c) 2020 The Galette Team
 * @license BSD
 * @see https://github.com/galette/smarty-gettext
 *
 * For the full copyright and license information,
 * please see the LICENSE file distributed with this source code.
 */

$header = <<<EOF
This file is part of the galette/smarty-gettext package.

@copyright (c) 2017 Elan Ruusamäe
@copyright (c) 2020 The Galette Team
@license BSD
@see https://github.com/galette/smarty-gettext

For the full copyright and license information,
please see the LICENSE file distributed with this source code.
EOF;

Symfony\CS\Fixer\Contrib\HeaderCommentFixer::setHeader($header);

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('templates_c');

return Symfony\CS\Config\Config::create()
    ->setUsingCache(true)
    ->level(Symfony\CS\FixerInterface::NONE_LEVEL)
    ->fixers(array(
        'linefeed',
        'trailing_spaces',
        'unused_use',
        '-short_tag',
        'return',
        'visibility',
        'php_closing_tag',
        'extra_empty_lines',
        'function_declaration',
        'include',
        'controls_spaces',
        'elseif',
        '-eof_ending',
        'header_comment',
    ))
    ->finder($finder);
