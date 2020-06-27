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

use Smarty_Internal_SmartyTemplateCompiler;

/**
 * Wrapper to grab tokens from Smarty Template Compiler as they get parsed from template.
 */
class TokenCollector extends Smarty_Internal_SmartyTemplateCompiler
{
    /** @var array */
    private $tokens = array();

    /**
     * @return array
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * {@inheritdoc}
     */
    public function compileTag($tag, $args, $parameter = array())
    {
        $line = $this->parser->lex->taglineno;

        $validtag = true;
        foreach ($args as $key => $argument) {
            if (isset($argument['string'])) {
                if (substr($argument['string'], 0, strlen('$_smarty_tpl')) === '$_smarty_tpl') {
                    $validtag = false;
                    continue;
                }
            }
        }

        if ($validtag === true) {
            $this->tokens[] = new Token\Tag($line, $tag, $args);
        }

        return parent::compileTag($tag, $args, $parameter);
    }

    /**
     * {@inheritdoc}
     */
    public function processText($text)
    {
        $line = $this->parser->lex->taglineno;
        $this->tokens[] = new Token\Text($line, $text);

        return parent::processText($text);
    }
}
