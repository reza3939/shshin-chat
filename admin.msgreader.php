<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'msgreader');

if (isset($_POST['id'])) {
    if (adminpanel::check_Permission('bool', 'delprivatemessage')) {
        $delid = safe::number($_POST['id']);
        $sql->where('id',$delid)->delete('message');
        $sql->where('id',$delid)->delete('message_archive');
        exit('ok');
    } else {
        die('شما دسترسی لازم برای حذف ندارید');
    }
}
if (isset($_POST['user'])) {
    if (adminpanel::check_Permission('bool', 'delprivatemessage')) {
        $delid = safe::string($_POST['user']);    
        $sql->where('user',$delid)->delete('message');
        $sql->where('user',$delid)->delete('message_archive');
        $sql->where('to',$delid)->delete('message');
        $sql->where('to',$delid)->delete('message_archive');
        exit('ok');
    } else {
        die('شما دسترسی لازم برای حذف ندارید');
    }
}
  

$if = '';
$order = 'DESC';

$page = isset($_POST['page']) ? ((int) safe::string($_POST['page'])) : 1;
if ($page == 1) {
    $startpage = 0;
} else {
    $startpage = ($page - 1) * $msgshostory;
}
$rowsadd = 0;

$adminmsgreader = adminpanel::check_Permission('bool', 'adminmsgreader');
$modmsgreader = adminpanel::check_Permission('bool', 'modmsgreader');
$tel = json_decode($options['teloptions'], true);

