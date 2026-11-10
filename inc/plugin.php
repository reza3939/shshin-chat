<?php

$deallow_country = $options['deallow_country'];
if (trim((string) $deallow_country) !== '') {
    $country = explode(",", $deallow_country);
    $visitor_country = iptocountry(ip());
    if (in_array($visitor_country, $country)) {
        include('pages/country_type.php');
        exit();
    }
}



$useroptions_tmp = json_decode($options['useroptions'], true);
if (!isset($useroptions_tmp['deallow_browser'])) {
    $useroptions_tmp['deallow_browser'] = array();
}
if (!isset($useroptions_tmp['deallow_platform'])) {
    $useroptions_tmp['deallow_platform'] = array();
}
if (!isset($useroptions_tmp['deallow_type'])) {
    $useroptions_tmp['deallow_type'] = array();
}
$browser = new Browser();
$browser_platform = $browser->getPlatform();
$browser_browser = $browser->getBrowser();
if (in_array($browser_browser, $useroptions_tmp['deallow_browser'])) {
    include('pages/browse_browser.php');
    exit();
} else if (in_array($browser_platform, $useroptions_tmp['deallow_platform'])) {
    include('pages/browse_platform.php');
    exit();
} else if (in_array('AOL', $useroptions_tmp['deallow_type'])) {
    if ($browser->isAol()) {
        $type_browser = 'AOL';
        include('pages/browse_type.php');
        exit();
    }
} else if (in_array('Mobile', $useroptions_tmp['deallow_type'])) {
    if ($browser->isMobile()) {
        $type_browser = 'موبايل';
        include('pages/browse_type.php');
        exit();
    }
} else if (in_array('Tablet', $useroptions_tmp['deallow_type'])) {
    if ($browser->isTablet()) {
        $type_browser = 'تبلت';
        include('pages/browse_type.php');
        exit();
    }
} else if (in_array('Robot', $useroptions_tmp['deallow_type'])) {
    if ($browser->isRobot()) {
        $type_browser = 'روبات هاي جستجو';
        include('pages/browse_type.php');
        exit();
    }
} else if (in_array('Facebook', $useroptions_tmp['deallow_type'])) {
    if ($browser->isFacebook()) {
        $type_browser = 'فيسبوک';
        include('pages/browse_type.php');
        exit();
    }
}
?>