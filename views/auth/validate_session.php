<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login');
    exit();
}


// session_start();

// // Eliminar todas las variables de sesión
// $_SESSION = [];

// // Eliminar la cookie de sesión si existe
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000,
//         $params["path"], $params["domain"],
//         $params["secure"], $params["httponly"]
//     );
// }

// // Destruir la sesión
// session_destroy();

// // Redirigir al usuario a la página de login
// header('Location: login.php');
// exit();