# A Latex2Png library

## 1. Installation

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

## 2. Requirements

* latex
* imagemagick

### 2.1 Debian / Ubuntu

```shell
user$ sudo apt install texlive-base biblatex texlive-latex-extra texlive-fonts-recommended
user$ sudo apt install ImageMagick
```

## 3. Usage

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

## 4. Examples

### 4.1 Basic

#### 4.1.1 Latex

```latex
E = mc^{2}
```

#### 4.1.2 Result

<img src="https://latex.ixno.de/?r=300&f=E%20=%20mc^{2}" width="92" alt="E = mc^{2}">

### 4.2 Summation

#### 4.2.1 Latex

```latex
\sum_{i = 0}^{n} i = \frac{n(n + 1)}{2}
```

#### 4.2.2 Result

<img src="https://latex.ixno.de/?r=300&f=\sum_{i%20=%200}^{n}%20i%20=%20\frac{n(n%20%2B%201)}{2}" width="166" alt="\sum_{i = 0}^{n} i = \frac{n(n + 1)}{2}">

### 4.3 Markov chain

#### 4.3.1 Latex

```latex
\substack{\textbf{max}\\ {\tiny a}}\sum_{s'}^{} T(s, a, s')[R(s, a, s') + \gamma \cdot V_k(s')]
```

#### 4.3.2 Result

<img src="https://latex.ixno.de/?r=300&f=%5Csubstack%7B%5Ctextbf%7Bmax%7D%5C%5C%20%7B%5Ctiny%20a%7D%7D%5Csum_%7Bs%27%7D%5E%7B%7D%20T%28s%2C%20a%2C%20s%27%29%5BR%28s%2C%20a%2C%20s%27%29%20%2B%20%5Cgamma%20%5Ccdot%20V_k%28s%27%29%5D" width="373" alt="\substack{\textbf{max}\\ {\tiny a}}\sum_{s'}^{} T(s, a, s')[R(s, a, s') + \gamma \cdot V_k(s')]">

## A. Authors

* Björn Hempel <bjoern@hempel.li> - _Initial work_ - [https://github.com/bjoern-hempel](https://github.com/bjoern-hempel)

## B. Licence

This tutorial is licensed under the MIT License - see the [LICENSE.md](/LICENSE.md) file for details
