<?php 
Config::onlyLogged();
if (!$myAcc->admin) Config::alert('error', 'Nu ai acces!', '#');

if (isset($_POST['adaugaServiciiAutomate']))
{

   $array_categories = [
      [
         "title" => "Sănătate",
         "image" => "https://i.imgur.com/HQ2D0DT.jpg"
      ],
      [
         "title" => "Înfrumusețare",
         "image" => "https://i.imgur.com/mNYVL08.jpg"
      ],
      [
         "title" => "Altele",
         "image" => "https://i.imgur.com/eXUdx3M.jpg"
      ],
   ];

   foreach($array_categories as $k=>$value) {
     $insert = Config::$g_con->prepare('INSERT INTO categories (title, image, edited_by, edited_at, created_by, created_at) VALUES (?, ?, ?, ?, ?, ?)');
     $insert->execute(array($value['title'], $value['image'], 0, 0, Config::getUser(), time()));
   }

   $array = [
      [ 
         "name" => "Prevenirea trombofeblitei",
         "price" => 300,
         "image" => "https://i.imgur.com/zunvmCF.jpg",
         "amount" => 1,
         "stars" => 3,
         "type" => 3,
         "selled" => 0,
         "description" => "none"
      ],
      [
          "name" => "Reducerea obezitatii",
          "price" => 400,
          "image" => "https://i.imgur.com/d2Hxi1L.jpg",
          "amount" => 1,
          "stars" => 5,
          "type" => 2,
          "selled" => 0,
          "description" => "none"
      ],
      [
          "name" => "Prevenirea varicelor",
          "price" => 100,
          "image" => "https://i.imgur.com/xEt8TiT.jpg",
          "amount" => 1,
          "stars" => 4,
          "type" => 2,
          "selled" => 0,
          "description" => "none"
      ],
      [
          "name" => "Masaj terapeutic",
          "price" => 350,
          "image" => "https://i.imgur.com/b5c7zNK.jpg",
          "amount" => 1,
          "stars" => 5,
          "type" => 3,
          "selled" => 2,
          "description" => "none"
      ],
      [
          "name" => "Detoxifierea totală a organismului",
          "price" => 300,
          "image" => "https://i.imgur.com/bGpsc1K.jpg",
          "amount" => 1,
          "stars" => 3,
          "type" => 1,
          "selled" => 0,
          "description" => "none"
      ],
      [
          "name" => "Accelerarea procesului de cicatrizare",
          "price" => 250,
          "image" => "https://i.imgur.com/MEwpSJy.jpg",
          "amount" => 1,
          "stars" => 2,
          "type" => 3,
          "selled" => 0,
          "description" => "none"
      ],
      [
          "name" => "Creșterea activității sistemului imunitar",
          "price" => 700,
          "image" => "https://i.imgur.com/0b6PVLC.jpg",
          "amount" => 1,
          "stars" => 5,
          "type" => 1,
          "selled" => 0,
          "description" => "none"
      ],
      [
          "name" => "Reducerea celulitei",
          "price" => 300,
          "image" => "https://i.imgur.com/WfftW0N.jpg",
          "amount" => 1,
          "stars" => 4,
          "type" => 1,
          "selled" => 0,
          "description" => "none"
      ]
   ];


   foreach($array as $k=>$value) {
     $insert = Config::$g_con->prepare('INSERT INTO services (category_id, title, price, image, description, created_by, created_at, edited_by, edited_at, selled) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
     $insert->execute(array($value['type'], $value['name'], $value['price'], $value['image'], $value['description'].' #'.($k+1), Config::getUser(), time(), 0, 0, 0));
   }

   Config::alert('success', 'Serviciile & categoriile automate au fost adăugate cu succes!');
}

if (isset($_POST['deleteAccount']))
{
   if (floor($_POST['account_id']) == Config::getUser()) {
      Config::alert("error", "Nu poți face asta!");
   }

   Config::query('DELETE FROM accounts WHERE id = '.floor($_POST['account_id']).'');
   Config::alert('success', 'Contul (dacă există) a fost șters cu succes!');
}

if (isset($_POST['deleteService']))
{
   Config::query('DELETE FROM services WHERE id = '.floor($_POST['service_id']).'');
   Config::alert('success', 'Serviciul (dacă există) a fost șters cu succes!');
}

if (isset($_POST['deletePoll']))
{
   Config::query('DELETE FROM polls WHERE id = '.floor($_POST['poll_id']).'');
   Config::alert('success', 'Sondajul (dacă există) a fost șters cu succes!');
}

if (isset($_POST['closePoll']))
{
   $existPoll = Config::queryOne('SELECT id FROM polls WHERE id = '.floor($_POST['poll_id']).' LIMIT 1');
   if (!isset($existPoll->id)) {
      Config::alert('error', 'Sondajul nu există!');
   }
   Config::query('UPDATE polls SET status = 1 WHERE id = '.floor($_POST['poll_id']).'');
   Config::alert('success', 'Sondajul a fost închis cu succes!');
}

if (isset($_POST['openPoll']))
{
   $existPoll = Config::queryOne('SELECT id FROM polls WHERE id = '.floor($_POST['poll_id']).' LIMIT 1');
   if (!isset($existPoll->id)) {
      Config::alert('error', 'Sondajul nu există!');
   }
   Config::query('UPDATE polls SET status = 0 WHERE id = '.floor($_POST['poll_id']).'');
   Config::alert('success', 'Sondajul a fost deschis cu succes!');
}

$categories = Config::query('SELECT * FROM categories');

if (isset($_POST['insertService']))
{
     $insert = Config::$g_con->prepare('INSERT INTO services (category_id, title, price, image, description, created_by, created_at, edited_by, edited_at, selled) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
     $insert->execute(array(floor($_POST['category_id']), Config::antiXSS($_POST['title']), floor($_POST['price']), Module::insertImage($_FILES['image']), Config::antiXSS($_POST['description']), Config::getUser(), time(), 0, 0, 0));

     Config::alert('success', 'Serviciul a fost adăugat cu succes!');
}

if (isset($_POST['editService']))
{
   if (isset($_FILES['image']) && $_FILES['image']['size'] >= 1) {
      $image = Module::insertImage($_FILES['image']);
   } else {
      $image = Config::getData('services', 'image', floor($_POST['editService']));
   }

   Config::query('UPDATE services SET category_id = '.floor($_POST['category_id']).', title = "'.Config::antiXSS($_POST['title']).'", price = '.floor($_POST['price']).', image = "'.$image.'", description = "'.Config::antiXSS($_POST['description']).'", edited_by = '.Config::getUser().', edited_at = '.time().' WHERE id = '.floor($_POST['editService']).'');

   Config::alert('success', 'Serviciul a fost editat cu succes!');
}

if (isset($_POST['insertPoll']))
{
   $answers = explode('||', Config::antiXSS($_POST['answers']));

   $insert = Config::$g_con->prepare('INSERT INTO polls (question, answers, status, created_by, created_at) VALUES (?, ?, ?, ?, ?)');
   $insert->execute(array(Config::antiXSS($_POST['question']), json_encode($answers), 0, Config::getUser(), time()));

   Config::alert('success', 'Sondajul a fost creat cu succes!');
}

?>      <div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Panoul de Admin</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid no py-2">
         <div class="container-fluid row-center">
            <div class="row pt-4 page-content">
               <div class="col-md-4 col-12 contact-info pt-3">
                  <h3>Opțiuni</h3>
                  <div class="media">
                     <div class="media-body">
                        <form method="POST">
                           <button name="adaugaServiciiAutomate" class="btn">Adaugă serviciile&categoriile automate</button>
                         </form>
                         <form method="POST">
                           <div class="row mt-2">
                              <div class="col-md-6"><input placeholder="ID cont" type="number" class="form-control" name="account_id" required></div>
                           <div class="col-md-6"><button type="submit" name="deleteAccount" class="btn">Șterge un cont</button></div>
                        </div>
                        </form>
                         <form method="POST">
                           <div class="row mt-2">
                              <div class="col-md-6"><input placeholder="ID serviciu" type="number" class="form-control" name="service_id" required></div>
                           <div class="col-md-6"><button type="submit" name="deleteService" class="btn">Șterge un serviciu</button></div>
                        </div>
                        </form>
                         <form method="POST">
                           <div class="row mt-2">
                              <div class="col-md-6"><input placeholder="ID serviciu" type="number" class="form-control" name="service_id" required></div>
                           <div class="col-md-6"><button name="edit_service_open" type="submit" class="btn">Editează un serviciu</button></div>
                        </div>
                        </form>
                        <hr>
                        <h3>Administrează Sondaje</h3>
                         <form method="POST">
                           <div class="row mt-2">
                              <div class="col-md-6"><input placeholder="ID sondaj" type="number" class="form-control" name="poll_id" required></div>
                           <div class="col-md-6"><button type="submit" name="deletePoll" class="btn">Șterge un sondaj</button></div>
                        </div>
                        </form>
                         <form method="POST">
                           <div class="row mt-2">
                              <div class="col-md-6"><input placeholder="ID sondaj" type="number" class="form-control" name="poll_id" required></div>
                           <div class="col-md-6"><button type="submit" name="closePoll" class="btn">Închide un sondaj</button></div>
                        </div>
                        </form>
                         <form method="POST">
                           <div class="row mt-2">
                              <div class="col-md-6"><input placeholder="ID sondaj" type="number" class="form-control" name="poll_id" required></div>
                           <div class="col-md-6"><button type="submit" name="openPoll" class="btn">Deschide un sondaj</button></div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-md-8 col-12 form-contact py-3">
<?php if (isset($_POST['edit_service_open'])) {
$existService = Config::queryOne('SELECT id FROM services WHERE id = '.floor($_POST['service_id']).'');
if (!isset($existService->id)) Config::alert('error', 'Serviciul nu există!');
?>
                  <h3>Editează serviciul cu ID <?= floor($_POST['service_id']) ?></h3>
                  <div class="text-center py-1 mt-4"> </div>
                  <form method="POST" enctype="multipart/form-data">
                     <div class="form-group mb-2">
                        <input name="title" type="text" class="form-control" value="<?= Config::antiXSS(Config::getData('services', 'title', floor($_POST['service_id']))) ?>" placeholder="Titlu" required>
                     </div>
                     <div class="form-group mb-2">
                        <input name="price" type="number" class="form-control" value="<?= Config::antiXSS(Config::getData('services', 'price', floor($_POST['service_id']))) ?>" placeholder="Preț" required>
                     </div>
                     <div class="form-group mb-2">
                        <input name="image" type="file" class="form-control" placeholder="Imagine">
                     </div>
                     <div class="form-group mb-2">
                        <select name="category_id" class="form-control">
                           <?php foreach ($categories as $category) { ?>
                              <option value="<?= Config::antiXSS($category->id) ?>"><?= Config::antiXSS($category->title) ?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="form-group mb-2">
                        <textarea name="description" class="form-control" placeholder="Descriere" style="height: 100px" required><?= Config::antiXSS(Config::getData('services', 'description', floor($_POST['service_id']))) ?></textarea>
                     </div>
                     <div class="form-group text-right">
                        <button value="<?= floor($_POST['service_id']) ?>" name="editService" class="btn btn-primary">Salvează</button>
                     </div>
                  </form>
<?php } ?>
                  <h3>Adaugă un serviciu</h3>
                  <div class="text-center py-1 mt-4"> </div>
                  <form method="POST" enctype="multipart/form-data">
                     <div class="form-group mb-2">
                        <input name="title" type="text" class="form-control" placeholder="Titlu" required>
                     </div>
                     <div class="form-group mb-2">
                        <input name="price" type="number" class="form-control" placeholder="Preț" required>
                     </div>
                     <div class="form-group mb-2">
                        <input name="image" type="file" class="form-control" placeholder="Imagine" required>
                     </div>
                     <div class="form-group mb-2">
                        <select name="category_id" class="form-control">
                           <?php foreach ($categories as $category) { ?>
                              <option value="<?= Config::antiXSS($category->id) ?>"><?= Config::antiXSS($category->title) ?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="form-group mb-2">
                        <textarea name="description" class="form-control" placeholder="Descriere" style="height: 100px" required></textarea>
                     </div>
                     <div class="form-group text-right">
                        <button name="insertService" class="btn btn-primary">Salvează</button>
                     </div>
                  </form>

                  <h3>Adaugă un sondaj</h3>
                  <div class="text-center py-1 mt-4"> </div>
                  <form method="POST">
                     <div class="form-group mb-2">
                        <input name="question" class="form-control" placeholder="Întrebare" required>
                     </div>
                     <div class="form-group mb-2">
                        <textarea name="answers" class="form-control" placeholder="Răspunsuri (separate prin ||) [ex: apple||samsung]" style="height: 100px" required></textarea>
                     </div>
                     <div class="form-group text-right">
                        <button name="insertPoll" class="btn btn-primary">Salvează</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>