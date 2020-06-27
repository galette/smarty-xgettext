# Smarty xgettext

A command line utility to extract translations source strings from [Smarty templates](https://smarty.net) to a PO-Template (`.pot`) file.

This utility will scan templates for `{_T string=""}` placeholders for translation strings and output a `.pot` file (`.po` template).

Features:
* scan files and directories recursively,
* inlude original string location,
* supports plurals `{_T string="singular" plural="plural"}`,
* supports contexts `{_T string="string" context="mycontext"}`,
* supports comments `{_T string="string" comment="Explanation"}`

Usage:

    ./vendor/bin/smarty-xgettext -o smarty.pot <filename or directory> <file2> <...>

    find templates -name '*.tpl.html' -o -name '*.tpl.text' -o -name '*.tpl.js' -o -name '*.tpl.xml' | xargs ./vendor/bin/smarty-xgettext -o smarty.pot

If a parameter is a directory, the template files within will be parsed, recursively.

If you want to combine Smarty translations with your PHP ones, you can combine results with the `msgcat` command:

```
./vendor/bin/smarty-xgettext.php -o smarty.pot /path/to/source/templates
xgettext /path/to/source/php --keyword=_T --output=php.pot
msgcat -o project.pot --use-first php.pot smarty.pot
```


## Developing

1. clone this repository
2. [get composer](https://getcomposer.org/download/)
3. install composer dependencies: `php composer.phar install`
4. start using it: `php bin/smarty-xgettext`

Initially based on [tsmatry2c](https://github.com/smarty-gettext/tsmarty2c).
Original project (which seems not maintained) was using Smarty blocks while Galette relies on a function.
