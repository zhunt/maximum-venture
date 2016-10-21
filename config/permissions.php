<?php

    return [
        'Users.SimpleRbac.permissions' => [
            [
                'role' => 'user',
                'controller' => 'Posts',
                'action' => ['view'],
            ],
            [
                'role' => 'user',
                'controller' => 'Landings',
                'action' => ['*'],
            ],
            
        ]
    ];