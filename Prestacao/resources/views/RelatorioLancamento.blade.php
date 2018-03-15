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
		<div id="teste"> 
          <div class="expanded row margin-top-20">

            <div class="columns large-12">        
            <h1>Relatório de lançamentos</h1>
            </div> 

          </div> 
			<div class="expanded row margin-top-20" style="width:100%">
			<div class="columns large-12">
				<h5>I - IDENTIFICAÇÃO DA UNIDADE </h5>
			</div>
			<table style="align:center;margin:2%;width:98%">
				<thead>
					<th>Mantenedora</th>
					<th>CNPJ</th>
					<th>N° NF</th>
					<th>Responsável pela cotação</th>
				</thead>
				<tbody>
					<tr>
						<td>Teste</td>
						<td>000000000000000</td>
						<td>00000000</td>
						<td>BT</td>
					</tr>
				</tbody>
				<thead>
					<th>Nome da Unidade</th>
					<th>CNPJ</th>
					<th>Código INEP</th>
					<th>DRE</th>
				</thead>
				<tbody>
					<tr>
						<td>Teste</td>
						<td>000000000000000</td>
						<td>00000000</td>
						<td>BT</td>
					</tr>
				</tbody>
			</table>
			<div class="columns large-12" style="margin-right:50%">
				<h5>II - IDENTIFICAÇÃO DOS PROPONENTES</h5>
			</div>
			<div class="columns large-12" style="align:center;margin-right:40%;width:98%" >  
				<div class="columns large-4" >  
					<label>Razão Social: Teste</label>
					<label>CNPJ:0000000000000000</label>
					<label>Telefone/EMAIL:000000000000000000</label>
					<label>Contato:00000000000000000000000</label>
				</div>
				<div class="columns large-4" >  
					<label>Razão Social: Teste</label>
					<label>CNPJ:0000000000000000</label>
					<label>Telefone/EMAIL:000000000000000000</label>
					<label>Contato:00000000000000000000000</label>
				</div>
				<div class="columns large-4">  
					<label>Razão Social: Teste</label>
					<label>CNPJ:0000000000000000</label>
					<label>Telefone/EMAIL:000000000000000000</label>
					<label>Contato:00000000000000000000000</label>
				</div>
			</div>
			<div class="columns large-12" style="margin-right:7%">
				<h5>III - Propostas</h5>
			</div>
			<table style="align:center;margin:2%;width:98%">
				<thead>
					<th>Item</th>
					<th>Descrição do Produto</th>
					<th>Unidade</th>
					<th>Quant. </th>
					<th>Proponente A</th>
					<th>Proponente B</th>
					<th>Proponente C</th>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Banana Nanica </td>
						<td>KG</td>
						<td>2</td>
						<td>3,65</td>
						<td>3,42</td>
						<td>3,33</td>
					</tr>
				</tbody>	
			</table>
				<table style="align:center;margin:2%;width:98%">
					<thead>
						<th>Declaro as informações supracitadas como verdadeiras e me compromento com os preceitos de economicidade e bom uso do dinheiro público, de acordo com o disposto no artigo 14º , Inciso V, da Portaria nº 6433 de 01/10/2015 e a manter em arquivo, juntamente com os demais documentos comprobatórios do PNAE,conforme disoposto na RESOLUÇÃO Nº 53 DE 29 DE SETEMBRO DE 2011 - Artigo 8º os orçamentos fornecidos pelos proponentes cotados à época dos fatos.</th>
				    <thead>
				</table>
			<div class="columns large-12" style="align:center;margin-right:30%;width:98%">
				<div class="columns large-12" >
					<h5>IV -  AUTENTICAÇÃO</h5>
				</div>
				<div class="columns large-12 " style="margin-bottom:5%">
					<label>São Paulo,15 de fevereiro de 2018</label>
				</div>
			</div>
			

			<div class="columns large-9" style="margin-align-center:2%;width:98%" >
				<div class="columns large-3" style= "width:30%">
					<label>________________________</label>
					<label style="margin-left:30%;">Presidente:</label>
					<label>RG:</label>
					<label>CPF:</label>
				</div>
				<div class="columns large-3" style= "width:30%" >
					<label>_________________________</label>
					<label style="margin-left:30%">Diretor(a):</label>
					<label>RG:</label>
					<label>CPF:</label>
				</div>
			</div>

			
			
			</div>
			<br>
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
				<!--<button type="button" class="success button">Cadastrar</button>
				<button type="button" class="alert button">Cancelar</button> -->
          <!-- End content area -->
    </div>

