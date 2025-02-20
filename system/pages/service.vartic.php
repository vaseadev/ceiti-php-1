<?php
	if (isset(Config::$_url[1])) {
		$service_id = Config::$_url[1];
	}

	if (!isset($service_id)) {
		Config::alert("error", "Acest serviciu nu există!", "#");
	}

	$service = Config::queryOne("SELECT * FROM services WHERE id = $service_id LIMIT 1");

	if (!isset($service->id)) {
		Config::alert("error", "Acest serviciu nu există!", "#");
	}

   $reviews = Config::query('SELECT * FROM reviews WHERE service_id = '.$service->id.'');

	if (isset($_POST['add_cart']))
	{
		$existCart = Config::queryOne('SELECT * FROM cart WHERE service_id = '.$service->id.' LIMIT 1');

		if (isset($existCart->id)) {
			Config::queryOne('UPDATE cart SET amount = '.(floor($_POST['cart_amount'])+$existCart->amount).' WHERE id = '.$existCart->id.'');
			Config::alert('success', 'Serviciul este deja în coș, drept urmare i-a fost schimbată cantitatea!');
		} else {
	        $insert = Config::$g_con->prepare('INSERT INTO cart (user_id, service_id, amount) VALUES (?, ?, ?)');
	        $insert->execute(array(Config::getUser(), $service->id, floor($_POST['cart_amount'])));
	        Config::alert('success', 'Serviciul a fost adăugat în coș!');
		}
	}

   $canReview = Config::queryOne('SELECT COUNT(id) as canReview FROM reviews WHERE user_id = '.Config::getUser().' && service_id = '.$service->id.'');
   $canReview = $canReview->canReview;

   if (isset($_POST['addReview']))
   {
      if ($canReview) {
         Config::alert('error', 'Ai scris o recenzie deja acestui serviciu!');
      }

      if (!in_array(floor($_POST['stars']), [1, 2, 3, 4, 5])) {
         Config::alert('error', 'Recenzie invalida (stele eronate).');
      }

      $insert = Config::$g_con->prepare('INSERT INTO reviews (user_id, service_id, stars, review, unix) VALUES (?, ?, ?, ?, ?)');
      $insert->execute(array(Config::getUser(), $service->id, floor($_POST['stars']), Config::antiXSS($_POST['review']), time()));

      Config::alert('success', 'Recenzia a fost postată cu succes!');
   }
?>

<div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
   <div class="container-fluid no page-header-overlay">
      <div class="container row-center">
         <div class="row">
            <div class="col-12 pt-4 text-center text-md-left">
               <h2>Vizualizare serviciu</h2>
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
                  <a href="#"><img src="<?= Config::antiXSS($service->image) ?>"></a>
               </figure>
            </div>
         </div>
         <div class="col-md-7 prod-page">
            <div class="row">
               <div class="col-md-12">
                  <h1><?= Config::antiXSS($service->title) ?> </h1>
                  <h4 class="prod-code">
                     Cod produs: <?= Config::antiXSS($service->id) ?>
                     <br>Steluțe: <?= Config::getHTMLStarsService($service->id) ?>
               </div>
               <div class="col-md-12 prod-price text-center">
                  <h2><?= Config::antiXSS($service->price) ?> MDL</h2>
                  <label class="stoc-label text-success">În stoc</label>
                  <label>Prețul include TVA</label>
                  <label>Achitare: numerar / card</label>                            
               </div>
               <div class="col-md-12 pt-4 text-center">
                  <form method="POST">
                     <div class="row">
                        <div class="col-md-6 prod-quant">
                           <div class="input-group mt-1 mb-2">
                              <span class="input-group-btn">
                              <button type="button" class="btn btn-number remove_cant" data-price="<?= Config::antiXSS($spanervice->price) ?>">
                              <span class="fa fa-minus"></span>
                              </button>
                              </span>
                              <input readonly="readonly" id="nr_cant" type="number" name="cart_amount" class="form-control" value="1">
                              <span class="input-group-btn">
                              <button type="button" class="btn btn-number add_cant" data-price="<?= Config::antiXSS($service->price) ?>">
                              <span class="fa fa-plus"></span>
                              </button>
                              </span>
                           </div>
                        </div>
                        <div class="col-md-6 mx-auto">
                           <button name="add_cart" class="btn btn-danger">Adaugă în coș</button>
                        </div>
                     </div>
                     <h3 class="text-center">Total preț: <span id="serviciuTotalPrice"><?= Config::antiXSS($service->price) ?></span> MDL</h3>
                  </form>
               </div>
            </div>
         </div>
            <div class="col-md-12 page-content">
               <h3>Descriere</h3>
               <p><?= Config::antiXSS($service->description) ?></p>
               <h3>Recenzii</h3>
               <?php if (!$canReview) { ?>
               <form method="POST">
                  <select class="form-control mb-2" name="stars">
                     <option value="1">1 stea</option>
                     <option value="2">2 stele</option>
                     <option value="3">3 stele</option>
                     <option value="4">4 stele</option>
                     <option value="5">5 stele</option>
                  </select>
                  <textarea name="review" class="form-control" placeholder="Descriere" style="height:80px" required></textarea>
                  <button type="submit" name="addReview" class="btn btn-primary mt-2">Adaugă recenzie</button>
               </form>
            <?php } ?>
               <p>
                 <?php if (!$canReview) echo '<hr>' ?>
                  <?php foreach ($reviews as $review) { ?>
               <div class="mb-4">
  <img style="vertical-align:middle; border-radius: 100%" src="https://i.imgur.com/WNZtJWu.jpg" width="40vw">
    <?php for ($i = 1; $i <= $review->stars; $i++) { ?>
      <i class="fa fa-star"></i> 
  <?php } ?> (<?= Config::formatUnix($review->unix) ?>)
  <br><b><a href="<?= Config::$URL ?>profile/<?= floor($review->user_id) ?>"><?= Config::getAcc('name', $review->user_id) ?></a></b>: <?= Config::antiXSS($review->review) ?>
</div>
<?php } if (count($reviews) <= 0) echo '<br>Nu sunt recenzii!'; ?>
               </p>
            </div>
      </div>
   </div>
</div>