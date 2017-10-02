<?php
/**
 * Created by PhpStorm.
 * User: anilrayamajhi
 * Date: 3/6/17
 * Time: 11:18 AM
 */

namespace AppBundle\Service;


class MarkdownTransformer
{
    public function parse($str)
    {
        return strtoupper($str);
    }
}