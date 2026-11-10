<?php

include('story.lib.php');

$userid = story_guard();

if (random_int(1, 25) === 1) {
    story_purge();
}

$now = time();
$rows = array();
$query = db::query("SELECT `id`,`userid`,`username`,`kind`,`url`,`body`,`bg`,`dur`,`views`,`time`,`expire` FROM `{prefix}story` WHERE `expire` > " . (int) $now . " ORDER BY `id` ASC LIMIT 400");
if ($query instanceof mysqli_result) {
    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
    }
    mysqli_free_result($query);
}

$ids = array();
foreach ($rows as $row) {
    $ids[] = (int) $row['id'];
}

$seen = array();
if ($ids) {
    $view_query = db::query("SELECT `story` FROM `{prefix}story_view` WHERE `userid`='" . (int) $userid . "' AND `story` IN (" . implode(',', $ids) . ")");
    if ($view_query instanceof mysqli_result) {
        while ($view_row = mysqli_fetch_assoc($view_query)) {
            $seen[(int) $view_row['story']] = 1;
        }
        mysqli_free_result($view_query);
    }
}

$groups = array();
foreach ($rows as $row) {
    $author = (int) $row['userid'];
    $id = (int) $row['id'];
    $mine = ($author === $userid);
    $story = array(
        'id' => $id,
        'kind' => (string) $row['kind'],
        'url' => (string) $row['url'],
        'text' => (string) $row['body'],
        'bg' => (string) $row['bg'],
        'dur' => (int) $row['dur'],
        'time' => (int) $row['time'],
        'left' => max(0, (int) $row['expire'] - $now),
        'seen' => isset($seen[$id]),
        'owner' => $mine,
        'views' => $mine ? (int) $row['views'] : null
    );
    if (!isset($groups[$author])) {
        $groups[$author] = array(
            'user' => $author,
            'name' => (string) $row['username'],
            'stories' => array(),
            'last' => 0
        );
    }
    $groups[$author]['stories'][] = $story;
    $groups[$author]['last'] = max($groups[$author]['last'], $id);
}

$ring = array_values($groups);
usort($ring, function ($a, $b) {
    return $b['last'] <=> $a['last'];
});

story_json(array(
    'ok' => 1,
    'me' => $userid,
    'can' => true,
    'max' => story_max_active(),
    'ring' => $ring
));
