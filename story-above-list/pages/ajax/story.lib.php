<?php

function story_day_length()
{
    return 86400;
}

function story_max_active()
{
    return 6;
}

function story_formats()
{
    return array(
        'image' => array('jpg', 'jpeg', 'png', 'gif', 'webp'),
        'video' => array('mp4', 'm4v', 'mov', 'webm'),
        'audio' => array('webm', 'ogg', 'opus', 'mp3', 'm4a', 'aac', 'wav'),
    );
}

function story_limits()
{
    return array('image' => 4194304, 'video' => 12582912, 'audio' => 6291456);
}

function story_kind_of($extension)
{
    foreach (story_formats() as $kind => $list) {
        if (in_array($extension, $list)) {
            return $kind;
        }
    }
    return false;
}

function story_dir()
{
    $root = rtrim(str_replace('\\', '/', (string) ($_SERVER['DOCUMENT_ROOT'] ?? '')), '/');
    $dir = ($root !== '' ? $root : '.') . '/theme/stories/';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    return $dir;
}

function story_allowed()
{
    global $options;
    $useroptions = json_decode((string) ($options['useroptions'] ?? ''), true);
    $key = isset($useroptions['story']) ? 'story' : 'voicesend';
    return chatroom::checkPermission($key);
}

function story_json($data)
{
    if (!headers_sent()) {
        header('Content-Type: application/json; charset=utf-8');
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit();
}

function story_fail($message)
{
    story_json(array('ok' => 0, 'error' => $message));
}

function story_ensure_tables()
{
    @db::query("CREATE TABLE IF NOT EXISTS `{prefix}story` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT, `userid` int(10) unsigned NOT NULL DEFAULT '0', `username` varchar(60) COLLATE utf8mb3_persian_ci NOT NULL DEFAULT '', `kind` varchar(8) COLLATE utf8mb3_persian_ci NOT NULL DEFAULT 'text', `url` varchar(190) COLLATE utf8mb3_persian_ci NOT NULL DEFAULT '', `filename` varchar(120) COLLATE utf8mb3_persian_ci NOT NULL DEFAULT '', `body` text COLLATE utf8mb3_persian_ci, `bg` varchar(7) COLLATE utf8mb3_persian_ci NOT NULL DEFAULT '', `dur` smallint(5) unsigned NOT NULL DEFAULT '0', `views` int(10) unsigned NOT NULL DEFAULT '0', `time` int(10) unsigned NOT NULL DEFAULT '0', `expire` int(10) unsigned NOT NULL DEFAULT '0', PRIMARY KEY (`id`), KEY `expire` (`expire`), KEY `userid` (`userid`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci");
    @db::query("CREATE TABLE IF NOT EXISTS `{prefix}story_view` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT, `story` int(10) unsigned NOT NULL DEFAULT '0', `userid` int(10) unsigned NOT NULL DEFAULT '0', `name` varchar(60) COLLATE utf8mb3_persian_ci NOT NULL DEFAULT '', `time` int(10) unsigned NOT NULL DEFAULT '0', PRIMARY KEY (`id`), UNIQUE KEY `story` (`story`,`userid`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci");
}

function story_guard()
{
    if (!session('id')) {
        story_fail('ابتدا وارد شوید');
    }
    if (!story_allowed()) {
        story_fail('برای شما باز نیست');
    }
    story_ensure_tables();
    $me = Users::Inputs();
    if (($me['silent'] ?? '0') == '1') {
        story_fail('شما ساکت شده اید');
    }
    return (int) session('id');
}

function story_trim_bad($str)
{
    $clean = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', (string) $str);
    return is_string($clean) ? $clean : '';
}

function story_count_active($userid)
{
    $query = db::query("SELECT COUNT(*) AS `c` FROM `{prefix}story` WHERE `userid`='" . (int) $userid . "' AND `expire` > " . time());
    if (!($query instanceof mysqli_result)) {
        return 0;
    }
    $row = mysqli_fetch_assoc($query);
    mysqli_free_result($query);
    return (int) ($row['c'] ?? 0);
}

function story_last_post_time($userid)
{
    $query = db::query("SELECT MAX(`time`) AS `t` FROM `{prefix}story` WHERE `userid`='" . (int) $userid . "'");
    if (!($query instanceof mysqli_result)) {
        return 0;
    }
    $row = mysqli_fetch_assoc($query);
    mysqli_free_result($query);
    return (int) ($row['t'] ?? 0);
}

function story_row($id)
{
    $query = db::query("SELECT `id`,`userid`,`username`,`kind`,`url`,`filename`,`body`,`bg`,`dur`,`views`,`time`,`expire` FROM `{prefix}story` WHERE `id`='" . (int) $id . "' LIMIT 1");
    if (!($query instanceof mysqli_result)) {
        return null;
    }
    $row = mysqli_fetch_assoc($query);
    mysqli_free_result($query);
    return $row ? $row : null;
}

function story_was_seen($story, $userid)
{
    $query = db::query("SELECT `id` FROM `{prefix}story_view` WHERE `story`='" . (int) $story . "' AND `userid`='" . (int) $userid . "' LIMIT 1");
    if (!($query instanceof mysqli_result)) {
        return false;
    }
    $row = mysqli_fetch_assoc($query);
    mysqli_free_result($query);
    return $row ? true : false;
}

function story_extension_from($original_name, $mime)
{
    $mime = strtolower((string) $mime);
    foreach (story_formats() as $list) {
        if (in_array(strtolower((string) pathinfo((string) $original_name, PATHINFO_EXTENSION)), $list)) {
            return strtolower((string) pathinfo((string) $original_name, PATHINFO_EXTENSION));
        }
    }
    $map = array(
        'jpeg' => 'jpg', 'jpg' => 'jpg', 'png' => 'png', 'gif' => 'gif', 'webp' => 'webp',
        'mp4' => 'mp4', 'quicktime' => 'mov', 'x-m4v' => 'm4v', 'mpeg' => 'mp3',
        'mp3' => 'mp3', 'aac' => 'aac', 'wav' => 'wav', 'wave' => 'wav',
        'vnd.wave' => 'wav', 'ogg' => 'ogg', 'oga' => 'ogg', 'opus' => 'opus',
        'webm' => 'webm', 'x-webm' => 'webm', 'mp4a-latm' => 'm4a', 'x-m4a' => 'm4a',
    );
    foreach (array('image/', 'audio/', 'video/') as $prefix) {
        if (strpos($mime, $prefix) === 0) {
            $tail = substr($mime, strlen($prefix));
            $tail = preg_replace('/[^\w.+-].*$/', '', $tail);
            if (isset($map[$tail])) {
                return $map[$tail];
            }
        }
    }
    return false;
}

function story_purge()
{
    $query = db::query("SELECT `filename` FROM `{prefix}story` WHERE `expire` < " . time());
    if ($query instanceof mysqli_result) {
        $dir = story_dir();
        while ($row = mysqli_fetch_assoc($query)) {
            $name = basename((string) $row['filename']);
            if ($name !== '' && is_file($dir . $name)) {
                @unlink($dir . $name);
            }
        }
        mysqli_free_result($query);
    }
    db::query("DELETE FROM `{prefix}story` WHERE `expire` < " . time());
    db::query("DELETE v FROM `{prefix}story_view` AS v LEFT JOIN `{prefix}story` AS s ON s.`id`=v.`story` WHERE s.`id` IS NULL");
}
