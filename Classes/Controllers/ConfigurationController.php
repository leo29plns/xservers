<?php

namespace lightframe\Controllers;

use lightframe\{SessionController, ViewBuilder, Components};
use lightframe\Entity\Server;
use lightframe\Repository\ServerRepository;

class ConfigurationController
{
    public function pageConfiguration() : void
    {
        $server = new Server();
        $serverRepository = new ServerRepository($server);

        if (isset($_POST['ACTION'])) {
            switch ($_POST['ACTION']) {
                case 'select':
                    if (isset($_POST['id'])) {
                        $serverRepository->getById($_POST['id']);

                        $html = new ViewBuilder('configuration/editor.php');
                        $html->entities['server'] = $server;

                        echo $html->render();

                        exit;
                    }
                    break;
                case 'add':
                        $html = new ViewBuilder('configuration/creator.php');
                        $html->entities['server'] = $server;

                        echo $html->render();

                        exit;
                    break;
                case 'updateServer':
                    if (isset($_POST['id'], $_POST['name'], $_POST['power'], $_POST['repairability'], $_POST['bugs'])) {
                        $editedServer = new Server();
                        $editedServerRepository = new ServerRepository($editedServer);
                        
                        $editedServerRepository->getById($_POST['id']);
                        
                        $editedServer->hydrate($_POST);

                        $editedServerRepository->update();
                    }
                    break;
                case 'deleteServerConfirm':
                        if (isset($_POST['id'])) {
                            $html = new ViewBuilder('configuration/deleteServerConfirm.php');
                            $html->entities['server'] = $server;

                            echo $html->render();
                        }

                        exit;
                    break;
                case 'deleteServer':
                    if (isset($_POST['id'])) {
                        $editedServer = new Server();
                        $editedServerRepository = new ServerRepository($editedServer);
                        
                        $editedServerRepository->getById($_POST['id']);

                        $editedServerRepository->delete();
                    }
                    break;
                case 'addServer':
                    if (isset($_POST['name'], $_POST['power'], $_POST['repairability'], $_POST['bugs'])) {
                        $editedServer = new Server();
                        $editedServerRepository = new ServerRepository($editedServer);
                        
                        $editedServer->hydrate($_POST);

                        $editedServerRepository->insert();
                    }
                    break;
            }
        }

        $servers = $serverRepository->getServers();

        $html = new ViewBuilder('configuration.php');
        $html->components['servers'] = new Components\Views\Configuration\ServerList($html);

        foreach ($servers as $server) {
            $html->components['servers']->addServer($server);
        }

        echo $html->render();
    }
}