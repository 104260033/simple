<?php

namespace Services;


class View
{
    public $path;
    const VIEW_BASE_PATH = 'App/Views/';

    public function __construct($path)
    {
        $this->path = $path;
    }

    public static function make($viewName = null)
    {
        if(! $viewName){
            throw new \InvalidArgumentException('视图名称不能为空');
        } else {
            $viewFilePath = static::getFilePath($viewName);
            if(is_file($viewFilePath)){
                return new static($viewFilePath);
            }else{
                throw new \UnexpectedValueException('视图文件不存在');
            }
        }
    }

    public function with($key,$value = null)
    {
        $this->data[$key] = $value;
        return $this;
    }


    public static function getFilePath($viewName)
    {
        $filePath = str_replace('.','/',$viewName);
        return BASE_PATH.'/'.static::VIEW_BASE_PATH.$filePath.'.php';
    }

    public function __call($method, $parameters)
    {
        if(starts_with($method,'with')){
            return $this->with(snake_case(substr($method,4)),$parameters[0]);
        }
        throw new \BadMethodCallException("方法 {$method} 不存在");
    }

    protected function show()
    {
        extract($this->data);
        require ''.$this->path.'';
    }
    public function __destruct()
    {
        $this->show();
    }
}