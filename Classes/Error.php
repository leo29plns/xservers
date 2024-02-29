<?php

namespace lightframe;

use lightframe\ViewBuilder;

class Error
{
    private $code = 500;
    private $message = 'Erreur interne.';

    public function setCode(int $code) : void
    {
        $this->code = $code;
    }

    public function setMessage(string $message) : void
    {
        $this->message = $message;
    }

    public function render() : void
    {
        ob_clean();

        $html = new ViewBuilder('error.php');

        $html->setTitle($this->code);

        $html->layout['error'] = [
            'code' => $this->code,
            'message' => $this->message
        ];

        http_response_code($this->code);

        echo $html->render();

        exit();
    }

    public static function throw(int $code, string $message) : void
    {
        $error = new self();

        $error->setCode($code);
        $error->setMessage($message);

        $error->render();
    }
}