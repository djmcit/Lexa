<?php
// public/index.php

require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Response.php';
require_once __DIR__ . '/../core/ApiSyntax.php';

$router = new Router();

require_once __DIR__ . '/../app/Routes/api.php';

$router->resolve();
