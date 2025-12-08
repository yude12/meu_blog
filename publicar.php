<?php
session_start();

// Verifica se está logado
if (!isset($_SESSION["status"]) || $_SESSION["status"] !== "logado") {
    header("Location: index.php");
    exit();
}


include("DLL.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Conteúdo digitado
    $conteudo = trim($_POST["conteudo"] ?? "");

    // Validação: não permitir vazio
    if ($conteudo === "") {
        $_SESSION["mensagem"] = "Erro: escreva algo antes de publicar.";
        header("Location: publicar.php");
        exit();
    }

    // Verifica se o id do usuário está na sessão
    if (empty($_SESSION["id_usuario"])) {
        $_SESSION["mensagem"] = "Erro: usuário não identificado. Faça login novamente.";
        header("Location: index.php");
        exit();
    }

    $id_usuario = (int) $_SESSION["id_usuario"];

    // Escapa o texto para evitar quebra de SQL
    $conteudo_esc = $conn->real_escape_string($conteudo);

    $sql = "INSERT INTO publicacoes (id_usuario, conteudo) 
            VALUES ($id_usuario, '$conteudo_esc')";

    if ($conn->query($sql)) {
        $_SESSION["mensagem"] = "Publicação feita com sucesso.";
    } else {
        $_SESSION["mensagem"] = "Erro ao publicar: (" . $conn->errno . ") " . $conn->error;
    }

    // Volta para o feed
    header("Location: principal.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Publicar</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <h1>Bem-vindo ao Seu Blog</h1>
        <h3>Olá, <?= htmlspecialchars($_SESSION["nome_usuario"] ?? "") ?>!</h3>
    </header>

    <nav>
        <ul>
            <li><a href="principal.php">Feed</a></li>
            <li><a href="publicar.php">Publicar</a></li>
            <li><a href="Perfil.php">Perfil de usuário</a></li>
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
