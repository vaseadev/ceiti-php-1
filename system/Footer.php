<?php
if (isset($_POST['contact_footer']))
{
   $to = Config::antiXSS($_POST['email']);
   $from = Config::$administratorEmail;
   $subject = "Contacteaza-ma, ".Config::antiXSS($_POST['telephone']);
   $body = Config::antiXSS("Te rog sa ma suni!");

   if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
     Config::alert('error', 'Email-ul nu este unul valid!');
   }

   Module::sendMail($to, $from, $subject, $body);

   Config::alert('success', 'Un administrator te va contacta in cel mai rapid timp posibil!');
}
?>

      <div class="container-fluid no parallax-bg" style="background-image:url(https://i.imgur.com/5hTJzyEh.jpg);">
         <div class="container-fluid no bg-overlay">
            <div class="container">
               <div class="row pt-2 pb-4">
                  <div class="col-12 text-center scrollpoz">
                     <img class="parallax-logo" src="https://i.imgur.com/3DeHjIZ.png">
                     <h2>De ce să ne alegi pe noi?</h2>
                     <p>Utilajele, echipamentele și tehnologiile sunt de ultimă generație, împreună cu specialiștii noștri și managerii profesioniști. Spectru complex al analizelor medicale cu rezultate disponibile în cel mai scurt timp.</p>
                     <a class="btn btn-default mt-4" href="<?= Config::$URL ?>about">Vezi detalii despre noi</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid no border-top py-4">
         <div class="container row-center">
            <div class="row">
               <div class="col-sm-4 col-12 section-info text-center py-3 ">
                  <img src="https://i.imgur.com/Ft6TF92.png"/>
                  <h5>Calitate</h5>
                  <p>Vă promitem cea mai înaltă calitate.</p>
               </div>
               <div class="col-sm-4 col-12 section-info text-center py-3 ">
                  <img src="https://i.imgur.com/ach9FwJ.png"/>
                  <h5>Drept de retur</h5>
                  <p>Returnare bani dacă nu vă mulțumesc serviciile.</p>
               </div>
               <div class="col-sm-4 col-12 section-info text-center py-3 ">
                  <img src="https://i.imgur.com/e2qOyxe.png"/>
                  <h5>Modalități de plata</h5>
                  <p>Acceptăm plata cash, dar și plata cu cardul.</p>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid no bg-light newsl-bg">
         <div class="container row-center">
            <div class="row py-4 pb-2">
               <div class="col-md-6 text-md-left pt-4 pb-2">
                  <h4>Contactează-ne!</h4>
                  <p>Lasă-ne numărul de telefon și email-ul, iar noi te vom suna!</p>
               </div>
               
               <div class="col-md-6 text-md-left pt-4 pb-2">
                  <form method="POST">
                  <div class="row">
                     <div class="col-md-4">
                        <input name="telephone" type="text" class="form-control emailfooter" placeholder="Nr. Telefon"/>
                     </div>
                     <div class="col-md-4">
                        <input name="email" type="text" class="form-control telfooter" placeholder="Adresa de e-mail"/>
                     </div>
                     <div class="col-md-4">
                        <button name="contact_footer" type="submit" class="btn btn-primary btn-block btn-contactfooter">Trimite</button>
                     </div>
                  </div>
                  </form>
               </div>
            
            </div>
         </div>
      </div>
      <div class="container-fluid no mini-footer">
         <div class="container row-center">
            <div class="row pt-2 pb-1">
               <div class="col-md-9 text-center text-md-left">
                  <p>Copyright BeautyHealth. Toate drepturile rezervate.</p>
               </div>
               <div class="col-md-3 text-center text-md-right">
                  <p><a href="#" target="_blank">Developed by Vartic Vasile</a> </p>
               </div>
            </div>
         </div>
      </div>
      <!-- <script src="js/scripts.js"></script> -->
      <script type="text/javascript" src="<?= Config::$URL ?>template/js/custom.js"></script>
		<script type='text/javascript' src='https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'></script>
   </body>
</html>