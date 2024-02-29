<?php

use lightframe\Controllers;

switch ($this->requestUri) {
    case '':
        (new Controllers\HomeController())->pageAccueil();
        break;
    case 'configuration':
        (new Controllers\ConfigurationController())->pageConfiguration();
        break;
    case 'jeu/selection':
        (new Controllers\GameController())->pageSelection();
        break;
    case 'jeu/fin':
        (new Controllers\GameController())->pageFin();
        break;
    case 'jeu':
        (new Controllers\GameController())->pageJeu();
        break;
    // case str_starts_with($this->requestUri, 'api/ade-ics'):
    //     (new Controllers\Api())->adeIcs();
    //     break;
    default:
        \lightframe\Error::throw(404, 'Page non trouvée.');
}