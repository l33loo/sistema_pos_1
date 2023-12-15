<?php
require_once '../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Registar novo artigo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h1>Registo de artigo</h1>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="/app/criar_artigo.php" method="post">
                    Nome do artigo: <input class="form-control form-control-lg" type="text" name="nome" maxlength="12"><br>
                    Preço Unitário: <input  class="form-control form-control-lg" type="text" name="preco" required><br>
                    <label for="iva"> Escolha a taxa de IVA</label>
                    <select name="iva" id="iva">
                        <option value="0">0</option>
                        <option value="4">4</option>
                        <option value="9">9</option>
                        <option value="16">16</option>
                    </select> </br> </br>
                    Código de barras <input class="form-control form-control-lg" type="text" name="barras" maxlength="13" minlength="13" required>
                    <br>
                    <button type="submit" class="btn btn-primary">Registar Artigo</button>
                    <enctype="multipart/form-data"></enctype>
                </form>

            </div>
        </div>

    </div>
</body>
</html>