    <?php
	use App\Lancamento;
	use Illuminate\Support\Facades\Session;

	
	if(Session::has('id')==true)
	{
		$id=Session::get('id');
		$html=Lancamento::consultaDetalhada($id);
		Session::forget('id');
	}
	if(Session::has('lancamento')==true)
	{

		$lancamento= Session::get('lancamento');
		Session::forget('lancamento');
	
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

          <!-- Begin content area --> 

          <div class="expanded row margin-top-20">

            <div class="columns large-12">        
            <h1> Consulta de Lançamentos</h1>
            </div> 

          </div> 
			<div class="expanded row margin-top-20">
				
			<div class="columns large-12">        
				
				
				<label>Unidade:</label>
				<label><?php echo $lancamento["Unid"]; ?>
						
						<br>
				
			</div>
          <!-- End content area -->
    </div>
	<br>
	<div class="columns large-12"> 
	<table style="width:100%">
				<thead>
					<th>Nota</th>
					<th>Data Emissão</th>
					<th>Valor</th>
					<th>Descontos</th>
					<th>Total</th>
					<th>Fornecedor</th>
				</thead>
				<?php
				echo $html;
				?>
			
	</table>
	</div>
	<div class="columns large-12"> 
		<div class="columns large-4">        
		<label>
				Repasse:
						<input type="text" name="Repasse" class="moeda" placeholder="000.000,00" value="<?php if(isset($lancamento)){echo $lancamento["Repasse"];}else{return redirect('prestacao/public/ConLancamento');} ?>" disabled>
					</label><br>
		</div>
	
	
	<div class="columns large-4">        
	
	<label>
			Saldo:
				<input type="text" name="Saldo" class="moeda" placeholder="000.000,00" value="<?php if(isset($lancamento)){echo $lancamento["Saldo"];}else{return redirect('prestacao/public/ConLancamento');} ?>" disabled>
				</label><br>
	</div>
	
	<div class="columns large-4">    
	<label>
			Total Nota:	
				<input type="text" name="Total" class="moeda"  placeholder="000.000,00" value="<?php if(isset($lancamento)){echo $lancamento["Total"];}else{return redirect('prestacao/public/ConLancamento');} ?>" disabled>
				</label><br>
	</div>
				
	</div>
	<div class="columns large-12"> 
	<p>
		<a href="<?php echo url('prestacao/public/CadNota/'.$id.'');?> " class="secondary button">+</a>
	</p>
	</div>
</div>

<?php
}
	else
	{
		echo "fail";
		echo $html;
	}
?>