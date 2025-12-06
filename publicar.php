<?php
session_start();
if (!isset($_SESSION["status"]) || $_SESSION["status"] !== "logado") {
    header("Location: index.php");
    exit();
}

include("DLL.php"); // deve conter $conn

$conteudo = trim($_POST["conteudo"] ?? "");

if ($conteudo == "") {
    $_SESSION["mensagem"] = "Erro: escreva algo antes de publicar.";
    header("Location: principal.php");
    exit();
}

// verifica se o ID está na sessão
if (empty($_SESSION["id_usuario"])) {
    $_SESSION["mensagem"] = "Erro: usuário não identificado. Faça login novamente.";
    header("Location: index.php");
    exit();
}

$id_usuario = $_SESSION["id_usuario"];

$stmt = $conn->prepare("INSERT INTO publicacoes (id_usuario, conteudo) VALUES (?, ?)");
$stmt->bind_param("is", $id_usuario, $conteudo);

if ($stmt->execute()) {
    $_SESSION["mensagem"] = "Publicação feita com sucesso!";
} else {
    $_SESSION["mensagem"] = "Erro ao publicar: " . $stmt->error;
}

$stmt->close();
header("Location: principal.php");
exit();
