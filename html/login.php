<?php
// Utilizador: um@utilizador.pt
// Palavra-passe: pass123

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT']  . '/app/login.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PoS - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/nav.inc.php') ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Login</h1>
                <?php if (!empty($mensagemErro)) { ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $mensagemErro ?>
                  </div>
                <?php } ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email:</label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="introduza o seu email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Password:</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="escreva a sua password" required>
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-primary mb-3" type="submit" value="Iniciar Sessão" name="login">
                </form>
            </div>
            </div> 
        </div>
</body>
</html>