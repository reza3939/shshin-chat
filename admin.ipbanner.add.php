<?php

if (!session('id') or session('admin') == '0')
    exit();
adminpanel::check_Permission('exit', 'addipbanner');
$token = isset($_POST['token']) ? safe::string($_POST['token']) : false;
if (!$token || $token != session('changepw'))
    die('لطفا صفحه خود را رفرش کنيد');

$ip = isset($_POST['ip']) ? safe::string($_POST['ip']) : '';
if ($ip == '') {
    echo('validip');
    exit();
}

$ip = substr($ip, 0, 15);
$ip = explode('.', $ip);
$x = 0;
$count = count($ip);
foreach ($ip as $key => $block) {
    if ($x == 3)
        break;
    $ip[$key] = safe::number($block);
    if ($ip[$key] > 255 or $ip[$key] < 0)
        $ip[$key] = 0;
    $x++;
}
$ip = implode('.', $ip);
if ($count != 4 && substr($ip, strlen($ip) - 1) != '.')
    $ip .='.';

$sql->where("ip", $ip);
$sql->delete('banns');

$date = isset($_POST['date']) ? safe::string($_POST['date']) : 'always';
switch ($date) {
    case('exit'):$time = time() + 3;
        break;
    case('1min'):$time = strtotime('+1 minute');
        break;
    case('30min'):$time = strtotime('+30 minute');
        break;
    case('1hour'):$time = strtotime('+1 hour');
        break;
    case('12hour'):$time = strtotime('+12 hour');
        break;
    case('1day'):$time = strtotime('+1 day');
        break;
    case('3day'):$time = strtotime('+3 day');
        break;
    case('1week'):$time = strtotime('+1 week');
        break;
    case('2week'):$time = strtotime('+2 week');
        break;
    case('1month'):$time = strtotime('+1 month');
        break;
    case('6month'):$time = strtotime('+6 month');
        break;
    case('1year'):$time = strtotime('+6 year');
        break;
    case('always'):$time = 0;
        break;
    default:die('date');
        break;
}
$sql->insert('banns', array(
    'ip' => $ip,
    'date' => time(),
    'to' => $time,
    'author' => session('id'),
    'user' => null
));
$sql->where('ip', '', '!=');
$sql->where('time', 0, '!=');
foreach($sql->get('onlines', null, array('id', 'ip', 'inputs')) as $row){
    if (substr($row['ip'], 0, strlen($ip)) == $ip) {
        $inputs = json_decode($row['inputs'], true);
        $inputs['benned'] = '1';
        Users::Inputs($row['id'], $inputs);
    }


}
  $tel = json_decode($options['teloptions'], true);
$text = " آیپی یا رنج$ip را به لیست تحریما افزود\n";
      $text .= "مدت تحریم: ".$date."\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    
    if($tel['sendipbanneraddlog'] == 'Sure'){
    tlg($text,'chat');
      }
echo('ok');
?>