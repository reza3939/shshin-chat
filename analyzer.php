<?php
include('header.php');
include('sidebar.php');
$time = strtotime("-30 day 00:00:00");
$query = db::query("SELECT * FROM {prefix}stats_num WHERE `day` >=  $time ORDER BY `day` ASC");
$days = array();
while ($row = mysqli_fetch_array($query)) {
    $days[] = $row;
}
mysqli_free_result($query);
?>
<?php
if(isset($_POST['openlock'])){
if(md5($_POST['code_password'])==$options['security_password']){
$_SESSION['yaser']=$options['security_password'];
}
}
?>
<?php
if(($_SESSION['yaser'] ?? '')==$options['security_password']){
?>
<section id="content" class="container_12 clearfix" data-sort=true>
    <h1 class="grid_12 margin-top no-margin-top-phone">تبلیغات</h1>

    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/user-business-boss.png')); ?>">
                    فعالیت در 30 روز گذشته
                </h2>

            </div>
            <div class="content" style="height: 350px;">
                <table class="chart styled borders">
                    <thead>
                        <tr>
                            <th></th>
                            <th>بازدید</th>
                            <th>پیام</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>بازدید</th>
                            <?php
                            foreach ($days as $day) {
                                echo("<td>{$day['visit']}</td>");
                            }
                            ?>
                        </tr>
                        <tr>
                            <th>پیام</th>
                            <?php
                            foreach ($days as $day) {
                                echo("<td>{$day['msgs']}</td>");
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grid_6">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/user-business-boss.png')); ?>">
                    مقایسه جنسیتی کاربران
                </h2>

            </div>
            <div class="content" style="height: 350px;">
                <table class="chart" data-type="pie">
                    <thead>
                        <tr>
                            <th></th>
                            <th>مذکر</th>
                            <th>مونث</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>مذکر</th>
                            <td><?php echo(db::num('users', "`gender`='1'")); ?></td>
                        </tr>
                        <tr>
                            <th>مونث</th>
                            <td><?php echo(db::num('users', "`gender`='2'")); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grid_6">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/user-business-boss.png')); ?>">
                    مقایسه سطوح کاربری
                </h2>

            </div>
            <div class="content" style="height: 350px;">
                <table class="chart" data-type="pie">
                    <thead>
                        <tr>
                            <th></th>
                            <?php
                            foreach ($usertype as $type) {
                                echo("<th>{$type['title']}</th>");
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($usertype as $type) {
                            echo("<tr>
            				<th>{$type['title']}</th>
                            <td>" . db::num('users', "`type`='{$type['id']}'") . "</td>
            			</tr>");
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/user-business-boss.png')); ?>">
                    مقایسه مرورگر کاربران
                </h2>

            </div>
            <div class="content" style="height: 350px;">
                <?php
                $browsers = array('Apple Safari', 'Google Chrome', 'Internet Explorer', 'Mozilla Firefox', 'Opera');
                ?>

                <table class="chart" data-type="pie" data-donut="0.5">
                    <thead>
                        <tr>
                            <th></th>
                            <?php
                            foreach ($browsers as $browser) {
                                echo("<th>{$browser}</th>\n");
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($browsers as $browser) {
                            echo("<tr>
            				<th>{$browser}</th>
                            <td>" . db::num('stats', "`browser`  REGEXP '$browser'") . "</td>
            			</tr>");
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grid_6">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/user-business-boss.png')); ?>">
                    مقایسه شهر محل زندگی کاربران
                </h2>

            </div>
            <div class="content" style="height: 350px;">
                <?php
                $query = db::query("SELECT COUNT( * ) AS `Rows` , `city` FROM `{prefix}profiles`  WHERE `city` != '' and `city`  NOT LIKE '%?%' GROUP BY `city` ORDER BY `Rows` DESC  LiMIT 10");
                $rows = array();
                ?>

                <table class="chart" data-type="pie" data-donut="0.5">
                    <thead>
                        <tr>
                            <th></th>
                            <?php
                            while ($row = mysqli_fetch_array($query)) {
                                echo("<th>{$row['city']}</th>\n");
                                $rows[] = $row;
                            }
                            mysqli_free_result($query);
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rows as $row) {
                            echo("<tr>
            				<th>{$row['city']}</th>
                            <td>{$row['Rows']}</td>
            			</tr>");
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grid_6">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/user-business-boss.png')); ?>">
                    مقایسه کشور محل زندگی کاربران
                </h2>

            </div>
            <div class="content" style="height: 350px;">
                <?php
                $query = db::query("SELECT COUNT( * ) AS `Rows` , `country` FROM `{prefix}profiles`  WHERE `country` != '' and `country`  NOT LIKE '%?%' GROUP BY `country` ORDER BY `Rows` DESC  LiMIT 10");
                $rows = array();
                ?>

                <table class="chart" data-type="pie" data-donut="0.5">
                    <thead>
                        <tr>
                            <th></th>
                            <?php
                            while ($row = mysqli_fetch_array($query)) {
                                echo("<th>{$row['country']}</th>\n");
                                $rows[] = $row;
                            }
                            mysqli_free_result($query);
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rows as $row) {
                            echo("<tr>
            				<th>{$row['country']}</th>
                            <td>{$row['Rows']}</td>
            			</tr>");
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php
}else{
?>
<center>
<br>
<form action="" method="POST">
<div style="background-image:url('/theme/adminpanel/img/files.png');height: 300px;width: 300px;margin-top:80px;margin-right:180px;color:#fff;border-radius: 5px;"><br><br>
<br><br><br><br><br><br><br><br>
<input name="code_password" value="" type="text">
<button name="openlock" class="grey cancel">باز کن</button>
</div>
<p><b>رمز امنیتی را وارد کنید</b></p>
<p><b>این رمز از پنل اضطراری قابل تغییر است</b></p>
</form>
</center>
<?php } ?>
<?php include 'footer.php'; ?>