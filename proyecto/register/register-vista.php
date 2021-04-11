<!DOCTYPE html>
<html lang="en">

<!-- ESTE CODIGO ES LA PARTE DE FRONTEND, EN LA QUE ESTA TODO LO ESTETICO DEL FORMULARIO DE REGISTER -->
<!-- SI QUEREMOS ACCEDER A LA PARTE DE BACK-END TENEMOS QUE ACCEDER AL ARCHIVO REGISTER.PHP -->

<head>
    <meta charset="UTF-8">
    <title>Login / Register</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container-form">
        <div class="header">
            <div class="menu">
                <a href="login.php">
                    <li class="module-login">Login</li>
                </a>
                <a href="register.php">
                    <li class="module-register active">Register</li>
                </a>
            </div>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form">
            <div class="welcome-form">
                <h1>Bienvenido</h1>
            </div>

            <div class="user line-input">
                <label class="lnr lnr-envelope"></label>
                <input type="text" placeholder="Correo" name="correo">
            </div>
            <div class="user line-input">
                <label class="lnr lnr-user"></label>
                <input type="text" placeholder="Nombre Usuario" name="usuario">
            </div>
            <div class="password line-input">
                <label class="lnr lnr-lock"></label>
                <input type="password" placeholder="Contraseña" name="clave">
            </div>
            <div class="password line-input">
                <label class="lnr lnr-lock"></label>
                <input type="password" placeholder="Confirmar contraseña" name="clave2">
            </div>

            <?php if (!empty($error)) : ?>
                <div class="mensaje">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <button type="submit">Registrarse<label class="lnr lnr-chevron-right"></label></button>

        </form>
    </div>
</body>

</html>