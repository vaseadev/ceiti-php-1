<?php
   $myAcc = 0;
   $header_countCart = 0;
   $header_countWishlist = 0;

   if (Config::isLogged()) {
      $myAcc = Config::queryOne('SELECT * FROM accounts WHERE id = '.Config::getUser().'');

      $header_countCart = Config::queryOne('SELECT COUNT(id) as header_countCart FROM cart WHERE user_id = '.Config::getUser().'');
      $header_countCart = $header_countCart->header_countCart;

      $header_countWishlist = Config::queryOne('SELECT COUNT(id) as header_countWishlist FROM wishlist WHERE user_id = '.Config::getUser().'');
      $header_countWishlist = $header_countWishlist->header_countWishlist;
   }

   if ($header_countCart <= 0) $header_countCart = '';
   if ($header_countWishlist <= 0) $header_countWishlist = '';
?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
      <title>Vartic Vasile - Site colegiu</title>
      <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300,400,500,700&display=swap&subset=latin-ext" rel="stylesheet">
      <link href="<?= Config::$URL ?>template/css/main.css" rel="stylesheet">
      <link href="<?= Config::$URL ?>template/css/style.css" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   </head>
   <body>
      <a href="#" class="scrollToTop"><i class="fa fa-heart"></i></a>
      <div class="container-fluid top no d-mobile-none">
         <div class="container row-center">
            <div class="row">
               <div class="col-md-4 col-12 user-login py-3 mt-md-3 mt-lg-4">

