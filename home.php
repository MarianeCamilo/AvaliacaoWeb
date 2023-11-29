<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Celulares</title>
    <style>
        /* Estilos CSS podem ser adicionados aqui */
    </style>
</head>
<body>
    <header>
        <h1>Bem-vindo à Loja de Celulares</h1>
        <p>As melhores ofertas em smartphones!</p>
    </header>

    <section>
        <h2>Produtos em Destaque</h2>
        <?php
            // Aqui você teria a lógica para buscar produtos do banco de dados e exibi-los dinamicamente
            $produtos = [
                ['id' => 1, 'nome' => 'Smartphone A', 'preco' => 999.99],
                ['id' => 2, 'nome' => 'Smartphone B', 'preco' => 799.99],
                ['id' => 3, 'nome' => 'Smartphone C', 'preco' => 1299.99]
            ];

            foreach ($produtos as $produto) {
                echo "<div>";
                echo "<h3>{$produto['nome']}</h3>";
                echo "<p>Preço: R$ {$produto['preco']}</p>";
                echo "<a href='detalhes_produto.php?id={$produto['id']}'>Detalhes</a>";
                echo "</div>";
            }
        ?>
    </section>

    <footer>
        <p>&copy; 2023 Loja de Celulares</p>
    </footer>
</body>
</html>
