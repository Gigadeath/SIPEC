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
            <h1> Selecione um Lançamento</h1>
            </div> 

          </div> 
			<div class="expanded row margin-top-20">
			<?php
			use App\Http\Controllers\LancamentoController;
			use Session;
			echo LancamentoController::index();
			?>
          <!-- End content area -->
    </div>
	<br>
	

</div>