<?php if (Config::isLogged()) { ?>
                  <a href="<?= Config::$URL ?>profile/<?= floor($myAcc->id) ?>">
                  <button type="button" class="btn">
                  <i class="fa fa-user"></i> <?= Config::antiXSS($myAcc->name) ?>
                  </button>
                  </a>

                  <a href="<?= Config::$URL ?>logout"><button class="btn logout-button">
                  <i class="fa fa-sign-out"></i> DECONECTEAZĂ-TE
                  </button></a>
<?php } else { ?>
                  <a href="<?= Config::$URL ?>login">
                  <button type="button" class="btn">
                  <i class="fa fa-user"></i> LOGHEAZĂ-TE</button>
                  </a>
<?php } ?>

                  <div id="google_translate_element" style=""></div>
               </div>
               <div class="col-md-4 col-12 logo text-center py-3">
                  <a href="<?= Config::$URL ?>"><img src="https://i.imgur.com/5KwhiY6.png" /></a>
               </div>
               <div class="col-md-4 top-utils text-right py-3 mt-md-3 mt-lg-4">
                  <div class="drop-search text-left">
                     <form method="GET" action="<?= Config::$URL ?>search">
                     <div class="row form-inline">
                     <input type="text" class="form-control" name="search" placeholder="Caută în site">
                     <button type="submit" class="btn btn-search ml-2 search-button"><i class="fa fa-search"></i></button>
                     </div>
                     </form>
                  </div>
                  <div class="second-menu">
                     <div class="hamburger ripple ripple-radius" data-active="0">
                        <span class="icon-menu" style="font-size: 32px"><i class="fa fa-bars"></i></span>
                     </div>
                     <div class="side-menu">
                        <div class="second-menu-links">
                           <img class="menu-sigla" src="https://i.imgur.com/Lh10eXb.png">
                           <h6><a href="<?= Config::$URL ?>">Acasă</a></h6>
                           <h6><a href="<?= Config::$URL ?>about">Despre Noi</a></h6>
                           <h6><a href="<?= Config::$URL ?>contact">Contact</a></h6>
                        </div>
                        <div class="second-menu-footer">
                           <p><a href="#">vartic2003@gmail.com</a> </p>
                           <p><a href="tel:#">0124131</a> </p>
                           <p class="socials-black">
                              <a href="#" target="_blank" title="Facebook"><i class="icon icon-facebook"></i></a>                                <a href="#"  target="_blank" title="Twitter"><i class="icon icon-twitter"></i></a>                                 <a href="#"  target="_blank" title="Instagram"><i class="icon icon-instagram"></i></a>                            
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid no menu-bg d-mobile-none">
         <div class="container row-center">
            <div class="row">
               <div class="col-12">
                  <nav class="navbar navbar-expand-md">
                     <a class="navbar-brand d-md-none" href="<?= Config::$URL ?>"><img src="https://i.imgur.com/5KwhiY6.png"></a>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                     <span class="navbar-toggler-icon"></span>
                     <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto ml-0">
                           <li class="nav-item <?= Config::liHeaderActive("") ?>"><a class="nav-link" href="<?= Config::$URL ?>"><span>ACASĂ</a></span></li>
                           <li class="nav-item <?= Config::liHeaderActive("categories") ?>"><a class="nav-link" href="<?= Config::$URL ?>categories"><span>CATEGORII</a></span></li>
                           <li class="nav-item <?= Config::liHeaderActive("payment") ?>"><a class="nav-link" href="<?= Config::$URL ?>payment"><span>ACHITARE</a></span></li>
                           <li class="nav-item <?= Config::liHeaderActive("about") ?>"><a class="nav-link" href="<?= Config::$URL ?>about"><span>DESPRE NOI</a></span></li>
                           <li class="nav-item <?= Config::liHeaderActive("contact") ?>"><a class="nav-link" href="<?= Config::$URL ?>contact"><span>CONTACT</a></span></li>
                           <li class="nav-item <?= Config::liHeaderActive("chat") ?>"><a class="nav-link" href="<?= Config::$URL ?>chat"><span>Chat</a></span></li>
                           <li class="nav-item <?= Config::liHeaderActive("polls") ?>"><a class="nav-link" href="<?= Config::$URL ?>polls"><span>Sondaje</a></span></li>
                           <?php if ($myAcc && $myAcc->admin) { ?>
                           <li class="nav-item <?= Config::liHeaderActive("admin") ?>"><a class="nav-link" href="<?= Config::$URL ?>admin"><span>ADMIN</a></span></li>
                           <?php } ?>
                        </ul>
                        <div class="menu-cart">
                           <div class="dropdown drop-cart ">
                              <a class="drop-link cart-open-small" href="<?= Config::$URL ?>cart" role="button" id="dropdownMenuLink" >
                              <small class="cart-number-new"></small>
                              <i class="fa fa-shopping-basket"></i> <span><?= $header_countCart ?></span>
                              </a>
                           </div>
                           <a class="top-utlis-link" href="<?= Config::$URL ?>wishlist" title="Favorite"> <i class="fa fa-heart"></i> <span><?= $header_countWishlist ?></span></a>
                        </div>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid top-mobile fixed-top d-md-none">
         <div class="container row-center">
            <div class="row">
               <div class="col-sm-7 col-5 no logo-mobile">
                  <a href="<?= Config::$URL ?>"><img src="https://i.imgur.com/5KwhiY6.png"/></a>
               </div>
               <div class="col-sm-5 col-7 no top-utils-mobile text-right ">
                  <div class="menu-cart">
                     <div class="dropdown drop-cart ">
                        <a class="drop-link cart-open-small" href="<?= Config::$URL ?>cart" role="button" id="dropdownMenuLink" >
                        <small class="cart-number-new"></small>
                        <i class="fa fa-shopping-basket"></i> <span><?= $header_countCart ?></span>
                        </a>
                     </div>
                     <div class="dropdown drop-user cont-open-small ">
                        <a class="drop-link" href="<?= Config::$URL ?>login" role="button" id="dropdownMenuLink" >
                        <i class="fa fa-user"></i>
                        </a>
                     </div>
                     <a class="top-utlis-link " href="#" title="Whishlist"> <i class="fa fa-heart"></i> <span><?= $header_countWishlist ?></span></a>
                  </div>
                  <div class="menu-mobile ">
                     <div class="hamburger-two ripple ripple-radius" data-active="0">
                        <span class="icon-menu-two"><i class="fa fa-bars"></i></span>
                     </div>
                     <div class="side-menu-two">
                        <div class="collapse-submenu">
                           <h5><a href="<?= Config::$URL ?>">
                              Acasă
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                           <h5><a href="<?= Config::$URL ?>categories">
                              Categorii
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                           <h5><a href="<?= Config::$URL ?>payment">
                              Achitare
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                           <h5><a href="<?= Config::$URL ?>about">
                              Despre Noi
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                           <h5><a href="<?= Config::$URL ?>contact">
                              Contact
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                            <h5><a href="<?= Config::$URL ?>admin">
                              Admin
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                        </div>
                        <div class="side-second-menu">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
             <form method="GET" action="<?= Config::$URL ?>search">
            <div class="row text-center"> <!-- form -->
              
               <div class="col-md-12 no text-center pb-2">
                  <button type="submit" class="btn btn-search srcbtnx search-button"><i class="fa fa-search"></i></button>
                  <input type="text" class="form-control" name="search" placeholder="Caută în site">
               </div>
                
            </div>
            </form>
         </div>
      </div>

<div id="alertHTML"></div>