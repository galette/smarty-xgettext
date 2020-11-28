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

namespace SmartyGettext\Tokenizer\Token;

class Text
{
    /** @var int */
    public $line;

    /** @var string */
    public $text;

    public function __construct($line, $text)
    {
        $this->line = $line;
        $this->text = $text;
    }
}
