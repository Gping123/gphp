<?php

namespace Gphp\App;

use Gphp\Filesystem\Dir;
use Gphp\Traits\SingletonTrait;

class Config
{
    use SingletonTrait;

    /**
     * @var null 配置对象
     */
    protected static $object = null;

    /**
     * 配置文件根目录
     */
    const ROOT = 'config';

    /**
     * @var array
     */
    protected $config = [];

    /**
     * Config constructor.
     */
    protected function __construct()
    {
        $this->init();
    }

    /**
     * 初始化方法
     *
     * @author GP
     * DateTime: 2021/1/22 16:02
     */
    public function init()
    {
        Dir::sRead(self::ROOT, function ($fileName, $fullFile) {
            if (in_array($fileName, ['.', '..'])) {
                return ;
            }

            $this->set(pathinfo($fileName, PATHINFO_FILENAME), (require $fullFile));
        });
    }

    /**
     * 设置配置项
     *
     * @param $name
     * @param $val
     * @return $this
     * @author GP
     * DateTime: 2021/1/22 17:15
     */
    public function set($name, $val)
    {
        $this->config[$name] = $val;

        return $this;
    }

    /**
     * 获取配置信息
     *
     * @param $name
     * @return mixed|null
     * @author GP
     * DateTime: 2021/1/22 16:08
     */
    public function get(string $name = '')
    {
        if ($name == '') {
            return null;
        }

        if (strpos($name, '.') !== false) {
            $config = $this->config;
            foreach (explode('.', $name) as $key) {
                $config = $config[$key];
            }

            return $config;
        }

        if (array_key_exists($name, $this->config) ) {
            return $this->config[$name];
        }

        return null;
    }


    # ====== 静态方法 ======

    /**
     * 创建配置对象
     *
     * @return Config|null
     * @author GP
     * DateTime: 2021/1/22 16:00
     */
    public static function create()
    {
        if (is_null(self::$object)) {
            self::$object = new self();
        }

        return self::$object;
    }


}