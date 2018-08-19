<?php
/*
 * MIT License
 *
 * Copyright (c) 2018 Björn Hempel <bjoern@hempel.li>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

include dirname(__FILE__).'/../autoload.php';

use Ixno\Latex2Png\Builder;

/* Some configs */
$cacheFolder = dirname(__FILE__).'/cache';
$useCache    = true;
$resolution  = 600;
$padding     = '1pt';
$formula     = '\sum_{i = 0}^{n} i = \frac{n(n + 1)}{2}';

if (array_key_exists('c', $_REQUEST)) {
    $useCache = $_REQUEST['c'] === '1' ? true : false;
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

/**
 * Collect all informations and print them.
 *
 * @author  Björn Hempel <bjoern@hempel.li>
 * @version 1.0 (2018-08-19)
 */
function getInformations($cacheFolder, $useCache, $resolution, $padding, $formula)
{
    $resolutions = array(150, 300, 600);

    $templatePost = <<<TEMPLATE_POST
<style>
    textarea { width: 600px; height: 300px; }
</style>

<form method="post">
    <label for="formula">Formula (Latex):</label><br />
    <textarea name="f" id="formula">%s</textarea><br />
    <br />
    <label for="resolution">Resolution:</label><br />
    <select name="r" id="resolution">%s</select><br />
    <br />
    <label for="padding">Padding:</label><br />
    <select name="p" id="padding">%s</select><br />
    <br />
    <label for="useCache">Use cache:</label><br />
    Yes <input type="radio" id="cache1" name="c" value="1"%s> &nbsp;
    No <input type="radio" id="cache0" name="c" value="0"%s><br />
    <br />
    <input type="submit" value="%s">
</form>
TEMPLATE_POST;

    $templateOption = '<option value="%s"%s>%s</option>';

    $optionsResolution = '';
    foreach ($resolutions as $r) {
        $optionsResolution .= sprintf($templateOption, $r, intval($resolution) === $r ? ' selected' : '', $r);
    }

    $optionsPadding = '';
    for ($i = 0; $i <= 10; $i++) {
        $p = sprintf('%dpt', $i);
        $optionsPadding .= sprintf($templateOption, $p, $padding === $p ? ' selected' : '', $p);
    }

    echo sprintf(
        $templatePost,
        $formula,
        $optionsResolution,
        $optionsPadding,
        $useCache ? ' checked' : '',
        $useCache ? '' : ' checked',
        'Submit'
    );
}

function showInformations($cacheFolder, $useCache, $resolution, $padding, $formula)
{
    $templateUrl   = '%s?r=%d&p=%s&c=%d&f=%s';
    $templateImage = '<img src="%s" width="%d">';

    $templateInformation = <<<TEMPLATE_INFORMATION
<style>

    table {  
        color: #333;
        font-family: Helvetica, Arial, sans-serif;
        border-collapse: collapse;
        border-spacing: 0; 
    }

    td, th {  
        border: 1px solid transparent;
        height: 30px; 
        transition: all 0.3s;
        padding: 20px;
    }

    th {
        background: #d0d0d0;
        font-weight: bold;
    }

    td {  
        background: #fafafa;
        text-align: left;
    }

    tr:nth-child(even) td { background: #f1f1f1; }   
    tr:nth-child(odd) td { background: #fefefe; }  

    tr td:hover { background: #b0b0b0; }  

</style>

<table border="0" cellpadding="0" cellspacing="0">
    <thead>
        <tr><th>Name</th><th>Value</th></tr>
    </thead>
    <tbody>
        <tr><td>URL:</td><td>%s</td></tr>
        <tr><td>Image-Tag:</td><td>%s</td></tr>
        <tr><td>Preview:</td><td>%s</td></tr>
    </tbody>
</table>

%s
TEMPLATE_INFORMATION;

    $builder = new Builder($cacheFolder, $formula, $useCache);

    $pngPath = $builder->createPNG($resolution, $padding);

    $pngPathWeb = str_replace($cacheFolder, '', $pngPath);

    $size = getimagesize($pngPath);

    $width = floor($size[0] / 2);

    $url     = sprintf($templateUrl, 'https://latex.ixno.de/', $resolution, $padding, $useCache ? '1' : '0', rawurlencode($formula));
    $urlLink = sprintf($templateUrl, '', $resolution, $padding, $useCache ? '1' : '0', rawurlencode($formula));
    $image   = sprintf($templateImage, $url, $width);

    echo sprintf($templateInformation, $url, htmlspecialchars($image), $image, '<a href="'.$urlLink.'">Back</a>');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    getInformations($cacheFolder, $useCache, $resolution, $padding, $formula);
} else {
    showInformations($cacheFolder, $useCache, $resolution, $padding, $formula);
}

