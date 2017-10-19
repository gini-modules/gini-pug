<?php

namespace Gini\View;

class Pug implements Engine
{
    private $_path;
    private $_vars;

    private static $_pug;

    public function __construct($path, array $vars)
    {
        $this->_path = $path;
        $this->_vars = $vars;
        if (!self::$_pug) {
            self::$_pug = new \Pug\Pug([
                'pretty' => true,
                'cache'=> self::cacheDir(),
                'expressionLanguage' => 'js'
            ]);
        }
    }

    public function __toString()
    {
        if ($this->_path) {
            $output = self::$_pug->render($this->_path, $this->_vars);
        }

        return $output;
    }

    public static function cacheDir() {
        return \Gini\Config::get('pug.cache_dir') ?: sys_get_temp_dir().'/gini-pug';
    }
}
