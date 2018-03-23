<?php 
	use App\Http\Controllers\FornecedorController;
	use App\Http\Controllers\TipoProdutoController;
	use App\Http\Controllers\MedidaController;
	use App\Http\Controllers\ProdutoController;
	
	
	?>
	<div class="medium-12 large-10 columns" id="main">        
        <div id="header" class="expanded row bg-grey">
            <div class="medium-6 columns hide-for-large text-left" style="border-right:02px dotted #fff;">
                <div class="blue text-left" style="font-size:1rem;line-height:2.8rem;" data-responsive-toggle="sidebar" data-hide-for="large"><i class="fi-list"></i> <a href="#" data-toggle>Menu</a></div>
            </div>
		</div> 

        <!-- Breadcrumb -->

          
		  
	<?php	  
	if(Session::has('success'))
	{
		echo "<div class='callout success' data-closable style='width:100%'><h5> Cotação Cadastrada</h5>".Session::get('success')."<button class='close-button' aria-label='Dismiss alert' type='button' data-close>    <span aria-hidden='true'>&times;</span></button><br>";
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

          <!-- Begin content area --> 

        <div class="expanded row margin-top-20">
            <div class="columns large-12">        
				<h2>Cadastro de Cotação</h2>
            </div> 
        </div> 
		<form action="<?php echo url('prestacao/public/CadCotacao/create'); ?>" method ="POST">
			<?php echo csrf_field()."<br>";?>
			<div class="expanded row margin-top-20">
				<div class="columns large-4"> 
					<label>Data Cotação:</label>
					<input type="date"  name="data" id="data"  <?php if(isset($dados)){echo "value='".$dados['data']."'";}if(isset($erro)==true && $erro==''){echo "style='border:1px solid red'";}?> required>
					<br/>
				</div>
				<div class="columns large-4"> 
					<label>Fornecedor</label>
					<select  id="selectForn" class="produto " name="codFornecedor" <?php if(isset($dados)){echo "value='".$dados['codFornecedor']."'";}if(isset($erro)==true && $erro=='1'){echo "style='border:1px solid red'";}?> required>
					</select>
				</div>
			</div>
			<div class="columns large-4"> 
			
			</div>
			
			<div class="columns large-12" style="margin-bottom:1%">	
				<p>
					<a data-open="exampleModal2" class="secondary button">Inserir Produto</a>
				</p>
			</div>
			
			<table id="ProdutosNota"style="width:100%">
				<thead>
					<tr>
						<th>Produto</th>
						<th>Un.Medida</th>
						<th>Data limite</th>
						<th>Qtde</th>
						<th>Valor Unitário</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody id="Produtos">
				
				</tbody>
			</table>
			<div class="expanded row margin-top-20">
				<div class="columns large-4">
					<p>
						<a href="#" class="secondary button" name="addVar">+</a>
					</p>
					<br/>
				</div>
				<div class="columns large-4"> 
					<label>Desconto:</label>
					<input type="number" onchange="SomaTotal()"id="inputdesconto" value="0" name="desconto" min="0" placeholder="desconto em %"<?php if(isset($dados)){echo "value='".$dados['desconto']."'";}if(isset($erro)==true && $erro==''){echo "style='border:1px solid red'";}?>>
					<br/>
				</div>
				<div class="columns large-4">
					<label>Total:</label>
					<input type="text" id="inputtotal"    name="total"  readonly <?php if(isset($dados)){echo "value='".$dados['total']."'";}if(isset($erro)==true && $erro==''){echo "style='border:1px solid red'";}?> >
				</div>
			</div>
			<button type="submit" name="form" class="success button">Cadastrar</button>
			<button type="button" class="alert button">Cancelar</button>
		</form>
		<div class="reveal" id="exampleModal2" data-reveal data-options="multipleOpened:false;">
			<div class="expanded row margin-top-20">
			 
				<div class="columns large-10">        
					<h1 name="Produto">Cadastro de Produto<h1>
				</div> 
				<form action="<?php echo url('prestacao/public/CadProduto/create'); ?>" method ="POST" id="produto">
					<?php echo csrf_field()."<br>";?>
					<div id="multi">
					</div>
					<p>
						<a href="#" class="secondary button" name="addProd">+</a>
					</p>
					<div class="columns large-12"> 
						<button type="submit" name="form2" class="success button">Cadastrar Produto</button>
						<button type="button"  class="alert button" name="esconder" href="#nota">Esconder</button>
					</div>
				</form>
			</div>
			<button class="close-button" data-close aria-label="Close reveal" type="button">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
        <button class="close-button" data-close aria-label="Close reveal" type="button">
		<span aria-hidden="true">&times;</span>
		</button>
    </div>
	<script>
	$(document).ready(function() {
			$('#fornecedor').select2();
			$('.produto').select2();
			$('.selectMed').select2();
			loadProduto(0);
			loadFornecedor();
		});
	
	$( "#data" ).change(function() 
	{
		dataCalc();	
	});	
			
	function dataCalc()
	{
		var data=new Date($('#data').val()),days = 15;
		if(!isNaN(data.getTime()))
		{
			data.setDate(data.getDate() + days);
		}
		else
		{
            alert("Invalid Date");  
        }
		$('#ProdutosNota > #Produtos  > .linha').each(function()
		{
			$(this).find('.datalimite').val(data.toInputFormat()); 
		});
	}	
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
							if($(this).find('.datalimite').val()<=0)
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
			}
		});
		return valida;
	}
	function  SomaTotal()
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
		numero[0] =  numero[0].split(/(?=(?:...)*$)/).join('.');
		return numero.join(',');
	}
	
	$('.qtde').change(function() 
	{
		SomaTotal();
	});
	
	$('.valor').change(function() 
	{
		SomaTotal();
	});
	
	$('#Produto').hide();
	//initialize with 3
	var produto=0;
	var startingNo = 0;
	var $node = "";
	for(varCount=0;varCount<=startingNo;varCount++)
	{
		var displayCount = varCount+1;
		$node = '<tr class="linha" id="linha'+varCount+'">\
				<td><select name="codProduto[]" class="produto" id="produto'+varCount+'" class="produto " style="width:100%" required ><?php //echo ProdutoController::show(null,'combo',null); ?></select></td> \
					<td><select id="selectMed"  name="codMedida[]" required><?php echo MedidaController::show(null,'combo'); ?></select></td>\
					<td> <input type="date" class="datalimite" name="Data_Limite[]"<?php if(isset($dados)){echo "value='".$dados['Data_Limite[]']."'";}if(isset($erro)==true && $erro==''){echo "style='border:1px solid red'";}?> readonly required></td>\
					<td><input type="text" min="1" onchange="SomaTotal()"  name="qtde" class="qtde" id="qtde" required></td>\
					<td><input type="text"  onchange="SomaTotal()" name="valorunit[]" class="valor" id="valorunit" required></td>\
				</tr>';
	}
	$('#Produtos').prepend($node);

	function deleta(varCount)
	{
		$('#linha'+varCount).remove();
		SomaTotal();
		//varCount--;
	}
	
	function deletaProd(produto)
	{
		$('#prod'+produto).remove();
		//varCount--;
	}
	
	$('[name="addVar"]').on('click', function()
	{
		//new node
		if (verificaCampos()==true)
		{
		
			$node = '<tr class="linha" id="linha'+varCount+'">\
					<td><select name="codProduto[]" id="produto'+varCount+'" class="produto" style="width:100%" required  ><?php // echo ProdutoController::show(null,'combo',null); ?></select></td> \
					<td><select id="selectMed" name="codMedida[]" required><?php echo MedidaController::show(null,'combo'); ?></select></td>\
					<td> <input type="date" class="datalimite" name="Data_Limite[]"<?php if(isset($dados)){echo "value='".$dados['Data_Limite[]']."'";}if(isset($erro)==true && $erro==''){echo "style='border:1px solid red'";}?> readonly required></td>\
					<td><input type="text"  onchange="SomaTotal()" min="1" class="qtde" name="qtde" id="qtde" required></td>\
					<td><input type="text" onchange="SomaTotal()" class="valor" name="valorunit" id="valorunit" required></td>\
					<td><a href="#" name="delete" class="alert button" id="'+varCount+'" onclick="deleta('+varCount+')">X</a></td>\
				</tr>';
			$('#Produtos').append($node);
			loadProduto(varCount);
			$('.produto').select2();
			$('.selectMed').select2();
			varCount++;
			dataCalc();
		}
		else
		{
			alert("insira um produto corretamente");
		}
	
	});
	
	
	$('[name="addProd"]').on('click', function()
	{
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
	
	$('[name="esconder"]').on('click', function()
	{
		 $('#Produto').hide();
	});
	
	Date.prototype.toInputFormat = function() 
	{
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
    };
		
	
		
	function loadFornecedor()
	{	
		$.ajax(
		{
				
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConFornecedor/combo');  ?>',
			data: {search: "", pagination:"" },
			success: function (response)
			{
				$('#selectForn').html(response);
			}
		});
	}
	
	function loadProduto(varCount)
	{	
		$.ajax(
		{
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConProduto/combo');  ?>',
			data: {search: "", pagination: "" },
			success: function (response)
			{
				$('#produto'+varCount+'').html(response);
			}
		});
	}
	</script>