<?php

declare(strict_types=1);

namespace App\GitHook;

use CaptainHook\App\Config;
use CaptainHook\App\Config\Action;
use CaptainHook\App\Console\IO;
use CaptainHook\App\Hook\Action as HookAction;
use SebastianFeldmann\Git\Repository as Repo;

class NoEmptyCommitMessages implements HookAction
{
    /**
     * Execute the action.
     *
     * @throws \Exception
     */
    public function execute(Config $config, IO $io, Repo $repository, Action $action): void
    {
        $message = $repository->getCommitMsg();
        if (empty($message->getContent())) {
            $io->writeError('<error>Commit rejeitado: A mensagem de commit não pode estar vazia. Por favor, adicione uma descrição significativa.</error>');
            throw new \RuntimeException('Erro: mensagem de commit vazia.');
        }

        $io->write('<info>Commit aceito.</info>');
    }
}
