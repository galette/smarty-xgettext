# Smarty xgettext

When writing entries, refer to [Keep a CHANGELOG](http://keepachangelog.com/) for guidelines.

All notable changes to this project will be documented in this file.

## [1.1.1] - 2020-07-07

- Fix source path in some cases

[1.1.1]: https://github.com/galette/smarty-xgettext/compare/1.1.0...1.1.1

## [1.1.0] - 2020-06-27

- Support for comments

[1.1.0]: https://github.com/galette/smarty-xgettext/compare/1.0.0...1.1.0

## [1.0.0] - 2020-06-27

- Complete rework for Galette needs

[1.0.0]: https://github.com/galette/smarty-xgettext/compare/0.1.2...1.0.0

## [0.1.2] - 2017-11-12

- add support for overriding delimiters, #9

[0.1.2]: https://github.com/smarty-gettext/tsmarty2c/compare/0.1.1...0.1.2

## [0.1.1] - 2017-09-11

- define dummy plugin handlers for unknown tags, #6
- fix plural handling, #7
- fix line number context to be line of opening tag, #8

[0.1.1]: https://github.com/smarty-gettext/tsmarty2c/compare/0.1.0...0.1.1

## [0.1.0] - 2017-09-10

Initial usable version.

- use Symfony\Console for CLI application
- use Symfony\Finder to find files
- parse template using Smarty engine into tokens: #2
- process smarty tokens into "Tag" object: #3
- for each "Tag" object, write .pot file: #4

[0.1.0]: https://github.com/smarty-gettext/tsmarty2c/commits/0.1.0
