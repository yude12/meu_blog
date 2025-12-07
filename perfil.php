<?php
session_start();

// Verifica login
function teste_login($sessao, $local){
    if($sessao != "ok"){
        $local = $local."login.html";
        header($local);
        exit;
    }
}

function banco($server, $user, $password, $db, $consulta) {
    $banco = new mysqli($server, $user, $password, $db);
    if ($banco->connect_error) {
        echo "Falha de conexão: (".$banco->connect_errno.") - ".$banco->connect_error;
        exit();
    }
    if (!$resultado = $banco->query($consulta)) {
        echo "Falha na consulta: (".$banco->errno.") - ".$banco->error;
        exit();
    }
    $banco->close();
    return $resultado;
}

function databr($data){
    $muda  = explode('-', $data);
    return $muda[2]."/".$muda[1]."/".$muda[0];
}

function form($action,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$b1,$b2,$b3){
    echo "<fieldset><form action='$action' method='post' enctype='multipart/form-data'>";
    $vars = [$var1,$var2,$var3,$var4,$var5,$var6,$var7];
    foreach($vars as $v){
        if($v) echo "<label>$v:</label> <input type='text' name='$v'/><br>";
    }
    $btns = [$b1,$b2,$b3];
    foreach($btns as $b){
        if($b) echo "<input type='submit' name='$b' value='$b'/>";
    }
    echo "</form></fieldset>";
}

function XML($label,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$file){
    $xml = '<?xml version="1.0" encoding="utf-8"?><links><link>';
    $vals = [$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10];
    for($i=0;$i<10;$i++){
        if(isset($vals[$i]) && $vals[$i]!=='') $xml .= "<".$label[$i].">".$vals[$i]."</".$label[$i].">";
    }
    $fim = count($label)-1;
    $xml .= "<modo>".$label[$fim]."</modo>";
    $xml .= "</link></links>";
    file_put_contents($file, $xml);
}

teste_login($_SESSION['sessao'] ?? '', 'Location: ');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome      = $_POST['nome'] ?? '';
    $idade     = $_POST['idade'] ?? '';
    $cidade    = $_POST['cidade'] ?? '';
    $profissao = $_POST['profissao'] ?? '';
    $bio       = $_POST['bio'] ?? '';

    if (!is_dir('usuarios')) mkdir('usuarios', 0755, true);

    $fotoNome = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoTemp = $_FILES['foto']['tmp_name'];
        $fotoNome = 'usuarios/' . uniqid() . '_' . $_FILES['foto']['name'];
        move_uploaded_file($fotoTemp, $fotoNome);
    }

    $labels = ['nome','idade','cidade','profissao','bio','foto','','','','modo'];

    XML($labels, $nome, $idade, $cidade, $profissao, $bio, $fotoNome, '', '', '', '', "usuarios/$nome.xml");

    $perfil = simplexml_load_file("usuarios/$nome.xml");

} else {
    form('', 'nome','idade','cidade','profissao','bio','foto', null, 'Enviar', null, null);
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Perfil de <?php echo htmlspecialchars($perfil->nome); ?></title>
</head>
<body>
<h2>Perfil do Usuário</h2>

<?php if (!empty($perfil->foto)): ?>
<img src="<?php echo htmlspecialchars($perfil->foto); ?>" width="150"><br><br>
<?php endif; ?>

<strong>Nome:</strong> <?php echo htmlspecialchars($perfil->nome); ?><br>
<strong>Idade:</strong> <?php echo htmlspecialchars($perfil->idade); ?><br>
<strong>Cidade:</strong> <?php echo htmlspecialchars($perfil->cidade); ?><br>
<strong>Profissão:</strong> <?php echo htmlspecialchars($perfil->profissao); ?><br><br>
<strong>Biografia:</strong><br>
<?php echo nl2br(htmlspecialchars($perfil->bio)); ?>

</body>
</html>
