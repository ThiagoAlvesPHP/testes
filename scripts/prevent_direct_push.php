<?php

declare(strict_types=1);

// Captura a referência do branch de destino
$input = file_get_contents('php://stdin');
if (preg_match('/refs\/heads\/(.+)/', $input, $matches)) {
    $branch = $matches[1];

    // Lista de branches protegidos
    $protectedBranches = ['stage', 'homolog', 'main'];

    // Verifica se o branch está protegido
    if (in_array($branch, $protectedBranches, true)) {
        fwrite(STDERR, "Push direto para a branch '{$branch}' é proibido.\n");
        exit(1); // Falha no pre-push
    }
}

exit(0); // Sucesso no pre-push
