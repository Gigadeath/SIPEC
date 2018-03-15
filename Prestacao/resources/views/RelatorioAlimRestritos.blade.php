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

            <div class="columns large-12 " style="text-align:center;">        
            <h1>PRESTAÇÃO DE CONTAS PNAE</h1>
			<h3>RELAÇÃO DE GÊNEROS ALIMENTÍCIOS RESTRITOS</h3>
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
					<th>Alimento</th>
					<th>Qtde:</th>
					<th>N° NF:</th>
					<th>Valor(R$):</th>
				</thead>
				<tbody>
					<tr>
						<td>Laranja Lima KG</td>
						<td>1</td>
						<td>61676</td>
						<td>4,22</td>
					</tr>
				</tbody>	
			</table>
			
			<div class="columns large-12" style="margin-right:45%;width:98%">
				<div class="columns large-12" style="width:98%;">
					<h5 style="margin-bottom:5%;text-align:center">Calculo</h5>
					<table style="align:center;margin:2%;width:98%;">
						<tbody>
							<tr>
								<td><h5>Valor do repasse PNAE em [data de referencia]</h5></td>
								<td><h5>[valor1]</h5></td>
							</tr>
							<tr>
								<td><h5> Até 30% do valor recebido</h5></td>
								<td><h5>[valor2]</h5></td>
							</tr>
							<tr>
								<td><h5>Valor total de alimentos restritos adquiridos</h5></td>
								<td><h5>[valor3]</h5></td>
							</tr>
							<tr>
								<td><h5>Resultado(+)/(-)</h5></td>
								<td><h5>[valor4]</h5></td>
							</tr>
							<tr>
								<td><h5>Total</h5></td>
								<td><h5>[valor5]</h5></td>
							</tr>
						</tbody>	
					</table>
				</div>
				<div class="columns large-12 " style="margin-bottom:5%;width:98%">
					<label>São Paulo,15 de fevereiro de 2018</label>
				</div>
			</div>
			

			<div class="columns large-9" style="margin:2%;width:98%" >
				<div class="columns large-3" style= "width:30%">
					<label>________________________</label>
					<p style="margin-left:10%;">Presidente:</p>
					<p>RG:</p>
					<p>CPF:</p>
				</div>
				<div class="columns large-3" style="margin-bottom:5%;margin-left:2%;margin-right:2%;width:30%">
					<label style="margin-bottom:5%">São Paulo ____/____/____</label>
					<label>Conferencia CODAE:______________________</label>
					<p style="margin-left:10%;">(ASSINATURA E CARIMBO)</p>
					
				</div>
				<div class="columns large-3" style= "width:30%" >
					<label>_________________________</label>
					<p style="margin-left:10%">Diretor(a):</p>
					<p>RG:</p>
					<p>CPF:</p>
				</div>
			</div>
			
			</div>
			<br>
				
          <!-- End content area -->
    </div>
		<button type="button" class="success button" onclick="teste();">Imprimir</button>
	</div>
	
			<!--<button type="button" class="alert button">Cancelar</button> -->
	<script type="text/javascript">	
			function teste(){
			/*var div = $("#teste").html();
			var div2 = $("#ass").html();
            var printWindow = window.open('', '', 'height=1024,width=768');
			
            printWindow.document.write(div+div2);
            
            printWindow.document.close();
            printWindow.print();
			*/
			
			  
									
		/*	var conteudo = document.getElementById('teste');
			var html = '<html><head>'+
              '<link href="css/style.css" rel="stylesheet" type="text/css"/>'+
              '</head><body style="background:#ffffff;">'+
              conteudo+'</body></html>';
			
			tela_impressao = window.open("",'teste',"width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
			tela_impressao.document.writeln(html);
			tela_impressao.window.print();
			tela_impressao.window.close();
	
			} */
			
		
           var divToPrint = document.getElementById('teste');
           var popupWin = window.open('', '_blank', 'width=1024,height=768');
           popupWin.document.open();
           popupWin.document.write('<html><link href="css/foundation.css"  rel="stylesheet" type="text/css"><link href="css/style.css" rel="stylesheet" type="text/css"><link href="css/foundation-flex.min.css"  rel="stylesheet" type="text/css"><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
           popupWin.document.close();
        }
		</script> 
	
	