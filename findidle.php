<?php
// فقط خواندنی: نشان می‌دهد وضعیت «ساکت/ساعت» (idle) برای کاربر مجازی (aibot) کجا ساخته و پاک می‌شود.
// خط‌هایی که کلمه‌هایی مثل key/token/secret دارند پنهان می‌شوند. بعد از استفاده حتماً حذفش کن.
// آدرس: /findidle?k=3e98c952
if (!isset($_GET['k']) || $_GET['k'] !== '3e98c952') { http_response_code(404); exit; }
header('Content-Type: text/plain; charset=utf-8');
$root = dirname(dirname(__FILE__));

function clean($line) {
    $line = trim(preg_replace('/\s+/', ' ', $line));
    if (preg_match('/key|token|secret|bearer|authorization|password|passwd|sk-[a-z0-9]/i', $line)) return '[خط پنهان شد]';
    return substr($line, 0, 220);
}

function show_context($root, $rel, $regex, $ctx, $max) {
    echo "\n=== " . $rel . " ===\n";
    $p = $root . '/' . $rel;
    if (!is_file($p)) { echo "(فایل نیست)\n"; return; }
    $lines = @file($p);
    if ($lines === false) { echo "(خوانده نشد)\n"; return; }
    $printed = array(); $count = 0;
    foreach ($lines as $i => $line) {
        if (!preg_match($regex, $line)) continue;
        for ($j = max(0, $i - $ctx); $j <= min(count($lines) - 1, $i + $ctx); $j++) {
            if (isset($printed[$j])) continue;
            $printed[$j] = true;
            echo ($j + 1) . ($j === $i ? '> ' : ': ') . clean($lines[$j]) . "\n";
            if (++$count >= $max) { echo "...\n"; return; }
        }
        echo "--\n";
    }
    if (!$count) echo "(چیزی پیدا نشد)\n";
}

echo "==== ساختار aibot.php (تابع‌ها و جاهایی که آنلاین/وضعیت کاربر را می‌نویسد) ====";
show_context($root, 'inc/classes/aibot.php', '/function |idle|onlines|inputs|silent|update\(|insert\(/i', 1, 120);

echo "\n==== getuser.php: ساخت وضعیت idle برای لیست آنلاین ====";
show_context($root, 'pages/ajax/getuser.php', '/idle|silent/i', 3, 70);

echo "\n==== get.json.php: جایی که idle برای کاربر واقعی تنظیم/پاک می‌شود ====";
show_context($root, 'pages/ajax/get.json.php', '/idle/i', 4, 60);

echo "\nتمام شد.\n";
