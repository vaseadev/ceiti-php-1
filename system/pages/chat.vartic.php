<?php 
Config::onlyLogged();

$chats = Config::query('SELECT * FROM chat ORDER BY id DESC');

   if (isset($_POST['addChat']))
   {
      $insert = Config::$g_con->prepare('INSERT INTO chat (user_id, message, unix) VALUES (?, ?, ?)');
      $insert->execute(array(Config::getUser(), Config::antiXSS($_POST['message']), time()));

      Config::alert('success', 'Postat cu succes!');
   }

   if (isset($_POST['deleteComment']) && $myAcc->admin)
   {
	   Config::query('DELETE FROM chat WHERE id = '.floor($_POST['deleteComment']).'');
	   Config::alert('success', 'Comentariul a fost șters cu succes!');
   }

   if (isset($_POST['deleteAllChat']) && $myAcc->admin)
   {
	   Config::query('DELETE FROM chat');
	   Config::alert('success', 'Chat-ul a fost șters cu succes!');
   }
?>
<div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
   <div class="container-fluid no page-header-overlay">
      <div class="container row-center">
         <div class="row">
            <div class="col-12 pt-4 text-center text-md-left">
               <h2>Chat</h2>
            </div>
         </div>
      </div>
   </div>
</div>          
<div class="container-fluid pb-4 pt-4">
   <div class="container row-center">
            <div class="col-md-12 page-content">
               <form method="POST">
                  <textarea name="message" class="form-control" placeholder="Text" style="height:80px" required></textarea>
                  <button type="submit" name="addChat" class="btn btn-primary mt-2">Adaugă în chat</button>
               </form>
               <p>
                 <?= '<hr>' ?>
                  <?php foreach ($chats as $chat) { ?>
               <div class="mb-4">
  <img style="vertical-align:middle; border-radius: 100%" src="https://i.imgur.com/WNZtJWu.jpg" width="40vw">
<?php if ($myAcc->admin) { ?>
<form style="display: inline-block" method="POST">
	<button style="cursor: pointer; border: 0; background: none; color: red" name="deleteComment" value="<?= floor($chat->id) ?>"><i class="fa fa-remove"></i></button>
</form>
<?php } ?>
(<?= Config::formatUnix($chat->unix) ?>)
  <br><b><a href="<?= Config::$URL ?>profile/<?= floor($chat->user_id) ?>"><?= Config::getAcc('name', $chat->user_id) ?></a></b>: <?= Config::antiXSS($chat->message) ?>
</div>
<?php } if (count($chats) <= 0) echo '<br>Chat-ul este gol!'; ?>
               </p>
               <?php if ($myAcc->admin) { ?>
               <form method="POST">
               	<button name="deleteAllChat" class="btn">Șterge tot chat-ul!</button>
               </form>
           <?php } ?>
            </div>
        </div>
    </div>