<?php

namespace lightframe\Components\Views\Game\Selection;

use lightframe\Interfaces\Component;
use lightframe\Entity\Server;

class ServerCardSelector implements Component
{
    private $viewBuilder;

    private $html = '';

    public function __construct(\lightframe\ViewBuilder $viewBuilder)
    {
        $this->viewBuilder = $viewBuilder;
    }

    public function render() : ?string
    {
        return $this->html;
    }

    public function addServer(Server $server) : void
    {
        $server = $server;

        ob_start();
        require('html' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'game' . DIRECTORY_SEPARATOR . 'selection' . DIRECTORY_SEPARATOR . 'serverCardSelector.php');
    
        $this->html .= ob_get_clean();
    }
}