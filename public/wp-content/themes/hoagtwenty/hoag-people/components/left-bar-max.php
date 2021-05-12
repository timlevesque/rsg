<?php 
use HoagPeople\TemplateTags as Tags;
include('meta.php');
?>

 <!--start rating goes here-->
                
 <div class="small text-grey mb-0 pb-5">
                	<!-- <span class="icon-before check-icon-before  d-inline-flex  mx-auto">Accepting New Patients</span> -->
                </div>
               <!--  <a href="" class="btn btn-primary px-5 py-3 mb-4 shadow">schedule appointment&nbsp;&rarr;</a> -->
        
        <?php if ( !empty( $post->hoagp_providerhasnoclinicalprivileges) || !empty( $post->hoagp_providerhasopprivilegesonly ) ) : ?>
        
		<div class="container-fluid physician-card__privileges card-footer alert-danger py-1 ">
			<div class="row ">
				<div class="col-12">	
					<div class="physician-card__privilege__text">
						<p class="mb-0 ml-2 small"> <?php Tags\get_privileges(); ?> </p>
					</div>
				</div>
			</div>
        </div>
        <?php endif; ?>

        <div class="col-12 px-4 ">

    
 

        
  
