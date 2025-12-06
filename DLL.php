<?php
// Configuração do banco de dados
$server   = "localhost";   // ou IP do servidor
$user     = "root";        // seu usuário do MySQL
$password = "Bibi@2025";            // senha do MySQL
$db       = "meu_blog";        // nome do banco de dados

// Criando a conexão global que será usada em todo o site
$conn = new mysqli($server, $user, $password, $db);

// Testando conexão
if ($conn->connect_error) {
    die("Falha de conexão: (" . $conn->connect_errno . ") " . $conn->connect_error);
}

// -------------------------
// As funções originais 
// -------------------------

Function teste_login($sessao,$local) {
   if($sessao != "ok"){
		  $local = $local."index.php";
        header($local);
        exit;
    }
}

Function banco($server, $user, $password, $db, $consulta)
{
	$banco = new mysqli($server, $user, $password, $db);
	if ($banco->connect_error) {
        echo "Falha de conexão referência: (".$banco->connect_errno.") - ".$banco->connect_error;
		echo "<a href = 'index.php'> <img src = 'img/fundo/voltar.png' / width = 40 heigth= 40> </a>";
        exit();
	}
	if (!$resultado = $banco->query($consulta)) {
        echo "Falha na consulta referência: (".$banco->errno.") - ".$banco->error;
		echo "<a href = 'index.php'> <img src = 'img/fundo/voltar.png' / width = 40 heigth= 40> </a>";
		exit();
	}
    $banco->close();
	return $resultado;
}

Function databr($data){
   $muda  = explode('-', $data);
   $retorna = $muda[2]."/".$muda[1]."/".$muda[0];
   return $retorna;
}

// para usar o form   lembrar do null nos campos e botões não usados
function form($action,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$b1,$b2,$b3){
    echo "
    <style type='text/css'>
    label.incluir {
            display: inline-block;
            width: 120px;
    }
    </style>";
    echo"<fieldset>";
    echo"<form action='$action'method='post'>";
    if(isset($var1)){
        echo "<label for= $var1 class='incluir'>$var1:</label>";
        echo "<input type='text' name='$var1'/><br/>";
    }
    if(isset($var2)){
        echo "<label for= $var2 class='incluir'>$var2:</label>";
        echo "<input type='text' name='$var2'/><br/>";
    }
    if(isset($var3)){
        echo "<label for= $var3 class='incluir'>$var3:</label>";
        echo "<input type='text' name='$var3'/><br/>";
    }
    if(isset($var4)){
        echo "<label for= $var4 class='incluir'>$var4:</label>";
        echo "<input type='text' name='$var4'/><br/>";
    }
    if(isset($var5)){
        echo "<label for= $var5 class='incluir'>$var5:</label>";
        echo "<input type='text' name='$var5'/><br/>";
    }
    if(isset($var6)){
        echo "<label for= $var6 class='incluir'>$var6:</label>";
        echo "<input type='text' name='$var6'/><br/>";
    }
    if(isset($var7)){
        echo "<label for= $var7 class='incluir'>$var7:</label>";
        echo "<input type='text' name='$var7'/><br/>";
    }
  
    if(isset($b1)) echo"<input type='submit' value='$b1' name='$b1'/>";
    if(isset($b2)) echo"<input type='submit' value='$b2' name='$b2'/>";
    if(isset($b3)) echo"<input type='submit' value='$b3' name='$b3'/>";

    echo"</form>";
    echo"</fieldset>";
}

function XML($label,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$file){
	
   $xml = '<?xml version="1.0" encoding="utf-8"?>';
   $xml .= '<links>';
   $xml .= '<link>';
   if(isset($x1)) $xml .= '<'.$label[0].'>'. $x1 .'</'.$label[0].'>';
   if(isset($x2)) $xml .= '<'.$label[1].'>'. $x2.'</'.$label[1].'>';
   if(isset($x3)) $xml .= '<'.$label[2].'>'. $x3.'</'.$label[2].'>';
   if(isset($x4)) $xml .= '<'.$label[3].'>'. $x4.'</'.$label[3].'>';
   if(isset($x5)) $xml .= '<'.$label[4].'>'. $x5.'</'.$label[4].'>';
   if(isset($x6)) $xml .= '<'.$label[5].'>'. $x6.'</'.$label[5].'>';
   if(isset($x7)) $xml .= '<'.$label[6].'>'. $x7.'</'.$label[6].'>';
   if(isset($x8)) $xml .= '<'.$label[7].'>'. $x8.'</'.$label[7].'>';
   if(isset($x9)) $xml .= '<'.$label[8].'>'. $x8.'</'.$label[8].'>';
   if(isset($x10)) $xml .= '<'.$label[9].'>'. $x10.'</'.$label[9].'>';
   $fim = count($label) - 1;
   $xml .= '<modo>'. $label[$fim].'</modo>';
   $xml .= '</link>';
   $xml .= '</links>';

   $fp = fopen($file, 'w+');
   fwrite($fp, $xml);
   fclose($fp);
}
?>
