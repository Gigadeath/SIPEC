    <?php 
	use App\Http\Controllers\MantenedorController;
	use App\Http\Controllers\FuncionarioController;
	use App\Http\Controllers\DreController;
	?>
	
	<div class="medium-12 large-10 columns" id="main">        

        <!-- header -->
        
        <div id="header" class="expanded row bg-grey">

            <div class="medium-6 columns hide-for-large text-left" style="border-right:02px dotted #fff;">
                <div class="blue text-left" style="font-size:1rem;line-height:2.8rem;" data-responsive-toggle="sidebar" data-hide-for="large"><i class="fi-list"></i> <a href="#" data-toggle>Menu</a></div>
            </div>

            

        </div> 

        <!-- Breadcrumb -->

          
		 <?php
			if(Session::has('success'))
			{
				echo "<div class='callout success' data-closable style='width:100%'><h5>Unidade Cadastrada</h5>".Session::get('success')."<button class='close-button' aria-label='Dismiss alert' type='button' data-close>    <span aria-hidden='true'>&times;</span></button><br>";
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
            <h2>Unidades</h2>
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
			<div class="expanded row margin-top-20" id="consulta">
		<div class="columns large-12"> 
			
				<label align="center"><input type="search" id="search" onchange="loadUnidades(1)" name="search" > </label><br>
			
		</div>
		
		<div class="columns large-12">
			<table style="width:100%">
				<thead>
					<th>#</th>
					<th>Nome</th>
					<th>EOL</th>
					<th>INEP</th>
					<th>CNPJ</th>
				</thead>
				<tbody id="unidades">
				
				</tbody>
			</table>
		<div class="row" id="row">
		
		</div>
		</div>	
		</div> 

		  <form  method="POST" id="cadastro">
		    <?php echo csrf_field()."<br>";?>
			
            <div class="columns large-12">        
            <h3>Cadastro de Unidades</h3>
            </div> 
			<div class="expanded row margin-top-20">
			<div class="columns large-4">
				<label>
					EOL:	
					<input type="number" name="eol"  placeholder="Insira o código EOL" min="1" max="99999999" maxlength="8" <?php if(isset($dados)){echo "value='".$dados['eol']."'";} ?> >
				</label><br>
				<label>
					Nome:	
					<input type="text" name="nome"  placeholder="Insira o nome" <?php if(isset($dados)){echo "value='".$dados['nome']."'";} if(isset($erro)==true && $erro=='4'){echo "style='border:1px solid red'";}?>>
				</label><br>
				<label>
				Email:
					<input type="email" name="email" placeholder="Insira um Email" <?php if(isset($dados)){echo "value='".$dados['email']."'";} if(isset($erro)==true && $erro=='2'){echo "style='border:1px solid red'";}?>>
				</label><br>
				<label>
					FAX:
						<input type="text" name="fax" class="Telefone" placeholder="55 (00) 0000-0000" <?php if(isset($dados)){echo "value='".$dados['fax']."'";}?>><br>
				</label>
				
			</div>
			
			<div class="columns large-4">        
				<label>
					INEP:
					<input type="number" name="inep" class="INEP" placeholder="00000000" min="1" min="99999999" <?php if(isset($dados)){echo "value='".$dados['inep']."'";}?>>
				</label><br>
				 
				 <label>
					Telefone:
						<input type="text" name="telefone" class="Telefone" placeholder="55 (00) 0000-0000" <?php if(isset($dados)){echo "value='".$dados['telefone']."'";} if(isset($erro)==true && $erro=='5'){echo "style='border:1px solid red'";}?>><br>
				</label>
						<label>Mantenedor
						<select id="mantenedora" name="mantenedor" <?php if(isset($dados)){echo "value='".$dados['mantenedor']."'";} ?> >
							<?php
							$valorMan= isset($dados['mantenedor']) ? $dados['mantenedor'] : null;
								//echo MantenedorController::show(null,'combo',null);
							?>
						</select></label><br>	
		
						<br><label>Coordenador:
						<select id ="coordenador" onchange="verifica();" name="coordenador" <?php if(isset($dados)){echo "value='".$dados['coordenador']."'";}?>>
							<?php
								$valorC= isset($dados['coordenador']) ? $dados['coordenador'] : null;
								//echo FuncionarioController::show(null,'combo',$valor);
							?>
						</select></label>
			</div>
			<div class="columns large-4"> 
				<label>
					CNPJ:
					<input type="text" name="CNPJ" class="CNPJ" placeholder="00.000.000/0000-00" <?php if(isset($dados)){echo "value='".$dados['CNPJ']."'";} if(isset($erro)==true && $erro=='1'){echo "style='border:1px solid red'";}?>>
				</label><br><br>
				
				<label>
					Telefone 2:
						<input type="text" name="telefone2" class="Telefone" placeholder="55 (00) 0000-0000" <?php if(isset($dados)){echo "value='".$dados['telefone2']."'";} ?>><br>
				</label>
				
				<label>DRE:
						<select id="dre" name="dre" <?php if(isset($dados['dre'])){echo "value='".$dados['dre']."'";}?>>
							<?php
							$valorDRE= isset($dados['dre']) ? $dados['dre'] : null;
								//echo DreController::show(null,'combo',$valor);	
							?>
						</select></label><br><br>
						
				<label>Diretor:
					<select id="diretor" onchange="verifica();" name="diretor" <?php if(isset($erro)==true && $erro=='1'){echo "style='border:1px solid red'";}?>>
								<?php
								$valorD= isset($dados['diretor']) ? $dados['diretor'] : null;
									//echo FuncionarioController::show(null,'combo',$valor);
								?>
					</select></label>
						
				
				 
				 
			</div>
				
				
			
			</div>
			<div class="columns large-12">        
				<h5>Endereço</h5>
            </div>
			<div class="columns large-12">
				<div class="columns large-4">
					<label>
						CEP:
						<input type="text" name="cep" id="cep" class="CEP" placeholder="00000-000" onblur="pesquisacep(this.value);" <?php if(isset($dados)){echo "value='".$dados['cep']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br>
					
					<label>
						Cidade:
						<input type="text" name="cidade"  id="cidade" readonly <?php if(isset($dados)){echo "value='".$dados['cidade']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br>
				</div>
				<div class="columns large-4">
					<label>
						Rua:
						<input type="text" name="rua" id="rua"  readonly <?php if(isset($dados)){echo "value='".$dados['rua']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br><label>
						Estado:
						<input type="text" name="uf" id="uf"  readonly <?php if(isset($dados)){echo "value='".$dados['uf']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br>
				</div>
				<div class="columns large-4">
					<label>
						Bairro:
						<input type="text" name="bairro" id="bairro"  readonly <?php if(isset($dados)){echo "value='".$dados['bairro']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br><label>
						IBGE:
						<input type="text" name="ibge" id="ibge"  readonly <?php if(isset($dados)){echo "value='".$dados['ibge']."'";} if(isset($erro)==true && $erro=='3'){echo "style='border:1px solid red'";}?>>
					</label><br>
				</div>
				
				</div>
				<div class="columns large-4">
				</div>
					<div class="columns large-4">
						<button type="button"  id="btnCadastra" class="success button">Cadastrar</button>
						<button type="button" class="alert button">Cancelar</button> 
					</div>
						<div class="columns large-4"></div>
		 </form>
		 
		 <form method ="POST" id="altera" >
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
          <!-- End content area -->
    </div>
	<script> 
	var aux=0;
	$(document).ready(function() {
                $("#rdbConsulta").click(Dados);
                $("#rdbCadastro").click(Cadastro);
				$("#cancelaAlt").click(cancelaAltera);
                });
				
	$('#btnAltera').on('click', function(){
		var verifica=1;
		var contagem;
		$("#altera").ajaxSubmit({url:'<?php echo url('prestacao/public/CadUnidade/update'); ?>',type:'post',error: function(xhr,textStatus,data) { alert("verifique os dados digitados: " +xhr.status); },success: function (data){alert("sucesso"); }});
		location.reload();
	});
	
	$('#btnCadastra').on('click', function(){
		var verifica=1;
		var contagem;
		$("#cadastro").ajaxSubmit({url:'<?php echo url('prestacao/public/CadUnidade/create'); ?>',type:'post',error: function(xhr,textStatus,data) { alert("verifique os dados digitados: " +xhr.status); },success: function (data){alert("sucesso"); }});
		location.reload();
	});
	
	
				
	function edit(id){
        $.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConUnidade/update');  ?>',
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
	function Dados(){
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
	
	loadUnidades(1);
	Dados(); 
	function isUndefined(x) {
		return typeof x == "undefined";
	}

	function loadUnidades(page)
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
		$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConUnidade/table');  ?>',
			data: { pagination: page,search: busca},
			success: function (response) 	
			{
				$('#unidades').html(response);
			}
		});
		
		$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConUnidade/page');  ?>',
			data: {pagination: page,search: busca},
			success: function (response) 	
			{
				$('#row').html(response);
			}
		});
	}
	</script>
	
	<script>
		
		$(document).ready(function() {
			$('#mantenedora').select2();
			$('#coordenador').select2();
			$('#diretor').select2();
			$('#dre').select2();
			loadFuncionario();
			loadDRE();
			loadMantenedor();
			
		});
		function verifica() {
		var combo1= document.getElementById("coordenador");
		var combo2=document.getElementById("diretor");
		if(combo1.value == combo2.value)
		{

			alert("Um diretor não pode ser um coordenador ao mesmo tempo..." +combo1.selectedIndex);
			$("#coordenador").val(0).trigger('change');
			
		}
			
		}
		
		function loadFuncionario()
		{
			
			$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConFuncionario/combo');  ?>',
			data: {search: "", pagination:<?php echo "'".$valorC."'"; ?>  },
			success: function (response)
			{
				$('#coordenador').html(response);
			}
		});
		
		$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConFuncionario/combo');  ?>',
			data: {search: "", pagination:<?php echo "'".$valorD."'"; ?>  },
			success: function (response)
			{
				$('#diretor').html(response);
			}
		});
		}
			
		
		function loadDRE()
		{
			
			$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConDre/combo');  ?>',
			data: {search: "", pagination:<?php echo "'".$valorDRE."'"; ?>  },
			success: function (response)
			{
				$('#dre').html(response);
			}
			});
		}
		
		function loadMantenedor()
		{
			
			$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConMantenedora/combo');  ?>',
			data: {search: "", pagination:<?php echo "'".$valorMan."'"; ?>  },
			success: function (response)
			{
				$('#mantenedora').html(response);
			}
			});
		}
		
	</script>