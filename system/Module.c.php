<?php class Module { 
	public static function iconRedWishlist($service_id)
	{
		$c = Config::queryOne('SELECT id FROM wishlist WHERE service_id = '.$service_id.' LIMIT 1');
		if (isset($c->id)) return 1; else return 0;
	}


public static function insertImage($image) {
  $img=$image;
  $filename = $img['tmp_name'];
  $type = mime_content_type($filename);

if ($type == "image/png" OR $type == "image/jpeg" OR $type == "image/JPEG" OR $type == "image/PNG") echo ''; else {
Config::alert("warning", "Actiunea a esuat! Doar imaginile (PNG, JPG, JPEG) sunt permise.");
};

  $client_id = "b234bda60e00570";
  $handle = fopen($filename, "r");
  $data = fread($handle, filesize($filename));
  $pvars   = array('image' => base64_encode($data));
  $timeout = 30;
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
  curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
  $out = curl_exec($curl);
  curl_close ($curl);
  $pms = json_decode($out,true);
  $url=$pms['data']['link'];
   return $url;
}

	public static function databaseProblem()
	{
		return '
			<title>Problemă tehnică</title>
			<style>
			body { text-align: center; padding: 150px; }
			h1 { font-size: 50px; }
			body { font: 20px Helvetica, sans-serif; color: #333; }
			article { display: block; text-align: left; width: 650px; margin: 0 auto; }
			a { color: #dc8100; text-decoration: none; }
			a:hover { color: #333; text-decoration: none; }
			</style>
			<article>
			<h1>Site-ul întâmpină probleme tehnice!</h1>
			<div>
			<meta http-equiv="refresh" content="3">
			<p>Vă rugăm să reveniți.</p>
			<p>&mdash; '.Config::$SITENAME.'</p>
			</div>
			</article>
		';
	}
	
	public static function getHeaderPageActive($page)
	{
		if (!strlen($page)) return 'Acasă';

		switch($page) {
			case "profile": return "Profil";
			case "search": return "Caută utilizator";
			case "recovery": return "Recuperează parola";
			case "confirm": return "Confirmare email";
			case "tests": return "Teste";
			case "admin": return "Administrare";
			default: return "undefined";
		}
	}

	public static function sendMail($to, $from, $subject, $body)
	{
		$to = Config::antiXSS($to);
		$from = Config::antiXSS($from);
		$subject = Config::antiXSS($subject);
		$message = $body;
		$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers = "From: $from"; 
		$ok = @mail($to, $subject, $message, $headers, "-f " . $from); 
	}

	public static function insert_confirm_emails($user_id, $to_email, $type, $code, $data)
	{
        $insert = Config::$g_con->prepare('INSERT INTO confirm_emails (user_id, to_email, type, code, data, unix) VALUES (?, ?, ?, ?, ?, ?)');
        $insert->execute(array($user_id, $to_email, $type, $code, $data, time()));
	}

	public static function insert_followers($user_id, $follower_id)
	{
        $insert = Config::$g_con->prepare('INSERT INTO followers (user_id, follower_id, unix) VALUES (?, ?, ?)');
        $insert->execute(array($user_id, $follower_id, time()));
	}

	public static function insert_category($title, $added_by)
	{
        $insert = Config::$g_con->prepare('INSERT INTO categories (title, added_by, added_unix, edited_by, edited_unix) VALUES (?, ?, ?, ?, ?)');
        $insert->execute(array($title, $added_by, time(), $added_by, time()));
	}

	public static function insert_subcategory($category_id, $title, $added_by)
	{
        $insert = Config::$g_con->prepare('INSERT INTO subcategories (category_id, title, added_by, added_unix, edited_by, edited_unix) VALUES (?, ?, ?, ?, ?, ?)');
        $insert->execute(array($category_id, $title, $added_by, time(), $added_by, time()));
	}

	public static function insert_chapter($subcategory_id, $title, $added_by)
	{
        $insert = Config::$g_con->prepare('INSERT INTO chapters (subcategory_id, title, added_by, added_unix, edited_by, edited_unix) VALUES (?, ?, ?, ?, ?, ?)');
        $insert->execute(array($subcategory_id, $title, $added_by, time(), $added_by, time()));
	}

	public static function insert_question($chapter_id, $question, $answers, $nr_page, $count_answers, $added_by)
	{
        $insert = Config::$g_con->prepare('INSERT INTO questions (chapter_id, question, answers, nr_page, count_answers, added_by, added_unix, edited_by, edited_unix) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $insert->execute(array($chapter_id, $question, $answers, $nr_page, $count_answers, $added_by, time(), $added_by, time()));
	}
} ?>