if (isset($_POST['sender'])) {
    $sender = isset($_POST['sender']) ? safe::string($_POST['sender']) : '0';
    if ($sender != '0') {
        $sql->where('id',$sender);
        $sender = $sql->getOne('users');
        if (!$sender) {
            exit();
        }
        if (($usertype[$sender['type']] == '1' and ! $adminmsgreader) or ( ($usertype[$sender['type']] == '2' or $usertype[$sender['type']] == '3') and $modmsgreader)) {
            exit();
        }
        $if = "(`user`='" . (int) $sender['id'] . "' or `to`='" . (int) $sender['id'] . "')";
        $geter = isset($_POST['geter']) ? safe::string($_POST['geter']) : '0';
        if ($geter != '0') {
            $geter = Users::get('*', $geter);
            if (($usertype[$geter['type']] == '1' and ! $adminmsgreader) or ( ($usertype[$geter['type']] == '2' or $usertype[$geter['type']] == '3') and $modmsgreader)) {
                exit();
            }
            $if .= " and (`user`='$geter[0]' or `to`='$geter[0]')";
        } else {
            if (!$adminmsgreader) {
                if ($if != '') {
                    $if .= ' and ';
                }
                $if .= "`type`!= '1'";
            }
            if (!$modmsgreader) {
                if ($if != '') {
                    $if .= ' and ';
                }
                $if .= "`type`!= '2'";
            }
        }
    } else {
        if (!$adminmsgreader) {
            if ($if != '') {
                $if .= ' and ';
            }
            $if .= "`type`!= '1'";
        }
        if (!$modmsgreader) {
            if ($if != '') {
                $if .= ' and ';
            }
            $if .= "`type`!= '2'";
        }
    }
    if ($if != '') {
        $if .= ' and ';
    }
    $if .= "`to`!= '-1'  and `user`!='-1'";
} elseif (isset($_POST['keyword'])) {
    $keyword = safe::string($_POST['keyword']);
    $if = "`to`!='-1' and `text` REGEXP '$keyword' and `user`!='-1'";
    if (!$adminmsgreader) {
        if ($if != '') {
            $if .= ' and ';
        }
        $if .= "`type`!= '1'";
    }
    if (!$modmsgreader) {
        if ($if != '') {
            $if .= ' and ';
        }
        $if .= "`type`!= '2'";
    }
}
$rowsadd = 0;
$rows = array();
$query = db::query("SELECT * FROM {prefix}message WHERE $if ORDER BY `date` $order LIMIT $startpage, $msgshostory");
header::toxml();
$color = 'D5D5D7';
echo('<?xml version="1.0" ?><msgs>');
while ($row = mysqli_fetch_array($query)) {
    $rows[$row['id']] = $row;
    $rowsadd++;
}
mysqli_free_result($query);
if ($rowsadd < $msgshostory) {
    $query = db::query("SELECT * FROM {prefix}message_archive WHERE $if ORDER BY `date` $order LIMIT $startpage, $msgshostory");
    while ($row = mysqli_fetch_array($query)) {
        $rows[$row['id']] = $row;
        $rowsadd++;
    }
    mysqli_free_result($query);
}
if ($order == 'DESC') {
    krsort($rows);
} else {
    ksort($rows);
}
foreach ($rows as $row) {
    if ($color == 'D5D5D7') {
        $color = 'EEEEFF';
    } else {
        $color = 'D5D5D7';
    }
    $uname = Users::get('name', $row['to']);
    $to = $row['to'] == '-1' ? 'همه' : ($row['into'] != 'main' && $row['into'] != 'pm' ? 'اتاق کنفرانس ' . $uname : $uname);
    $jmsg = str_replace(array('<b>', '</b>', '<i>', '</i>'), "", $row['7']);
    if (isJson($row['7'])) {
        $jd = json_decode($jmsg, true);
        if (isset($jd['action'])) {
            $replymsg = $jd['umsg'];
            $replyme = $jd['uname'];
            $mymsg = $jd['mymsg'];
           if ($jd['action'] == 'reply') {
               
                echo("<msg><![CDATA[
        <tr id=\"priv-" . $row['id'] . "\" bgcolor=\"#$color\">
            <td width=\"50\" align=\"center\">$row[0]</td>
            <td width=\"180\" align=\"center\"><a href=\"../../../admin/users/edit/{$row['user']}\" target=\"_blank\">.: $row[2] :.</a></td>
            <td width=\"180\" align=\"center\"><a href=\"../../../admin/users/edit/{$row['to']}\" target=\"_blank\">.: $to :.</a></td>
            <td width=\"80\" align=\"center\">" . jdate::start('Y/m/d H:i', $row['date']) . "</td>
            <td align=\"center\" style=\"font-family:$row[4];font-size:$row[5]px;\"><div class=\"pmbox\"><div class=\"mess_back\"><div id=\"repbox\"><div id=\"khat\"><div id=\"name\">$replyme</div><div id=\"text\">$replymsg</div></div><div id=\"means\">$mymsg</div></div></div></div></td>
			<td width=\"20\" align=\"center\"><a href=\"javascript:del_private_message('" . $row['id'] . "');\">X</a></td>
        </tr>
    ]]></msg>");
                if ($color == 'D5D5D7') {
                    $color = 'EEEEFF';
                } else {
                    $color = 'D5D5D7';
                }
            }
        }
    }
    if (isset($jd['action']) && $jd['action'] == 'delete') {
        continue;
    }

    echo("<msg><![CDATA[

        <tr id=\"priv-" . $row['id'] . "\" bgcolor=\"#$color\">
            <td width=\"50\" align=\"center\">$row[0]</td>
            <td width=\"180\" align=\"center\"><a href=\"../../../admin/users/edit/{$row['user']}\" target=\"_blank\">.: $row[2] :.</a></td>
            <td width=\"180\" align=\"center\"><a href=\"../../../admin/users/edit/{$row['to']}\" target=\"_blank\">.: $to :.</a></td>
            <td width=\"80\" align=\"center\">" . jdate::start('Y/m/d H:i', $row['date']) . "</td>
            <td align=\"center\" style=\"font-family:$row[4];font-size:$row[5]px;\">$row[7]</td>
			<td width=\"20\" align=\"center\"><a href=\"javascript:del_private_message('" . $row['id'] . "');\">X</a></td>
        </tr>
]]></msg>"); 
    if (isset($jd['action']) && $jd['action'] == 'reply') {
      //  continue;
    }
}

$numgs = db::num('message', $if);
$numgs += db::num('message_archive', $if);
$totalpages = ceil($numgs / $msgshostory);
$x = 0;
echo("<pages><![CDATA[");
while ($x < $totalpages) {
    $nextpage = $x + 1;
    $x++;
    $numgs -= $msgshostory;
    if ($nextpage == $page) {
        $selected = " selected=\"selected\"";
    } else {
        $selected = "";
    }
    echo("<option$selected>$nextpage</option>");
}
if ($x == 0) {
    echo("<option>1</option>");
}

echo(']]></pages></msgs>');

?>