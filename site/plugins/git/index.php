<?php

// $sshDir = '/mnt/web115/d0/91/54620591/web_user_ssh';
// $privateKey = $sshDir . '/id_ed25519';
// $publicKey  = $sshDir . '/id_ed25519.pub';

// if (!file_exists($sshDir)) {
//     mkdir($sshDir, 0700, true);
// }

// if (!file_exists($privateKey)) {
//     // Generate a new Ed25519 SSH key without a passphrase
//     $cmd = sprintf('ssh-keygen -t ed25519 -N "" -f %s', escapeshellarg($privateKey));
//     exec($cmd . ' 2>&1', $output, $returnCode);

//     if ($returnCode !== 0) {
//         die("Failed to generate key: " . implode("\n", $output));
//     }
// }

function runGit(array $args, string $cwd): string
{
    $cmd = array_merge(['git'], $args);

    $descriptors = [
        1 => ['pipe', 'w'], // stdout
        2 => ['pipe', 'w'], // stderr
    ];

    $process = proc_open($cmd, $descriptors, $pipes, $cwd);

    if (!is_resource($process)) {
        throw new \RuntimeException('Failed to start git process');
    }

    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);

    fclose($pipes[1]);
    fclose($pipes[2]);

    $exitCode = proc_close($process);

    if ($exitCode !== 0) {
        throw new \RuntimeException($stderr ?: $stdout);
    }

    return $stdout;
}

Kirby::plugin('jcb/git', [
    'sections' => [
        'git' => []
    ],
    'api' => [
            'routes' => [
                [
                    'pattern' => 'commit',
                    'method'  => 'POST',
                    'action'  => function () {
                        $kirby = kirby();
                        $user  = $kirby->user();

                        // Being authenticated just means "some Panel user is
                        // logged in" — check role/permission separately if
                        // not every role should be allowed to trigger this.
                        if ($user === null || $user->isAdmin() === false) {
                            throw new PermissionException('Not allowed to run commands');
                        }

                        $message = $kirby->request()->get('text', '');

                        $repoPath = $kirby->root('index');

                        runGit(['add', '-A'], $repoPath);

                        try {
                            $output = runGit(['commit', '-m', $message], $repoPath);
                        } catch (\RuntimeException $e) {
                            if (str_contains($e->getMessage(), 'nothing to commit')) {
                                throw new \Kirby\Exception\Exception('No changes to commit');
                            }
                            throw $e;
                        }

                        return ['output' => $output];
                    }
                ],
                [
                    'pattern' => 'push',
                    'method'  => 'POST',
                    'action'  => function () {
                        $kirby = kirby();
                        $user  = $kirby->user();

                        // Being authenticated just means "some Panel user is
                        // logged in" — check role/permission separately if
                        // not every role should be allowed to trigger this.
                        if ($user === null || $user->isAdmin() === false) {
                            throw new PermissionException('Not allowed to run commands');
                        }

                        $repoPath = $kirby->root('index');

                        $output = runGit(['push'], $repoPath);

                        return ['output' => $output];
                    }
                ]
            ]
        ],
]);
