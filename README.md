# Better Polylang Experience for Sage 10

  [![Latest Stable Version](https://poser.pugx.org/ouun/sage-polylang/v/stable)](https://packagist.org/packages/ouun/sage-polylang)
  [![Total Downloads](https://poser.pugx.org/ouun/sage-polylang/downloads)](https://packagist.org/packages/ouun/sage-polylang)
  [![License](https://poser.pugx.org/ouun/sage-polylang/license)](https://packagist.org/packages/ouun/sage-polylang)

This package is an extended fork of the ["generoi/sage-poylang"](https://github.com/generoi/sage-polylang) package. It provides a better Polylang experience for Sage 10 by adding the following features:
- Auto-Registers (`pll_register_string()`) your textdomain strings for translation with Polylang Translation System
- Improves the Poylang Translation System by displaying the pretranslated strings from the .mo translation files, but allows you to...
- Override the pretranslated strings with your own translations in the Polylang Translation System

This is a great way to provide a better translation experience for your clients, while still allowing you to provide your own translations.

## Installation
```
$ composer require ouun/sage-polylang
```

## Getting Started
Publish the Polylang config file with Acorn:
```
$ wp acorn vendor:publish --provider="Ouun\Sage\Polylang\Providers\PolylangServiceProvider"
```

## Usage
All strings in your theme will be automatically registered with Polylang. You can then translate them in the Polylang Translation System.
If you have .mo translation files in your theme, they will be used as the pretranslated strings. You can then override these strings with your own translations in the Polylang Translation System.
