<?php

/**
 * Textile - A Humane Web Text Generator
 *
 * Copyright (c) 2012 Netcarver http://github.com/netcarver
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *
 * * Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * * Neither the name Textile nor the names of its contributors may be used to
 * endorse or promote products derived from this software without specific
 * prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace Netcarver\Textile;

/**
 * Constructs a HTML tag.
 *
 * This class allows constructing objects to HTML tags. Each
 * set method will be used a tag attribute.
 *
 * @example
 * echo (string) new Tag('img')->class('big blue')->src('images/elephant.jpg');
 */
class Tag extends \Netcarver\Textile\DataBag
{
    /**
     * Stores the tag name.
     *
     * @var string
     */
    protected $tag;

    /**
     * Creates a self-closing tag.
     *
     * @var bool
     */
    protected $selfclose;

    /**
     * Constructor.
     *
     * @param string $name        The tag name
     * @param array  $attribs     An array attributes
     * @param bool   $selfclosing If TRUE, creates a self-closing tag
     * @example
     * echo (string) new Tag('a', array('href' => '#'), false);
     */
    public function __construct($name, $attribs=array(), $selfclosing=true)
    {
        parent::__construct($attribs);
        $this->tag = $name;
        $this->selfclose = $selfclosing;
    }

    /**
     * Constructs a tag from the object.
     *
     * @return string HTML tag
     */
    public function __tostring()
    {
        $attribs = '';

        if (count($this->data)) {
            ksort($this->data);
            foreach ($this->data as $k => $v) {
                $attribs .= " $k=\"$v\"";
            }
        }

        if ($this->tag) {
            $o = '<' . $this->tag . $attribs . (($this->selfclose) ? " />" : '>');
        } else {
            $o = $attribs;
        }

        return $o;
    }
}
