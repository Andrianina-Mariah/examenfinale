<?php
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/DashController.php';

require_once __DIR__ . '/services/Validator.php';
require_once __DIR__ . '/services/UserService.php';

require_once __DIR__ . '/repositories/VilleRepository.php';
// require_once __DIR__ . '/repositories/*';

/* AUTH */
Flight::route('GET /', ['DashController', 'DashBoard']);


// Flight::route('GET /login', ['AuthController', 'login']);
// Flight::route('POST /validate/login', ['AuthController', 'validateLoginAjax']);

