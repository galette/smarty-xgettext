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
    /** @var bool @var boolean */
    private $with_modifier = false;

    /**
     * @return array
     */
    public function getTokens(): array
    {
        return $this->tokens;
    }

    /**
     * {@inheritdoc}
     */
    public function compileTag($tag, $args, $parameter = array())
    {
        $validtag = true;
        $line = $this->parser->lex->taglineno;

        //flag we're using a modifier.
        if ($tag === 'private_modifier') {
            $validtag = false;
            //store value parameter if we're working on a modifier
            if (!$this->isVariable($parameter['value'] ?? '')) {
                $this->with_modifier = $parameter['value'];
            }
        } else {
            //we get a modifier. Check if its value is contained in current one and replace it
            if (
                false !== $this->with_modifier
                && isset($args[0]['string'])
                && $this->with_modifier !== false
                && false !== strpos(trim($args[0]['string'], '"'), $this->with_modifier)
            ) {
                $args[0]['string'] = $this->with_modifier;
            }
            $this->with_modifier = false;
        }

        foreach ($args as $key => $argument) {
            if (isset($argument['string']) && $this->isVariable($argument['string'])) {
                $validtag = false;
                continue;
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

    public function isVariable($value): bool
    {
        return (strpos($value, '$_smarty_tpl') === 0);
    }
}
