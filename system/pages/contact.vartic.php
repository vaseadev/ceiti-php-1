<?php
if (isset($_POST['contact']))
{
   $to = Config::antiXSS($_POST['to']);
   $from = Config::$administratorEmail;
   $subject = "Contacteaza-ma, ".Config::antiXSS($_POST['surname']);
   $body = Config::antiXSS($_POST['body']);

   if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
     Config::alert('error', 'Email-ul nu este unul valid!');
   }

   Module::sendMail($to, $from, $subject, $body);

   Config::alert('success', 'Un administrator te va contacta in cel mai rapid timp posibil!');
}
?>

<div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
   <div class="container-fluid no page-header-overlay">
      <div class="container row-center">
         <div class="row">
            <div class="col-12 pt-4 text-center text-md-left">
               <h2>Contact</h2>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container-fluid no py-2">
   <div class="container-fluid row-center">
      <div class="row pt-4 page-content">
         <div class="col-md-4 col-12 contact-info pt-3">
            <h3>Date contact</h3>
            <div class="media">
               <div class="media-body">
                  <p>
                  </p>
                  <p>Bulevardul Dacia<br> Chișinău, Republica Moldova</p>
                  <p></p>
               </div>
            </div>
            <div class="media">
               <div class="media-body">
                  <p>
                     068674812                        
                  </p>
               </div>
            </div>
            <div class="media">
               <div class="media-body">
                  <p>
                     <a href="#">contact@beautyhealth.md</a>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-8 col-12 form-contact py-3">
            <h3>Formular contact</h3>
            <div class="text-center py-1 mt-4"> </div>
            <form method="POST">
               <div class="form-group mb-2">
                  <input type="text" class="form-control" name="surname" placeholder="Nume și prenume" required>
               </div>
               <div class="form-group mb-2">
                  <input type="email" class="form-control" name="to" placeholder="Adresa de e-mail" required>
               </div>
               <div class="form-group mb-2">
                  <textarea class="form-control" name="body" placeholder="Mesaj" rows="8" required></textarea>
               </div>
               <div class="form-group text-right">
                  <button name="contact" class="btn btn-primary button-contact">Trimite mesaj</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="container-fluid header-page contact-header">
   <div class="container-fluid row-center pb-4">
      <div class="text-center">
         <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2722.849967743817!2d28.88827901585588!3d46.96463774009506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c97eada902d729%3A0xbb00536d925e7e2b!2sBulevardul%20Dacia%2C%20Chi%C8%99in%C4%83u%2C%20Moldova!5e0!3m2!1sen!2s!4v1651825194026!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>
      </div>
   </div>
</div>