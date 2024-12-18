<?php

// Lê a entrada do Git enviada ao hook
$stdin = fopen('php://stdin', 'r');
$protectedBranches = ['stage', 'homolog', 'master'];

while (($line = fgets($stdin)) !== false) {
    $parts = preg_split('/\s+/', trim($line));
    if (count($parts) >= 2) {
        $localBranch = $parts[0];
        $remoteBranch = $parts[1];

        // Captura apenas o nome da branch remota
        if (preg_match('/refs\/heads\/(.+)/', $remoteBranch, $matches)) {
            $branch = $matches[1];

            // Verifica se o branch está na lista de protegidos
            if (in_array($branch, $protectedBranches, true)) {
                fwrite(STDERR, "Push direto para a branch '{$branch}' é proibido.\n");
                exit(1); // Bloqueia o push
            }
        }
    }
}

fclose($stdin);
exit(0); // Permite o push se não encontrar problemas
