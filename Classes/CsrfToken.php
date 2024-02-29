<?php

namespace lightframe;

class CsrfToken
{
    public static function generate() : string
    {
        $_SESSION['CSRF_TOKEN'] = bin2hex(random_bytes(16));

        return $_SESSION['CSRF_TOKEN'];
    }

    public static function verify(string $token) : void
    {
        if (isset($_SESSION['CSRF_TOKEN']) && $_SESSION['CSRF_TOKEN'] === $token) {
            self::generate();
        } else {
            \lightframe\Error::throw(401, 'Jeton CSRF non valide.');
        }
    }

    public static function getForm() : string
    {
        return '<input type="hidden" name="CSRF_TOKEN" value="' . self::generate() . '">';
    }

    public static function verifyPost() : void
    {
        $postCsrfToken = $_POST['CSRF_TOKEN'] ?? null;


        if ($postCsrfToken) {
            self::verify($postCsrfToken);
        } else {
            \lightframe\SessionController::end();
            \lightframe\Error::throw(401, 'Jeton CSRF non valide.');
        }
    }
}