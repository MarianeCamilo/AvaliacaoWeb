<?php
// Simulação de recuperação de dados do banco de dados
$produto_id = isset($_GET['id']) ? $_GET['id'] : null;

// Lógica para buscar detalhes do produto no banco de dados
// Substitua isso pela lógica real de busca no seu banco de dados
$produto = null;

if ($produto_id) {
    // Supondo que você tenha uma função de busca no banco de dados
    // Substitua esta lógica pela lógica real para buscar o produto pelo ID
    $produto = buscarProdutoPorId($produto_id);
}

// Se o produto não for encontrado, redirecione para a página inicial
if (!$produto) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <style>
        /* Estilos CSS podem ser adicionados aqui */
    </style>
</head>
<body>
    <header>
        <h1>Detalhes do Produto</h1>
    </header>

    <section>
        <h2><?php echo $produto['nome']; ?></h2>
        <p>Preço: R$ <?php echo $produto['preco']; ?></p>
        <p>Descrição: <?php echo $produto['descricao']; ?></p>
        <!-- Adicione mais informações conforme necessário -->

        <a href="index.php">Voltar para a página inicial</a>
    </section>

    <footer>
        <p>&copy; 2023 Loja de Celulares</p>
    </footer>
</body>
</html>
