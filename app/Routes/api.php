<?php
// app/Routes/api.php

PostOn('/api/v1/users', function () {
    PostIn(function($data) {
        PosValidate($data, ['name', 'email']);
        PostAction(function () use ($data) {
            $user = [
                'id' => rand(100,999),
                'name' => $data['name'],
                'email' => $data['email']
            ];
            PostRespond('Usuario creado.', $user, 201);
        });
    });
});

GetOn('/api/v1/users', function () {
    GetAction(function () {
        $usuarios = [
            [ 'id' => 1, 'name' => 'Ana' ],
            [ 'id' => 2, 'name' => 'Luis' ]
        ];
        GetRespond('Lista de usuarios.', $usuarios);
    });
});
