<?php
declare(strict_types=1);
namespace iutnc\deefy\Action;

/**
 * Class DefaultAction
 * action to display the default page
 */
class DefaultAction extends Action
{
    /**
     * execute the default action and return the result
     * @return string
     */
    public function execute(): string
    {
        return "Bienvenue sur Deefy !";
    }
}