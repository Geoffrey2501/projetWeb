<?php
declare(strict_types=1);
namespace iutnc\deefy\Action;

class DefaultAction extends Action
{
    public function execute(): string
    {
        return "Bienvenue sur Deefy !";
    }
}