<?php
    Config::onlyGuest();

    if (isset($_POST['register']))
    {
        $name = Config::antiXSS($_POST['username1'])." ".Config::antiXSS($_POST['username2']);
        $email = Config::antiXSS($_POST['email']);
        $password = Config::antiXSS(password_hash($_POST['password'], PASSWORD_DEFAULT));

        if (Config::getAccFromEmail('id', $email) != 0) {
            Config::alert("error", "Este deja creat un cont cu acest email!");
        }

        if (count(Config::query('SELECT id FROM accounts WHERE created_ip = "'.Config::getIP().'"')) >= 3) {
            Config::alert("error", "Ai atins limita maximă de conturi de pe acest IP!");
        }

        $insert = Config::$g_con->prepare('INSERT INTO accounts (name, password, email, created_ip, created_date) VALUES (?, ?, ?, ?, ?)');
        $insert->execute(array($name, $password, $email, Config::getIP(), time()));

        Config::alert("success", "Contul a fost creat cu succes!");
    }
?>

<div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
   <div class="container-fluid no page-header-overlay">
      <div class="container row-center">
         <div class="row">
            <div class="col-12 pt-4 text-center text-md-left">
               <h2>Înregistrare</h2>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container-fluid pb-4 pt-4 pl-8 pr-8">
   <div class="row">
      <div class="col-md-4">
         <h2>Autentificare</h2>
         <p>Ai deja un cont înregistrat? Nu uita să te loghezi!</p>
         <div class="text-right pt-3"><a class="btn btn-primary ripple" href="<?= Config::$URL ?>login">Intra în cont</a></div>
      </div>
      <div class="col-md-8">
         <h2>Creare cont</h2>
         <form method="POST">
            <div class="row">
               <div class="col-md-6 pt-2 pb-4">
                  <label>Nume</label>
                  <input type="text" name="username1" class="form-control" required>
               </div>
               <div class="col-md-6 pt-2 pb-4">
                  <label>Prenume</label>
                  <input type="text" name="username2" class="form-control" required>
               </div>
               <div class="col-md-6 pt-2 pb-4">
                  <label>Adresa de e-mail</label>
                  <input type="email" name="email" class="form-control" required>
               </div>
               <div class="col-md-6 pt-2">
                  <label>Parola</label>
                  <input type="password" name="password" class="form-control" required>
               </div>
            </div>
            <div class="text-right pt-4"><button type="submit" name="register" class="btn btn-primary register-button">Creare cont</button></div>
         </form>
      </div>
   </div>
</div>