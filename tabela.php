<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        
        $path = "upload/permanent/";
        $diretorio = dir($path);
        
        echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
        ?>
        <table border='1'>
                <th>Arquivo</th>
            <?php
        while($arquivo = $diretorio -> read()){
            ?>
            <tr>
                <td><a href='<?=$path.$arquivo;?>'>.<?=$arquivo;?></a></td>
            </tr>
        <?php
        }
        $diretorio -> close();
        ?>
        </table>
    
</body>
</html>