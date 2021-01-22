<?php

namespace Gphp\Filesystem;

use Gphp\Helper\Arr;

class Dir
{
    /**
     * @var string 目录
     */
    protected $path = '';

    /**
     * 构造方法
     *
     * Dir constructor.
     * @param string|null $path
     * @throws \Exception
     */
    public function __construct(string $path = null)
    {
        if (!is_null($path)) {
            $this->setPath($path);
        }
    }

    /**
     * 设置对象目录
     *
     * @param string $path
     * @return $this
     * @throws \Exception
     * @author GP
     * DateTime: 2021/1/22 16:13
     */
    public function setPath(string $path)
    {
        if (is_null($path)) {
            throw new \Exception('无效目录');
        }

        $appRootDir = app()->getRootDir();

        $this->path = Arr::toString([$appRootDir, $path]);

        return $this;
    }

    /**
     * 获取目录文件回调
     *
     * @param \Closure $callback
     * @return bool
     * @throws \Exception
     * @author GP
     * DateTime: 2021/1/22 16:48
     */
    public function read(\Closure $callback)
    {
        if (is_dir($this->path)) {
            $dir = opendir($this->path);

            while (false !== ($file = readdir($dir))) {
                call_user_func($callback, $file , Arr::toString($this->path, $file), $this);
            }

            closedir($dir);
            return true;
        }

        throw new \Exception($this->path.'非目录文件！');
    }

    /**
     * 读取目录并返回当前文件
     *
     * @return array
     * @throws \Exception
     * @author GP
     * @return array
     * DateTime: 2021/1/22 16:53
     */
    public function readToArray() : array
    {
        $arr = [];

        $this->read(function ($file, $fullFile) use(&$arr) {
            if (!in_array($file, ['.','..'])) {
                $arr[] = $fullFile;
            }
        });

        return $arr;
    }

    # ====== static methods ======
    public static function sRead(string $dir, \Closure $closure){
        (new self($dir))->read($closure);
    }


}
