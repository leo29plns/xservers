<?php

namespace lightframe\Controllers;

use lightframe\{ViewBuilder, SessionController, Components, Db, Models, CsrfToken};

class LoginController
{
    public function pageLogin() : void
    {
        $html = new ViewBuilder('login.php');
        $html->components['flash'] = new Components\Views\Login\Flash($html);

        $cookieToken = $_COOKIE['USER'] ?? null;
        
        if (isset($_POST['ACTION'])) {
            switch ($_POST['ACTION']) {
                case 'login':
                    if (isset($_POST['uid'], $_POST['password'])) {
                        if ($this->tryLogUser($_POST['uid'], $_POST['password'])) {
                            header('Location: ' . $_ENV['BASE_LINK'] . '');
                            exit;
                        } else {
                            $html->components['flash']->status('errLogin');
                        }
                    }
                    break;
                case 'logout':
                    $this->logoutUser();
                    $html->components['flash']->status('logout');
                    break;
            }
        } elseif ($cookieToken && !SessionController::isUserLogged()) {
            if ($this->tryPersistentLogin($cookieToken)) {
                header('Location: ' . $_ENV['BASE_LINK'] . '');
                exit;
            };
        }

        echo $html->render();
    }

    private function logUser(string $uid) : void
    {
        $ldapUserModel = new Models\Ldap\User();
        $_SESSION['USER'] = $ldapUserModel->getUser($uid);
    }

    public function tryLogUser(string $uid, string $password) : bool
    {
        $ldapUserModel = new Models\Ldap\User();
        $user = $ldapUserModel->bindUser($uid, $password);

        if ($user) {
            $_SESSION['USER'] = $user;
            $this->setPersistentLogin($uid);

            return true;
        } else {
            return false;
        }
    }

    public function logoutUser() : void
    {
        SessionController::end();
        $this->unsetPersistentLogin();
    }

    private function setPersistentLogin(string $uid) : void
    {
        $dbUserModel = new Models\Db\User();
        $dbUserModel->deleteToken($uid);

        $token = bin2hex(random_bytes(64));
        $expirationTimestamp = strtotime('+7 days');

        $dbUserModel->insertToken($token, $uid, $expirationTimestamp);

        setcookie('USER', $token, $expirationTimestamp, '/', '', !$_ENV['DEBUG'], true);
    }

    private function unsetPersistentLogin() : void
    {
        $token = $_COOKIE['USER'] ?? null;
    
        if ($token) {
            $dbUserModel = new Models\Db\User();
            $dbUserModel->deleteTokenByValue($token);
        }
    
        setcookie('USER', '', time() - 3600, '/', '', !$_ENV['DEBUG'], true);
    }

    public function tryPersistentLogin(string $token) : bool
    {
        $dbUserModel = new Models\Db\User();
        $result = $dbUserModel->getToken($token);

        if ($result) {
            $expirationTimestamp = strtotime($result['expiration_at']);
            if ($expirationTimestamp > time()) {
                $this->logUser($result['uid']);

                return true;
            } else {
                $dbUserModel->deleteTokenByValue($token);
            }
        }

        $this->unsetPersistentLogin();

        return false;
    }

    // public function createUser(array $userData) : array
    // {
    //     $dbUserModel = new Models\Db\User();
    //     $result = $dbUserModel->getUserIdByMail($userData['mail']);

    //     if ($result) {
    //         return [false, 'Cette addresse mail est déjà utilisée.'];
    //     }

    //     $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);

    //     $dbUserModel->createUser($userData['lastname'], $userData['firstname'], $userData['mail'], $hashedPassword);

    //     return [true];
    // }
}