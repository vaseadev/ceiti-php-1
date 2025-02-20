<?php 
	Config::onlyLogged();
	$polls = Config::query('SELECT * FROM polls ORDER BY id DESC');
	if(!isset(Config::$_url[1])) {
?>

      <div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Sondaje</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid pb-4 pt-4">
         <div class="container row-center">

         	<div class="row">
         		<?php foreach ($polls as $poll) { ?>
         		<div class="col-md-6">
         			<div class="card">
         				<center><h2><b><?= Config::antiXSS($poll->question) ?></b></h2>
         					<?= !$poll->status ? 'sondaj deschis' : 'sondaj închis' ?></center>
         				<?php if (!$poll->status) { ?><a href="<?= Config::$URL ?>polls/vote/<?= floor($poll->id) ?>"><button class="btn">Votează</button></a><?php } ?>
         				<a href="<?= Config::$URL ?>polls/results/<?= floor($poll->id) ?>"><button class="btn float-right">Vezi rezultate</button></a>
         			</div>
         		</div>
         	<?php } ?>
         	</div>

         	</div></div>
<?php } else if(Config::$_url[1] == "vote" && is_numeric(Config::$_url[2])) {
	$vote_poll = Config::queryOne("SELECT * FROM polls WHERE id = ".Config::$_url[2]." LIMIT 1");

	if (!isset($vote_poll->id)) {
		Config::alert("error", "Acest sondaj nu există!", "polls");
	}

	$existVote = Config::queryOne('SELECT id FROM poll_answers WHERE user_id = '.Config::getUser().' && poll_id = '.$vote_poll->id.'');

	if (isset($existVote->id)) {
		Config::alert('error', 'Ai votat deja la acest sondaj!', 'polls');
	}

	if (isset($_POST['send_vote']))
	{

		if (!isset($_POST['poll_answer'])) {
			Config::alert('error', 'Nu ai ales un răspuns!');
		}

	     $insert = Config::$g_con->prepare('INSERT INTO poll_answers (poll_id, user_id, answer, unix) VALUES (?, ?, ?, ?)');
	     $insert->execute(array($vote_poll->id, Config::getUser(), Config::antiXSS($_POST['poll_answer']), time()));

	     Config::alert('success', 'Votul tău la acest sondaj a fost trimis cu succes!', 'polls');
	}
?>

      <div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Sondaje >> votează</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid pb-4 pt-4">
         <div class="container row-center">
         	<div class="card">
         		<form method="POST">
         		<h1><?= Config::antiXSS($vote_poll->question) ?></h1>
         		<?php foreach (json_decode($vote_poll->answers) as $k=>$value) { ?>
         			<input class="mt-2" type="radio" value="<?= Config::antiXSS($value) ?>" name="poll_answer"><font style="font-size: 18px;"><?= Config::antiXSS($value) ?></font><br>
         		<?php } ?>
         		<br>
         		<button name="send_vote" class="btn mt-2">Trimite votul</button>
         	</form>
			</div>
         	</div></div>

<?php } else if(Config::$_url[1] == "results" && is_numeric(Config::$_url[2])) {

   $result_poll = Config::queryOne("SELECT * FROM polls WHERE id = ".Config::$_url[2]." LIMIT 1");

   if (!isset($result_poll->id)) {
      Config::alert("error", "Acest sondaj nu există!", "polls");
   }

   $answers = Config::query('SELECT * FROM poll_answers WHERE poll_id = '.$result_poll->id.'');

   $count_answers = Config::queryOne('SELECT COUNT(id) AS countAnswers FROM poll_answers WHERE poll_id = '.$result_poll->id.'');
   $count_answers = $count_answers->countAnswers;

   $answers_data = [];
   foreach ($answers as $answer) {
      array_push($answers_data, $answer->answer);
   }

   $answers_count = [];
   $answers_percent = [];
   foreach (array_unique($answers_data) as $answer) {
      $answers_count[$answer] = count(array_keys($answers_data, $answer));
      $answers_percent[$answer] = (100*$answers_count[$answer])/$count_answers;
   }

   arsort($answers_count);
?>

<style type="text/css">
/* Three column layout */
.side {
  float: left;
  width: 15%;
  margin-top: 10px;
}

.middle {
  float: left;
  width: 70%;
  margin-top: 10px;
}

/* Place text to the right */
.right {
  text-align: right;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* The bar container */
.bar-container {
  width: 100%;
  background-color: #f1f1f1;
  text-align: center;
  color: white;
}

/* Individual bars */
.bar-5 {width: 60%; height: 18px; background-color: #04AA6D;}
.bar-4 {width: 30%; height: 18px; background-color: #2196F3;}
.bar-3 {width: 10%; height: 18px; background-color: #00bcd4;}
.bar-2 {width: 4%; height: 18px; background-color: #ff9800;}
.bar-1 {width: 15%; height: 18px; background-color: #f44336;}

/* Responsive layout - make the columns stack on top of each other instead of next to each other */
@media (max-width: 400px) {
  .side, .middle {
    width: 100%;
  }
  /* Hide the right column on small screens */
  .right {
    display: none;
  }
}
</style>

      <div class="container-fluid no margin-mobile page-header-bg" style="background-image:url(https://i.imgur.com/YnwNnPp.jpg);">
         <div class="container-fluid no page-header-overlay">
            <div class="container row-center">
               <div class="row">
                  <div class="col-12 pt-4 text-center text-md-left">
                     <h2>Sondaje >> rezultate</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid pb-4 pt-4">
         <div class="container row-center">
<p>La acest sondaj au votat <?= $count_answers ?> persoane.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">

<?php foreach ($answers_count as $answer=>$count) { ?>
  <div class="side">
    <div><?= Config::antiXSS($answer) ?> (<?= $count ?> votes)</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div style="width: <?= $answers_percent[$answer] ?>%" class="bar-5"></div>
    </div>
  </div>
  <div class="side right">
    <div><?= number_format($answers_percent[$answer], 2) ?>%</div>
  </div>
<?php } ?>

</div>
            </div></div>

<?php } else Config::alert('', '', '404'); ?>