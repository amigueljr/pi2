<?php
if(isset($_POST['userName']) && isset($_POST['password'])){
    if($_POST['userName']=='aluno' && $_POST['password']=='univesp'){
        header("Location: first.php");
    }else{
        echo 'Você não tem credenciais para acessar a página';
    }
}