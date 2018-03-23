 <?php 
	use App\Http\Controllers\TipoProdutoController;
	use App\Http\Controllers\ProdutoController;
	use App\Http\Controllers\MedidaController;
	
	?>
	
	<div class="medium-12 large-10 columns" id="main">        
        <div id="header" class="expanded row bg-grey">
            <div class="medium-6 columns hide-for-large text-left" style="border-right:02px dotted #fff;">
                <div class="blue text-left" style="font-size:1rem;line-height:2.8rem;" data-responsive-toggle="sidebar" data-hide-for="large"><i class="fi-list"></i> <a href="#" data-toggle>Menu</a></div>
            </div>
        </div> 
		<?php 
		if(Session::has('success'))
		{
			echo "<div class='callout success' data-closable style='width:100%'><h5> Produto Cadastrado</h5>".Session::get('success')."<button class='close-button' aria-label='Dismiss alert' type='button' data-close>    <span aria-hidden='true'>&times;</span></button><br>";
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
		<div class="columns large-12">        
				<h3>Produto</h3>
		</div> 
		<div class="columns large-12">    
			<div class="grid-x grid-padding-x">	
				<fieldset class="fieldset">
					<legend>Selecione uma Funcionalidade</legend>
					<input type="radio" id="rdbConsulta" name="form" value="Consulta" checked><label for="rdbConsulta" >Consulta/Alteracao</label>
					<input type="radio" id="rdbCadastro" name="form" value="Cadastra"><label for="rdbCadastro">Cadastro</label>
				</fieldset>
			</div>
		</div>
		<div id="consulta">
			<div class="expanded row margin-top-20">
				<div class="expanded row margin-top-20">
					<div class="columns large-4">  
					</div>
					<div class="columns large-4">  
					</div>
				</div>
			</div> 
			<div class="columns large-12"> 
				<label align="center"><input type="search" id="search" onchange="loadProdutos(1)" name="search" placeholder="Insira o nome do produto"> </label><br>
			</div>
			<div class="columns large-12">
				<table style="width:100%">
					<thead>
						<th>#</th>
						<th>Nome</th>
						<th>Tipo</th>
						<th>Ações</th>
					</thead>
					<tbody id="produtos">
					</tbody>
				</table>
				<div class="row" id="row">
				</div>
			</div>	
		</div>	
        <form  method ="POST" id="cadastro" action="<?php echo url('prestacao/public/CadProduto/create'); ?>">
			<?php echo csrf_field()."<br>";?>
			<div class="expanded row margin-top-20">
				<div class="columns large-4">  
					<h4>Cadastro de Dados</h4><br>
				</div>
				<div class="columns large-4"></div>
				<div class="columns large-4"></div>
			</div>
			<div class="expanded row margin-top-20">
				<div class="columns large-4">        
					<label>Nome:</label>
					<input type="text" name="nome[]" placeholder="Insira o nome  " <?php if(isset($dados)){echo "value='".$dados['nome'][0]."'";} if(isset($erro)==true && $erro=='1'){echo "style='border:1px solid red'";}?>>
					<br/>
				</div>
				<div class="columns large-4">
					<label>Tipo Produto</label>
					<select  id="selectProd" class="produto" name="codTipoProduto[]" <?php if(isset($dados)){echo "value='".$dados['codTipoProduto'][0]."'";}if(isset($erro)==true && $erro=='1'){echo "style='border:1px solid red'";}?> required><?php echo TipoProdutoController::show(null,'combo'); ?>	
					</select>
					<br/>
				</div>
				<div class="columns large-4"></div>  
			</div>
			<div class="expanded row margin-top-20">
				<div class="columns large-4">  
					<button type="submit" id="btnCadastr" class="success button">Cadastrar</button>
					<button type="button" class="alert button">Cancelar</button>
				</div>
				<div class="columns large-4">  
				</div>
				<div class="columns large-4"> 
				</div>
			</div>
		</form>
		<form method ="POST" id="altera">
			<?php echo csrf_field()."<br>";?>
			<div class="expanded row margin-top-20">
				<div class="columns large-4">  
					<h4>Alteracao de Dados</h4><br>
				</div>
				<div class="columns large-4"></div>
				<div class="columns large-4"></div>
			</div>
			<div class="expanded row margin-top-20" id="dadosAlterar">
			</div>
			<div class="expanded row margin-top-20">
				<div class="columns large-4">  
					<button type="button" id="btnAltera" class="success button">Altera</button>
					<button type="button" id="cancelaAlt" class="alert button">Cancelar</button>
				</div>
				<div class="columns large-4"></div>
				<div class="columns large-4"></div>
			</div>
		</form>
		<div class="expanded row margin-top-20" id="dadosAlterar">
		</div>
          <!-- End content area -->
    </div>
	<script>
		$(document).ready(function() 
		{
			$(document).foundation();
			$('#selectTipo').select2();
			$(document).foundation();
		});

	var aux=0;
	$(document).ready(function()
	{
        $("#rdbConsulta").click(Dados);
        $("#rdbCadastro").click(Cadastro);
		$("#cancelaAlt").click(cancelaAltera);
    });
				
	$('#btnAltera').on('click', function()
	{
		var verifica=1;
		var contagem;
		$("#altera").ajaxSubmit({url:'<?php echo url('prestacao/public/CadProduto/update'); ?>',type:'post',error: function(xhr,textStatus,data) { alert("verifique os dados digitados: " +xhr.status); },success: function (data){alert("sucesso"); }});
		location.reload();
	});
	
	
				
	function edit(id)
	{
        $.ajax(
		{
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConProduto/update');  ?>',
			data: { id: id},
			success: function (response) 	
			{
				$("#consulta").hide();
				$("#altera").show();
				$('#dadosAlterar').html(response);
				$('#dadosAlterar').show();
			}
		});
    }
	
	function cancelaAltera()
	{
		$('#dadosAlterar').hide();
		$('#consulta').show();
		
	}
	function Dados()
	{
        $("#consulta").show();
		$("#cadastro").hide();
		$("#altera").hide();
    }
    function Cadastro()
	{
        $("#consulta").hide();
		$("#cadastro").show();
		$("#altera").hide();
    }
	
	loadProdutos(1);
	Dados(); 
	function isUndefined(x) 
	{
		return typeof x == "undefined";
	}

	function loadProdutos(page)
	{
		var busca=$('#search').val();
		if(  busca == '')
		{
			busca ='';
		}
		else
		{
			busca=$('#search').val();
		
		}
		$.ajax(
		{
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConProduto/table');  ?>',
			data: { pagination: page,search: busca},
			success: function (response) 	
			{
				$('#produtos').html(response);
			}
		});
		
		$.ajax(
		{
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConProduto/page');  ?>',
			data: {pagination: page,search: busca},
			success: function (response) 	
			{
				$('#row').html(response);
			}
		});
	}
	</script>