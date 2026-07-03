<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

    if ($user === 'admin' && $pass === 'TuPasswordSegura123') {

        $_SESSION['logged'] = true;

        header('Location: /app/panel/');
        exit;
    }

    $error = 'Usuario o contraseña incorrectos';
}
?>



<div class="panel">
    <h1>Acceso Panel</h1>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <input name="user" placeholder="Usuario">
        <input type="password" name="pass" placeholder="Contraseña">
        <button>Entrar</button>
    </form>
</div>
