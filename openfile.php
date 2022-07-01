<?php
include 'classes/conexao.php';
include 'classes/evento.php';
// include 'upload.php';
function openFile($file, $novoNome, $timestamp){
    $arquivo = fopen($file,'r');
    if ($arquivo == false) die('Não foi possível abrir o arquivo.');
    $maquina= array();
    $conteudo = array();
    $Nlinhas = count(file($file));
    $boas=0;
    $ruins=0;
    echo "Número de linhas igual a: ".$Nlinhas."<br>";
    $arquivogravado = fopen('meuarquivo.txt','w'); if ($arquivo == false) die('Não foi possível criar o arquivo.'); 
    $contagemBoas=0;
    $contagemRuins=0;
    $contagem = 0;
    $conexao = new Banco();
    $con = $conexao->getConnection();
    $evento = new Evento($con);
    for($i=0;$i<=$Nlinhas;$i++){
        
       
        $linha = fgets($arquivo); 
        if($linha[0] != "!" && $linha[0] != "E" && $linha[0] != "F"){ 
            $row = preg_replace('/\s+/', ' ', $linha);
            $pieces = explode(" ", $row); 

            
            if($pieces[0] == 'B' && $pieces[4] == '0'){
                $boas +=1;
            }
            if($pieces[0] == 'B' && $pieces[4] != '0'){
                $ruins +=1;
            }
            if($pieces[0] != null && $pieces[3] != null && $pieces[4] != null){
            // echo "<pre>";
            // print_r($pieces[0].'--'.$pieces[3].'--'.$pieces[4].' -- CONTAGEM DE BOAS: '.$boas.' CONTAGEM DE RUINS: '.$ruins);
            // echo "<br>";
            // echo "</pre>"; 
            // $DataAtual = new DateTime();
            $data = substr($pieces[3], 0, -9);  // retorna "data"
            $hora = substr($pieces[3], -8);  // retorna "data"
            $dataHora = $data.' '.$hora;
            $DataCompletaEspecifica = new DateTime($dataHora);
            
            
            $evento->nome_arquivo = $novoNome;
            $evento->data_upload = $timestamp;
            $dataEvento = implode('-', array_reverse(explode('-', $data)));
            // echo 'DATA EVENTO: '.$dataEvento;
            $date = new DateTime($dataEvento);
            $dateFormatada = $date->format('y-m-d')."<br>";
            $evento->data_evento = $dateFormatada;
            $evento->hora_evento = $hora;
            if($pieces[0] == 'B' && $pieces[4] == '0'){
                $evento->status = 'B';
                $contagemBoas +=1;
            }else if($pieces[0] == 'B' && $pieces[4] != '0'){
                $evento->status = 'E';
                $contagemRuins +=1;
                
            }
   
            fwrite($arquivogravado, $pieces[0].'--'.$pieces[3].'--'.$pieces[4].' -- CONTAGEM DE BOAS: '.$boas.' CONTAGEM DE RUINS: '.$ruins.PHP_EOL);
            // fclose($arquivogravado);
            // $arquivo2 = fopen('meuarquivo.txt','r');
            // $linhas = count(file($arquivo2));
            // fclose($arquivo2);
            try{
                $evento->criar();
                // header("Location: ./consulta_turnos.php");
                }catch (Error $e){
                    echo "ERROR: ".$e;
                }

                    // $contagem = $contagemBoas + $contagemRuins;
                    // echo 'Contagem: '.$contagem."<br>";
                    
                    // if($i == ($contagemBoas + $contagemRuins)){
                    //     header("Location: consulta_turnos.php");
                    //     die();
                    // }
        }

            



            // // if($pieces[])
            // echo "<pre>";
            // print_r($pieces[0]."*".$pieces[1]."*".$pieces[2]."*".$pieces[3]."*".$pieces[4]."*".$pieces[5]."*".$pieces[6]."*".$pieces[7]."*".$pieces[8]);
            // echo "</pre>";

            // $pieces = explode(" ", $linha);
            // array_push($maquina, $pieces[4], $pieces[5],$pieces[7]);
            // echo "<pre>";
            // print_r($maquina);
            // echo "</pre>";
            
        }
        // foreach($linha as &$line){
            
        //     if ($linha==null){ 
        //         array_push($vetorLinha, "linha vazia");
        //         }else{
        //             // break;
        //         // echo $linha."<br>";
                
        //         array_push($vetorLinha, $linha);
        //         // $pieces = explode(" ", $linha);
        //         // foreach ($linha as &$line) {
                    
        //         //     $vetorLinha = $line;
        //         //     print_r($vetorLinha."<br>");
        //         // }
        //         // echo $pieces[0]."<br>"; // piece1
        //         
        //     }
        // }
        // // while(true) {
        // //     $linha = fgets($arquivo);
        // //     if ($linha==null){ 
        // //     array_push($vetorLinha, "linha vazia");
        // //     }else{
        // //         // break;
        // //     // echo $linha."<br>";
            
        // //     array_push($vetorLinha, $linha);
        // //     // $pieces = explode(" ", $linha);
        // //     // foreach ($linha as &$line) {
                
        // //     //     $vetorLinha = $line;
        // //     //     print_r($vetorLinha."<br>");
        // //     // }
        // //     // echo $pieces[0]."<br>"; // piece1
        // //     
        

        }
        echo "<script>window.location.href='consulta_turnos.php';</script>";

        echo "Boas: ".$boas;
        echo "<br>";
        echo "Ruins: ".$ruins;
        fwrite($arquivogravado, 'PLACAS BOAS: '.$boas.PHP_EOL.'PLACAS RUINS: '.$ruins.PHP_EOL);
        
        fclose($arquivogravado);
        
        // sleep(5);

        // header("Location: consulta_turnos.php");
}

?>