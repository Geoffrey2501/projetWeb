<?php
declare(strict_types=1);
namespace iutnc\deefy\action;


abstract class Action {

    protected string $http_method ;
    protected string $hostname;
    protected ?string $script_name;

    public function __construct(){

        $this->http_method = $_SERVER['REQUEST_METHOD'];
        $this->hostname = $_SERVER['HTTP_HOST'];
        $this->script_name = $_SERVER['SCRIPT_NAME'];
    }

    abstract public function execute() : string;

}