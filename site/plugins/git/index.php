<?php

Kirby::plugin('git', [
  'routes' => [
    [
      'method'  => 'POST'
      'pattern' => 'git/commit',
      'action'  => function () {
        return "<html><body>Hello</body></html>"
      }
    ]
  ]
]);
