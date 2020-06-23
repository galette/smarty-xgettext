<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Getetxt Smarty plugin for Galette
 *
 * PHP version 5
 *
 * Copyright © 2008-2014 The Galette Team
 *
 * This file is part of Galette (http://galette.tuxfamily.org).
 *
 * Galette is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Galette is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Galette. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  Smarty
 * @package   Galette
 *
 * @author    Johan Cwiklinski <johan@x-tnd.be>
 * @copyright 2008-2014 The Galette Team
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL License 3.0 or (at your option) any later version
 * @link      http://galette.tuxfamily.org
 * @since     Available since 0.7-dev - 2008-07-17
 */

/**
 * Smarty translations for Galette
 *
 * @param array  $params An array that can contains:
 *                       string: the string to translate
 *                       domain: a translation domain name
 *                       notrans: do not indicate not translated strings
 *                       pattern: A pattern (optional - required if replace present)
 *                       replace: Replacement for pattern (optional - required
 *                       if pattern present)
 *
 *
 *
 * Any parameter that is sent to the function will be represented as %n in the translation text,
 * where n is 1 for the first parameter. The following parameters are reserved:
 *   - escape - sets escape mode:
 *       - escaping is turned off per default, when argument is missing.
 *       - 'html' for HTML escaping.
 *       - 'js' for javascript escaping.
 *       - 'url' for url escaping.
 *   - plural - The plural version of the text (2nd parameter of ngettext())
 *   - count - The item count for plural mode (3rd parameter of ngettext())
 *   - domain - Textdomain to be used, default if skipped (dgettext() instead of gettext())
 *   - context - gettext context. reserved for future use.
 
 * @param Smarty $smarty Smarty
 *
 * @return translated string
 */
function smarty_function__T($params, &$smarty)
{
    extract($params);

    //$domain = $domain ?? 'galette';
    //$plural = $plural ?? false;
    //$count = $count ?? ($plural !== false ?  : null);
    //$pattern = $pattern ?? [];
    //$replace = $replace ?? [];
    //$notrans = $notrans ?? true;
    //$escape = $escape ?? false;
    //$context = $context ?? null;

    $known_params = [
        'domain',
        'notrans',
        'plural',
        'count'
    ];

    if (!isset($domain)) {
        $domain = 'galette';
    }

    if (!isset($notrans)) {
        $notrans = true;
    }

    // set plural parameters 'plural' and 'count'.
    /*if (isset($params['plural'])) {
        $plural = $params['plural'];
        unset($params['plural']);

        // set count
        if (isset($params['count'])) {
            $count = $params['count'];
            unset($params['count']);
        }
    }*/

    // use plural if required parameters are set
    if (isset($count) && isset($plural)) {
        // a context ha been specified
        if (isset($context)) {
            $text = _Tnx($context, $string, $plural, $count, $domain, $notrans);
        } else {
            $text = _Tn($string, $plural, $count, $domain, $notrans);
        }
    } else {
        // a context ha been specified
        if (isset($context)) {
            $text = _Tx($context, $string, $domain, $notrans);
        } else {
            //$text = gettext($text);
            $ret = _T($string, $domain, $notrans);
        }
    }

    if (isset($pattern) && isset($replace)) {
        $ret = preg_replace($pattern, $replace, $ret);
    }


    if (isset($escape)) {
        //replace insecable spaces
        $ret = str_replace('&nbsp;', ' ', $ret);
        //for the moment, only 'js' type is know
        $ret = htmlspecialchars($ret, ENT_QUOTES, 'UTF-8');

        /*switch ($escape)
            case 'html':
                $text = nl2br(htmlspecialchars($text));
                break;
            case 'javascript':
            case 'js':
                // javascript escape
                $text = strtr($text, array('\\' => '\\\\', "'" => "\\'", '"' => '\\"', "\r" => '\\r', "\n" => '\\n', '</' => '<\/'));
                break;
            case 'url':
                // url escape
                $text = urlencode($text);
                break;
        }*/
    }


    return $ret;
}
