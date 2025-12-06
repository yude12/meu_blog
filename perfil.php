<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["status"]) || $_SESSION["status"] != "logado") {
    header("Location: index.php");
    exit();
}

// Conexão com o banco
include "DLL.php";

$id_usuario = $_SESSION["id_usuario"]; // vem do login

// Busca os dados do usuário
$sql = "SELECT conteudo FROM publicacoes WHERE id_usuario = '$id_usuario'";
$resultado = $conn->query($sql);
$usuario = $resultado->fetch_assoc();

// Conta quantas publicações ele tem
$sql_pub = "SELECT COUNT(*) AS total FROM publicacoes WHERE id_usuario = $id_usuario";
$res_pub = $conn->query($sql_pub);
$total = $res_pub->fetch_assoc()["total"];

// Busca as últimas publicações
$sql_posts = "SELECT conteudo, data_publicacao FROM publicacoes WHERE id_usuario = $id_usuario ORDER BY id_publicacao DESC LIMIT 5";
$res_posts = $conn->query($sql_posts);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="principal">

    <header>
        <h1>Meu Perfil</h1>
        <a href="principal.php">← Voltar</a>
    </header>

    <main class="conteudo">
        <h2><?= $usuario["nome"] ?></h2>
        <p><strong>Email:</strong> <?= $usuario["email"] ?></p>
        <p><strong>Membro desde:</strong> <?= date("d/m/Y", strtotime($usuario["data_de_cadastro"])) ?></p>
        <p><strong>Total de publicações:</strong> <?= $total ?></p>

        <hr>

        <h3>Minhas últimas publicações</h3>

        <?php if ($res_posts->num_rows == 0): ?>
            <p>Você ainda não publicou nada.</p>
        <?php else: ?>
            <?php while ($p = $res_posts->fetch_assoc()): ?>
                <div class="publicacao">
                    <p><?= nl2br(htmlspecialchars($p["conteudo"])) ?></p>
                    <small>Data: <?= date("d/m/Y H:i", strtotime($p["data_publicacao"])) ?></small>
                    <hr>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </main>

</body>
</html>
