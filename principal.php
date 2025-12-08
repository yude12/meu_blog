<?php
session_start();

// Verificação de login no seu padrão
if (!isset($_SESSION["status"]) || $_SESSION["status"] !== "logado") {
    header("Location: index.php");
    exit();
}

// Inclui a DLL sem alterar nada nela
include("DLL.php");

// Consulta todas as publicações com o nome do usuário
$sql = "
    SELECT p.conteudo, p.criado_em, u.nome
    FROM publicacoes p
    JOIN usuarios u ON p.id_usuario = u.id_usuario
    ORDER BY p.criado_em DESC
";

// Você pode usar banco(...) ou $conn->query(...). Vou usar $conn direto.
$result = $conn->query($sql);
if (!$result) {
    die("Erro na consulta: (" . $conn->errno . ") " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Feed</title>
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
        <h2>Publicações recentes</h2>

        <?php
        // Mensagem de sessão (como "Publicação feita com sucesso")
        if (isset($_SESSION["mensagem"])) {
            echo "<p>" . htmlspecialchars($_SESSION["mensagem"]) . "</p>";
            unset($_SESSION["mensagem"]);
        }

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
                <article class="publicacao">
                    <small>
                        <strong><?= htmlspecialchars($row["nome"]) ?></strong>
                        &bull;
                        <?= htmlspecialchars($row["criado_em"]) ?>
                    </small>
                    <hr>
                    <p><?= nl2br(htmlspecialchars($row["conteudo"])) ?></p>
                </article>
        <?php
            endwhile;
        else:
            echo "<p>Não há publicações ainda.</p>";
        endif;
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



