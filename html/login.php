<?php
// Utilizador: um@utilizador.pt
// Palavra-passe: pass123

require_once '../config/config.php';
require_once SERVER_ROOT . '/app/inc/login.inc.php';
require_once SERVER_ROOT . '/html/components/head.inc.php';

$pageTitle = 'Login';

// HTML
echo getHeader($pageTitle);
include($_SERVER['DOCUMENT_ROOT'] . ROOT . '/components/nav.inc.php');
?>

<h1><?php echo $pageTitle; ?></h1>
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

<?php include(SERVER_ROOT . '/html/components/body_end.inc.php'); ?>