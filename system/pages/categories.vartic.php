<?php
   if (!isset(Config::$_url[1])) { 
   $categories = Config::query('SELECT * FROM categories ORDER BY id ASC');
?>

<div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
   <div class="container-fluid no page-header-overlay">
      <div class="container row-center">
         <div class="row">
            <div class="col-12 pt-4 text-center text-md-left">
               <h2>Categorii</h2>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container-fluid no">
   <center><a href="<?= Config::$URL ?>categories/all"><button class="btn mt-4">Toate serviciile existente</button></a></center>
   <div class="container row-center pt-4 pb-4">
      <div class="row">
         <?php foreach ($categories as $category) { ?>
         <div class="col-md-4 prod-banners pb-4">
            <figure>
               <a class="prod-banner-content" href="<?= Config::$URL ?>categories/<?= Config::antiXSS($category->id) ?>">
                  <div class="prod-banner-info">
                     <h3><?= Config::antiXSS($category->title) ?></h3>
                     <h4></h4>
                  </div>
                  <img src="<?= Config::antiXSS($category->image) ?>">
               </a>
            </figure>
         </div>
         <?php } ?>
      </div>
   </div>
</div>

<?php } else if(isset(Config::$_url[1])) {
if (is_numeric(Config::$_url[1])) {
   $services = Config::query('SELECT * FROM services WHERE category_id = '.Config::$_url[1].' ORDER BY id DESC');
   if (count($services) < 1)
      Config::alert('warning', 'Nu există momentan servicii în această categorie!', 'categories');
} else if (Config::$_url[1] == "all") {
   $services = Config::query('SELECT * FROM services ORDER BY id DESC');
   if (count($services) < 1)
      Config::alert('warning', 'Nu există momentan servicii!', 'categories');
} else Config::alert('error', 'URL invalid!', '404');

if (isset($_GET['sort'])) {
   if (Config::$_url[1] == "all") {
      if ($_GET['sort'] == "asc") {
         $services = Config::query('SELECT * FROM services ORDER BY price ASC');
      } else if ($_GET['sort'] == "desc") {
         $services = Config::query('SELECT * FROM services ORDER BY price DESC');
      }
   } else {
      if ($_GET['sort'] == "asc") {
         $services = Config::query('SELECT * FROM services WHERE category_id = '.Config::$_url[1].' ORDER BY price ASC');
      } else if ($_GET['sort'] == "desc") {
         $services = Config::query('SELECT * FROM services WHERE category_id = '.Config::$_url[1].' ORDER BY price DESC');
      }
   }
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
      <div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Servicii</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
<div class="row no pb-4 pt-4">
              <div class="col-md-3 mx-auto col-center">
               <form method="GET">
                  <select name="sort" class="form-control getPriceOrder" onchange="this.form.submit()">
                     <option value="none">Ordonare preț</option>
                     <option <?= isset($_GET['sort']) && $_GET['sort'] == "asc" ? 'selected' : false ?> value="asc">Ascendent</option>
                     <option <?= isset($_GET['sort']) && $_GET['sort'] == "desc" ? 'selected' : false ?> value="desc">Descendent</option>
                  </select>
               </form>
               </div>
</div>
      <div class="container-fluid no pb-1 pt-4">
         <div class="container-fluid row-center">
            <div class="row prod-list mb-4">
               <?php foreach($services as $service) { ?>
                  <div class="col-md-3">
                <div class="card prod-item mb-2 small-prod pb-4">
                   <figure>
                      <form method="POST">
                      <div>
                         <button value="<?= floor($service->id) ?>" style="border: 0; background: transparent" name="add_wishlist" type="submit" class="add-whis"><i class="fa fa-heart" <?= Module::iconRedWishlist($service->id) ? 'style="color:red"' : false ?>></i></button>
                      </div>
                     </form>
                      <form method="POST">
                      <div>
                         <button value="<?= floor($service->id) ?>" style="border: 0; background: transparent" name="add_cart" type="submit" class="add-cart"><i class="fa fa-heart"></i></button>
                      </div>
                     </form>
                      <form method="POST">
                      <div>
                        <button value="<?= floor($last_service->id ?? 0) ?>" style="border: 0; background: transparent" name="add_cart" type="submit" class="add-cart">
                           <i class="fa fa-shopping-basket"></i>
                        </button>
                     </div>
                     </form>
                      <a href="<?= Config::$URL ?>service/<?= Config::antiXSS($service->id) ?>">
                      <img src="<?= Config::antiXSS($service->image) ?>">
                      </a>
                   </figure>
                   <center><small>tip: <?= Config::antiXSS(Config::getCategory('title', $service->category_id)) ?></small></center>
                   <h3>
                      <a href="<?= Config::$URL ?>service/<?= Config::antiXSS($service->id) ?>"><?= Config::antiXSS($service->title) ?></a>
                   </h3>
                   <div class="prod-price">
                      <h4 class="prod-price"><?= Config::antiXSS($service->price) ?> MDL</h4>
                      <div class="star-item-single"><?= Config::getHTMLStarsService($service->id) ?>
                      <br><small><?= Config::antiXSS($service->selled) ?> cantități cumpărate</small></div>
                   </div>
                </div>
             </div>
             <?php } ?>
            </div>
         </div>
      </div>
<?php } ?> 