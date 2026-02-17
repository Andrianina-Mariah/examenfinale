<?php
require_once __DIR__ . '/controllers/AchatController.php';
require_once __DIR__ . '/controllers/DashController.php';
require_once __DIR__ . '/controllers/BesoinController.php';
require_once __DIR__ . '/controllers/DonController.php';
require_once __DIR__ . '/controllers/SimulationController.php';
require_once __DIR__ . '/controllers/RecapController.php';

require_once __DIR__ . '/services/Validator.php';
require_once __DIR__ . '/services/UserService.php';

require_once __DIR__ . '/repositories/VilleRepository.php';
require_once __DIR__ . '/repositories/BesoinRepository.php';
require_once __DIR__ . '/repositories/TypeDonRepository.php';
require_once __DIR__ . '/repositories/CategorieRepository.php';
require_once __DIR__ . '/repositories/DonRepository.php';
require_once __DIR__ . '/repositories/DispatchRepository.php';
require_once __DIR__ . '/repositories/StatRepository.php';

/* AUTH */
Flight::route('GET /', ['DashController', 'DashBoard']);

Flight::route('GET /villesDetails/@id', ['DashController', 'Details']);

Flight::route('GET /formulaireBesoin', ['DashController', 'form']);


Flight::route('GET /besoin/nouveau', ['BesoinController', 'form']);

Flight::route('POST /besoin/enregistrer', ['BesoinController', 'enregistrer']);

Flight::route('GET /don/nouveau', ['DonController', 'form']);

Flight::route('GET /don/liste', ['DonController', 'liste']);

Flight::route('POST /don/enregistrer', ['DonController', 'enregistrer']);

/* V2 - FRONT */

Flight::route('GET /achats/besoins', ['AchatController', 'pageAchats']);
Flight::route('POST /achats/effectuer', ['AchatController', 'effectuerAchat']);

Flight::route('GET /simulation', ['SimulationController', 'index']);
Flight::route('POST /simulation/lancer', ['SimulationController', 'lancer']); 
Flight::route('POST /simulation/valider', ['SimulationController', 'valider']);

Flight::route('GET /recapitulatif', ['DashController', 'recapitulatif']);

Flight::route('GET /recapitulatif', ['RecapController', 'index']);
Flight::route('GET /api/stats', ['RecapController', 'apiStats']);