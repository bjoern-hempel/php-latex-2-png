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

namespace Ixno\Latex2Png;

class Builder
{
    protected $latex = '';

    protected $latexDocument = <<<LATEX_DOCUMENT
\\documentclass[border={%s %s %s %s}]{standalone}

\\nofiles
\\usepackage[utf8]{inputenc}
\\usepackage{amssymb,amsmath}
\\usepackage{color}
\\usepackage{amsfonts}
\\usepackage{amssymb}
\\usepackage{pst-plot}
\\usepackage{physics}

\\begin{document}
\\pagestyle{empty}

$\\displaystyle
%s
$

\\end{document}
LATEX_DOCUMENT;

    protected $templateTexFile = '%s/%s.tex';

    protected $templatePdfFile = '%s/%s.pdf';

    protected $templatePngFile = '%s/%s.png';

    protected $templateLogFile = '%s/%s.log';

    protected $templatePdfCommand = 'pdflatex -halt-on-error -output-directory "%s" "%s" 2>&1';

    protected $templateConvertCommand = 'convert -density %d %s -quality 100 %s 1>/dev/null 2>&1';

    protected $documentHash = null;

    protected $cacheFolder = null;

    protected $useCache = true;

    protected $debug = false;

    /**
     * The constructor of this builder class.
     *
     * @author  Bjoern Hempel <bjoern@hempel.li>
     * @version 1.0 (2018-08-14)
     */
    public function __construct($cacheFolder, $latex, $useCache = true, $debug = false)
    {
        $this->cacheFolder = $cacheFolder;
        $this->latex = $latex;
        $this->useCache = $useCache;
        $this->debug = $debug;
    }

    public function getLatexDocument($padding = '1pt')
    {
        return sprintf(
            $this->latexDocument,
            $padding,
            $padding,
            $padding,
            $padding,
            $this->latex
        );
    }

    public function createPNG($outputResolution = 155, $padding = '1pt')
    {
        $this->documentHash = md5(sprintf('%d:%s:%s', $outputResolution, $padding, $this->latex));

        /* Create the cache directory if it does not exist */
        if (!file_exists($this->cacheFolder)) {
            mkdir($this->cacheFolder, 0775, true);
        }

        /* create filenames */
        $pngFile = sprintf($this->templatePngFile, $this->cacheFolder, $this->documentHash);

        /* do not render the png multiple times; use the cache */
        if ($this->useCache && file_exists($pngFile)) {
            return $pngFile;
        }

        /* get the latex document */
        $latexDocument = $this->getLatexDocument($padding);

        /* create filenames */
        $texFile = sprintf($this->templateTexFile, $this->cacheFolder, $this->documentHash);
        $pdfFile = sprintf($this->templatePdfFile, $this->cacheFolder, $this->documentHash);
        $logFile = sprintf($this->templateLogFile, $this->cacheFolder, $this->documentHash);

        /* save the latex document */
        file_put_contents($texFile, $latexDocument);

        /* execute tex command (create pdf file) */
        $output = '';
        $returnVar = 0;
        exec(sprintf($this->templatePdfCommand, $this->cacheFolder, $texFile), $output, $returnVar);

        /* an error occurred */
        if ($returnVar > 0) {
            if ($this->debug) {
                foreach ($output as $o) {
                    echo $o.'<br />';
                }
                exit;
            }

            foreach ($output as $o) {
                error_log($o);
            }

            $this->latex = 'Error\,(see\,error.log)';
            return $this->createPNG($outputResolution, $padding);
        }

        /* execute convert command (create png file) */
        exec(sprintf($this->templateConvertCommand, $outputResolution, $pdfFile, $pngFile));

        /* tidy up the used files */
        unlink($texFile);
        unlink($pdfFile);
        unlink($logFile);

        /* return the png file */
        return $pngFile;
    }

    public function sendPNGToBrowser($outputResolution = 155, $padding = '1pt')
    {
        $pngPath = $this->createPNG($outputResolution, $padding);

        $png = file_get_contents($pngPath);

        header('Content-type: image/png');
        header('Expires: 0');
        header(sprintf('Content-Length: %d', strlen($png)));

        print $png;
    }
}
