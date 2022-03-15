<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $acaoIV = isset($_GET['acaoIV']) ? $_GET['acaoIV'] : "";
    if ($acaoIV == "excluir"){
        $id = isset($_GET['id_clube']) ? $_GET['id_clube'] : 0;
        excluir($id);
    }

    $acaoIV = isset($_POST['acaoIV']) ? $_POST['acaoIV'] : "";
    if ($acaoIV == "salvar"){
        $id = isset($_POST['id_clube']) ? $_POST['id_clube'] : "";
        if ($id == 0)
            inserir($id);
        else
            editar($id);
    }

    // Métodos para cada operação
    function inserir($id){
        $dados = dadosForm();
        //var_dump($dados)
        
        $pdo = Conexao::getInstance();
        $nome_clube = isset($_POST['nome_clube']) ? $_POST['nome_clube'] : "";
        $nome= isset($_POST['nome']) ? $_POST['nome'] : "";
        $nome_tec = isset($_POST['nome_tec']) ? $_POST['nome_tec'] : "";
        $stmt = $pdo->prepare('INSERT INTO clubes (nome_clube, nome, nome_tec) VALUES(:nome_clube, :nome, :nome_tec)');
        $stmt->bindParam(':nome_clube', $nome_clube, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':nome_tec', $nome_tec, PDO::PARAM_STR);
        $nome_clube = $dados['nome_clube'];
        $nome = $dados['nome'];
        $nome_tec = $dados['nome_tec'];
        $stmt->execute();
        header("location:clube.php");
        
    }

    function editar($id){
        $nome_clube = isset($_POST['nome_clube']) ? $_POST['nome_clube'] : "";
        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        $nome_tec = isset($_POST['nome_tec']) ? $_POST['nome_tec'] : "";
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE `fute`.`campeonato` SET `nome_clube` = :nome_clube, `nome` = :nome, `nome_tec` = :nome_tec   WHERE (`id_clube` = :id);');
        $stmt->bindParam(':nome_clube', $nome_clube, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':nome_tec', $nome_tec, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $nome_clube = $dados['nome_clube'];
        $nome = $dados['nome'];
        $nome_tec = $dados['nome_tec'];
        $id = $dados['id_clube'];
        $stmt->execute();
        header("location:clube.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from clubes WHERE id_clube = :id');
        $idD = $id;
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location:clube.php");
        //echo "Excluir".$id;

    }

    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM clubes WHERE id_clube = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id_clube'] = $linha['id_clube'];
            $dados['nome_clube'] = $linha['nome_clube'];
            $dados['nome'] = $linha['nome'];
            $dados['nome_tec'] = $linha['nome_tec'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id_clube'] = $linha['id_clube'];
        $dados['nome_clube'] = $linha['nome_clube'];
        $dados['nome'] = $linha['nome'];
        $dados['nome_tec'] = $linha['nome_tec'];
        return $dados;
    }
?>