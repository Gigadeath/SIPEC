    <div class="medium-12 large-10 columns" id="main">        
        <div id="header" class="expanded row bg-grey">
            <div class="medium-6 columns hide-for-large text-left" style="border-right:02px dotted #fff;">
                <div class="blue text-left" style="font-size:1rem;line-height:2.8rem;" data-responsive-toggle="sidebar" data-hide-for="large"><i class="fi-list"></i> <a href="#" data-toggle>Menu</a></div>
            </div>
        </div> 
        <div class="expanded row" id="breadcrumb">
			<div class="columns large-12 gray">Home <i class="fa fa-angle-right"></i> Page</div>
        </div>
        <div class="expanded row margin-top-20">
            <div class="columns large-12">        
				<h1>Cadastro de Lançamentos</h1>
            </div> 
        </div> 
		<form>
			<div class="expanded row margin-top-20">
				<div class="columns large-4">        
					<label>Total Nota:</label>	
					<input type="text" name="Nome" class="moeda"  placeholder="000.000,00" disabled>
					<br/>
					<label>Repasse:</label>
					<input type="text" name="Repasse" class="moeda" placeholder="000.000,00">
					<br/>
				</div>
				<div class="columns large-4">        
				</div>
			
				<div class="columns large-4"> 
					<label>Saldo:</label>
					<input type="text" name="Saldo" class="moeda" placeholder="000.000,00" disabled>
					<br/>
					<label>Unidade:</label>
						<select>
							<option value="husker">Husker</option>
							<option value="starbuck">Starbuck</option>
							<option value="hotdog">Hot Dog</option>
							<option value="apollo">Apollo</option>
						</select>
				</div>
			</div>
			<br/>
				<button type="button" class="success button">Cadastrar</button>
				<button type="button" class="alert button">Cancelar</button>
		</form>
          <!-- End content area -->
    </div>