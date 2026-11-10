<?php
check_session();

$action = giu('el2');
$avatar_dir = MiniAvatarDir();
if ($action == 'likes') {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>رتبه بندی بر اساس لایک</title>
            <?php echo RankHeader(); ?>
        <table id="likertable" dir="rtl" width="80%" cellspacing="1" cellpadding="0" border="1">
            <thead>
                <tr>
                    <td width="8%">رتبه</td>
                    <td width="10%">آواتار</td>
                    <td width="27%">نام</td>
                    <td width="17%">گروه کاربري</td>
                    <td width="13%">لايک</td>
                    <td width="13%">ديسلايک</td>
                    <td width="13%">لایک واقعی</td>
                </tr>
            </thead>
            <tbody id="results">
                <?php
                $x = 1;
                $sql->join('users u', 'u.id=p.id', 'LEFT');
                $sql->where('u.type', 1, '!=');
                $sql->orderBy('resualt', 'DESC');
                $sql->orderBy('like', 'DESC');
                foreach($sql->get('profiles p', 30, array(
                    'u.id',
                    'u.name',
                    'u.type',
                    'p.like',
                    'p.dislike',
                    'p.avatar',
                    '(p.`like` - p.`dislike`) AS resualt'
                )) as $row){
                    ?> 
                    <tr>
                        <td><?= $x; ?></td>
                        <td><a target="_blank" href="/profile/<?= $row['id']; ?>"><img src="/<?= $options['avatar_dir'] . '/' . $avatar_dir . '/' . $row['avatar']; ?>"></a></td>
                        <td><a target="_blank" href="/profile/<?= $row['id']; ?>"><font color="<?= $usertype[$row['type']]['color']; ?>"><?= $row['name']; ?></font></a></td>
                        <td><img src="/<?= $usertype[$row['type']]['icon']; ?>"></td>
                        <td><?= $row['like']; ?></td>
                        <td><?= $row['dislike']; ?></td>
                        <td><?= $row['resualt']; ?></td>
                    </tr>
                    <?php
                    $x++;
                }
                ?>
            </tbody>
        </table>
        <div class="animation_image" style="display:none" align="center"><img src="<?= theme::url('theme/images/chat/ajax-loader-pro.gif'); ?>"></div>
        <script type="text/javascript">
    <?php
    $sql->where("(`like` != '' OR `dislike` != '') AND (`like` != '0' OR `dislike` != '0')");
    $total_records = $sql->getValue('profiles', "count(*)");
    $total_groups = ceil($total_records / 30);
    ?>
            $(document).ready(function () {
                var track_load = 1; //total loaded record group(s)
                var loading = false; //to prevents multipal ajax loads
                var total_groups = <?php echo $total_groups; ?>; //total record group(s)

                $(window).scroll(function () { //detect page scroll

                    //if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
                    if ($(window).scrollTop() >= $(document).height() - $(window).height() - 700)  //user scrolled to bottom of the page?
                    {

                        if (track_load <= total_groups && loading == false) //there's more data to load
                        {
                            loading = true; //prevent further ajax loading
                            $('.animation_image').show(); //show loading image

                            //load data from the server using a HTTP POST request
                            $.post('<?= url('ajax/chat.getmoreliker'); ?>', {'group_no': track_load, 'row': $('#likertable tr').length}, function (data) {

                                $("#results").append(data); //append received data into the element

                                //hide loading image
                                $('.animation_image').hide(); //hide loading image once data is received

                                track_load++; //loaded group increment
                                loading = false;

                            }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?

                                alert(thrownError); //alert with HTTP error
                                $('.animation_image').hide(); //hide loading image
                                loading = false;

                            });

                        }
                    }
                });
            });
        </script>
    </html>

    <?php
}
if ($action == 'posts') {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>رتبه بندی بر اساس مطالب ارسالی</title>
            <?php echo RankHeader(); ?>
        <center><font color="red">رتبه بندی بر اساس مطالب ارسالی</font></center>
        <table id="likertable" dir="rtl" width="80%" cellspacing="1" cellpadding="0" border="1">
            <thead>
                <tr>
                    <td width="8%">رتبه</td>
                    <td width="10%">آواتار</td>
                    <td width="27%">نام</td>
                    <td width="17%">گروه کاربري</td>
                    <td width="13%">مطلب</td>

                </tr>
            </thead>
            <tbody id="results">
                <?php
                $x = 1;
                $sql->join('users u', 'u.id=pc.userid', 'LEFT');
                $sql->join('profiles p', 'p.id=pc.userid', 'LEFT');
                $sql->orderBy('pc.posts', 'DESC');
                foreach($sql->get('profile_counts pc', 30, array(
                    'pc.userid as uid',
                    'pc.posts',
                    'p.avatar',
                    'u.name',
                    'u.type'
                )) as $row){
                    ?> 
                    <tr>
                        <td><?= $x; ?></td>
                        <td><a target="_blank" href="/profile/<?= $row['uid']; ?>"><img src="/<?= $options['avatar_dir'] . '/' . $avatar_dir . '/' . $row['avatar']; ?>"></a></td>
                        <td><a target="_blank" href="/profile/<?= $row['uid']; ?>"><font color="<?= $usertype[$row['type']]['color']; ?>"><?= $row['name']; ?></font></a></td>
                        <td><img src="/<?= $usertype[$row['type']]['icon']; ?>"></td>
                        <td><?= $row['posts']; ?></td>
                    </tr>
                    <?php
                    $x++;
                }
                ?>
            </tbody>
        </table>
    </html>
    <?php
}
if ($action == 'ldposts') {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>رتبه بندی بر اساس لایک مطلب</title>
            <?php echo RankHeader(); ?>
        <center><font color="red">برترین مطالب کاربران بر اساس لایک مطلب</font></center>
        <table id="likertable" dir="rtl" width="80%" cellspacing="1" cellpadding="0" border="1">
            <thead>
                <tr>
                    <td width="8%">رتبه</td>
                    <td width="10%">آواتار</td>
                    <td width="27%">نام</td>
                    <td width="17%">گروه کاربري</td>
                    <td width="13%">لايک مطلب</td>
                    <td width="13%">ديسلايک مطلب</td>
                    <td width="13%">لایک واقعی</td>
                </tr>
            </thead>
            <tbody id="results">
                <?php
                $x = 1;
                $sql->join('users u', 'u.id=p.userid', 'LEFT');
                $sql->join('profiles pp', 'pp.id=p.userid', 'LEFT');
                $sql->where('u.type', 1, '!=');
                $sql->orderBy('resualt', 'DESC');
                $sql->orderBy('like', 'DESC');
                foreach($sql->get('profile_posts p', 30, array(
                    'p.id as pid',
                    'u.id',
                    'u.name',
                    'u.type',
                    'p.likes',
                    'p.dislikes',
                    'pp.avatar',
                    '(p.`likes` - p.`dislikes`) AS resualt'
                )) as $row){
                    ?> 
                    <tr>
                        <td><?= $x; ?></td>
                        <td><a target="_blank" href="/profile/<?= $row['id'] . '/' . $row['pid']; ?>"><img src="/<?= $options['avatar_dir'] . '/' . $avatar_dir . '/' . $row['avatar']; ?>"></a></td>
                        <td><a target="_blank" href="/profile/<?= $row['id'] . '/' . $row['pid']; ?>"><font color="<?= $usertype[$row['type']]['color']; ?>"><?= $row['name']; ?></font></a></td>
                        <td><img src="/<?= $usertype[$row['type']]['icon']; ?>"></td>
                        <td><?= $row['likes']; ?></td>
                        <td><?= $row['dislikes']; ?></td>
                        <td><?= $row['resualt']; ?></td>
                    </tr>
                    <?php
                    $x++;
                }
                ?>
            </tbody>
        </table>
    </html>
    <?php
}if ($action == 'ldavatar') {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>رتبه بندی بر اساس لایک آواتار</title>
            <?php echo RankHeader(); ?>
        <center><font color="red">برترین کاربران بر اساس لايک آواتار</font></center>
        <table id="likertable" dir="rtl" width="80%" cellspacing="1" cellpadding="0" border="1">
            <thead>
                <tr>
                    <td width="8%">رتبه</td>
                    <td width="10%">آواتار</td>
                    <td width="27%">نام</td>
                    <td width="17%">گروه کاربري</td>
                    <td width="13%">لايک آواتار</td>
                    <td width="13%">ديسلايک آواتار</td>
                    <td width="13%">لایک واقعی</td>
                </tr>
            </thead>
            <tbody id="results">
                <?php
                $x = 1;
                $sql->join('users u', 'u.id=p.userid', 'LEFT');
                $sql->join('profiles pp', 'pp.id=p.userid', 'LEFT');
                $sql->where('u.type', 1, '!=');
                $sql->orderBy('resualt', 'DESC');
                $sql->orderBy('p.lavatar', 'DESC');
                foreach($sql->get('profile_counts p', 30, array(
                    'u.id',
                    'u.name',
                    'u.type',
                    'p.lavatar',
                    'p.davatar',
                    'pp.avatar',
                    '(p.`lavatar` - p.`davatar`) AS resualt'
                )) as $row){
                    ?> 
                    <tr>
                        <td><?= $x; ?></td>
                        <td><a target="_blank" href="/profile/<?= $row['id']; ?>"><img src="/<?= $options['avatar_dir'] . '/' . $avatar_dir . '/' . $row['avatar']; ?>"></a></td>
                        <td><a target="_blank" href="/profile/<?= $row['id']; ?>"><font color="<?= $usertype[$row['type']]['color']; ?>"><?= $row['name']; ?></font></a></td>
                        <td><img src="/<?= $usertype[$row['type']]['icon']; ?>"></td>
                        <td><?= $row['lavatar']; ?></td>
                        <td><?= $row['davatar']; ?></td>
                        <td><?= $row['resualt']; ?></td>
                    </tr>
                    <?php
                    $x++;
                }
                ?>
            </tbody>
        </table>
    </html>
    <?php
}if ($action == 'ldmusic') {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>رتبه بندی بر اساس آهنگ مورد علاقه</title>
            <?php echo RankHeader(); ?>
        <center><font color="red">برترین کاربران بر اساس آهنگ های دانلود شده</font></center>
        <table id="likertable" dir="rtl" width="80%" cellspacing="1" cellpadding="0" border="1">
            <thead>
                <tr>
                    <td width="8%">رتبه</td>
                    <td width="10%">آواتار</td>
                    <td width="20%">نام</td>
                    <td width="17%">گروه کاربري</td>
                    <td width="17%">تعداد دانلود</td>
                    <td width="10%">لايک</td>
                    <td width="10%">ديسلايک</td>
                    <td width="14%">لایک واقعی</td>
                </tr>
            </thead>
            <tbody id="results">
                <?php
                $x = 1;
                $sql->join('users u', 'u.id=p.userid', 'LEFT');
                $sql->join('profiles pp', 'pp.id=p.userid', 'LEFT');
                $sql->where('u.type', 1, '!=');
                $sql->orderBy('p.dlmusic', 'DESC');
                $sql->orderBy('resualt', 'DESC');
                foreach($sql->get('profile_counts p', 30, array(
                    'u.id',
                    'u.name',
                    'u.type',
                    'p.dlmusic',
                    'p.lmusic',
                    'p.dmusic',
                    'pp.avatar',
                    '(p.`lmusic` - p.`dmusic`) AS resualt'
                )) as $row){
                    ?> 
                    <tr>
                        <td><?= $x; ?></td>
                        <td><a target="_blank" href="/profile/<?= $row['id']; ?>"><img src="/<?= $options['avatar_dir'] . '/' . $avatar_dir . '/' . $row['avatar']; ?>"></a></td>
                        <td><a target="_blank" href="/profile/<?= $row['id']; ?>"><font color="<?= $usertype[$row['type']]['color']; ?>"><?= $row['name']; ?></font></a></td>
                        <td><img src="/<?= $usertype[$row['type']]['icon']; ?>"></td>
                        <td><?= $row['dlmusic']; ?></td>
                        <td><?= $row['lmusic']; ?></td>
                        <td><?= $row['dmusic']; ?></td>
                        <td><?= $row['resualt']; ?></td>
                    </tr>
                    <?php
                    $x++;
                }
                ?>
            </tbody>
        </table>
    </html>
    <?php
}
?>

