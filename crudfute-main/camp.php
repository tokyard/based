<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Lista dos Campeonatos";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "2";
    $procurar = isset($_POST['procurar']) ? $_POST['procurar'] : "";

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">

    <link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/csscelio.css" />   
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>
</head>
<body>
<?php include "menu.php"; ?>

 <br>
<form method="post">
<h3> Procurar por: </h3>
<div class="form-check">
    <input class="form-check-input" type="radio" name="tipo" id="tipo" value="1" <?php if ($tipo
    == 1) { echo "checked"; }?>>  
     <label class="form-check-label" for="flexRadioDefault1">ID
    </label> <br>
    <input class="form-check-input" type="radio" name="tipo" id="tipo" value="2" <?php if ($tipo
    == 2) { echo "checked"; }?>>
    <label class="form-check-label" for="flexRadioDefault1">Nome do Campeonato
    </label>
    </div>

<table class="table table-dark table-striped">
    <tr><td><b>ID</b></td>
        <td><b>Nome do Campeonato</b></td>
        <td><b>Edição do Campeonato</b></td>    
        <td><b>Excluir</b></td>
        <td><b>Editar</b></td>
    </tr>
<br>
    <div class="mb-3">
<label for="exampleFormControlInput1" class="form-label">Inserir</label>
<input class="form-control" type="text" name="procurar" id="procurar" value="<?php echo
$procurar; ?>">
</div>
<div class="dados">
<div class="d-grid gap-2">
   
    <input class="btn btn-dark" type="submit" value="Consultar">
    </div>
</div>
</form>
<br>


<?php
    $sql = "";
    if ($tipo == 1){
        $sql = "SELECT * FROM campeonato WHERE id_camp = '$procurar%' ORDER BY id_camp";
    }else{    
        $sql = "SELECT * FROM campeonato WHERE nome_camp LIKE '$procurar%' ORDER BY nome_camp";
    }
$pdo = Conexao::getInstance();
$consulta = $pdo->query($sql);
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

?> 

    <tr class = "tabela">
        <td><?php echo $linha['id_camp'];?></td>
        <td><?php echo $linha['nome_camp'];?></td>
        <td><?php echo $linha['edicao'];?></td>
        <td><?php echo " <a href=javascript:excluirRegistro('acaoII.php?acaoII=excluir&id_camp={$linha['id_camp']}')>"; ?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
  <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
</svg></a></td>
        <td><?php echo "<a href='tipo3.php?acaoII=editar&id={$linha['id_camp']}')>";?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench" viewBox="0 0 16 16">
  <path d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364L.102 2.223zm13.37 9.019.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11l.471.242z"/>
</svg></a></td>
  
    </td>
    </tr>
    <?php } ?>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
crossorigin="anonymous"></script>
</body>
</html>