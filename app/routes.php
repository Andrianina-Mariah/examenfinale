<?php
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/MessageController.php';

require_once __DIR__ . '/services/Validator.php';
require_once __DIR__ . '/services/UserService.php';

require_once __DIR__ . '/repositories/UserRepository.php';
require_once __DIR__ . '/repositories/MessageRepository.php';

/* AUTH */
Flight::route('GET /', ['AuthController', 'loginAdmin']);


Flight::route('GET /login', ['AuthController', 'login']);
Flight::route('POST /validate/login', ['AuthController', 'validateLoginAjax']);

