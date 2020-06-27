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
