<?php

namespace lightframe\Controllers;

use lightframe\{SessionController, ViewBuilder};

class HomeController
{
    public function pageAccueil() : void
    {        
        $html = new ViewBuilder('home.php');
        echo $html->render();
    }
}