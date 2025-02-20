<?php 
  Config::onlyGuest();

    if (isset($_POST['login']))
    {
        $email = Config::antiXSS($_POST['email']);
        $password = Config::antiXSS($_POST['password']);

        $acc = Config::queryOne('SELECT id, password, login_protection FROM accounts WHERE email = "'.$email.'" LIMIT 1');

        if (!isset($acc->id)) {
            Config::alert("error", "Acest cont nu există!");
        }

        $acc_id = $acc->id;
        if ($acc->login_protection != NULL) {
            $login_protection = json_decode($acc->login_protection);

            if ($login_protection->attempts >= 10) $login_protection->attempts = 0;

            if ($login_protection->attempts+1 >= 10 && $login_protection->time+900 > time()) {
                Config::alert("error", "Contul a fost blocat 15 minute din cauza încercărilor multiple de logare cu parolă greșită!");
            }
        } else $login_protection = 0;

        if (password_verify($password, $acc->password)) {
            Config::queryOne("UPDATE accounts SET last_ip = '".Config::getIP()."', login_protection = NULL, last_login = ".time()." WHERE id = $acc_id");
            $_SESSION[Config::$loginSessionName] = $acc_id;
            Config::alert("success", "Te-ai logat cu succes!", "#");
        } else {
            if (!$login_protection) {
                $protection_array = json_encode(["attempts" => 1, "ip" => Config::getIP(), "time" => time()]);
            } else {
                $protection_array = json_encode(["attempts" => $login_protection->attempts+1, "ip" => Config::getIP(), "time" => time()]);
            }
            
            Config::queryOne("UPDATE accounts SET login_protection = '".$protection_array."' WHERE id = $acc_id");
            Config::alert("error", "Parola întrodusă greșit!");
        }
    }
?>

<div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
   <div class="container-fluid no page-header-overlay">
      <div class="container row-center">
         <div class="row">
            <div class="col-12 pt-4 text-center text-md-left">
               <h2>Autentificare</h2>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container-fluid pb-4 pt-4 pl-8 pr-8">
   <div class="row">
      <div class="col-md-4">
         <h2>Creare cont</h2>
         <p>Pentru a putea finaliza procesul de cumpărare, te rugăm să îți creezi cont.</p>
         <div class="text-right pt-3"><a class="btn btn-primary ripple" href="<?= Config::$URL ?>register">Creare cont</a></div>
      </div>
      <div class="col-md-8">
         <h2>Autentificare</h2>
         <form method="POST">
            <div class="row">
               <div class="col-md-6 pt-2">
                  <label>Adresa de e-mail</label>
                  <input type="email" name="email" class="form-control" required>
               </div>
               <div class="col-md-6 pt-2">
                  <label>Parola</label>
                  <input type="password" name="password" class="form-control" required>
               </div>
            </div>
            <div class="text-right pt-4">
               <button type="submit" name="login" class="btn btn-primary login-button" type="button">Intra în Cont</button>
            </div>
         </form>
      </div>
   </div>
</div>