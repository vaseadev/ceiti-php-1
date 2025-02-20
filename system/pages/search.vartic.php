<?php 
$searches = [];
   if(isset($_GET['search'])) {
      $searches = Config::query('SELECT * FROM services WHERE title LIKE "%'.$_GET['search'].'%"');
   }
?>
      <div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Căutare serviciu</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 py-2 prod-item new-line-item pb-4 pt-4 pl-8 pr-8">
               <div class="row">
<?php foreach ($searches as $service) { ?>
                <div class="col-md-4 mb-2">
                   <div class="row">
                      <div class="col-md-4">
                         <figure>
                            <a class="prod-img-new" href="<?= Config::$URL ?>service/<?= floor($service->id) ?>"><img src="<?= Config::antiXSS($service->image) ?>"></a>
                         </figure>
                      </div>
                      <div class="col-md-8">
                         <h3>
                            <a href="<?= Config::$URL ?>service/<?= floor($service->id) ?>"><?= Config::antiXSS($service->title) ?></a>
                         </h3>
                         <h4 class="prod-price"><?= Config::antiXSS($service->price) ?> MDL</h4>
                      </div>
                   </div>
                </div>
<?php } if(count($searches) <= 0) echo 'Nu s-au găsit serviciile căutate!'; ?>
               </div>
            </div>
         </div>
      </div>