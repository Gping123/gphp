<?php

namespace Gphp\Helper;

class Arr 
{


    # ====== static methods ======
    /**
     * 数组转路径
     *
     * @param $pathA
     * @param string $pathB
     * @param string $separator
     * @return string
     * @author GP
     * DateTime: 2021/1/22 16:23
     */
    public static function toString($pathA, string $pathB = '',  string $separator = DIRECTORY_SEPARATOR)
    {
        if (!is_array($pathA)) {
            $pathA = [$pathA, $pathB];
        }

        $pathStr = '';
        foreach ($pathA as $key => $path) {
            if ($path == array_key_first($pathA)) {
                $path = rtrim($path, $separator) . '/';
            } else {
                $path = '/' . ltrim($path, $separator);
            }

            $pathStr .= $path;
        }

        return substr($pathStr, 0, -1);
    }

}
