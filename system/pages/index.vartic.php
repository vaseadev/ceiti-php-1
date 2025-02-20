<?php 
$last_services = Config::query('SELECT * FROM services ORDER BY id DESC LIMIT 4');
$most_services = Config::query('SELECT * FROM services ORDER BY selled DESC LIMIT 2');

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

if (isset($_POST['add_wishlist']))
{
   Config::onlyLogged();

   $existWishlist = Config::queryOne('SELECT * FROM wishlist WHERE service_id = '.floor($_POST['add_wishlist']).' LIMIT 1');

   if (isset($existWishlist->id)) {
      Config::query('DELETE FROM wishlist WHERE service_id = '.floor($_POST['add_wishlist']).'');
      Config::alert('success', 'Serviciul a fost scos din Favorite!');
   } else {
      $insert = Config::$g_con->prepare('INSERT INTO wishlist (user_id, service_id) VALUES (?, ?)');
      $insert->execute(array(Config::getUser(), floor($_POST['add_wishlist'])));
      Config::alert('success', 'Serviciul a fost adăugat în Favorite!');
   }
}
?>

      <div class="container-fluid no margin-mobile">
         <div class="row no slide-bg">
            <div class="col-12 no">
               <ul class="slider">
                  <li>
                     <div class="row-absolute">
                        <div class="slider-text slider-text-lg">
                           <h1>
                              <a href="#">
                              <span class="bars-opacity">ALEGEREA TA - BEAUTYHEALTH.MD!</span>
                              <strong></strong>
                              </a>
                           </h1>
                        </div>
                     </div>
                     <a class="slider-img" href="#">
                     <img class="unfeldebg" src="https://i.imgur.com/CwuqTqj.jpg">
                     </a>
                     <div class="slider-text slider-text-xs d-md-none">
                        <h1>
                           <a href="#">
                           <span>ALEGEREA TA - BEAUTYHEALTH.MD!</span>
                           <strong></strong>
                           </a>
                        </h1>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <div class="container-fluid no pb-4 pt-4">
         <div class="container row-center">
            <div class="row">
               <div class="col-12 text-center scrollpoz">
                  <h2>Cele mai noi servicii</h2>
               </div>
            </div>
            <div class="row prod-row">
<?php foreach ($last_services as $last_service) { ?>
   <div class="col-md-3">
                <div class="card mb-2 prod-item scrollpoz">
                   <figure>
                      <form method="POST">
                      <div>
                         <button value="<?= floor($last_service->id) ?>" style="border: 0; background: transparent" name="add_wishlist" type="submit" class="add-whis"><i class="fa fa-heart" <?= Module::iconRedWishlist($last_service->id) ? 'style="color:red"' : false ?>></i></button>
                      </div>
                     </form>
                      <form method="POST">
                      <div>
                         <button value="<?= floor($last_service->id) ?>" style="border: 0; background: transparent" name="add_cart" type="submit" class="add-cart"><i class="fa fa-shopping-basket"></i></button>
                      </div>
                     </form>
                      <a href="<?= Config::$URL ?>service/<?= Config::antiXSS($last_service->id) ?>">
                      <img src="<?= Config::antiXSS($last_service->image) ?>" alt="image">
                      </a>
                   </figure>
                   <center><small>tip: <?= Config::getCategory('title', $last_service->category_id) ?></small></center>
                   <h3>
                      <a href="<?= Config::$URL ?>service/<?= Config::antiXSS($last_service->id) ?>" title=""><?= Config::antiXSS($last_service->title) ?></a>
                   </h3>
                   <div class="prod-price">
                      <h4 class="prod-price"><?= Config::antiXSS($last_service->price) ?> MDL</h4>
                      <div class="star-item-single"><?= Config::getHTMLStarsService($last_service->id) ?>
                      <br><small><?= Config::antiXSS($last_service->selled) ?> cantități cumpărate</small></div>
                   </div>
                </div>
             </div>
<?php } if (count($last_services) <= 0) echo "<div class='card col-md-12 mb-4'>Nu sunt servicii disponibile pe site!</div>"; ?>
            </div>
         </div>
      </div>
      <!-- Footer -->
      <div class="container-fluid no bg-dark voucher-bg">
         <div class="container row-center">
            <div class="row pt-4 pb-4 scrollpoz">
               <div class="col-md-9 col-12 pt-1 text-center text-md-left">
                  <h2>
                  Prețuri reduse</h3>
                  <h3>Pe beautyhealth.md găsiți cele mai ieftine servicii!</h3>
               </div>
               <div class="col-md-3 col-12 py-md-1 text-center text-md-right">
                  <a class="btn btn-default btn-xl" href="<?= Config::$URL ?>categories">Vezi categoriile</a>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid no pt-4 pb-4">
         <div class="container row-center">
            <div class="row">
               <div class="col-12 text-center scrollpoz">
                  <h2>Cele mai vândute servicii</h2>
               </div>
            </div>
            <div class="row">
               <div class="col-md-5 col-12 prod-banners content-banner scrollpoz pb-3">
                  <figure>
                     <a class="prod-banner-content" href="<?= Config::$URL ?>payment">
                        <div class="prod-banner-info">
                           <h3>VEZI METODELE DE ACHITARE</h3>
                           <h4></h4>
                        </div>
                        <img src="https://i.imgur.com/qGuIcMH.jpg">
                     </a>
                  </figure>
               </div>
               <div class="col-md-7 col-12 carousel-section">
                  <div class="row">
                     <?php foreach ($most_services as $most_service) { ?>
                        <div class="col-md-6">
                <div class="card prod-item scrollpoz pb-3">
                   <figure>
                      <form method="POST">
                      <div>
                         <button value="<?= floor($most_service->id) ?>" style="border: 0; background: transparent" name="add_wishlist" type="submit" class="add-whis"><i class="fa fa-heart" <?= Module::iconRedWishlist($most_service->id) ? 'style="color:red"' : false ?>></i></button>
                      </div>
                     </form>
                      <form method="POST">
                      <div>
                         <button value="<?= floor($most_service->id) ?>" style="border: 0; background: transparent" name="add_cart" type="submit" class="add-cart"><i class="fa fa-shopping-basket"></i></button>
                      </div>
                     </form>
                      <a href="<?= Config::$URL ?>service/<?= Config::antiXSS($most_service->id) ?>">
                      <img src="<?= Config::antiXSS($most_service->image) ?>">
                      </a>
                   </figure>
                   <center><small>tip: <?= Config::getCategory('title', $most_service->category_id) ?></small></center>
                   <h3>
                      <a href="<?= Config::$URL ?>service/<?= Config::antiXSS($most_service->id) ?>"><?= Config::antiXSS($most_service->title) ?></a>
                   </h3>
                   <div class="prod-price">
                      <h4 class="prod-price"><?= Config::antiXSS($most_service->price) ?> MDL</h4>
                      <div class="star-item-single"><?= Config::getHTMLStarsService($most_service->id) ?>
                      <br><small><?= Config::antiXSS($most_service->selled) ?> cantități cumpărate</small></div>
                   </div>
                </div>
             </div>
                     <?php } if (count($most_services) <= 0) echo "<div class='card col-md-12 mb-4'>Nu sunt servicii disponibile pe site!</div>"; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>