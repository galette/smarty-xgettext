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
     * @param string|null $domain
     *
     * @return TranslateTag[]
     */
    public function getTranslateTags($templateFile, string $domain = null)
    {
        $tokens = $this->tokenizer->getTokens($templateFile);

        return $this->processTokens($tokens, $domain);
    }

    /**
     * Process tokens into TranslateTag objects
     *
     * @param array $tokens
     * @param string|null $domain
     *
     * @return TranslateTag[]
     */
    private function processTokens($tokens, $domain = null)
    {
        $tags = array();
        $topen = null;
        foreach ($tokens as $i => $token) {
            $previous = $i > 0 ? $tokens[$i - 1] : null;
            //check domain for exclusion
            $accepted = $domain === null;
            if ($domain !== null) {
                $accepted = false; //do not accept per default when restricting on a domain
                $arguments = $token->arguments;
                foreach ($arguments as $argument) {
                    if (isset($argument['domain']) && $argument['domain'] == '"' . $domain . '"') {
                        $accepted = true;
                        break;
                    }
                }
            }

            if (!$accepted) {
                continue;
            }

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
