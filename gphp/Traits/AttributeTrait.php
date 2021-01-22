<?php

namespace Gphp\Traits;


trait AttributeTrait
{
    /**
     * 设置属性
     *
     * @param $name
     * @param $value
     * @author GP
     * @throws \Exception
     * DateTime: 2021/1/21 10:30
     */
    public function __set($name, $value)
    {
        if (method_exists($this, $name)) {
            $this->$name($value);
        } else
            if (property_exists(self::class, $name)){
                $this->$name = $value;
            }

        throw new \Exception('非法操作！');
    }

    /**
     * 获取属性
     *
     * @param $name
     * @return mixed
     * @throws \Exception
     * @author GP
     * DateTime: 2021/1/22 15:34
     */
    public function __get($name)
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        } else
            if (property_exists(self::class, $name)){
                return $this->$name;
            }

        throw new \Exception('非法获取！');
    }
}