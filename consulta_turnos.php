<?php
include 'classes/conexao.php';
include 'classes/evento.php';



$conexao = new Banco();
$con = $conexao->getConnection();
$evento = new Evento($con);
$stmt = $evento->getDatasIniciais();
$stmt2 = $evento->getDatasFinais();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>Consulta resultado por turnos</title>
    
</head>
<body>
    <?php
        include 'navbar.php';
    ?>
    <div class="container mt-5">
            <div class="row">
                <div class="col-sm-4"> 
                    <label for="inicial">Data Inicial:</label>
                      
                        <select class="form-control" name="dataInicio" id='dataInicio'>
                            <?php
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?=$row['data_evento'];?>"><?=$row['data_evento'];?></option>

                            <?php
                                }
                            
                            ?>
                        </select>
                </div>
                
                <div class="col-sm-4">  
                    <label for="horainicial">Hora Inicial:</label>
                    <select class="form-control" name="hora_inicial" id='hora_inicial'>
                        <option>Hora Inicial</option>

                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-4"> 
                    <label for="final">Data Final:</label>
                        <select class="form-control" name="dataFim" id='dataFim'>
                            <?php
                                while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?=$row2['data_evento'];?>"><?=$row2['data_evento'];?></option>

                            <?php
                                }
                            ?>
                        </select>
                </div>
                <div class="col-sm-4"> 
                    <label for="horafinal">Hora Final:</label>
                        <select class="form-control" name="hora_final" id='hora_final'>
                            <option>Hora Final</option>
                            </select>
                </div>
            </div>
            
            <div class="row mb-3 mt-3 ml-1">
                <button class="btn btn-primary" id="submit">Gera Relatório</button>
            </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                <div class="card-header">PLACAS BOAS</div>
                <div class="card-body">
                    <h4 class="card-title" id="boas"></h4>
                    <p class="card-text" ></p>
                </div>
            </div>
            <div class="card bg-danger mb-3 ml-2" style="max-width: 20rem;">
                <div class="card-header">PLACAS RUINS</div>
                <div class="card-body">
                    <h4 class="card-title" id="ruins"></h4>
                    <p class="card-text" ></p>
                </div>
            </div>
            <div class="card text-white bg-secondary mb-3 ml-2" style="max-width: 20rem;">
                <div class="card-header">YIELD</div>
                <div class="card-body">
                    <h4 class="card-title" id="yield"></h4>
                    <p class="card-text" ></p>
                </div>
            </div>
            <div class="row mb-5 mt-3 ml-2">
            <a href="https://integrador202201.herokuapp.com/" class="btn btn-warning">CLIQUE PARA GRÁFICOS</a> <hr/>
            </div>
            </div>
        </div>               
    </div>

<script type="text/javascript">
$(document).ready(function(){

	<!-- Carrega os Horários Iniciais -->
	$('#dataInicio').change(function(e){
		var dataInicio = $('#dataInicio').val();
  
		$.getJSON('consultacombobox.php?opcao=data_inicial&valor='+dataInicio,
        
		function (dados){
            
		   if (dados.length > 0){
			  var option = '<option>Selecione o Horário Inicial</option>';
			  $.each(dados, function(i, obj){
				  option += '<option value="'+obj.hora_evento+'">'+obj.hora_evento+'</option>';
			  })
            //   $('#mensagem').html('<span class="mensagem">Total de cidades encontradas.: '+dados.length+'</span>');
		   }else{
			  Reset();
		   }
		   $('#hora_inicial').html(option).show();
		})
	})
});

$(document).ready(function(){

<!-- Carrega os Horários Finais -->
$('#dataFim').change(function(e){
    var dataFim = $('#dataFim').val();

    $.getJSON('consultacombobox.php?opcao=data_final&valor='+dataFim,
    
    function (dados){
        
       if (dados.length > 0){
          var option = '<option>Selecione o Horário Final</option>';
          $.each(dados, function(i, obj){
              option += '<option value="'+obj.hora_evento+'">'+obj.hora_evento+'</option>';
          })
        //   $('#mensagem').html('<span class="mensagem">Total de cidades encontradas.: '+dados.length+'</span>');
       }else{
          Reset();
       }
       $('#hora_final').html(option).show();
    })
})
});

$(document).ready(function(){

<!-- Envia Dados para o Relatório -->
$('#submit').click(function(e){
    var dataInicio = $('#dataInicio').val();
    var horaInicio = $('#hora_inicial').val();
    var dataFim = $('#dataFim').val();
    var horaFinal = $('#hora_final').val();

    $.getJSON('relatorio.php?dataInicio='+dataInicio+'&hora_inicial='+horaInicio+'&dataFim='+dataFim+'&hora_final='+horaFinal,
    
    function (dados){
        // console.log(dados);
        // Object.keys(dados).forEach((item) => {
        //     console.log(item + " = " + dados[item]);
        //     });
            var arrayBoas;
            var arrayRuins;
            var boas;
            var ruins;
            for (const property in dados) {
                if (property =='boas'){
                    arrayBoas = dados[property];
                }else if(property =='ruins'){
                    arrayRuins = dados[property];
                }
                // console.log('PROPRIEDADE: '+property + " = " + dados[property]);
                
            }
                // console.log('BOAS: '+arrayBoas);
                // console.log('RUINS: '+arrayRuins);

            arrayBoas.forEach(numero => {
                // console.log('Placas boas: '+numero.qtdeB);
                boas = numero.qtdeB;
            });
            arrayRuins.forEach(numero => {
                // console.log('Placas ruins: '+numero.qtdeE);
                ruins = numero.qtdeE;
            });

            console.log('BOAS: '+boas);
            console.log('RUINS: '+ruins);
            var total = Number(boas) + Number(ruins);
            console.log('Total: '+total.toString());
            var resp = Number(boas) / Number(total);
            console.log('Yield: '+resp.toString());

            $('#boas').html('<span class="mensagem">'+boas+'</span>');
            $('#ruins').html('<span class="mensagem">'+ruins+'</span>');
            $('#yield').html('<span class="mensagem">'+resp.toFixed(2).toString()+'</span>');
    

    })
})
});
</script>
</body>
</html>