<?php
// فقط خواندنی: پیدا می‌کند آیکون ساعت (تایمر) کنار کاربران در لیست آنلاین از کدام فایل می‌آید.
// بعد از استفاده حتماً حذفش کن. آدرس: /findtimer?k=3e98c952
if (!isset($_GET['k']) || $_GET['k'] !== '3e98c952') { http_response_code(404); exit; }
header('Content-Type: text/plain; charset=utf-8');
set_time_limit(60);
$root = dirname(dirname(__FILE__));
$RE = '/(timer|idle|afk|away|clock|sleep|tlimit|limit_?time)/i';

function skip_path($rel) {
    return (bool)preg_match('/jquery|elfinder|hashchange|mylibs|\.min\.|mobile-1|backup|story-above-list|\/m\/js\/|adminpanel|emergency/i', $rel);
}

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS));
$hits = array(); $files = array(); $imgs = array();
foreach ($it as $f) {
    if (!$f->isFile()) continue;
    $ext = strtolower($f->getExtension());
    $rel = substr($f->getPathname(), strlen($root) + 1);
    if (in_array($ext, array('png', 'gif', 'jpg', 'jpeg', 'svg')) && preg_match($RE, $f->getFilename())) {
        if (count($imgs) < 30) $imgs[] = $rel;
        continue;
    }
    if (!in_array($ext, array('php', 'js', 'inc', 'html', 'tpl', 'css'))) continue;
    if ($f->getSize() > 2 * 1024 * 1024) continue;
    if (skip_path($rel) || $f->getFilename() === basename(__FILE__)) continue;
    $c = @file_get_contents($f->getPathname());
    if ($c === false) continue;
    $n = preg_match_all($RE, $c);
    if ($n > 0) { $hits[$rel] = $n; $files[$rel] = $c; }
}
arsort($hits);

echo "== 1) عکس‌هایی که اسمشان ساعت/تایمر/idle دارد ==\n";
foreach ($imgs as $r) echo $r . "\n";
if (!$imgs) echo "(پیدا نشد)\n";

echo "\n== 2) فایل‌هایی که timer / idle / away / clock دارند ==\n";
$i = 0;
foreach ($hits as $rel => $n) { echo $rel . "  (" . $n . " بار)\n"; if (++$i >= 30) { echo "...\n"; break; } }

echo "\n== 3) خط‌های مرتبط در ۷ فایل اول ==\n";
$shown = 0;
foreach ($hits as $rel => $n) {
    echo "\n--- " . $rel . " ---\n";
    $lines = explode("\n", $files[$rel]);
    $k = 0;
    foreach ($lines as $idx => $line) {
        if (!preg_match($RE, $line)) continue;
        if (preg_match('/pass|token|secret/i', $line)) continue;
        echo ($idx + 1) . ': ' . substr(trim(preg_replace('/\s+/', ' ', $line)), 0, 220) . "\n";
        if (++$k >= 10) { echo "...\n"; break; }
    }
    if (++$shown >= 7) break;
}
echo "\nتمام شد.\n";
