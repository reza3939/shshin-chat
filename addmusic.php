<?php 
if (!session('id') or session('admin') == '0') {
	exit;
}
adminpanel::check_Permission('notfound', 'player');
$error = "";
function get_ext($key) {
	$key = strtolower(substr(strrchr($key, "."), 1));
	$key = str_replace("jpeg", "jpg", $key);
	return $key;
}
if ($_FILES['fileToUpload']) {
	$type = get_ext($_FILES['fileToUpload']['name']);
	if ($type != 'mp3' && $type != 'wma' && $type != 'ogg' && $type != 'amr' && $type != 'mp2') {
		header::Go(url('admin/player/add/type'));
		exit;
	} else {
		$format = get_ext($_FILES['fileToUpload']['name']);
		$folder = 'theme/music';
		$nextid = $sql->where('table_schema', db_name)->where('table_name', db_prefix . 'player')->getValue('information_schema.tables', 'AUTO_INCREMENT');
		$name = "music{$nextid}.{$format}";
		$filename = "{$folder}/{$name}";
		if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $filename)) {
			$img = file_get_contents($filename);
			if (strpos((string) $img, '<?php') !== false) {
				unlink($filename);
				header::Go(url('admin/player/add/security'));
				exit;
			} else {
				$title = safe::string($_REQUEST['title']);
				chatroom::addmusic($title, $filename, $nextid);
				chatroom::addlog('9', "آهنگی اضافه کرد:{$title}");
				header::Go(url('admin/player/add/ok'));
			}
		} else {
			header::Go(url('admin/player/add/noup'));
		}
	}
} else {
	$error = 'noelemrnr';
}
