# A Latex2Png library

With this library you can directly convert latex formulas into images. Feel free to use it directly on github.com or in your web projects:

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

To include all needed libraries to your project you can use `vendor/autoload.php`.

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

And of course also on other systems. ;) See the documentation of the corresponding system.

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

TODO.. (add a cli example)

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


### 4.4 Bellman equation

#### 4.4.1 Latex

```latex
V^*(s) = \substack{\textbf{max}\\ {\tiny a}}\sum_{s'}^{} T(s, a, s')[R(s, a, s') +
\gamma \cdot V^*(s')] \quad \forall s
```

#### 4.4.2 Result

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=V%5E%2A%28s%29%20%3D%20%5Csubstack%7B%5Ctextbf%7Bmax%7D%5C%5C%20%7B%5Ctiny%20a%7D%7D%5Csum_%7Bs%27%7D%5E%7B%7D%20T%28s%2C%20a%2C%20s%27%29%5BR%28s%2C%20a%2C%20s%27%29%20%2B%20%5Cgamma%20%5Ccdot%20V%5E%2A%28s%27%29%5D%20%5Cquad%20%5Cforall%20s" width="499" alt="V^*(s) = \substack{\textbf{max}\\ {\tiny a}}\sum_{s'}^{} T(s, a, s')[R(s, a, s') + \gamma \cdot V^*(s')] \quad \forall s">

### 4.5 Schrödinger equation

#### 4.5.1 Latex

```latex
\mathrm{i} \hbar \partial_t \ket{\psi_{(\textbf{x}, t)}} = \hat{\mathcal{H}}_{(\hat{\textbf{p}},
\hat{\textbf{x}})} \ket{\psi_{(\textbf{x}, t)}} \hspace{0.5cm} \Bigg\vert \hspace{0.2cm}
\hbar = \frac{h}{2\pi} \hspace{0.2cm} and \hspace{0.2cm} \hat{\mathcal{H}}_{(\hat{\textbf{p}},
\hat{\textbf{x}})} = -\frac{\hat{\textbf{p}}^2}{2m} + V_{(\hat{\textbf{x}})}
```

#### 4.5.2 Result

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=%5Cmathrm%7Bi%7D%20%5Chbar%20%5Cpartial_t%20%5Cket%7B%5Cpsi_%7B%28%5Ctextbf%7Bx%7D%2C%20t%29%7D%7D%20%3D%20%5Chat%7B%5Cmathcal%7BH%7D%7D_%7B%28%5Chat%7B%5Ctextbf%7Bp%7D%7D%2C%20%5Chat%7B%5Ctextbf%7Bx%7D%7D%29%7D%20%5Cket%7B%5Cpsi_%7B%28%5Ctextbf%7Bx%7D%2C%20t%29%7D%7D%20%5Chspace%7B0.5cm%7D%20%5CBigg%5Cvert%20%5Chspace%7B0.2cm%7D%20%5Chbar%20%3D%20%5Cfrac%7Bh%7D%7B2%5Cpi%7D%20%5Chspace%7B0.2cm%7D%20and%20%5Chspace%7B0.2cm%7D%20%5Chat%7B%5Cmathcal%7BH%7D%7D_%7B%28%5Chat%7B%5Ctextbf%7Bp%7D%7D%2C%20%5Chat%7B%5Ctextbf%7Bx%7D%7D%29%7D%20%3D%20-%5Cfrac%7B%5Chat%7B%5Ctextbf%7Bp%7D%7D%5E2%7D%7B2m%7D%20%2B%20V_%7B%28%5Chat%7B%5Ctextbf%7Bx%7D%7D%29%7D" width="640" alt="\mathrm{i} \hbar \partial_t \ket{\psi_{(\textbf{x}, t)}} = \hat{\mathcal{H}}_{(\hat{\textbf{p}}, \hat{\textbf{x}})} \ket{\psi_{(\textbf{x}, t)}} \hspace{0.5cm} \Bigg\vert \hspace{0.2cm} \hbar = \frac{h}{2\pi} \hspace{0.2cm} and \hspace{0.2cm} \hat{\mathcal{H}}_{(\hat{\textbf{p}}, \hat{\textbf{x}})} = -\frac{\hat{\textbf{p}}^2}{2m} + V_{(\hat{\textbf{x}})}">

### 4.6 Derivation of the time-dependent Schrödinger equation from wave mechanics

#### 4.6.1 Latex

See below

#### 4.6.2 Result

See below

#### 4.6.3 Wave equation

