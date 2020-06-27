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

namespace SmartyGettext\Test\Parser;

use SmartyGettext\PotFile;
use SmartyGettext\Test\TestCase;

class QuoteParserTest extends TestCase
{
    public function testTranslationBeginsWithQuote()
    {
        $p = $this->parseTemplate('quotes_in_translation.tpl');
        $this->assertNotNull($p);

        $entries = $p->getPoFile()->getEntries();
        $this->assertCount(3, $entries);

        $this->assertArrayHasKey('Note', $entries);
        $this->assertArrayHasKey("'Note Discussion' is required.", $entries);
        $this->assertArrayHasKey('\"Email Discussion\" is required.', $entries);
    }

    public function testArgumentQuotes()
    {
        $p = new PotFile();
        $tags = $p->getTags(__DIR__ . '/../data/argument_quotes.tpl');

        $this->assertCount(1, $tags);
        $args = $tags[0]->getArguments();

        $exp = array(
            'quote' => 'bar',
            'apostrophe' => 'pub',
            'int' => '1',
            'bool' => 'false',
        );
        $this->assertEquals($exp, $args);
        $this->assertEquals($tags[0]->message, '"text"');
    }
}
