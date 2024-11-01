<?php

class Psr4Loader
{
    private string $namespacePrefix;

    private string $baseDir;
    public function __construct($namespacePrefix, $baseDir) {
        $this->namespacePrefix = rtrim($namespacePrefix, '\\') . '\\';
        $this->baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }


    public function register() {
        spl_autoload_register([$this, 'loadClass']);
    }

    public function loadClass($className) {
        $relativeClass = substr($className, strlen($this->namespacePrefix));
        $relativeClass = str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass);
        $file = $this->baseDir . $relativeClass . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
}