See [Wave equation (Wikipedia)](https://en.wikipedia.org/wiki/Wave_equation)

```latex
(\partial_x^2-\frac{1}{c^2}\partial_t^2)\psi=0
```

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=%28%5Cpartial_x%5E2-%5Cfrac%7B1%7D%7Bc%5E2%7D%5Cpartial_t%5E2%29%5Cpsi%3D0" width="171" alt="(\partial_x^2-\frac{1}{c^2}\partial_t^2)\psi=0">

#### 4.6.4 Relativistic law of conservation of energy

Particles are considered to be massless (m = 0). For relativistic law of conservation of energy see [Wikipedia (german)](https://de.wikipedia.org/wiki/Energieerhaltungssatz#Energieerhaltungssatz_in_der_Relativit%C3%A4tstheorie)

```latex
E^2=c^2p^2+m^2c^4 \,\, \xrightarrow{\text{m=0}} \,\, -(p^2 - \frac{1}{c^2}E^2)=0
```

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=E%5E2%3Dc%5E2p%5E2%2Bm%5E2c%5E4%20%5C%2C%5C%2C%20%5Cxrightarrow%7B%5Ctext%7Bm%3D0%7D%7D%20%5C%2C%5C%2C%20-%28p%5E2%20-%20%5Cfrac%7B1%7D%7Bc%5E2%7DE%5E2%29%3D0" width="411" alt="E^2=c^2p^2+m^2c^4 \,\, \xrightarrow{\text{m=0}} \,\, -(p^2 - \frac{1}{c^2}E^2)=0">

The transformation of the equation is now somewhat similar to the wave function and shows the relationship between the classical mechanics and the relativistic mechanics (correspondence principle).

#### 4.6.5 Correspondence principle

Derivation from 4.6.3 and 4.6.4. For correspondence principle see [Correspondence principle (Wikipedia)](https://en.wikipedia.org/wiki/Correspondence_principle)

```latex
\begin{aligned} p {}\longrightarrow{} & \frac{1}{\mathrm{i}} \hbar
\partial_x \\ E {}\longrightarrow{} & \mathrm{i} \hbar \partial_t \\
\mathrm{i}^2 {}\longrightarrow{} & -1 \end{aligned}
```

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=%5Cbegin%7Baligned%7D%0D%0Ap%20%7B%7D%5Clongrightarrow%7B%7D%20%26%20%5Cfrac%7B1%7D%7B%5Cmathrm%7Bi%7D%7D%20%5Chbar%20%5Cpartial_x%20%5C%5C%0D%0AE%20%7B%7D%5Clongrightarrow%7B%7D%20%26%20%5Cmathrm%7Bi%7D%20%5Chbar%20%5Cpartial_t%20%5C%5C%0D%0A%5Cmathrm%7Bi%7D%5E2%20%7B%7D%5Clongrightarrow%7B%7D%20%26%20-1%0D%0A%5Cend%7Baligned%7D" width="124" alt="\begin{aligned} p {}\longrightarrow{} & \frac{1}{\mathrm{i}} \hbar \partial_x \\ E {}\longrightarrow{} & \mathrm{i} \hbar \partial_t \\ \mathrm{i}^2 {}\longrightarrow{} & -1 \end{aligned}">

Test: If we put this relationship into the relativistic energy equation, we get the classical wave equation.

#### 4.6.6 Total energy

The total amount of energy is the sum of the kinetic energy and the potential energy:

```latex
\frac{p^2}{2m} + V = E
```

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=%5Cfrac%7Bp%5E2%7D%7B2m%7D%20%2B%20V%20%3D%20E" width="131" alt="\frac{p^2}{2m} + V = E">

#### 4.6.7 Use correspondence principle

```latex
-\frac{\hbar^2 \partial_x^2}{2m}+V = \mathrm{i} \hbar \partial_t \hspace{0.5cm}
\Bigg\vert \hspace{0.2cm} \cdot \psi_{(x,t)}
```

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=-%5Cfrac%7B%5Chbar%5E2%20%5Cpartial_x%5E2%7D%7B2m%7D%2BV%20%3D%20%5Cmathrm%7Bi%7D%20%5Chbar%20%5Cpartial_t%20%5Chspace%7B0.5cm%7D%0D%0A%5CBigg%5Cvert%20%5Chspace%7B0.2cm%7D%20%5Ccdot%20%5Cpsi_%7B%28x%2Ct%29%7D" width="290" alt="-\frac{\hbar^2 \partial_x^2}{2m}+V = \mathrm{i} \hbar \partial_t \hspace{0.5cm} \Bigg\vert \hspace{0.2cm} \cdot \psi_{(x,t)}">

```latex
-\frac{\hbar^2 \partial_x^2}{2m} \psi_{(x,t)}+V \psi_{(x,t)} = \mathrm{i}
\hbar \partial_t \psi_{(x,t)}
```

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=-%5Cfrac%7B%5Chbar%5E2%20%5Cpartial_x%5E2%7D%7B2m%7D%20%5Cpsi_%7B%28x%2Ct%29%7D%2BV%20%5Cpsi_%7B%28x%2Ct%29%7D%20%3D%20%5Cmathrm%7Bi%7D%20%5Chbar%20%5Cpartial_t%20%5Cpsi_%7B%28x%2Ct%29%7D" width="323" alt="-\frac{\hbar^2 \partial_x^2}{2m} \psi_{(x,t)}+V \psi_{(x,t)} = \mathrm{i} \hbar \partial_t \psi_{(x,t)}">

Now we have the time-dependent Schrödinger equation.


### 4.7 Gaussian error integral

#### 4.7.1 Latex

```latex
\int_{-\infty}^{\infty} e^{-x^2} dx = \sqrt{\pi}
```

#### 4.7.2 Result

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=%5Cint_%7B-%5Cinfty%7D%5E%7B%5Cinfty%7D%20e%5E%7B-x%5E2%7D%20dx%20%3D%20%5Csqrt%7B%5Cpi%7D" width="178" alt="\int_{-\infty}^{\infty} e^{-x^2} dx = \sqrt{\pi}">

### 4.8 Eulerian identity

#### 4.8.1 Latex

```latex
e^{\mathrm{i}\cdot\pi} + 1 = 0 \hspace{0.5cm} \Bigg\vert \hspace{0.2cm}
e^{\mathrm{i}\cdot\pi} = {\underbrace{cos(\pi)}_{=-1}} + {\underbrace{\mathrm{i} \cdot sin(\pi)}_{=0}}
```

#### 4.8.2 Result

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=e%5E%7B%5Cmathrm%7Bi%7D%5Ccdot%5Cpi%7D%20%2B%201%20%3D%200%20%5Chspace%7B0.5cm%7D%20%5CBigg%5Cvert%0D%0A%5Chspace%7B0.2cm%7D%20e%5E%7B%5Cmathrm%7Bi%7D%5Ccdot%5Cpi%7D%20%3D%20%7B%5Cunderbrace%7Bcos%28%5Cpi%29%7D_%7B%3D-1%7D%7D%20%2B%20%7B%5Cunderbrace%7B%5Cmathrm%7Bi%7D%20%5Ccdot%20sin%28%5Cpi%29%7D_%7B%3D0%7D%7D" width="383" alt="e^{\mathrm{i}\cdot\pi} + 1 = 0 \hspace{0.5cm} \Bigg\vert \hspace{0.2cm} e^{\mathrm{i}\cdot\pi} = {\underbrace{cos(\pi)}_{=-1}} + {\underbrace{\mathrm{i} \cdot sin(\pi)}_{=0}}">

### 4.9 Euler product

#### 4.9.1 Latex

```latex
{\underbrace{\sum_{n=1}^\infty {1 \over n^s}}_{Riemannsche \hspace{0.1cm} Zeta-Funktion}}
= {\underbrace{\prod_p {1 \over {1 - {1 \over {p^s}}}}}_{p \in \mathbb{P} \hspace{0.2cm}
\wedge \hspace{0.2cm} s \hspace{0.1cm} > \hspace{0.1cm} 1}}
```

#### 4.9.2 Result

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=%7B%5Cunderbrace%7B%5Csum_%7Bn%3D1%7D%5E%5Cinfty%20%7B1%20%5Cover%20n%5Es%7D%7D_%7BRiemannsche%20%5Chspace%7B0.1cm%7D%20Zeta-Funktion%7D%7D%20%3D%20%7B%5Cunderbrace%7B%5Cprod_p%20%7B1%20%5Cover%20%7B1%20-%20%7B1%20%5Cover%20%7Bp%5Es%7D%7D%7D%7D%7D_%7Bp%20%5Cin%20%5Cmathbb%7BP%7D%20%5Chspace%7B0.2cm%7D%20%5Cwedge%20%5Chspace%7B0.2cm%7D%20s%20%5Chspace%7B0.1cm%7D%20%3E%20%5Chspace%7B0.1cm%7D%201%7D%7D" width="373" alt="{\underbrace{\sum_{n=1}^\infty {1 \over n^s}}_{Riemannsche \hspace{0.1cm} Zeta-Funktion}} = {\underbrace{\prod_p {1 \over {1 - {1 \over {p^s}}}}}_{p \in \mathbb{P} \hspace{0.2cm} \wedge \hspace{0.2cm} s \hspace{0.1cm} > \hspace{0.1cm} 1}}">

## 5. Check for errors

If there is an error in the formula, you will get the following picture:

<img src="https://latex.ixno.de/?r=300&p=1pt&c=1&f=Error%5C%2C%28see%5C%2Cerror.log%29" width="201" alt="Error\,(see\,error.log)">

Check the web server error files to locate the error (example):

```
...
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

That's it. Enjoy!

## 7. Tools

* [Image-Template-Builder](https://latex.ixno.de/build.php)
* [Online-Formula-Editor](http://www.hostmath.com/)
* [TeX Mathmode](http://www.lsv.fr/~markey/LaTeX/doc/Mathmode.pdf)
* [List of LaTeX symbols](http://latex.wikia.com/wiki/List_of_LaTeX_symbols)

## A. Authors

* Björn Hempel <bjoern@hempel.li> - _Initial work_ - [https://github.com/bjoern-hempel](https://github.com/bjoern-hempel)

## B. Licence

This tutorial is licensed under the MIT License - see the [LICENSE.md](/LICENSE.md) file for details

## C. Closing words

Have fun! :)
