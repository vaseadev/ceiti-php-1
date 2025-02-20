<?php 
	if (isset(Config::$_url[1])) {
		$user_id = Config::$_url[1];
	}

	if (!isset($user_id)) {
		Config::alert("error", "Acest serviciu nu există!", "#");
	}

	$profile = Config::queryOne("SELECT * FROM accounts WHERE id = $user_id LIMIT 1");

	if (!isset($profile->id)) {
		Config::alert("error", "Acest cont nu există!", "#");
	}
?>

      <div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Vizualizare profil</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid pb-4 pt-4">
         <div class="container row-center">
            <div class="row">
        <div class="col-md-5">
           <div class="item px-2">
              <figure>
                 <a href="#"><img src="https://i.imgur.com/Q3uYVy3.jpg"></a>
              </figure>
           </div>
        </div>
        <div class="col-md-7 prod-page">
           <div class="row">
              <div class="col-md-12">
                 <h1>
                 Profilul lui <span style="text-transform: capitalize;"><?= Config::antiXSS($profile->name) ?></span>
                 </h1><br>
                 <h3 class="col-md-12" style="color: #A8A8A8; font-weight: 500; font-size: 17px">
                 ID <span class="float-right"><?= $profile->id ?></span>
                 <?php if (($myAcc && $myAcc->admin) || $myAcc->id == $profile->id) { ?>
                 	<br>E-Mail <span class="float-right"><?= Config::antiXSS($profile->email) ?></span>
             	<?php } ?>
                 <br>Administrator <span class="float-right"><?= $profile->admin ? 'da' : 'nu' ?></span>
                 <br>Data creării contului <span class="float-right"><?= Config::formatUnix($profile->created_date) ?></span>
                 </h3>
              </div>
           </div>
        </div>
            </div>
         </div>
      </div>