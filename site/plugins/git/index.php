<?php

function runGit(array $args, string $cwd): string
{
    $cmd = array_merge(['git'], $args);

    $descriptors = [
        1 => ['pipe', 'w'], // stdout
        2 => ['pipe', 'w'], // stderr
    ];

    $sshDir = '/mnt/web115/d0/91/54620591/htdocs/.ssh';
    $keyPath = $sshDir . '/id_ed25519';
    $hostsPath = $sshDir . '/known_hosts';

    // Build the SSH command to force Git to use your specific key and host verification settings
    $gitSshCommand = sprintf(
        'ssh -i %s -o UserKnownHostsFile=%s -o StrictHostKeyChecking=no',
        escapeshellarg($keyPath),
        escapeshellarg($hostsPath)
    );

    // Build a clean, string-only environment array for proc_open
    $env = [];
    foreach (array_merge($_ENV, $_SERVER) as $key => $value) {
        if (is_string($value) || is_numeric($value)) {
            $env[(string)$key] = (string)$value;
        }
    }

    $process = proc_open($cmd, $descriptors, $pipes, $cwd, $env);

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
