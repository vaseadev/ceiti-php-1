<?php 
   Config::onlyLogged();
   
   $wishlists = Config::query('SELECT * FROM wishlist WHERE user_id = '.Config::getUser().'');

   if (isset($_POST['removeFromWishlist']))
   {
      Config::queryOne('DELETE FROM wishlist WHERE id = '.floor($_POST['removeFromWishlist']).'');
      Config::alert('success', 'Ai scos serviciul din favorite cu succes!');
   }

if (isset($_POST['add_cart']))
{
   Config::onlyLogged();

   $existCart = Config::queryOne('SELECT * FROM cart WHERE service_id = '.floor($_POST['add_cart']).' LIMIT 1');

   if (isset($existCart->id)) {
      Config::queryOne('UPDATE cart SET amount = '.(1+$existCart->amount).' WHERE id = '.$existCart->id.'');
      Config::alert('success', 'Serviciul este deja în coș, drept urmare i-a fost schimbată cantitatea!');
   } else {
        $insert = Config::$g_con->prepare('INSERT INTO cart (user_id, service_id, amount) VALUES (?, ?, ?)');
        $insert->execute(array(Config::getUser(), floor($_POST['add_cart']), 1));
        Config::alert('success', 'Serviciul a fost adăugat în coș!');
   }
}
?>

      <div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Wish List</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid row-center pb-4 pt-4">
         <div class="row card">
         	<?php foreach ($wishlists as $wishlist) { ?>
               <div class="col-md-3 card prod-item mb-2" id="wishcard_${item.id}">
                   <figure>
                      <div class="add-whis">
                      	<form method="POST">
                      		<button style="border: none; background: none; cursor: pointer" name="removeFromWishlist" value="<?= floor($wishlist->id) ?>"><i class="fa fa-times"></i></button>
                      	</form>
                      </div>
                     
                      <div class="add-cart jsaddcart">
                      	 <form method="POST">
                         <button value="<?= floor($wishlist->service_id) ?>" style="border: 0; background: transparent" name="add_cart" type="submit" class="add-cart"><i class="fa fa-shopping-basket"></i></button>
                     </form>
                      </div>
                      <a href="serviciu.html?id=${item.id}">
                      <img src="<?= Config::getData('services', 'image', $wishlist->service_id) ?>">
                      </a>
                   </figure>
                   <div class="prod-item-info">
                      <h3>
                         <a href="serviciu.html?id=${item.id}"><?= Config::getData('services', 'title', $wishlist->service_id) ?></a>
                      </h3>
                      <h4 class="prod-price"><?= Config::getData('services', 'price', $wishlist->service_id) ?> MDL</h4>
                      <div class="star-item-single"><?= Config::getHTMLStarsService($wishlist->service_id) ?></div>
                   </div>
                </div>
                <div class="col-md-1" id="wishcardtwo_${item.id}"></div>
            <?php } if (!count($wishlists)) echo 'Nu sunt servicii!'; ?>
         </div>
         </div>
      </div>