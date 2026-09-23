<?php

function runGit(array $args, string $cwd): string {
    $env = array_merge($_ENV, [
        'GIT_SSH_COMMAND' => 'ssh -i '. escapeshellarg($cwd . '/.ssh/git_deploy_key') . ' -o IdentitiesOnly=yes',

        'GIT_AUTHOR_NAME' => 'JCP Kirby Panel',
        'GIT_AUTHOR_EMAIL' => 'deploy@example.com',

        'GIT_COMMITTER_NAME' => 'JCP Kirby Panel',
        'GIT_COMMITTER_EMAIL' => 'deploy@example.com',
    ]);

    $cmd = array_merge(['git'], $args);

    $descriptors = [
        1 => ['pipe', 'w'], // stdout
        2 => ['pipe', 'w'], // stderr
    ];

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

                        if ($user === null || $user->isAdmin() === false) {
                            throw new PermissionException('Not allowed to run commands');
                        }

                        $message = $kirby->request()->get('text', '');

                        $repoPath = $kirby->root('index');

                        runGit(['add', '-A'], $repoPath);

                        try {
                            $output = runGit(['commit', '-m', $message], $repoPath);
                        } catch (\RuntimeException $e) {
                            if (str_contains($e->getMessage(), 'no changes added to commit')) {
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
