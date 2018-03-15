   
	<div class="medium-12 large-10 columns" id="main">        

        <!-- header -->
        
        <div id="header" class="expanded row bg-grey">

            <div class="medium-6 columns hide-for-large text-left" style="border-right:02px dotted #fff;">
                <div class="blue text-left" style="font-size:1rem;line-height:2.8rem;" data-responsive-toggle="sidebar" data-hide-for="large"><i class="fi-list"></i> <a href="#" data-toggle>Menu</a></div>
            </div>

            

        </div> 

        <!-- Breadcrumb -->

          <div class="expanded row" id="breadcrumb">
            <div class="columns large-12 gray">Home <i class="fa fa-angle-right"></i> Page</div>
          </div>

          <!-- Begin content area --> 
		  
		 <div id="teste" >
          <div class="expanded row margin-top-20">
			 
            <div class="columns large-12" style="text-align:center;">        
            <h1>PRESTAÇÃO DE CONTAS PNAE</h1>
			<h3>JUSTIFICATIVA DE GASTOS</h3>
            </div> 

          </div> 
			<div class="expanded row margin-top-20" style="width:100%">
			
			<div class="columns large-12">
				<label>Mantenedora:</label>
				<label>Nome da Unidade:</label>
				<label>Código do INEP:</label>
				<label>Período:</label>
			</div>
			
			<table style="align:center;margin:2%;width:98%">
					<thead>
						<th>A [Nome da Mantenedora] realizou a aquisição dos produtos constantes da(s) nota(s) fiscal(is) em anexo, com recursos provenientes da verba PNAE para utilização em sua unidade escolar acima identificada, conforme descrito, carimbado e assinado na mesma.<br><br>
						Informamos que apesar de alguns desses produtos serem enviados por CODAE, a aquisição se fez necessária para garantir o bom atendimento de sua unidade escolar uma vez que, em alguns momentos ocorreram falhas na entrega, tais como: ausência de produto, por desabastecimento e entregas em quantidade insuficiente para o número de alunos atendidos.</th>
				    <thead>
			</table>
			
			<table style="align:center;margin:2%;width:98%">
				<thead>
					<th>Quantidade:</th>
					<th>N° NF:</th>
					<th>Descrição:</th>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>61676</td>
						<td>Laranja Lima KG</td>
						
					</tr>
				</tbody>	
			</table>
			
			<div class="columns large-12" style="align:center;margin-right:45%;width:98%">
				<div class="columns large-12 " style="margin-bottom:5%">
					<label>São Paulo,15 de fevereiro de 2018</label>
				</div>
			</div>
			

			<div class="columns large-9" style="margin-align-center:2%;width:98%" >
				<div class="columns large-3" style= "width:30%">
					<label>________________________</label>
					<p style="margin-left:10%;">Presidente:</p>
					<p>RG:</p>
					<p>CPF:</p>
				</div>
				<div class="columns large-3" style= "width:30%" >
					<label>_________________________</label>
					<p style="margin-left:10%">Diretor(a):</p>
					<p>RG:</p>
					<p>CPF:</p>
				</div>
			</div>
		</div>
		</div>
	
	 
			<input type="button" id="btnI" value="Imprimir" onclick="teste()"  class="success button"  />  
				<!--<button type="button" class="success button">Cadastrar</button>
				<button type="button" class="alert button">Cancelar</button> -->
          <!-- End content area -->
    
	</div>
	
			<script>	
			function teste(){
			/*var div = $("#teste").html();
			var div2 = $("#ass").html();
            var printWindow = window.open('', '', 'height=1024,width=768');
			
            printWindow.document.write(div+div2);
            
            printWindow.document.close();
            printWindow.print();
			*/
			 
			  
									
	      var divToPrint = document.getElementById('teste');
          var popupWin = window.open('', '_blank', 'width=1024,height=768');
          popupWin.document.open();
          popupWin.document.write('<html><link href="css/foundation.css"  rel="stylesheet" type="text/css"><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
          popupWin.document.close();
        }
			</script> 
	
	

	<!--<script>
		function printIt() {
		var win = window.open();
		self.focus();
		win.document.open();
		win.document.write('<?php// echo view('RelatorioJustificativa'); ?>');
		win.document.close();
		win.print();
		win.close();
}

	</script> -->