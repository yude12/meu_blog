<?php
session_start();
include "DLL.php";

$mensagem_erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email_usuario"] ?? "";
    $senha = $_POST["senha_usuario"] ?? "";

    if (empty($email) || empty($senha)) {
        $mensagem_erro = "Preencha todos os campos.";
    } else {
        // Busca usuário no banco
        $stmt = $conn->prepare("SELECT id_usuario, nome, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();

            // Verifica senha
            if (password_verify($senha, $usuario["senha"])) {

                // 🔹 Aqui as linhas que você pediu
                $_SESSION["status"]       = "logado";
                $_SESSION["nome_usuario"] = $usuario["nome"];
                $_SESSION["id_usuario"]   = $usuario["id_usuario"]; // ESSENCIAL
                $_SESSION["usuario"]      = $usuario["nome"];

                header("Location: principal.php");
                exit();

            } else {
                $mensagem_erro = "Senha incorreta.";
            }
        } else {
            $mensagem_erro = "Usuário não encontrado.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="index.php">
        <label>Email:</label><br>
        <input type="email" name="email_usuario" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha_usuario" required><br><br>

        <button type="submit" name="entrar">Entrar</button>
    </form>
    <?php if (!empty($mensagem_erro)): ?>
        <p style="color:red;"><?= htmlspecialchars($mensagem_erro) ?></p>
    <?php endif; ?>

    <p><a href="cadastro.php">Cadastre-se aqui</a></p>
</body>
</html>

