<?php

namespace lightframe;

class Router
{
    private $requestUri;

    public function bindController() : void
    {
        $this->getRequestUri();
        $this->toEnvBaseUrl();
        $_ENV['BASE_LINK'] = ($_ENV['WEBROOT_FOLDER']) ? "{$_ENV['WEBROOT_URL']}/{$_ENV['WEBROOT_FOLDER']}/" : "{$_ENV['WEBROOT_URL']}/";

        require_once('routes.php');
    }

    private function getRequestUri() : void
    {
        $trimedRequestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $webrootFolder = trim(dirname($_SERVER['PHP_SELF']), DIRECTORY_SEPARATOR);
        $requestUri = trim(substr($trimedRequestUri, strlen($webrootFolder)), '/');

        $_ENV['WEBROOT_FOLDER'] = $webrootFolder;
        $_ENV['REQUEST_URI'] = $requestUri;

        $this->requestUri = $requestUri;
    }

    private function toEnvBaseUrl() : void
    {
        $_ENV['WEBROOT_URL'] = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
    }
}