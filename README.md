# A Latex2Png library

With this library you can convert formulas into images. Feel free to use it directly on github.com or in your web projects:

<img src="https://latex.ixno.de/?r=600&p=1pt&c=1&f=%5Cbegin%7Barray%7D%7Bc%7D%5C%5CA%5C%2C%5Cend%7Barray%7D%7B%5Cunderbrace%7BLatex%5E2_%7BPng%7D%7D_%7Blibrary%7D%7D" width="275" alt="\begin{array}{c}\\A\,\end{array}{\underbrace{Latex^2_{Png}}_{library}}">

## 1. Installation

It is possible to use this repository with [Composer](https://getcomposer.org/download/). Write a `composer.json` file to install this project:

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

Now use `vendor/autoload.php` to include all libraries to your project.

## 2. Requirements

The project requires at least all subsequent libraries:

* latex
* imagemagick

### 2.1 Debian / Ubuntu

Easy to install on [Debian](https://de.wikipedia.org/wiki/Debian) or [Ubuntu](https://de.wikipedia.org/wiki/Ubuntu):

```shell
user$ sudo apt install texlive-base biblatex texlive-latex-extra texlive-fonts-recommended
user$ sudo apt install ImageMagick
```

## 3. Usage

### 3.1 Browser

If you need the pictures directly embed in your web projects:

```shell
user$ vi index.php
```

```php
<?php

include "vendor/autoload.php";

use Ixno\Latex2Png\Builder;

/* Some configs */
$cacheFolder = dirname(__FILE__).'/cache';
$useCache    = true;
$debug       = false;
$resolution  = 600;
$padding     = '1pt';
$formula     = '\sum_{i = 0}^{n} i = \frac{n(n + 1)}{2}';

if (array_key_exists('c', $_REQUEST)) {
    $useCache = $_REQUEST['c'] === '1' ? true : false;
}

if (array_key_exists('d', $_REQUEST)) {
    $debug = $_REQUEST['d'] === '1' ? true : false;
}

if (array_key_exists('r', $_REQUEST)) {
    $resolution = $_REQUEST['r'];
}

if (array_key_exists('p', $_REQUEST)) {
    $padding = $_REQUEST['p'];
}

if (array_key_exists('f', $_REQUEST)) {
    $formula = $_REQUEST['f'];
}

$builder = new Builder($cacheFolder, $formula, $useCache, $debug);

$builder->sendPNGToBrowser($resolution, $padding);
```

An image can now be created by requesting it in the browser:

https://latex.ixno.de/?r=300&f=E%3Dmc^2

### 3.2 Command Line

If you need the pictures directly within the command line:

TODO..

## 4. Examples

### 4.1 Mass–energy equivalence

#### 4.1.1 Latex

```latex
E = m \cdot c^2
```

#### 4.1.2 Result

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=E%20%3D%20m%20%5Ccdot%20c%5E2" width="107" alt="E = m \cdot c^2">

### 4.2 Summation

#### 4.2.1 Latex

```latex
\sum_{i = 0}^{n} i = \frac{n(n + 1)}{2}
```

#### 4.2.2 Result

<img src="https://latex.ixno.de/?r=300&f=\sum_{i%20=%200}^{n}%20i%20=%20\frac{n(n%20%2B%201)}{2}" width="166" alt="\sum_{i = 0}^{n} i = \frac{n(n + 1)}{2}">

### 4.3 Damped oscillator

#### 4.3.1 Latex

```latex
\ddot x(t) +2 \delta \cdot \dot x(t) + \omega_0^2 \cdot x(t) = 0 \hspace{0.5cm} \Bigg\vert
\hspace{0.2cm} \delta=\frac{d}{2m} \hspace{0.2cm} and \hspace{0.2cm} \omega_0=\sqrt{\frac{k}{m}}
\hspace{0.2cm} and \hspace{0.2cm} \ddot x(t) = \frac{\text{d}^2}{\text{d}t^2}x(t) \hspace{0.2cm}
and \hspace{0.2cm} \dot x(t) = \frac{\text{d}}{\text{d}t}x(t)
```

#### 4.3.2 Result

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=%5Cddot%20x%28t%29%20%2B2%20%5Cdelta%20%5Ccdot%20%5Cdot%20x%28t%29%20%2B%20%5Comega_0%5E2%20%5Ccdot%20x%28t%29%20%3D%200%20%5Chspace%7B0.5cm%7D%20%5CBigg%5Cvert%20%5Chspace%7B0.2cm%7D%0D%0A%5Cdelta%3D%5Cfrac%7Bd%7D%7B2m%7D%20%5Chspace%7B0.2cm%7D%20and%20%5Chspace%7B0.2cm%7D%20%5Comega_0%3D%5Csqrt%7B%5Cfrac%7Bk%7D%7Bm%7D%7D%20%5Chspace%7B0.2cm%7D%20and%20%5Chspace%7B0.2cm%7D%20%5Cddot%20x%28t%29%20%3D%20%5Cfrac%7B%5Ctext%7Bd%7D%5E2%7D%7B%5Ctext%7Bd%7Dt%5E2%7Dx%28t%29%20%5Chspace%7B0.2cm%7D%20and%20%5Chspace%7B0.2cm%7D%20%5Cdot%20x%28t%29%20%3D%20%5Cfrac%7B%5Ctext%7Bd%7D%7D%7B%5Ctext%7Bd%7Dt%7Dx%28t%29" width="921" alt="\ddot x(t) +2 \delta \cdot \dot x(t) + \omega_0^2 \cdot x(t) = 0 \hspace{0.5cm} \Bigg\vert \hspace{0.2cm} \delta=\frac{d}{2m} \hspace{0.2cm} and \hspace{0.2cm} \omega_0=\sqrt{\frac{k}{m}} \hspace{0.2cm} and \hspace{0.2cm} \ddot x(t) = \frac{\text{d}^2}{\text{d}t^2}x(t) \hspace{0.2cm} and \hspace{0.2cm} \dot x(t) = \frac{\text{d}}{\text{d}t}x(t)">


### 4.4 Markov decision process

#### 4.4.1 Latex

```latex
V^*(s) = \substack{\textbf{max}\\ {\tiny a}}\sum_{s'}^{} T(s, a, s')[R(s, a, s') + \gamma \cdot V_k(s')]
```

#### 4.4.2 Result

<img src="https://latex.ixno.de/?r=300&f=V%5E%2A%28s%29%20%3D%20%5Csubstack%7B%5Ctextbf%7Bmax%7D%5C%5C%20%7B%5Ctiny%20a%7D%7D%5Csum_%7Bs%27%7D%5E%7B%7D%20T%28s%2C%20a%2C%20s%27%29%5BR%28s%2C%20a%2C%20s%27%29%20%2B%20%5Cgamma%20%5Ccdot%20V_k%28s%27%29%5D" width="453" alt="V^*(s) = \substack{\textbf{max}\\ {\tiny a}}\sum_{s'}^{} T(s, a, s')[R(s, a, s') + \gamma \cdot V_k(s')]">

### 4.5 Schrödinger equation

#### 4.5.1 Latex

```latex
\mathrm{i} \hbar \frac{\partial}{\partial t} \ket{\psi(t, \textbf{x})} =
\hat{\mathcal{H}}(\hat{\textbf{x}}, \hat{\textbf{p}}) \ket{\psi(t, \textbf{x})} \hspace{0.5cm}
\Bigg\vert \hspace{0.2cm} \hbar = \frac{h}{2\pi} \hspace{0.2cm} and
\hspace{0.2cm} \hat{\mathcal{H}}(\hat{\textbf{x}}, \hat{\textbf{p}}) =
-\frac{\hat{\textbf{p}}^2}{2m} + V(\hat{\textbf{x}})
```

#### 4.5.2 Result

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=%5Cmathrm%7Bi%7D%20%5Chbar%20%5Cfrac%7B%5Cpartial%7D%7B%5Cpartial%20t%7D%20%5Cket%7B%5Cpsi%28t%2C%20%5Ctextbf%7Bx%7D%29%7D%20%3D%20%5Chat%7B%5Cmathcal%7BH%7D%7D%28%5Chat%7B%5Ctextbf%7Bx%7D%7D%2C%20%5Chat%7B%5Ctextbf%7Bp%7D%7D%29%20%5Cket%7B%5Cpsi%28t%2C%20%5Ctextbf%7Bx%7D%29%7D%20%5Chspace%7B0.5cm%7D%20%5CBigg%5Cvert%20%5Chspace%7B0.2cm%7D%20%5Chbar%20%3D%20%5Cfrac%7Bh%7D%7B2%5Cpi%7D%20%5Chspace%7B0.2cm%7D%20and%20%5Chspace%7B0.2cm%7D%20%5Chat%7B%5Cmathcal%7BH%7D%7D%28%5Chat%7B%5Ctextbf%7Bx%7D%7D%2C%20%5Chat%7B%5Ctextbf%7Bp%7D%7D%29%20%3D%20-%5Cfrac%7B%5Chat%7B%5Ctextbf%7Bp%7D%7D%5E2%7D%7B2m%7D%20%2B%20V%28%5Chat%7B%5Ctextbf%7Bx%7D%7D%29" width="697" alt="\mathrm{i} \hbar \frac{\partial}{\partial t} \ket{\psi(t, \textbf{x})} = \hat{\mathcal{H}}(\hat{\textbf{x}}, \hat{\textbf{p}}) \ket{\psi(t, \textbf{x})} \hspace{0.5cm} \Bigg\vert \hspace{0.2cm} \hbar = \frac{h}{2\pi} \hspace{0.2cm} and \hspace{0.2cm} \hat{\mathcal{H}}(\hat{\textbf{x}}, \hat{\textbf{p}}) = -\frac{\hat{\textbf{p}}^2}{2m} + V(\hat{\textbf{x}})">

## 5. Check for errors

If there is an error in the formula, you will get the following picture:

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=Error%5C%2C%28see%5C%2Cerror.log%29" width="201" alt="Error\,(see\,error.log)">

Check the web server error files to locate the error (example):

```
[Mon Aug 20 21:59:43.406729 2018] [:error] [pid 174] [client 172.17.0.1:33807] ) (/usr/share/texlive/texmf-dist/tex/latex/amsfonts/umsa.fd)
[Mon Aug 20 21:59:43.406734 2018] [:error] [pid 174] [client 172.17.0.1:33807] (/usr/share/texlive/texmf-dist/tex/latex/amsfonts/umsb.fd)
[Mon Aug 20 21:59:43.406738 2018] [:error] [pid 174] [client 172.17.0.1:33807]
[Mon Aug 20 21:59:43.406742 2018] [:error] [pid 174] [client 172.17.0.1:33807] LaTeX Warning: Command \\" invalid in math mode on input line 16.
[Mon Aug 20 21:59:43.406747 2018] [:error] [pid 174] [client 172.17.0.1:33807]
[Mon Aug 20 21:59:43.406751 2018] [:error] [pid 174] [client 172.17.0.1:33807] ! Please use \\mathaccent for accents in math mode.
[Mon Aug 20 21:59:43.406756 2018] [:error] [pid 174] [client 172.17.0.1:33807] \\add@accent ...@spacefactor \\spacefactor }\\accent
[Mon Aug 20 21:59:43.406761 2018] [:error] [pid 174] [client 172.17.0.1:33807]                                                   #1 #2\\egroup \\spacefactor ...
[Mon Aug 20 21:59:43.406766 2018] [:error] [pid 174] [client 172.17.0.1:33807] l.16 E=m\xc3\xb6
[Mon Aug 20 21:59:43.406771 2018] [:error] [pid 174] [client 172.17.0.1:33807]           c^2
[Mon Aug 20 21:59:43.406776 2018] [:error] [pid 174] [client 172.17.0.1:33807] !  ==> Fatal error occurred, no output PDF file produced!
[Mon Aug 20 21:59:43.406781 2018] [:error] [pid 174] [client 172.17.0.1:33807] Transcript written on /var/www/de/ixno/latex/php-latex-2-png/examples/cache/09f
[Mon Aug 20 21:59:43.406786 2018] [:error] [pid 174] [client 172.17.0.1:33807] 87da0b0e7a03f691d5e4e2d2165b0.log.
```

Or use the debug parameter (`d=1`) to see the log directly on screen:

https://latex.ixno.de/?c=0&r=300&f=E%3Dm%C3%B6c^2&d=1

## 6. The way it works (the technique)

If you don't like PHP and you want to build your own framework or you are just interested in how it works, you will find the following command line commands for creating images from tex files. This is the background of this library:

```shell
user$ vi latex.tex
```

```latex
\documentclass[border={1pt 1pt 1pt 1pt}]{standalone} % <- The padding arround the formula.
\nofiles
\usepackage[utf8]{inputenc}
\usepackage{amssymb,amsmath}
\usepackage{color}
\usepackage{amsfonts}
\usepackage{amssymb}
\usepackage{pst-plot}
\usepackage{physics}
\begin{document}
\pagestyle{empty}
$\displaystyle
E = m \cdot c^2 % <- The formula here at this point.
$
\end{document}
```

Create a pdf document `latex.pdf` (intermediate step):

```shell
user$ pdflatex latex.tex
```

Create the png image `latex.png` from `latex.pdf`:

```shell
user$ convert -density 300 latex.pdf -quality 100 latex.png
```

That's it. Now enjoy your png file `latex.png`.

## 7. Tools

* [Image-Template-Builder](https://latex.ixno.de/build.php)
* [Online-Formula-Editor](http://www.hostmath.com/) 

## A. Authors

* Björn Hempel <bjoern@hempel.li> - _Initial work_ - [https://github.com/bjoern-hempel](https://github.com/bjoern-hempel)

## B. Licence

This tutorial is licensed under the MIT License - see the [LICENSE.md](/LICENSE.md) file for details

## C. Closing words

Have fun! :)
