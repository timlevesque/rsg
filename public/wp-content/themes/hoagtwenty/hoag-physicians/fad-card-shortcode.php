<?php
/*************************
fad card shortcode by slug
*************************/
// example usage: [physician name='ram-mudiyam-md']

function phoneFormat($number) {
	if(ctype_digit($number) && strlen($number) == 10) {
  	$number = substr($number, 0, 3) .'-'. substr($number, 3, 3) .'-'. substr($number, 6);
	} else {
		if(ctype_digit($number) && strlen($number) == 7) {
			$number = substr($number, 0, 3) .'-'. substr($number, 3, 4);
		}
	}
	return $number;
}


function fad_card_shortcode($atts) {
    
  //use slug name
  $slug= $atts['name'];
  $style= $atts['style'];
  //convert slug to post id
  $id = get_id_by_slug($slug);
  //physician info
    $physician_name = get_the_title($id);
    $physician_img = get_the_post_thumbnail_url($id);
    $physician_lang = get_post_meta($id, "hoagp_languages", true);
    $physician_lang2 = get_post_meta($id, "hoagp_languages2", true);
    $physician_office1 = get_post_meta($id, "hoagp_paddress1", true);
    $physician_office2 = get_post_meta($id, "hoagp_paddress2", true);
    $physician_phone = phoneFormat(get_post_meta($id, "hoagp_pphone", true));
    $city = get_post_meta($id, "hoagp_pcity", true);
    $state = get_post_meta($id, "hoagp_pstate", true);
    $zip = get_post_meta($id, "hoagp_pzipcode", true);
    
    $phy_post = get_post($id);
    $physician_specialties = array_merge(
      wp_list_pluck( $phy_post->hoagp_primaryspecialty, 'Specialty' ),
      wp_list_pluck( $phy_post->hoagp_secondaryspecialty, 'Specialty' ));

      $specialties = "";
    
      foreach ($physician_specialties as $physician_specialty) {
          $specialties.= $physician_specialty.' |  ';
          
              }
      $specialties = rtrim($specialties, ' | ');

    $phone = '<svg style="overflow:visible;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24" enable-background="new0 0 24 24" xml:space="preserve">
    <path d="M20.599,15.762c-1.344,0-2.634-0.215-3.838-0.613c-0.375-0.117-0.795-0.031-1.096,0.259l-2.364,2.364
    c-3.042-1.548-5.536-4.03-7.083-7.072l2.364-2.375c0.301-0.29,0.387-0.709,0.269-1.086C8.453,6.035,8.238,4.745,8.238,3.401
    c0-0.591-0.484-1.075-1.075-1.075H3.401c-0.591,0-1.075,0.484-1.075,1.075c0,10.094,8.179,18.272,18.272,18.272
    c0.591,0,1.075-0.484,1.075-1.075v-3.762C21.674,16.246,21.189,15.762,20.599,15.762z"></path>
    </svg>';
    
    $pin = '<svg style="overflow:visible;" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" style=""></path>
    <path d="M0 0h24v24H0z" fill="none"></path>
    </svg>';

 
  //display here
  if ($style === 'card'){
  $physician_card = '<div class="card m-0 p-0">
  <img class="card-img-top fluid-img flex-img dr-img" src="'.$physician_img.'" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title font-normal pt-3">'.$physician_name.'<br><small class="font-sm">'.$specialties.'</small></h5>
    
    <div class="col-12">
                                      <a class="row font-sm py-3" href="tel:'.$physician_phone.'"><div class="pr-3">'.$phone.'</div>'.$physician_phone.'</a>
                                      <a target"_blank"  class="row font-sm" href="https://www.google.com/maps/place/'.$physician_office1.'+'.$city.',+'.$state.'+'.$zip.'/"><div class="pr-3">'.$pin.'</div>'.$physician_office1.'<br>'.$city.', '.$state.' '.$zip.'</a>
                                    </div>
    
    
 
  </div>
  
  <div class="card-body">
  <a href="'.get_permalink($id).'" class="btn .bg-transparent btn-outline-primary btn-block">View profile</a>
  </div>
</div>';
  }
  else{ $physician_card = '<div class="container-fluid  border pl-0">
                              <div class="row p-0 m-0" >
                                <div class=" px-0 pr-md-4  pr-lg-0 pr-xl-5 col-4 col-sm-3 col-lg-2 overflow-hidden" style="max-height:250px;">
                                  <img  class="card-img-top fluid-img h-100 flex-img dr-img" src="'.$physician_img.'" alt="Card image cap">
                                </div>
                                <div class="col-8 col-sm-8 col-lg-9 pl-0 pl-xl-0 pb-0 pb-sm-0  p-3 pl-sm-4  overflow-hidden">
                                  <div class="">
                                    <h5 class="card-title font-ms">'.$physician_name.'<br><small class="font-sm">'.$specialties.'</small></h5>
                                    <div class="col-12">
                                      <a class="row font-sm py-3" href="tel:'.$physician_phone.'"><div class="pr-3">'.$phone.'</div>'.$physician_phone.'</a>
                                      <a target"_blank"  class="row font-sm" href="https://www.google.com/maps/place/'.$physician_office1.'+'.$city.',+'.$state.'+'.$zip.'/"><div class="pr-3">'.$pin.'</div>'.$physician_office1.'<br>'.$city.', '.$state.' '.$zip.'</a>
                                    </div>
                                  </div>
                                <div class="card-body d-none  pt-4 d-sm-block">
                                  <a href="'.get_permalink($id).'" class="btn  btn-outline-primary px-4">View profile</a>
                                </div>
                              </div>
                            </div>
                          </div>'; }		

  return $physician_card;
}
add_shortcode('physician', 'fad_card_shortcode');

?>