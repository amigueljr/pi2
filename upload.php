<?php 
include 'openfile.php';




$conexao = new Banco();
$con = $conexao->getConnection();
$evento = new Evento($con);
$evento->consultaVaziaEDeleta();

$mask = "./upload/permanent/*.txt";
array_map("unlink", glob($mask));

$date = date_create();
$dataTimeStamp = date_timestamp_get($date);
$dataLegivel = date("m-d-Y H_i_s", $dataTimeStamp); 
$filename = basename($_FILES['UploadFileName']['name']);
$ext = substr($filename, -4);
$novoNome = 'log'.'_'.$dataLegivel.$ext;
// echo 'Filename: '.$novoNome;

$novoNomeECaminho = 'upload/permanent/'.$novoNome;
// $target = "upload/files/".basename($_FILES['UploadFileName']['name']); 
$target = $novoNomeECaminho;
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
if (move_uploaded_file($_FILES['UploadFileName']['tmp_name'],$target)) { 
    echo "Arquivo sendo enviado! - ";//.$target;
    echo '<br>'; 
    openFile($target, $dataLegivel, $dataTimeStamp);
} 
else { 
    echo "Erro, o arquivo n&atilde;o pode ser enviado."; 
}           
?>