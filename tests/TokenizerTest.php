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

        //assign
        $this->assertEquals('assign', $tokens[2]->name);
        // and nothing else, since the string value is a smarty variable, we do not need it.
    }

    public function testComments()
    {
        $tokens = $this->getTokens(__DIR__ . '/data/comments.tpl');
        $this->assertCount(1, $tokens);

        $this->assertEquals('_T', $tokens[0]->name);
        $this->assertEquals('"%member email"', $tokens[0]->string);
        $this->assertEquals('"%member will be replaced with members email address"', $tokens[0]->arguments[1]['comment']);
    }

    public function testVariableModifiers()
    {
        $tokens = $this->getTokens(__DIR__ . '/data/smarty_modifiers.tpl');
        $this->assertCount(1, $tokens);

        $this->assertEquals('_T', $tokens[0]->name);
        $this->assertEquals('"My escape\'d text!"', $tokens[0]->string);
        $this->assertCount(0, $tokens[0]->arguments);
    }

    public function testDomains()
    {
        $tokens = $this->getTokens(__DIR__ . '/data/restrict_domain.tpl');
        $this->assertCount(4, $tokens);

        $this->assertEquals('_T', $tokens[0]->name);
        $this->assertEquals('"A string with a domain"', $tokens[0]->string);
        $this->assertCount(1, $tokens[0]->arguments);
        $this->assertEquals(['domain' => '"galette"'], $tokens[0]->arguments[1]);

        $this->assertEquals('_T', $tokens[1]->name);
        $this->assertEquals('"Another string with a domain"', $tokens[1]->string);
        $this->assertCount(1, $tokens[1]->arguments);
        $this->assertEquals(['domain' => '"auto"'], $tokens[1]->arguments[1]);

        $this->assertEquals('_T', $tokens[2]->name);
        $this->assertEquals('"String"', $tokens[2]->string);
        $this->assertCount(2, $tokens[2]->arguments);
        $this->assertEquals(['plural' => '"Strings"'], $tokens[2]->arguments[1]);
        $this->assertEquals(['domain' => '"pluralized"'], $tokens[2]->arguments[2]);
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
