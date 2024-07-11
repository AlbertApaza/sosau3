<?php
namespace App\Controller;

use App\Model\Usuario;

class LoginController {
    private $model;

    public function __construct(Usuario $model = null) {
        $this->model = $model ?: new Usuario();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (!empty($username) && !empty($password)) {
                $user = $this->model->login($username, $password);

                if ($user) {
                    session_start();
                    $_SESSION['user'] = $user;
                    $_SESSION['autenticado'] = 'SI';
                    header("Location: login.php?action=panelAdmin");
                    exit();
                } else {
                    return "Nombre de usuario o contraseña incorrectos";
                }
            } else {
                return "Por favor ingrese nombre de usuario y contraseña";
            }
        }
        // No debe haber salida directa aquí
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>
