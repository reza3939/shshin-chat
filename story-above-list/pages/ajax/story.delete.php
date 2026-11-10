<?php

include('story.lib.php');

$userid = story_guard();

$id = (int) safe::number($_POST['story'] ?? ($_REQUEST['story'] ?? 0));
if ($id <= 0) {
    story_fail('شماره استوری درست نیست');
}

$row = story_row($id);
if ($row === null) {
    story_fail('استوری پیدا نشد');
}

$is_admin = ((int) session('admin')) > 0;
if (!$is_admin && (int) $row['userid'] !== $userid) {
    story_fail('فقط نویسنده یا مدیریت می توانند پاک کنند');
}

$name = basename((string) ($row['filename'] ?? ''));
if ($name !== '' && is_file(story_dir() . $name)) {
    @unlink(story_dir() . $name);
}

db::delete('story', "`id`='" . (int) $id . "'");
db::delete('story_view', "`story`='" . (int) $id . "'");

story_json(array('ok' => 1, 'deleted' => $id));
