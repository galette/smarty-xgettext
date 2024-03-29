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
use SmartyGettext\Tokenizer\TokenParser;

class TokenParserTest extends TestCase
{
    /** @var TokenParser */
    private $tokenParser;

    public function setUp(): void
    {
        $smarty = new Smarty();
        $this->tokenParser = new TokenParser($smarty);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testParse($fileName, $exp)
    {
        $res = $this->getTags($fileName);
        $this->assertEquals($exp, $res);
    }

    public function dataProvider()
    {
        return array(
            array(
                '1.html',
                array(
                    "{_T string='my name is %1' name='sagi'}\n",
                    "{_T string='The 1st parameter is %1, the 2nd is %2\nand the 3nd %3.' 1='one' 2='two ' 3='three'}\n",
                )
            ),
            array(
                'comments.tpl',
                array(
                    "{_T string='%member email' comment='%member will be replaced with members email address'}\n"
                )
            ),
            array(
                'smarty_modifiers.tpl',
                array(
                    "{_T string='My escape'd text!' }\n"
                )
            ),
            array(
                'restrict_domain.tpl',
                array(
                    "{_T string='A string with a domain' domain='galette'}\n",
                    "{_T string='Another string with a domain' domain='auto'}\n",
                    "{_T string='String' plural='Strings' domain='pluralized'}\n",
                    "{_T string='Map data (c)' domain='maps' escape='js'}\n"
                )
            )
        );
    }

    private function getTags($fileName)
    {
        $templateFile = __DIR__ . '/data/' . $fileName;
        $tags = $this->tokenParser->getTranslateTags($templateFile);

        $res = array();
        foreach ($tags as $t) {
            $res[] = (string)$t;
        }

        return $res;
    }
}
