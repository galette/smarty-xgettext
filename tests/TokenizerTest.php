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

namespace SmartyGettext\Test;

use Smarty;
use SmartyGettext\Tokenizer\Tokenizer;

class TokenizerTest extends TestCase
{

    public function test1()
    {
        $tokens = $this->getTokens(__DIR__ . '/data/1.html');
        $this->assertCount(3, $tokens);

        // {_T string="my name is %1" name="sagi"}
        $this->assertEquals('_T', $tokens[0]->name);
        $this->assertEquals('"my name is %1"', $tokens[0]->string);
        $this->assertEquals('"sagi"', $tokens[0]->arguments[1]['name']);

        $this->assertEquals('assign', $tokens[2]->name);
    }

    /**
     * @param string $template
     * @return array
     */
    private function getTokens($template)
    {
        $smarty = new Smarty();
        $tokenizer = new Tokenizer($smarty);

        return $tokenizer->getTokens($template);
    }
}
