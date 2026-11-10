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

if (!story_was_seen($id, $userid)) {
    try {
        $added = db::query("INSERT IGNORE INTO `{prefix}story_view` (`story`,`userid`,`name`,`time`) VALUES('"
            . (int) $id . "','" . (int) $userid . "','" . db::escape(story_trim_bad(session('name'))) . "'," . time() . ")");
        if ($added) {
            db::query("UPDATE `{prefix}story` SET `views`=`views`+1 WHERE `id`='" . (int) $id . "'");
        }
    } catch (Throwable $e) {
        $added = false;
    }
}

story_json(array('ok' => 1, 'seen' => 1));
