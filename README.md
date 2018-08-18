# A Latex2Png library

## Installation

```shell
user$ vi composer.json
```

```json
{
    "name": "My Project",
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/bjoern-hempel/php-latex-2-png.git"
        }
    ],
    "require": {
        "ixno/php-latex-2-png": "dev-master"
    }
}
```

```shell
user$ composer install
user$ composer dumpautoload -o
```

## Requirements

* latex
* imagemagick

### Debian / Ubuntu

```shell
user$ sudo apt install texlive-base biblatex texlive-latex-extra texlive-fonts-recommended
user$ sudo apt install ImageMagick
```

## Usage

```php
<?php

include "vendor/autoload.php";

use Ixno\Latex2Png\Builder;

/* Some configs */
$cacheFolder = dirname(__FILE__).'/cache';
$useCache    = false;
$resolution  = 600;
$formula     = '\sum_{i = 0}^{n} i = \frac{n(n + 1)}{2}';

if (array_key_exists('f', $_REQUEST)) {
    $formula = $_REQUEST['f'];
}

if (array_key_exists('r', $_REQUEST)) {
    $resolution = $_REQUEST['r'];
}

$builder = new Builder($cacheFolder, $formula, $useCache);

$builder->sendPNGToBrowser($resolution);
```

## Examples

### Basic

```latex
E = mc^{2}
```

<img src="https://latex.ixno.de/?r=300&f=E%20=%20mc^{2}" width="92" alt="E = mc^{2}">

### Summation

```latex
\sum_{i = 0}^{n} i = \frac{n(n + 1)}{2}
```

<img src="https://latex.ixno.de/?r=300&f=\sum_{i%20=%200}^{n}%20i%20=%20\frac{n(n%20%2B%201)}{2}" width="166" alt="\sum_{i = 0}^{n} i = \frac{n(n + 1)}{2}">

## A. Authors

* Björn Hempel <bjoern@hempel.li> - _Initial work_ - [https://github.com/bjoern-hempel](https://github.com/bjoern-hempel)

## B. Licence

This tutorial is licensed under the MIT License - see the [LICENSE.md](/LICENSE.md) file for details