<?php

function RankHeader() {
    echo '<script type="text/javascript" src="' . theme::url('theme/microblog/js/jquery.min.js') . '"></script>
</head>
<style>
	table {
		background: #ffffff none repeat scroll 0 0;
		border: 1px solid #cccccc;
		margin: 25px auto;
		direction:rtl;
	}
	thead {
		background: #00cfea none repeat scroll 0 0;
		color: #ffffff;
	}
	body {
		background: #f3f3f8 none repeat scroll 0 0;
		color: #333333;
		font-family: tahoma;
		font-size: 13px;
		margin: 0;
		padding: 0;
	}
	td {
		border: 1px solid #e6e6e6;
		padding: 5px;
		text-align: center;
	}
	a {
		text-decoration: none;
	}
	 tbody tr:nth-child(1) td:nth-child(1) {
		background: #f4e200 none repeat scroll 0 0;
	}
	tbody tr:nth-child(2) td:nth-child(1) {
		background: #cfcfcf none repeat scroll 0 0;
	}
	tbody tr:nth-child(3) td:nth-child(1) {
		background: #ffb96a none repeat scroll 0 0;
	}
	tbody tr td:nth-child(5) {
		color: green;
	}
	tbody tr td:nth-child(6) {
		color: green;
	}
	tbody tr td:nth-child(7) {
		color: red;
	}
	tbody tr td:nth-child(8) {
		color: green;
	}
</style>';
}
?>