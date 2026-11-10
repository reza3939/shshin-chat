<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'iconmororgar');
if (($_FILES['pc']['size'] == 0) &&
        ($_FILES['tablet']['size'] == 0) &&
        ($_FILES['mobile']['size'] == 0) &&
        ($_FILES['firefox']['size'] == 0) &&
        ($_FILES['ie']['size'] == 0) &&
        ($_FILES['safari']['size'] == 0) &&
        ($_FILES['chrome']['size'] == 0) &&
        ($_FILES['unknown']['size'] == 0) &&
        ($_FILES['netscape']['size'] == 0) &&
        ($_FILES['camino']['size'] == 0) &&
        ($_FILES['opera']['size'] == 0)) {
    exit("nofile");
}
if ($_FILES['pc']['size'] > 0) {
    $link = "theme/images/status/status_pc.mini.png";
    move_uploaded_file($_FILES['pc']['tmp_name'], $link);
}
if ($_FILES['tablet']['size'] > 0) {
    $link = "theme/images/status/status_tablet.mini.png";
    move_uploaded_file($_FILES['tablet']['tmp_name'], $link);
}
if ($_FILES['mobile']['size'] > 0) {
    $link = "theme/images/status/status_phone.mini.png";
    move_uploaded_file($_FILES['mobile']['tmp_name'], $link);
}
if ($_FILES['firefox']['size'] > 0) {
    $link = "theme/images/browser/firefox.png";
    move_uploaded_file($_FILES['firefox']['tmp_name'], $link);
}
if ($_FILES['ie']['size'] > 0) {
    $link = "theme/images/browser/ie.png";
    move_uploaded_file($_FILES['ie']['tmp_name'], $link);
}
if ($_FILES['safari']['size'] > 0) {
    $link = "theme/images/browser/safari.png";
    move_uploaded_file($_FILES['safari']['tmp_name'], $link);
}
if ($_FILES['chrome']['size'] > 0) {
    $link = "theme/images/browser/chrome.png";
    move_uploaded_file($_FILES['chrome']['tmp_name'], $link);
}
if ($_FILES['opera']['size'] > 0) {
    $link = "theme/images/browser/opera.png";
    move_uploaded_file($_FILES['opera']['tmp_name'], $link);
}
if ($_FILES['unknown']['size'] > 0) {
    $link = "theme/images/browser/unknown.png";
    move_uploaded_file($_FILES['unknown']['tmp_name'], $link);
}
if ($_FILES['netscape']['size'] > 0) {
    $link = "theme/images/browser/netscape.png";
    move_uploaded_file($_FILES['netscape']['tmp_name'], $link);
}
if ($_FILES['camino']['size'] > 0) {
    $link = "theme/images/browser/camino.png";
    move_uploaded_file($_FILES['camino']['tmp_name'], $link);
}

echo "ok";
?>