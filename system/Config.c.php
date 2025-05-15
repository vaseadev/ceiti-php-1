<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Config {

private static $instance;

public static $g_con;
public static $_url = array();
public static $loginSessionName = 'user_login_afs123asd';
public static $administratorEmail = 'user_login_afs123asd';

public static $URL = 'http://localhost/ceiti-php-1/';
public static $SITENAME = 'Magazin Auto';

private function __construct() {
		$db['mysql'] = array(
			'host' 		=>	Database::$host,
			'username' 	=> 	Database::$username,
			'dbname' 	=> 	Database::$dbname,
			'password' 	=> 	Database::$password
		);

try {
	self::$g_con = new PDO('mysql:host='.$db['mysql']['host'].';dbname='.$db['mysql']['dbname'].';charset=utf8',$db['mysql']['username'],$db['mysql']['password']);
	self::$g_con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	self::$g_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	@file_put_contents('error_log',@file_get_contents('error_log') . $e->getMessage() . "\n");
	die(Module::databaseProblem());
}
	self::_getUrl();
}

public static function query($prepare) {
	$query = Config::$g_con->prepare($prepare); $query->execute(); 
	$query = $query->fetchAll(PDO::FETCH_OBJ);
	return $query;
}

public static function queryOne($prepare) {
	$query = Config::$g_con->prepare($prepare); $query->execute(); 
	$query = $query->fetch(PDO::FETCH_OBJ);
	return $query;
}

public static function isLogged()
{
	if (isset($_SESSION[self::$loginSessionName])) return 1; else return 0;
}

public static function getUser()
{
	if (isset($_SESSION[self::$loginSessionName])) return $_SESSION[self::$loginSessionName]; else return 0;
}

public static function getTitleAdmin($admin)
{
	switch($admin) {
		case 1: return "Moderator";
		case 2: return "Administrator";
	}
}

public static function getHTMLStarsService($service_id)
{
	$reviews = Config::query('SELECT * FROM reviews WHERE service_id = '.$service_id.'');

	$sum_stars = 0;
	$count_stars = 0;
	$html = '';

	foreach ($reviews as $review) {
		$count_stars++;
		$sum_stars += $review->stars;
	}

	if ($sum_stars > 0 && $count_stars > 0) {
		for ($i = 1; $i <= $sum_stars/$count_stars; $i++) {
			$html .= '<i class="fa fa-star"></i>';
		}
	} else {
		return '';
	}

	return $html;
}

public static function myAcc($myAcc, $column)
{
	if ($myAcc) {
		if (isset($myAcc->$column)) return $myAcc->$column; else return 0;
	} else return 0;
}

public static function onlyLogged()
{
	if (!self::isLogged()) Config::alert("danger", "Trebuie să te loghezi!", "login");
}

public static function onlyGuest()
{
	if (self::isLogged()) Config::alert("danger", "Nu trebuie să fii logat!", "#");
}

public static function getIP()
{ 
	return $_SERVER['REMOTE_ADDR']; 
}

public static function alert($type, $message, $redirect = null, $die = null)
{
	self::alertOpen($type, $message, $redirect);
	if ($die == null) die();
}

public static function alertOpen($type, $message, $redirect = null)
{
	if ($redirect != null) echo '<meta http-equiv="refresh" content="0; url='.self::$URL.''.$redirect.'">';
	else if ($redirect === "#") echo '<meta http-equiv="refresh" content="0; url='.self::$URL.'">';
	else echo '<meta http-equiv="refresh" content="0;">'; 

    echo "<script>localStorage.clear()</script>";
    echo "<script>localStorage.setItem('alertHTMLKeNNy', JSON.stringify([type='".$type."', message='".$message."']))</script>";
}

public static function formatUnix($time, $type = null)
{
	// type: null = format, 1 - time ago
	if ($time == 0) return 'undefined';

	if ($type == null) {
		$date = date('d.m.Y H:i', $time);
	}

	if ($type == 1) {
		$hours = ((time() - $time) / 60)/60;
		$days = $hours / 24;
		$date = floor($days);
	}

	return $date;
}

public static function init()
{
	if (is_null(self::$instance)) self::$instance = new self();
	return self::$instance;
}


private static function _getUrl()
{
    $url = rtrim($_GET['page'] ?? '', '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    self::$_url = explode('/', $url);
}

public static function getContent()
{
	$separated_pages = [];

	if(isset(self::$_url[0]) && !strlen(self::$_url[0])) { 
		include_once 'system/Header.php';
		include_once 'system/pages/index.vartic.php';
		include_once 'system/Footer.php';
	}

	else if(file_exists('system/pages/'.self::$_url[0].'.vartic.php') && in_array(self::$_url[0], $separated_pages)) {
		include 'system/pages/'.self::$_url[0].'.vartic.php';
	}

	else if(file_exists('system/pages/' . self::$_url[0] . '.vartic.php')) {
		include_once 'system/Header.php';
		include 'system/pages/' . self::$_url[0] . '.vartic.php';
		include_once 'system/Footer.php';
	} else {
		include_once 'system/Header.php';
		include_once 'system/pages/404.vartic.php'; 
		include_once 'system/Footer.php';
	}
}

public static function liHeaderActive($active)
{
	if(is_array($active)) {
		foreach($active as $ac) {
			if($ac === self::$_url[0]) return ' active';
		}
	return;
	} else return self::$_url[0] === $active ? ' active' : false;
}

public static function antiXSS($text)
{
	return htmlspecialchars(strip_tags($text));
}

public static function cleanText($text = null)
{
	if (strpos($text, 'script') !== false) return '<small>Caractere invalide!</small>';
	if (strpos($text, 'meta') !== false) return '<small>Caractere invalide!</small>';
	if (strpos($text, 'document.location') !== false) return '<small>Caractere invalide!</small>';
	if (strpos($text, 'php') !== false) return '<small>Caractere invalide!</small>';
	if (strpos($text, '"') !== false) return '<small>Caractere invalide!</small>';
	if (strpos($text, 'src') !== false) return '<small>Caractere invalide!</small>';

	$rezultat = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', "<a href='$1' target='_blank' rel='nofollow'>$1</a>", $text);
	return $rezultat;
}

public static function getCategory($data, $category_id)
{
	$q = Config::$g_con->prepare('SELECT '.$data.' FROM categories WHERE id = ?');
	$q->execute(array($category_id));
	if (!$q->rowCount()) return 0;
	$r_data = $q->fetch();
	return $r_data[$data];
}

public static function getAcc($data, $id = null)
{
	if ($id == null) $id = Config::getUser();
	$q = Config::$g_con->prepare('SELECT '.$data.' FROM accounts WHERE id = ?');
	$q->execute(array($id));
	if (!$q->rowCount()) return 0;
	$r_data = $q->fetch();
	return $r_data[$data];
}

public static function getAccFromName($data, $name)
{
	$q = Config::$g_con->prepare('SELECT '.$data.' FROM accounts WHERE name = ?');
	$q->execute(array($name));
	if (!$q->rowCount()) return 0;
	$r_data = $q->fetch();
	return $r_data[$data];
}

public static function getAccFromEmail($data, $email)
{
	$q = Config::$g_con->prepare('SELECT '.$data.' FROM accounts WHERE email = ?');
	$q->execute(array($email));
	if (!$q->rowCount()) return 0;
	$r_data = $q->fetch();
	return $r_data[$data];
}

public static function getData($table, $data, $id)
{
	$q = Config::$g_con->prepare('SELECT '.$data.' FROM '.$table.' WHERE id = ?');
	$q->execute(array($id));
	$r_data = $q->fetch();
	return $r_data[$data];
}

public static function getName($id = null)
{
	if ($id == null) $id = Config::getUser();
	$q = Config::$g_con->prepare('SELECT name FROM accounts WHERE id = ?');
	$q->execute(array($id));
	if (!$q->rowCount()) return "None";
	$r_data = $q->fetch();
	return $r_data['name'];
}

public static function formatName($target)
{
	if (is_numeric($target)) $db = "id"; else $db = "name";

	$q = Config::$g_con->prepare('SELECT name, id FROM accounts WHERE '.$db.' = ?');
	$q->execute(array($target));
	if (!$q->rowCount()) return "None";

	$acc = $q->fetch();
	return "<a href='".Config::$URL."profile/".$acc['id']."'>".$acc['name']."</a>";
}

public static function getEditable($data, $type)
{
	$q = Config::$g_con->prepare('SELECT '.$data.' FROM editables WHERE type = ?');
	$q->execute(array($type));
	if (!$q->rowCount()) return 0;
	$r_data = $q->fetch();
	return $r_data[$data];
}

public static function randomString($length = 10)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';

	for ($i = 0; $i < $length; $i++) {
	$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

} 
?>