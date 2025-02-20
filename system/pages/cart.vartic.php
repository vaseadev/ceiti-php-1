<?php 
   Config::onlyLogged();
   
   $carts = Config::query('SELECT * FROM cart WHERE user_id = '.Config::getUser().'');
   $count_carts = Config::queryOne('SELECT COUNT(id) AS countcarts FROM cart WHERE user_id = '.Config::getUser().' LIMIT 1');
   $count_carts = $count_carts->countcarts;

   if (isset($_POST['removeFromCart']))
   {
      Config::queryOne('DELETE FROM cart WHERE id = '.floor($_POST['removeFromCart']).'');
      Config::alert('success', 'Ai scos serviciul din coș cu succes!');
   }

   if (isset($_POST['completeCommand']))
   {
      if ($count_carts < 1) Config::alert('error', 'Nu ai servicii în coș!');
      Config::queryOne('DELETE FROM cart WHERE user_id = '.Config::getUser().'');
      Config::alert('success', 'Ai achiziționat cu succes serviciile selectate!');
   }
?>
      <div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Cos</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid pb-4 pt-4 pr-8 pl-8">
         <div class="row">

            <div class="col-md-8 prod-item new-line-item pb-4">
               <?php 
               $sumar_price = 0;
               foreach ($carts as $cart) {
                  $total_price = Config::getData('services', 'price', $cart->service_id)*$cart->amount;
                  $sumar_price += $total_price;
               ?>
               <div>
                <div class="card pb-4" id="card_<?= floor($cart->id) ?>">
                   <div class="row">
                      <div class="col-md-4">
                         <figure>
                            <a class="prod-img-new" href="<?= Config::$URL ?>service/<?= floor($cart->service_id) ?>"><img src="<?= Config::getData('services', 'image', $cart->service_id) ?>"></a>
                         </figure>
                      </div>
                      <div class="col-md-8">
                         <h3><a href="<?= Config::$URL ?>service/<?= floor($cart->service_id) ?>"><?= Config::getData('services', 'title', $cart->service_id) ?></a></h3>
                         <h4 class="prod-price">Preț: <?= Config::getData('services', 'price', $cart->service_id) ?> MDL</h4>
                         <div class="prod-quant text-center">
                            <div class="input-group mt-1 mb-2">
                               <input value="cantitate: <?= floor($cart->amount) ?>" class="form-control" id="nr_cant_<?= floor($cart->id) ?>" disabled>
                            </div>
                         </div>
                         <h4 class="prod-price">Total: <?= $total_price ?> MDL</h4>
                         <div class="float-right">
                         <form method="POST">
                           <button name="removeFromCart" class="btn btn-danger" value="<?= floor($cart->id) ?>"><i class="fa fa-remove"></i></button>
                         </form>
                      </div>
                      </div>
                   </div>
                </div>
                <br>
               </div>
            <?php } if (!count($carts)) echo '<div class="card">Nu sunt servicii în coș!</div>'; ?>
            </div>
            
            <div class="col-md-4">
               <h2>Sumar comandă</h2>
               <p>Număr servicii: <span id="nrServicii"><?= $count_carts ?></span></p>
               <h4>Total preț: <span id="totalPrice"><?= $sumar_price ?></span> MDL</h4>
               <form method="POST">
                  <button name="completeCommand" class="btn btn-primary btn-block mt-4">Finalizare comandă</button>
               </form>
            </div>
         </div>
      </div>