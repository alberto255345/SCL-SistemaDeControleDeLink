<?PHP
$path2 = $_SERVER['DOCUMENT_ROOT'];
$path2 .= "/SCL/db/protect.php";
include($path2);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCL - Sistema de Cadastro de Links</title>
    <link rel="stylesheet" href="/SCL/grafico/css/1graf.css">
    <link rel="stylesheet" href="../css/popper.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="/SCL/css/bootstrap-multiselect.css" type="text/css"/>
    <link rel="icon" type="image/png" href="../assets/img/logo.png">
</head>
<body>
    <div>
    <div class="pamens"></div>
    <div class="pamens2"></div>    
    </div>
    <div id="valortempo"></div>
    <div id="load">
        <img src="../assets/img/giphy.gif" alt="Carregando aguarde..."/>
    </div>
    <div id="pames">
            
    <table>
    <tbody>
    <tr>
    <td>Slide</td>
    <td>Configurações</td>
    <td>Ferramentas</td>
    </tr>
    <tr>
    <td><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    </tbody>
    </table>

    </div>
    <script src="../dist/js/jquery-3.5.1.js"></script>
    <script src="/SCL/assets/js/core/popper.min.js"></script>
    <script type="text/javascript" src="/SCL/js/bootstrap-multiselect.js"></script>
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>