    <?php
	use Illuminate\Support\Facades\Session;
	use App\Http\Controllers\FornecedorController;
	use App\Http\Controllers\ProdutoController;
	use App\Http\Controllers\TipoProdutoController;
	use App\Http\Controllers\MedidaController;
	
	Session::has('id')==true ? $id=Session::get('id') : $id=null;
		
	?>
	
	<div class="medium-12 large-10 columns" id="content">        

		
        <!-- header -->
        
        <div id="header" class="expanded row bg-grey">

            <div class="medium-6 columns hide-for-large text-left" style="border-right:02px dotted #fff;">
                <div class="blue text-left" style="font-size:1rem;line-height:2.8rem;" data-responsive-toggle="sidebar" data-hide-for="large"><i class="fi-list"></i> <a href="#" data-toggle>Menu</a></div>
            </div>
		
            

            

        </div> 
		

          <!-- Begin content area --> 

          <div class="expanded row margin-top-20">
		   <form method="post" action="<?php echo url('prestacao/public/CadNota/create');?>" id="nota" >

		   <?php
			if(Session::has('success'))
			{
				echo "<div class='callout success' data-closable style='width:100%'><h5>".Session::get('success')."</h5><button class='close-button' aria-label='Dismiss alert' type='button' data-close>    <span aria-hidden='true'>&times;</span></button><br>";
				Session::forget('success');
				echo "</div>";
			}
			if(Session::has('alert'))
			{
				echo "<div class='callout alert' data-closable style='width:100%'><h5>Erro!!!</h5>".Session::get('alert')."<button class='close-button' aria-label='Dismiss alert' type='button' data-close>    <span aria-hidden='true'>&times;</span></button><br>";
				Session::forget('alert');
				echo "</div>";
			}
			
			if(Session::has('dados'))
			{
				$dados= Session::get('dados');
				Session::forget('dados');
			}
			
			if(Session::has('erro'))
			{
					$erro=Session::get('erro');
					Session::forget('erro');
			}
				
				
			?>
		   
			<meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="columns large-12">        
            <h1>Cadastro de Notas</h1>
			<br>
			
			<label>Metodo de digitação:</label>
                <input type="radio" name="escolha" value="automatico" id="aut"><label for="aut" readonly>Automatico</label>
                <input type="radio" name="escolha" value="manual" id="man"><label for="man" checked>Manual</label>
            </div> 


			<div class="columns large-4">        
				<label>
					N° da Nota:	
					<input type="text" name="Nota"  placeholder="Insira o numero da nota" required>
				</label><br>
			</div>
			
			<div class="columns large-4">        
				<label>
					Data Emissão:
					<input type="date" name="Data" required>
				</label><br>
				
			</div>
				
				
			<div class="columns large-4">
			<label>Fornecedor:
						<select required id="fornecedor" name="fornecedor"   <?php if(isset($dados['fornecedor'])){echo "value='".$dados['fornecedor']."'";} ?>>
							<?php
							$valor= isset($dados['fornecedor']) ? $dados['fornecedor'] : null;
							echo FornecedorController::show(null,'combo',$valor);
							?>
						</select></label>
			</div>
			<br>
			<div class="columns large-12" style="margin-bottom:1%">	
				<p><a data-open="exampleModal2" class="secondary button">Inserir Produto</a></p>
			</div>
			<table id="ProdutosNota" style="width:100%">
			<thead>
				<tr>
					<th>Produto</th>
					<th>Medida</th>
					<th>Qtde</th>
					<th>Valor Unitário</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody id="Produtos">
				
			</tbody>
			</table>
			
			<div class="expanded row margin-top-20">
			<div class="columns large-4"><p>
			<a href="#" class="secondary button" name="addVar">+</a></p><br>
			</div>
				<div class="columns large-4"> 
				<label>
					Desconto:	
					<input type="number" min="0" max="100" id="inputdesconto" value="0" name="desconto" onchange="SomaTotal()"  placeholder="desconto em %"<?php if(isset($dados)){echo "value='".$dados['desconto']."'";}if(isset($erro)==true && $erro==''){echo "style='border:1px solid red'";}?>>
				</label><br>
			</div>
			<div class="columns large-4">
			
					Total:	
					<input type="text" id="inputtotal"  placeholder="R$"  name="total"  readonly <?php if(isset($dados)){echo "value='".$dados['total']."'";}if(isset($erro)==true && $erro==''){echo "style='border:1px solid red'";}?> >
				<br>
			</div>
			</div>
			<div class="columns large-4"> 
				<br><button type="submit" name="form" class="success button">Cadastrar</button>
				<button type="button" class="alert button">Cancelar</button>
			</div>
		 </form>
		</div> 

			<div class="reveal" id="exampleModal2" data-reveal data-options="multipleOpened:false;">

			<div class="expanded row margin-top-20">
			 
			<div class="columns large-12">        
				<h1 name="Produto">Cadastro de Produto<h1>
            </div> 
			<form id="produto">
				<meta name="csrf-token" content="{{ csrf_token() }}">
		
			<div id="multi">
			
				
			</div>
			<p><a href="#" class="secondary button" name="addProd">+</a></p><br>
			
			
			
			<br>
			<div class="columns large-12"> 
				<button type="button" name="form2" class="success button">Cadastrar Produto</button>
				<button type="button"  class="alert button" name="esconder" href="#nota">Esconder</button>
			</div>
				
		 </form>
		 
		 
		</div>
		
        <button class="close-button" data-close aria-label="Close reveal" type="button">
		<span aria-hidden="true">&times;</span>
		</button>
    </div>
	
	<script>
	
	$('#Produto').hide();
		//initialize with 3
	var produto=0;
	var startingNo = 0;
	var $node = "";
	for(varCount=0;varCount<=startingNo;varCount++){
		var displayCount = varCount+1;
		$node = '<tr id="linha'+varCount+'" class="linha">\
					<td><select id="produto'+varCount+'" name="produto[]" class="produto"  style="width:100%" required> </select></td> \
					<td><select class="selectMed" id="codMedida'+varCount+'" name="codMedida[]" style="width:100%" required ></select></td>\
					<td><input type="number" min="1" name="qtde[]" id="qtde[]" onchange="SomaTotal()" class="qtde" required></td>\
					<td><input type="text"  name="valorunit[]" id="valorunit[]" onchange="SomaTotal()" class="valor" required></td>\
				</tr>';
	}
	$('#Produtos').prepend($node);
	loadProduto(0);
	loadMedida(0);
	function verificaCampos()
	{
		var valida=false;
		$('#ProdutosNota > #Produtos  > .linha').each(function()
		{
			if($(this).find('.produto').val()<=0)
			{
				valida=false;
			}
			else
			{
				if($(this).find('.selectMed').val()<=0)
				{
					valida=false;
				}
				else
				{
					if($(this).find('.qtde').val()<=0)
					{
						valida=false;
					}
					else
					{
						if($(this).find('.valor').val()<=0)
						{
							valida=false;
						}
						else
						{
							valida=true;
						}
						
					}
				}
			}
			
		
		});
		
		return valida;
	}
	function SomaTotal()
	{
		var sum = 0.0;
		$('#ProdutosNota > #Produtos  > .linha').each(function() 
		{
			var price = $(this).find('.valor').val().replace(",",".");
			var qty = $(this).find('.qtde').val();
			var amount = (qty*price)
			sum+=amount;
			//alert(sum);
			//$(this).find('.amount').text(''+amount);
		});
		//just update the total to sum  
		var valor=sum-(sum*($('#inputdesconto').val()/100));
		$('#inputtotal').val(numberToReal(valor));
	}
	function numberToReal(numero) 
	{
		var numero = numero.toFixed(2).split('.');
		numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
		return numero.join(',');
	}

	
	$('.qtde').change(function() {
		SomaTotal();
	});
	
	$('.valor').change(function() {
		SomaTotal();
	});
	function deleta(varCount){
		$('#linha'+varCount).remove();
		SomaTotal();
		//varCount--;
	}
	
	function deletaProd(produto){
		$('#prod'+produto).remove();
		//varCount--;
		
	}
	
	$('[name="addVar"]').on('click', function()
	{
		if (verificaCampos()==true)
		{
			$node = '<tr id="linha'+varCount+'" class="linha">\
						<td><select id="produto'+varCount+'" name="produto[]" class="produto"  style="width:100%" required> </select></td> \
						<td><select class="selectMed" id="codMedida'+varCount+'" name="codMedida[]" style="width:100%" required ></select></td>\
						<td><input type="number" min="1"  class="qtde" name="qtde[]"  id="qtde[]" required></td>\
						<td><input type="text" class="valor" name="valorunit[]" onchange="SomaTotal()" id="valorunit[]"  required></td>\
						<td><a href="#" name="delete" class="alert button"  onchange="SomaTotal()" id="'+varCount+'" onclick="deleta('+varCount+')">X</a></td>\
					</tr>';
			$('#Produtos').append($node);
			loadProduto(varCount);
			loadMedida(varCount);
			$('.produto').select2();
			$('.selectMed').select2();
			varCount++;
		}else
		{
			alert("Termine de digitar a linha do produto acima!!!");
		}
		

		
		
	});
	
	$('[name="addProd"]').on('click', function(){
		$node = '<div id="prod'+produto+'">\
					<div class="columns large-12">\
					<div class="columns large-3"><label name="lblnome">Nome:<input type="text" name="nome[]"  placeholder="Insira o nome"></label><br></div>\
					<div class="columns large-3"><label>Tipo Produto</label><select id="selectTipo" name="codTipoProduto[]"><?php echo TipoProdutoController::show(null,'combo'); ?></select></div>\
					<div class="columns large-3"><label><a href="#" name="delete" class="alert button" id="'+produto+'" onclick="deletaProd('+produto+')">X</a></label></div>\
					</div>\
					</div>';
		$('#multi').append($node);
		produto++;
	});
	
	$('[name="esconder"]').on('click', function(){
 
		 $('#Produto').hide();
	});
	
	$.ajaxSetup({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
	});
	
	$('[name="form2"]').on('click', function(){
		var verifica=1;
		var contagem;
		$("#produto").ajaxSubmit({url:'<?php echo url('prestacao/public/CadProduto/create'); ?>',type:'post',error: function(data) { alert("verifique os dados digitados");verifica=0; },success: function (data){ alert("Produto(s) cadastrados com sucesso");verifica=1;if (verifica ==1){for(contagem=produto;contagem>=0;contagem--){deletaProd(contagem);}loadProduto();}}});
	});
	
	/*$('[name="form"]').on('click', function(){
		$('#nota').validate();
		$("#nota").ajaxSubmit({
			url:'<?php echo url('prestacao/public/CadNota/create');?>',type:'post',error: 
				function(data) 
				{
						alert("verifique os dados digitados");
						verifica=0;
				}
				,success: function (data)
				{
					alert("Produto(s) cadastrados com sucesso");
					verifica=1;
					if (verifica ==1)
					{
						for(contagem=produto;contagem>=0;contagem--)
						{
							deletaProd(contagem);
						}
					loadProduto();
					}
				}
		});
	});*/
	function loadProduto(varCount)
	{
		$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConProduto/combo');  ?>',
			success: function (response) 	
			{
				$( '#produto'+varCount+'').html(response);
			}
		});
	}
	
	function loadMedida(varCount)
	{
		$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConMedida/combo');  ?>',
			success: function (response) 
			{
				$('#codMedida'+varCount+'').html(response);
			}
		});
	}
		
	
	$(document).ready(function()
	{
		loadProduto(varCount);
		loadMedida(varCount);
		$('#fornecedor').select2();
		$('.produto').select2();
		$('.selectMed').select2();
		loadProduto(varCount);
		loadMedida(varCount);
		$('#inputtotal').mask('R$ 000.000.000.000.000,00', {reverse: true});

	});
	</script>