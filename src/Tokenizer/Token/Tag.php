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

class Tag
{
    /** @var int */
    public $line;

    /** @var string */
    public $name;

    /** @var string */
    public $string;

    /** @var string[] */
    public $arguments;

    public function __construct($line, $name, $arguments)
    {
        $this->line = $line;
        $this->name = $name;
        foreach ($arguments as $key => $argument) {
            if (isset($argument['string'])) {
                $this->string = $argument['string'];
                unset($arguments[$key]);
                break;
            }
        }
        $this->arguments = $arguments;
    }
}
