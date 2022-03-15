<!DOCTYPE html>
<?php
include_once "acaoIV.php";
$acaoIV = isset($_GET['acaoIV']) ? $_GET['acaoIV'] : "";
$dados;
if ($acaoIV == 'editar'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
//var_dump($dados);
?>
<html lang="pt-br">
<head>
<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/csscelio.css" /> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Clubes</title> 
</head>
<body>
<?php include "menu.php"; ?>
<br>
<div class="dados">
    <center>
<a id="listar" href="clube.php"><button type="button" class="btn btn-dark">Listar</button></a>
<a id="novo" href="tipo4.php"><button type="button" class="btn btn-dark"> Cadastrar Novo</button></a>
</center>
<br>
<br>
<form action="acaoIV.php" method="post">
  <center>
            

<label for="exampleFormControlInput1" class="form-label">
ID <input readonly class="form-control" type="text" name="id_clube" id="id_clube" value="<?php if ($acaoIV == "editar") echo $dados['id_clube']; else echo 0; ?>"><br>
<label for="exampleFormControlInput1" class="form-label"><br>

Nome do Clube <input required=true class="form-control"  type="text" name="nome_clube" id="nome_clube" value="<?php if ($acaoIV == "editar") echo $dados['nome_clube']; ?>"><br>
<label for="exampleFormControlInput1" class="form-label"><br>

Nome do País <input required=true class="form-control"  type="text" name="nome" id="nome" value="<?php if ($acaoIV == "editar") echo $dados['nome']; ?>"><br>

Nome do Técnico <input required=true class="form-control"  type="text" name="nome_tec" id="nome_tec" value="<?php if ($acaoIV == "editar") echo $dados['nome_tec']; ?>"><br>

<br>

<label for="exampleFormControlInput1" class="form-label">Nome do País
  <select class="form-select form-select-sm">

            <?php
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM clubes");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option name="" value="<?php echo $dados['id_pais']; ?>" <?php if ($acaoIV == "editar" && $linha['id_pais'] == $dados['id_pais']){echo "selected";}?>><?php echo $dados['nome'];?></option>
            <?php } ?>
            </select>
           
            <br>

            <label for="exampleFormControlInput1" class="form-label">Nome do Técnico
  <select class="form-select form-select-sm">
</label>
            <?php
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM clubes");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option name="nome_tec" value="<?php echo $dados['id_tec']; ?>" <?php if ($acaoIV == "editar") echo $dados['nome_tec'];{echo "selected";}?>></option>
            <?php } ?>
            </select>
            </label>
            <br>
</center>
<div class="dados">
<div class="d-grid gap-2">
<br><button type="submit" class = "btn btn-dark" name="acaoIV" id="acaoIV" value="salvar">Salvar</button></a></div>
</div>
<br>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>