<?php

/*
 * This file is part of the smarty-gettext/tsmarty2c package.
 *
 * @copyright (c) Elan Ruusamäe
 * @license BSD
 * @see https://github.com/smarty-gettext/tsmarty2c
 *
 * For the full copyright and license information,
 * please see the LICENSE and AUTHORS files
 * that were distributed with this source code.
 */

/**
 * Maps _T Galette's function
 *
 * @param string $string String to translate
 *
 * @return string
 */
function _T($string)
{
    return $string;
}

require_once __DIR__ . '/../vendor/autoload.php';
