<?php

/**
 * MIT License
 *
 * Copyright (c) 2021 Heinrich Schiller
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
 *
 */

declare( strict_types = 1 );

namespace Slim\Views;

use Mustache_Engine;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Slim4 Mustache View
 * 
 * This class is a Slim Framework view helper built on top 
 * of the Mustache templating component.
 * Mustache is a PHP component created by Justin Hileman.
 * 
 * @link https://github.com/bobthecow/mustache.php
 */
class Mustache implements ViewInterface
{
    /**
     * @var Mustache_Engine
     */
    private $mustache;

    /**
     * The constructor
     * 
     * @param array $options Mustache constructor options
     * 
     * For more details about Mustache constructor options,
     * see: 
     * 
     * https://github.com/bobthecow/mustache.php/wiki#constructor-options
     */
    public function __construct(array $options)
    {
        $this->mustache = new Mustache_Engine($options);
    }

    /**
     * Output rendered template
     * 
     * @param Response $response
     * @param string $template Name of the template
     * @param mixed $data Template variables
     * 
     * @return Response
     */
    public function render(Response $response, string $template, $data = []): Response
    {
        $html = $this->mustache->render($template, $data);
        $response->getBody()->write($html);

        return $response;
    }
}