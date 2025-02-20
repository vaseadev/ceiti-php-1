<?php
Config::onlyGuest(); 
if(!isset(Config::$_url[1])) {

if (isset($_POST['recovery_submit'])) {

$acc_email = Config::antiXSS($_POST['email']);

$account = Config::queryOne('SELECT * FROM accounts WHERE email = "'.$acc_email.'"');
if (!isset($account->id)) Config::alert('error', 'Contul nu există!');

$recovery = Config::queryOne('SELECT * FROM `recovery` WHERE `user_id` = '.$account->id.''); 

if (isset($recover->id)) {
	if ($recovery->unix + 1800 > time()) 
		Config::alert('warning', '[DELAY] Trebuie să aștepți 30 de minute de la ultima resetare de parolă!');
}

$token = Config::randomString(15);
$changepwd_url = Config::$URL."recovery/".$token;

Module::sendMail($acc_email, Config::$administratorEmail, "Recovery Password", "Acesta este un e-mail automat așa că vă rugăm să nu răspundeți!<br>Intră pe acest link ca să îți schimbi parola contului <b>".$account->name."</b>: <a href='".$changepwd_url."'>".$changepwd_url."</a>");

$insert = Config::$g_con->prepare('INSERT INTO `recovery` (`user_id`,`token`,`unix`) VALUES (?,?,?)');
$insert->execute(array($account->id, $token, time()));

Config::alert('success', 'Un link cu resetarea parolei ți-a fost trimis pe e-mail, dacă nu îți apare verifică secțiunea SPAM!');
}

?>
<div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Recuperează parola</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
<div class="container-fluid pb-4 pt-4">
   <div class="container row-center">
   	<form method="POST">
   	<input type="email" name="email" class="form-control" placeholder="Email">
   	<button name="recovery_submit" class="btn mt-2">Recuperează</button>
   	</form>
   	</div>
   </div>
<?php } else if(isset(Config::$_url[1]))
$recovery = Config::queryOne('SELECT * FROM recovery WHERE `token` = "'.Config::$_url[1].'"');

if (!isset($recovery->id)) Config::alert('error', 'Token invalid!', '#');

if (isset($_POST['validate_submit'])) {
	Config::queryOne('UPDATE accounts SET password = "'.password_hash(Config::antiXSS($_POST['password']), PASSWORD_DEFAULT).'" WHERE id = '.$recovery->user_id.'');

	Config::queryOne('DELETE FROM recovery WHERE user_id = '.$recovery->user_id.'');

	Config::alert('success', 'Parola a fost modificată cu succes!', 'login');
}
{
?>      <div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Schimbă-ți parola</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
<div class="container-fluid pb-4 pt-4">
   <div class="container row-center">
   	<form method="POST">
   	<input type="password" name="password" class="form-control" placeholder="Noua parolă">
   	<button name="validate_submit" class="btn mt-2">Modifică</button>
   	</form>
   	</div>
   </div>
?>
<?php } ?>