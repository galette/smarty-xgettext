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

use Geekwright\Po\PoEntry;
use Geekwright\Po\PoTokens;
use SmartyGettext\PotFile;
use Symfony\Component\Finder\SplFileInfo;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Assert that references are equal to expected
     *
     * @param array $expected
     * @param PoEntry[] $entries
     */
    protected function assertReferences($expected, $entries)
    {
        $refs = array();
        foreach ($entries as $i => $e) {
            $refs[$i] = $e->get(PoTokens::REFERENCE);
        }

        $this->assertEquals($expected, $refs);
    }

    /**
     * Flatten entries to be index based
     *
     * @param PotFile $p
     * @return PoEntry[]
     */
    protected function getEntries($p)
    {
        $e = $p->getPoFile()->getEntries();

        return array_values($e);
    }

    /**
     * @param string $template
     * @param Callable $cb
     * @return PotFile
     */
    protected function parseTemplate($template, $cb = null)
    {
        $filename = __DIR__ . '/data/' . $template;

        $file = new SplFileInfo($filename, $template, $template);
        $p = new PotFile();
        if ($cb) {
            $cb($p);
        }
        $p->loadTemplate($file);

        return $p;
    }
}
