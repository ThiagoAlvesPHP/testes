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

        $blockedBranches = ['main', 'homolog'];
        if (in_array($currentBranch, $blockedBranches, true)) {
            $io->writeError("<error>Push para a branch '{$currentBranch} não é permitido.'.</error>");
            throw new \RuntimeException('Erro: branch bloqueada para push.');
        }

        // Mensagem para confirmar que a branch é permitida
        $io->write("<info>Push permitido na branch '{$currentBranch}'.</info>");
    }
}
