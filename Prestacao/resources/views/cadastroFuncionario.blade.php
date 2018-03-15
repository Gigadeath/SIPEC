<!doctype html>

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
		   <?php
			if(Session::has('success'))
			{
				echo "<div class='callout success' data-closable style='width:100%'><h5>Funcionario Cadastrado</h5>".Session::get('success')."<button class='close-button' aria-label='Dismiss alert' type='button' data-close>    <span aria-hidden='true'>&times;</span></button><br>";
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
            <h1>Funcionario</h1>
            </div> 
			
		<div class="expanded row margin-top-20">
				<div class="columns large-4">  
					<h4>Consulta</h4><br>
				</div>
			
				<div class="columns large-4">  
				
				</div>
			
				<div class="columns large-4">  
				</div>
			
		</div>
		<div class="columns large-12"> 
			<label align="center">
				<input type="search" name="search" placeholder="Search.."/>
			</label>
		</div>
		
		<div class="columns large-12">
			<table style="width:100%">
				<thead>
					<th>#</th>
					<th>Nome</th>
					<th>CPF</th>
					<th>Ações</th>
				</thead>
				<tbody id="funcionarios">
				
				</tbody>
			</table>
		<div class="row" id="row">
		
		</div>
		</div>
          </div> 
		<form action="<?php echo url('prestacao/public/CadFuncionario/create'); ?>" method ="POST">
		   <?php echo csrf_field()."<br>";?>
		   <div class="expanded row margin-top-20">
				<div class="columns large-4">  
					<h4>Dados</h4><br>
				</div>
			
				<div class="columns large-4">  
				</div>
			
				<div class="columns large-4">  
				</div>
			
			</div>
			<div class="expanded row margin-top-20">
			
			<div class="columns large-4">        
				
				<label>
					Nome:
					<input type="text" name="nome" placeholder="Insira o Cpf " <?php if(isset($dados)){echo "value='".$dados['nome']."'";} if(isset($erro)==true && $erro=='1'){echo "style='border:1px solid red'";}?>>
				</label><br>
				
				
				
			</div>
	
			<div class="columns large-4">
				<label>
					CPF:
					<input type="text" name="cpf" class="CPF" placeholder="000.000.000-00" <?php if(isset($dados)){echo "value='".$dados['cpf']."'";} if(isset($erro)==true && $erro=='2'){echo "style='border:1px solid red'";}?>>
				</label><br>
				<p class="help-text" id="passwordHelpText">use somente numeros neste campo.</p>
			
			</div>
	
				<div class="columns large-4">        
					<!--<h4>Login</h4>
					<label>
					Senha:
						<input type="password" name="Senha" placeholder="Insira uma senha">
					</label><br>
					<label>
					Confirmar a senha:
						<input type="password" name="CSenha" placeholder="Insira uma senha">
					</label><br>
					
					-->
					
				</div>  
				
				
			
			</div>
			<div class="expanded row margin-top-20">
				<div class="columns large-4">  
					<button type="submit" class="success button">Cadastrar</button>
					<button type="button" class="alert button">Cancelar</button>
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
	loadFuncionarios(0)
	function loadFuncionarios(page)
	{
		$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConFuncionario/table');  ?>',
			data: { pagination: page},
			success: function (response) 	
			{
				$('#funcionarios').html(response);
			}
		});
		
		$.ajax({
			type: 'get',	
			url: '<?php echo url('prestacao/public/ConFuncionario/page');  ?>',
			data: { pagination: page},
			success: function (response) 	
			{
				$('#row').html(response);
			}
		});
	}
	</script>