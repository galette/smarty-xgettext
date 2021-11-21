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

use Geekwright\Po\PoEntry;
use Geekwright\Po\PoTokens;
use SmartyGettext\Test\TestCase;

class RestrictDomainTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            [
                'domain' => 'galette',
                'string' => 'A string with a domain'
            ], [
                'domain' => 'auto',
                'string' => 'Another string with a domain'
            ], [
                'domain' => 'pluralized',
                'string' => 'String|Strings'
            ], [
                'domain' => 'maps',
                'string' => 'Map data (c)'
            ]
        ];
    }

    /**
     * @param string $domain
     * @param string $string
     *
     * @dataProvider dataProvider
     */
    public function testRestrictDomain(string $domain, string $string)
    {
        $p = $this->parseTemplate('restrict_domain.tpl', null, $domain);
        $this->assertNotNull($p);

        $entries = $p->getPoFile()->getEntries();
        $this->assertCount(1, $entries);

        $this->assertEquals($string, array_key_first($entries));
    }
}
