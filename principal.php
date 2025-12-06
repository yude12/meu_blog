<?php
session_start();

if (!isset($_SESSION["status"]) || $_SESSION["status"] !== "logado") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <h1>Bem-vindo ao Seu Blog</h1>
        <h3>Olá, <?= htmlspecialchars($_SESSION["nome_usuario"]) ?>!</h3>
    </header>

    <nav>
        <ul>
            <li><a href="#Novas Publicações">Novas Publicações</a></li>
            <li><a href="perfil.php">Perfil de usuario</a></li>
            <li><a href="#Fale conosco">Fale conosco</a></li>
            <li><a href="lougout.php">Sair</a></li>
        </ul>
    </nav>

    <main class="conteudo">
        <h2>Faça uma nova publicação</h2>

        <form action="publicar.php" method="post">
            <textarea name="conteudo" rows="4" cols="60" placeholder="Escreva sua publicação..." required></textarea><br><br>
            <button type="submit">Publicar</button>
        </form>

        <?php
        if (isset($_SESSION["mensagem"])) {
            echo "<p>" . htmlspecialchars($_SESSION["mensagem"]) . "</p>";
            unset($_SESSION["mensagem"]);
        }
        ?>
    </main>
    <section id="contato" style="text-align: center;">
        <h2>Contato</h2>
        <p>Email: nosso@blog.com</p>
    </section>

    <section id="blog" style="text-align: center;">
        <h2>Blog</h2>
        <p>Confira nossas últimas postagens.</p>
    </section>

</body>
</html>

