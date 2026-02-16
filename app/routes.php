<?php
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/DashController.php';
require_once __DIR__ . '/controllers/BesoinController.php';
require_once __DIR__ . '/controllers/DonController.php';

require_once __DIR__ . '/services/Validator.php';
require_once __DIR__ . '/services/UserService.php';

require_once __DIR__ . '/repositories/VilleRepository.php';
require_once __DIR__ . '/repositories/BesoinRepository.php';
require_once __DIR__ . '/repositories/TypeDonRepository.php';
require_once __DIR__ . '/repositories/CategorieRepository.php';
require_once __DIR__ . '/repositories/DonRepository.php';
require_once __DIR__ . '/repositories/DispatchRepository.php';

/* AUTH */
Flight::route('GET /', ['DashController', 'DashBoard']);

Flight::route('GET /villesDetails/@id', ['DashController', 'Details']);

Flight::route('GET /formulaireBesoin', ['DashController', 'form']);


Flight::route('GET /besoin/nouveau', ['BesoinController', 'form']);

Flight::route('POST /besoin/enregistrer', ['BesoinController', 'enregistrer']);

Flight::route('GET /don/nouveau', ['DonController', 'form']);

Flight::route('POST /don/enregistrer', ['DonController', 'enregistrer']);
