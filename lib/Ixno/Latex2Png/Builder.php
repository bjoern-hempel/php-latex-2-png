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
\\documentclass[12pt]{article}
\\nofiles
\\usepackage[utf8]{inputenc}
\\usepackage{amssymb,amsmath}
\\usepackage{color}
\\usepackage{amsfonts}
\\usepackage{amssymb}
\\usepackage{pst-plot}
\\begin{document}
\\pagestyle{empty}
\\begin{displaymath}
%s
\\end{displaymath}
\\end{document}
LATEX_DOCUMENT;

    protected $templateTexFile = '%s/%s.tex';

    protected $templateDviFile = '%s/%s.dvi';

    protected $templatePngFile = '%s/%s.png';

    protected $templateLogFile = '%s/%s.log';

    protected $templateTexCommand = 'latex -output-directory "%s" "%s" 1>/dev/null';

    protected $templateDviCommand = 'dvipng -q -T tight -D 300 -o %s %s 1>/dev/null 2>&1';

    protected $documentHash = null;

    protected $cacheFolder = null;

    /**
     * The constructor of this builder class.
     *
     * @author  Bjoern Hempel <bjoern@hempel.li>
     * @version 1.0 (2018-08-14)
     */
    public function __construct($cacheFolder, $latex)
    {
        $this->cacheFolder = $cacheFolder;
        $this->latex = $latex;
        $this->documentHash = md5($latex);
    }

    public function getLatexDocument()
    {
        return sprintf($this->latexDocument, $this->latex);
    }

    public function createPNG()
    {
        /* create filenames */
        $pngFile = sprintf($this->templatePngFile, $this->cacheFolder, $this->documentHash);

        /* do not render the png multiple times; use the cache */
        if (file_exists($pngFile)) {
            return file_get_contents($pngFile);
        }

        /* get the latex document */
        $latexDocument = $this->getLatexDocument();

        /* create filenames */
        $texFile = sprintf($this->templateTexFile, $this->cacheFolder, $this->documentHash);
        $dviFile = sprintf($this->templateDviFile, $this->cacheFolder, $this->documentHash);
        $logFile = sprintf($this->templateLogFile, $this->cacheFolder, $this->documentHash);

        /* save the latex document */
        file_put_contents($texFile, $latexDocument);

        /* execute tex command (create dvi file) */
        exec(sprintf($this->templateTexCommand, $this->cacheFolder, $texFile));

        /* execute dvi command (create png file) */
        exec(sprintf($this->templateDviCommand, $pngFile, $dviFile));

        /* tidy up the used files */
        unlink($texFile);
        unlink($dviFile);
        unlink($logFile);

        /* return the png file */
        return file_get_contents($pngFile);
    }

    public function sendPNGToBrowser()
    {
        $png = $this->createPNG();

        header('Content-type: image/png');
        header('Expires: 0');
        header(sprintf('Content-Length: %d', strlen($png)));

        print $png;
    }
}
