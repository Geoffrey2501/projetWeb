<?php

class Psr4Loader
{

    /**
     * @var string
     */
    private string $namespacePrefix;

    /**
     * @var string
     */
    private string $baseDir;

    /**
     * @param string $namespacePrefix
     * @param string $baseDir
     */
    public function __construct($namespacePrefix, $baseDir) {
        $this->namespacePrefix = rtrim($namespacePrefix, '\\') . '\\';
        $this->baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }


    /**
     * @return void
     * register loader with SPL autoloader stack
     */
    public function register() {
        spl_autoload_register([$this, 'loadClass']);
    }

    /**
     * @param string $className
     * @return void
     * load the class file for a given class name
     */
    public function loadClass($className) {
        $relativeClass = substr($className, strlen($this->namespacePrefix));
        $relativeClass = str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass);
        $file = $this->baseDir . $relativeClass . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
}