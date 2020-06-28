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
use SmartyGettext\Tokenizer\Tag\TranslateTag;

class TokenParser
{
    /** @var Tokenizer */
    private $tokenizer;

    public function __construct(Smarty $smarty)
    {
        $this->tokenizer = new Tokenizer($smarty);
    }

    /**
     * Get translate tags from $templateFile
     *
     * @param string $templateFile
     * @return TranslateTag[]
     */
    public function getTranslateTags($templateFile)
    {
        $tokens = $this->tokenizer->getTokens($templateFile);

        return $this->processTokens($tokens);
    }

    /**
     * Process tokens into TranslateTag objects
     *
     * @param array $tokens
     * @return TranslateTag[]
     */
    private function processTokens($tokens)
    {
        $tags = array();
        $topen = null;
        foreach ($tokens as $i => $token) {
            $previous = $i > 0 ? $tokens[$i - 1] : null;
            if ($token instanceof Token\Tag && $token->name === '_T') {
                $tags[] = new TranslateTag($token->string, $token->arguments, $token->line);
                $topen = $token;
            } elseif (
                $topen &&
                ($token instanceof Token\Tag &&
                $token->name === 'Tclose') &&
                $previous instanceof Token\Text
            ) {
                $tags[] = new TranslateTag($previous->text, $topen->arguments, $topen->line);
                $topen = null;
            }
        }

        return $tags;
    }
}
