<?php

include('story.lib.php');

$userid = story_guard();

if (strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? '')) !== 'POST') {
    story_fail('درخواست درست نیست');
}

$now = time();
$expire = $now + story_day_length();

if (story_count_active($userid) >= story_max_active()) {
    story_fail('شما ' . story_max_active() . ' استوری باز دارید. اول یکی را پاک کنید');
}
if (($now - story_last_post_time($userid)) < 10) {
    story_fail('ده ثانیه صبر کنید بعد استوری بعدی را بفرستید');
}

$kind = '';
$url = '';
$body = '';
$bg = '';
$dur = 0;
$filename = '';

if (isset($_FILES['story']) && is_array($_FILES['story']) && (int) ($_FILES['story']['error'] ?? 4) !== UPLOAD_ERR_NO_FILE) {
    if ((int) ($_FILES['story']['error'] ?? 4) !== UPLOAD_ERR_OK) {
        story_fail('فایل خیلی بزرگ است یا به سرور نرسید');
    }
    $tmp = (string) ($_FILES['story']['tmp_name'] ?? '');
    $size = (int) ($_FILES['story']['size'] ?? 0);
    $mime = strtolower((string) ($_FILES['story']['type'] ?? ''));
    $extension = story_extension_from($_FILES['story']['name'] ?? '', $mime);
    if ($tmp === '' || !is_uploaded_file($tmp)) {
        story_fail('فایلی به سرور نرسید');
    }
    if ($size <= 0) {
        story_fail('فایل خالی است');
    }
    $kind = story_kind_of($extension);
    if ($kind === false) {
        story_fail('فرمت فایل مجاز نمی باشد');
    }
    if ($kind === 'video' && strpos($mime, 'audio/') === 0) {
        $kind = 'audio';
    }
    if ($size > story_limits()[$kind]) {
        story_fail('حجم فایل زیاد است');
    }
    if ($kind === 'image' && @getimagesize($tmp) === false) {
        story_fail('فایل تصویر سالم نیست');
    }
    $filename = $now . '_' . $userid . '_' . random_int(1000, 99999) . '.' . $extension;
    $dir = story_dir();
    if (!is_dir($dir)) {
        story_fail('پوشه استوری روی سرور ساخته نشد');
    }
    if (!move_uploaded_file($tmp, $dir . $filename)) {
        story_fail('فایل روی سرور ذخیره نشد. پوشه theme/stories باید قابل نوشتن باشد');
    }
    @chmod($dir . $filename, 0644);
    $url = '/theme/stories/' . $filename;
} else {
    $kind = 'text';
    $body = trim((string) safe::string($_POST['text'] ?? ''));
    $body = (string) story_trim_bad(mb_substr($body, 0, 240));
    if ($body === '') {
        story_fail('چیزی برای نوشتن وارد نشد');
    }
    $bg = strtolower(preg_replace('/[^0-9a-f]/', '', (string) ($_POST['bg'] ?? '')));
    $bg = strlen($bg) === 6 ? $bg : '1f6fb2';
}

$dur = (int) ($_POST['dur'] ?? 0);
if ($dur < 0 || $dur > 60) {
    $dur = 0;
}

try {
    $id = $sql->insert('story', array(
        'userid' => $userid,
        'username' => story_trim_bad(session('name')),
        'kind' => $kind,
        'url' => $url,
        'filename' => $filename,
        'body' => $body,
        'bg' => $bg,
        'dur' => $dur,
        'views' => 0,
        'time' => $now,
        'expire' => $expire
    ));
} catch (Throwable $e) {
    $id = false;
}

if (!$id) {
    if ($filename !== '') {
        @unlink(story_dir() . $filename);
    }
    story_fail('استوری در پایگاه داده ثبت نشد');
}

story_json(array(
    'ok' => 1,
    'id' => (int) $id,
    'kind' => $kind,
    'url' => $url,
    'text' => $body,
    'bg' => $bg,
    'time' => $now,
    'expire' => $expire
));
