<?php

namespace Gphp\Traits;


trait SingletonTrait
{

    private function __clone()
    {
        throw new \Exception('无法'.__CLASS__.'对象');
    }

}