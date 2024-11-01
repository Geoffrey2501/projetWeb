<?php
declare(strict_types=1);
namespace iutnc\deefy\action;


/**
 * Class Action
 */
abstract class Action {

    /**
     * @var string
     */
    protected string $http_method;

    /**
     * @var string
     */
    protected string $hostname;

    /**
     * @var string
     */
    protected ?string $script_name;

    /**
     * Action constructor.
     */
    public function __construct(){

        $this->http_method = $_SERVER['REQUEST_METHOD'];
        $this->hostname = $_SERVER['HTTP_HOST'];
        $this->script_name = $_SERVER['SCRIPT_NAME'];
    }

    /**
     * @return string
     * executes the action
     */
    abstract public function execute() : string;

}