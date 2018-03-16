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

          <div class="expanded row" id="breadcrumb">
            <div class="columns large-12 gray">Home <i class="fa fa-angle-right"></i> Page</div>
          </div>
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
			<div class="large-6 columns">
				<label>Choose Your Favorite</label>
				<input type="radio" name="opcao" value="Cadastro" id="pokemonRed"><label for="pokemonRed">Red</label>
				<input type="radio" name="opcao" value="Consulta" id="pokemonBlue"><label for="pokemonBlue">Blue</label>
			</div>
            <div class="columns large-12">        
            <h3>Cadastro de Unidades</h3>
            </div> 
          </div> 
		  <form action="<?php echo url('prestacao/public/CadUnidade/create'); ?>" method="POST">
		    <?php echo csrf_field()."<br>";?>
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
							$valor= isset($dados['mantenedor']) ? $dados['mantenedor'] : null;
								echo MantenedorController::show(null,'combo',null);
							?>
						</select></label><br>	
		
						<br><label>Coordenador:
						<select id ="coordenador" onchange="verifica();" name="coordenador" <?php if(isset($dados)){echo "value='".$dados['coordenador']."'";}?>>
							<?php
								$valor= isset($dados['coordenador']) ? $dados['coordenador'] : null;
								echo FuncionarioController::show(null,'combo',$valor);
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
						<select id="dre" name="dre" <?php if(isset($dados)){echo "value='".$dados['dre']."'";}?>>
							<?php
							$valor= isset($dados['dre']) ? $dados['dre'] : null;
								echo DreController::show(null,'combo',$valor);
							?>
						</select></label><br><br>
						
				<label>Diretor:
					<select id="diretor" onchange="verifica();" name="diretor" <?php if(isset($erro)==true && $erro=='1'){echo "style='border:1px solid red'";}?>>
								<?php
								$valor= isset($dados['diretor']) ? $dados['diretor'] : null;
									echo FuncionarioController::show(null,'combo',$valor);
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
						<button type="submit" class="success button">Cadastrar</button>
						<button type="button" class="alert button">Cancelar</button> 
					</div>
						<div class="columns large-4"></div>
		 </form>
          <!-- End content area -->
    </div>
	
	<script>
		$(document).ready(function() {
			$('#mantenedor').select2();
			$('#coordenador').select2();
			$('#diretor').select2();
			$('#dre').select2();
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
		
	</script>