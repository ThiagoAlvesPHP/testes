<?php

declare(strict_types=1);

namespace App\GitHook;

use CaptainHook\App\Config;
use CaptainHook\App\Config\Action;
use CaptainHook\App\Console\IO;
use CaptainHook\App\Hook\Action as HookAction;
use SebastianFeldmann\Git\Repository as Repo;

class PrePushBranchsBlock implements HookAction
{
    /**
     * Execute the action.
     *
     * @throws \Exception
     */
    public function execute(Config $config, IO $io, Repo $repository, Action $action): void
    {
        // Obtém o nome da branch atual
        $currentBranch = $repository->getInfoOperator()->getCurrentBranch();

        // Adicione lógica para bloquear branches específicas
        $blockedBranches = ['main', 'master', 'release']; // Branches que devem ser bloqueadas
        if (in_array($currentBranch, $blockedBranches, true)) {
            throw new \Exception("Push para a branch '{$currentBranch}' não é permitido.");
        }

        // Mensagem para confirmar que a branch é permitida
        $io->write("<info>Push permitido na branch '{$currentBranch}'.</info>");
    }
}
