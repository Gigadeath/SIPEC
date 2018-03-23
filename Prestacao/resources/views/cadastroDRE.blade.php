    <div class="medium-12 large-10 columns" id="main">        
        <div id="header" class="expanded row bg-grey">
            <div class="medium-6 columns hide-for-large text-left" style="border-right:02px dotted #fff;">
                <div class="blue text-left" style="font-size:1rem;line-height:2.8rem;" data-responsive-toggle="sidebar" data-hide-for="large"><i class="fi-list"></i> <a href="#" data-toggle>Menu</a></div>
            </div>
        </div> 

        
          <!-- Begin content area --> 
	<?php
	if(Session::has('success'))
	{
		echo "<div class='callout success' data-closable style='width:100%'><h5>DRE Cadastrada</h5>".Session::get('success')."<button class='close-button' aria-label='Dismiss alert' type='button' data-close>    <span aria-hidden='true'>&times;</span></button><br>";
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
        <div class="expanded row margin-top-20">
			<div class="columns large-12">    
			<div class="grid-x grid-padding-x">	
				<fieldset class="fieldset">
					<legend>Selecione uma Funcionalidade</legend>
						<input type="radio" id="rdbConsulta" name="form" value="Consulta" checked><label for="rdbConsulta" >Consulta/Alteracao</label></input>
						<input type="radio" id="rdbCadastro" name="form" value="Cadastra"><label for="rdbCadastro">Cadastro</label></input>
				</fieldset>
			</div>
		</div>
            <div class="columns large-12">        
				<h1>DRE</h1>
            </div> 
         </div> 
		<div class="expanded row margin-top-20" id="consulta">
			<div class="columns large-4">  
				<h4>Consulta</h4><br>
			</div>
			<div class="columns large-4"></div>
			<div class="columns large-4"></div>
			<div class="columns large-12"> 
				<label align="center"><input type="search" id="search" onchange="loadDre(1)" name="search" placeholder="Insira o nome do produto" > </label><br>
			</div>
			<div class="columns large-12">
				<table style="width:100%">
					<thead>
						<th>#</th>
						<th>Nome</th>
						<th>Telefone</th>
						<th>Email</th>
						<th>Endereço</th>
					</thead>
					<tbody id="dres">
				
					</tbody>
				</table>
				<div class="row" id="row">
				</div>
			</div>
		</div>
		<form  method ="POST" id="cadastro">
			<div class="expanded row margin-top-20">
				<div class="columns large-12">        
					<h1>Cadastro de DRE</h1>
				</div> 
			<?php echo csrf_field()."<br>";?>	
				<div class="expanded row margin-top-20">

					<div class="columns large-4">        
						<label>Nome:</label>
						<input type="text" name="nome"  placeholder="insira o nome da DRE" <?php if(isset($dados)){echo "value='".$dados['nome']."'";} if(isset($erro)==true && $erro=='1'){echo "style='border:1px solid red'";}?>/>
						<br/>
					</div>
					<div class="columns large-4">
						<label>Telefone:</label>
						<input type="text" name="telefone" class="Telefone" placeholder="(00) 0000-0000" <?php if(isset($dados)){echo "value='".$dados['telefone']."'";} if(isset($erro)==true && $erro=='4'){echo "style='border:1px solid red'";}?>/>
						<br/>
						<p class="help-text" id="passwordHelpText">Ex: 55 119xxxx-xxxx</p>
					</div>
					<div class="columns large-4">        
					<label>Email:</label>
						<input type="email" name="email" placeholder="Insira o Email" <?php if(isset($dados)){echo "value='".$dados['email']."'";} if(isset($erro)==true && $erro=='2'){echo "style='border:1px solid red'";}?>/>
					<br/>	
					</div>  
				</div>
				<div class="columns large-12">        
					<h5>Endereço</h5>
				</div>
				<div class="columns large-12">
					<div class="columns large-4">
						<label>CEP:</label>
						<input type="text" name="cep" id="cep" class="CEP" placeholder="00000-000" onblur="pesquisacep(this.value);" <?php if(isset($dados['cep'])){echo "value='".$dados['cep']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>/>
						<br/>
						<label>Cidade:</label>
						<input type="text" name="cidade" id="cidade" readonly <?php if(isset($dados['cidade'])){echo "value='".$dados['cidade']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>/>
						<br/>
					</div>
					<div class="columns large-4">
						<label>Rua:</label>
						<input type="text" name="rua" id="rua"  readonly <?php if(isset($dados['rua'])){echo "value='".$dados['rua']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>/>
						<br/>
						<label>Estado:</label>
						<input type="text" name="uf" id="uf"  readonly <?php if(isset($dados['uf'])){echo "value='".$dados['uf']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>/>
						<br/>
					</div>
					<div class="columns large-4">
						<label>Bairro:</label>
						<input type="text" name="bairro" id="bairro"  readonly <?php if(isset($dados['bairro'])){echo "value='".$dados['bairro']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
						<br/>
						<label>IBGE:</label>
						<input type="text" name="ibge" id="ibge"  readonly <?php if(isset($dados['ibge'])){echo "value='".$dados['ibge']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
						<br/>
					</div>
				</div>
				<div class="columns large-4">
				</div>
				<div class="columns large-4">
					<button type="button" id="btnCadastra" class="success button">Cadastrar</button>
					<button type="button" class="alert button">Cancelar</button> 
				</div>
				<div class="columns large-4"></div>
			</div> 		
		</form> 
		<form method ="POST" id="altera">
			<?php echo csrf_field()."<br>";?>
			<div class="expanded row margin-top-20">
				<div class="columns large-4">  
					<h4>Alteracao de Dados</h4><br>
				</div>
				<div class="columns large-4">  
				</div>
				<div class="columns large-4">  
				</div>
			</div>
			<div class="expanded row margin-top-20" id="dadosAlterar">
			</div>
			
			<div class="expanded row margin-top-20">
				<div class="columns large-4">  
					<button type="button" id="btnAltera" class="success button">Altera</button>
					<button type="button" id="cancelaAlt" class="alert button">Cancelar</button>
				</div>
				<div class="columns large-4">  
				</div>
				<div class="columns large-4"> 
				</div>
			</div>
		</form>
		
	</div>
	<script> 
    loadDre(1);
	Dados(); 
	$('#btnAltera').on('click', function()
	{
		var verifica=1;
		var contagem;
		$("#altera").ajaxSubmit({url:'<?php echo url('prestacao/public/CadDre/update'); ?>',type:'post',error: function(xhr,textStatus,data) { alert("verifique os dados digitados: " +xhr.status); },success: function (data){alert("sucesso"); }});
		location.reload();
	});
	
	
	$('#btnCadastra').on('click', function()
	{
		var verifica=1;
		var contagem;
		$("#cadastro").ajaxSubmit({url:'<?php echo url('prestacao/public/CadDre/create'); ?>',type:'post',error: function(data) {  },success: function (data){ }});
		location.reload();
	});
	
	$.ajaxSetup({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
	});
	
	$(document).ready(function() 
	{
        $("#rdbConsulta").click(Dados);
        $("#rdbCadastro").click(Cadastro);
		$("#cancelaAlt").click(cancelaAltera);
    });
	
	function edit(id)
	{
        $.ajax(
		{
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConDre/update');  ?>',
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

	function loadDre(page)
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
			url: '<?php echo url('prestacao/public/ConDre/table');  ?>',
			data: { pagination: page,search: busca},
			success: function (response) 	
			{
				$('#dres').html(response);
			}
		});
		
		$.ajax(
		{
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConDre/page');  ?>',
			data: {pagination: page,search: busca},
			success: function (response) 	
			{
				$('#row').html(response);
			}
		});
	}
	</script>
   