<?php
// فقط خواندنی: خط‌های مربوط به story را از چند فایل مشخص و از تنظیم‌های دیتابیس نشان می‌دهد.
// بعد از استفاده حتماً حذفش کن. آدرس: /findstory?k=3e98c952
if (!isset($_GET['k']) || $_GET['k'] !== '3e98c952') { http_response_code(404); exit; }
header('Content-Type: text/plain; charset=utf-8');
set_time_limit(60);
$root = dirname(dirname(__FILE__));

function fs_lines($root, $rel, $regex, $max) {
    $p = $root . '/' . $rel;
    echo "\n--- " . $rel . " ---\n";
    if (!is_file($p)) { echo "(فایل نیست)\n"; return; }
    $lines = @file($p);
    if ($lines === false) { echo "(خوانده نشد)\n"; return; }
    $n = 0;
    foreach ($lines as $i => $line) {
        if (!preg_match($regex, $line)) continue;
        if (preg_match('/pass|db_user|db_name|db_server|token|secret|loginkey/i', $line)) continue;
        echo ($i + 1) . ': ' . substr(trim(preg_replace('/\s+/', ' ', $line)), 0, 240) . "\n";
        if (++$n >= $max) { echo "...\n"; break; }
    }
    if (!$n) echo "(خطی پیدا نشد)\n";
}

function fs_keys($data, $path, &$out) {
    if (!is_array($data)) return;
    foreach ($data as $k => $v) {
        $p = $path . '/' . $k;
        if (stripos((string)$k, 'story') !== false) {
            $out[] = $p . ' = ' . substr(json_encode($v, JSON_UNESCAPED_UNICODE), 0, 200);
        }
        if (is_array($v)) fs_keys($v, $p, $out);
    }
}

echo "== 1) خط‌های story در فایل‌های مهم ==\n";
fs_lines($root, 'inc/config.php', '/story/i', 25);
fs_lines($root, 'inc/classes/theme.php', '/story/i', 25);
fs_lines($root, 'theme/adminpanel/setting.themes.php', '/story/i', 25);
fs_lines($root, 'theme/adminpanel/restriction.useroptions.php', '/story/i', 25);
fs_lines($root, 'pages/ajax/admin.setting.themes.php', '/story/i', 25);
fs_lines($root, 'pages/ajax/admin.restriction.useroptions.php', '/story/i', 25);
fs_lines($root, 'pages/ajax/core.php', '/story/i', 25);
fs_lines($root, 'pages/in.php', '/story/i', 25);
fs_lines($root, 'theme/js/dstarter.js', '/story/i', 25);
fs_lines($root, 'theme/js/story.js', '/(enable|active|config|setting|window\.|\.story_)/i', 30);

echo "\n== 2) تنظیم‌های story داخل دیتابیس ==\n";
$cfg = @file_get_contents($root . '/inc/config.php');
$db = array();
if ($cfg !== false && preg_match_all("/define\(\s*['\"](db_[a-z]+)['\"]\s*,\s*['\"]([^'\"]*)['\"]/i", $cfg, $m, PREG_SET_ORDER)) {
    foreach ($m as $x) { $db[strtolower($x[1])] = $x[2]; }
}
if (!isset($db['db_server'], $db['db_user'], $db['db_pass'], $db['db_name'])) {
    echo "مشخصات دیتابیس خوانده نشد.\n";
} else {
    $link = @mysqli_connect($db['db_server'], $db['db_user'], $db['db_pass'], $db['db_name']);
    if (!$link) {
        echo "اتصال به دیتابیس نشد.\n";
    } else {
        @mysqli_set_charset($link, 'utf8');
        $t = (isset($db['db_prefix']) ? $db['db_prefix'] : '') . 'options';
        $r = mysqli_query($link, 'SELECT name, value FROM `' . $t . '`');
        $out = array();
        while ($r && ($row = mysqli_fetch_assoc($r))) {
            $data = json_decode($row['value'], true);
            if (is_array($data)) { fs_keys($data, $row['name'], $out); }
            elseif (stripos($row['name'], 'story') !== false) { $out[] = $row['name'] . ' = ' . substr($row['value'], 0, 200); }
        }
        if ($out) { foreach ($out as $l) echo $l . "\n"; } else { echo "هیچ کلیدی با story در تنظیم‌ها پیدا نشد.\n"; }

        echo "\nستون‌های جدول story:\n";
        $c = mysqli_query($link, 'SHOW COLUMNS FROM `' . $db['db_prefix'] . 'story`');
        while ($c && ($col = mysqli_fetch_assoc($c))) { echo '  ' . $col['Field'] . ' (' . $col['Type'] . ")\n"; }
    }
}
echo "\nتمام شد.\n";
