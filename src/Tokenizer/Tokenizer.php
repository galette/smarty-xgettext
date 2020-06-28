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

namespace SmartyGettext\Tokenizer;

use Smarty;
use Smarty_Internal_Template;

class Tokenizer
{
    /** @var Smarty */
    private $smarty;

    /**
     * Compiler constructor.
     *
     * @param Smarty $smarty
     */
    public function __construct(Smarty $smarty)
    {
        $this->smarty = $smarty;
    }

    /**
     * @param string $templateFile
     * @return array
     */
    public function getTokens($templateFile)
    {
        /** @var Smarty_Internal_Template $template */
        $template = $this->smarty->createTemplate($templateFile, $this->smarty);
        $template->source->compiler_class = __NAMESPACE__ . '\\TokenCollector';

        /** @var TokenCollector $compiler */
        $compiler = $template->compiler;
        $compiler->compileTemplate($template);

        return $compiler->getTokens();
    }
}
