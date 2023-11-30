<?php

// Database connection details
$hostname = "localhost";
$user = "root";
$password = "";
$database = "db_crud_teste";

// Capture the action to be executed
$action = $_REQUEST["action"];

// Create a PDO instance for database connection
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Identify action and invoke the corresponding method
switch ($action) {
    case "lista":
        carregarLista();
        break;
    case "salvar":
        salvarForm();
        break;
    case "excluir":
        excluirForm();
        break;
    case "buscar":
        carregarCliente();
        break;
}

// Method to load the list of registered clients
function carregarLista()
{
    global $pdo;

    try {
        $sql = "SELECT * FROM cliente ORDER BY id DESC";
        $stmt = $pdo->query($sql);

        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($results);
        } else {
            echo "Nenhum cadastro realizado até o momento.";
        }
    } catch (PDOException $e) {
        echo "Erro ao executar SQL: " . $e->getMessage();
    }
}

// Method to load data of the selected client for modification
function carregarCliente()
{
    global $pdo;

    if (!isset($_POST) || empty($_POST)) {
        echo "Dados do formulário não chegaram no PHP.";
        exit;
    }

    $id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;

    try {
        $stmt = $pdo->prepare("SELECT * FROM cliente WHERE id = ?");
        $stmt->execute([$id]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            echo json_encode($results);
        } else {
            echo "ID não encontrado.";
        }
    } catch (PDOException $e) {
        echo "Erro ao buscar cliente: " . $e->getMessage();
    }
}

// Method to save or update client registration form
function salvarForm()
{
    global $pdo;

    if (!isset($_POST) || empty($_POST)) {
        echo "Dados do formulário não chegaram no PHP.";
        exit;
    }

    $id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $nome_imagem = $_POST["nomeFoto"];
    $foto = isset($_FILES['foto']) ? $_FILES['foto'] : null;

    $v = validarForm($id, $nome, $email, $telefone, $foto);

    if ($v != null) {
        echo "Problema encontrado:<br>" . $v;
        exit;
    }

    if (!empty($foto)) {
        $imagem_tmp = $foto['tmp_name'];
        $diretorio = $_SERVER['DOCUMENT_ROOT'] . '/crud/imagens/';
        $envia_imagem = $diretorio . $nome_imagem;

        if (!move_uploaded_file($imagem_tmp, $envia_imagem)) {
            echo 'Erro ao enviar arquivo de imagem.';
            exit;
        }
    }

    try {
        if ($id > 0) {
            $sql = "UPDATE cliente SET nome=?, email=?, telefone=?, foto=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $telefone, $nome_imagem, $id]);
        } else {
            $sql = "INSERT INTO cliente (nome, email, telefone, foto) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $telefone, $nome_imagem]);
        }

        if ($stmt->rowCount() > 0) {
            echo ($id > 0) ? "Cliente atualizado com sucesso!" : "Cliente cadastrado com sucesso!";
        } else {
            echo "Nenhum dado foi modificado.";
        }
    } catch (PDOException $e) {
        echo "Erro ao salvar cliente: " . $e->getMessage();
    }
}

// Method to delete client record
function excluirForm()
{
    global $pdo;

    if (!isset($_POST) || empty($_POST)) {
        echo "Dados do formulário não chegaram no PHP.";
        exit;
    }

    $id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;

    try {
        $stmt = $pdo->prepare("DELETE FROM cliente WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            echo "Registro deletado com sucesso!";
        } else {
            echo "Nenhum registro foi deletado.";
        }
    } catch (PDOException $e) {
        echo "Erro ao excluir cliente: " . $e->getMessage();
    }
}

// Method to validate form data
function validarForm($id, $nome, $email, $telefone, $foto)
{
    if ($nome == null || trim($nome) == "") {
        return "Campo Nome deve ser preenchido.";
    }

    if ($email == null || trim($email) == "") {
        return "Campo Email deve ser preenchido.";
    }

    if ($telefone == null || trim($telefone) == "") {
        return "Campo Telefone deve ser preenchido.";
    }

    return null;
}
?>