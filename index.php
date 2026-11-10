<?php
include('header.php');
include('sidebar.php');
$time = strtotime("-7 day 00:00:00");
$query = db::query("SELECT * FROM {prefix}stats_num WHERE `day` >=  $time ORDER BY `day` ASC");
$days = array();
while ($row = mysqli_fetch_array($query)) {
    $days[] = $row;
}
mysqli_free_result($query);
?>
<script src="<?php echo(theme::url('js/jquery-1.6.1.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo(theme::url('js/highcharts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo(theme::url('js/exporting.js')); ?>"></script>
<section id="content" class="container_12 clearfix" data-sort=true>
    <ul class="stats not-on-phone">
        <li>
            <strong><?php echo(db::num('users')); ?></strong>
            <small>همه کاربران</small>
        </li>
        <li>
            <strong><?php echo(db::num('letters')); ?></strong>
            <small>همه نامه ها</small>
        </li>
        <li>
            <strong><?php echo(db::num('banns')); ?></strong>
            <small>اخراج ها</small>
        </li>
        <li>
            <strong><?php echo(db::num('smilies')); ?></strong>
            <a href="sidebar.php"></a>
            <small>همه شکلک ها</small>
        </li>
        <li>
            <strong><?php echo(db::num('silents')); ?></strong>
            <small>کاربران خفه شده</small>
        </li>
        <li>
            <strong><?php echo(db::num('rooms')); ?></strong>
            <small>تعداد اتاق ها</small>
        </li>
        <li>
            <strong><?php echo(db::num('links')); ?></strong>
            <small>لينک ها</small>
        </li>
        <li>
            <strong><?php echo(db::num('adminpanel')); ?></strong>
            <small>تعداد پنل ها</small>
        </li>
    </ul>
    <h1 class="grid_12 margin-top no-margin-top-phone">پيشخوان</h1>
    <!--[if gt IE 8]>
    <!-->
    <div class="grid_12 center-elements">
        <div class="full-stats">
            <?php
            $time = strtotime("-9 day 00:00:00");
            $query = db::query("SELECT * FROM {prefix}stats_num WHERE `day` >=  $time ORDER BY `day` ASC");
            $days = array();
            $visits = array();
            $registers = array();
            while ($row = mysqli_fetch_array($query)) {
                $days[] = $row;
                $visits[] = $row['visit'];
                $registers[] = $row['visit'];
            }
            mysqli_free_result($query);
            ?>
            <div class="stat minichart" data-total="<?php echo(end($visits)); ?>" data-values="[<?php echo(implode(',', $visits)); ?>]" data-title="بازديد امروز" data-format="+0,0;-0,0" data-change="<?php echo(59); ?>">
            </div>
        </div>
        <div class="full-stats">
            <div class="stat minichart" data-total="<?php echo(end($registers)); ?>" data-values="[<?php echo(implode(',', $registers)); ?>]" data-title="عضويت ها" data-format="+0,0;-0,0" data-change=-6>
            </div>
        </div>
        <div class="full-stats">
            <div class="stat minichart" data-total=0 data-values="[0,0,0,1,2,1,-2,-2,-1]" data-title=Orders data-change=0>
            </div>
        </div>
    </div>
    <!--<![endif]-->

    <div class="grid_12 not-on-phone">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="/theme/adminpanel/img/icons/packs/fugue/16x16/chart-pie.png">
                    آناليز بازديد و پيام ها
                </h2>

            </div>
            <div id="container" style="width: 870px; height: 350px; margin: 0 auto"></div>
            <script type="text/javascript">

                var chart;
                $(document).ready(function () {
                    chart = new Highcharts.Chart({
                        chart: {
                            renderTo: 'container',
                            defaultSeriesType: 'line',
                            marginRight: 0,
                            marginBottom: 0
                        },
                        title: {
                            text: 'گزارش کارکرد در 7 روز گذشته',
                            x: -20 //center
                        },
                        subtitle: {
                            text: '',
                            x: -20
                        },
                        xAxis: {
                            categories: [<?php
            $x = 0;
            foreach ($days as $day) {
                if ($x > 0)
                    echo(',');
                echo("'" . jdate::start('l', $day['day']) . "'");
                $x++;
            }
            ?>]
                        },
                        yAxis: {
                            title: {
                                text: ''
                            },
                            plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#808080'
                                }]
                        },
                        tooltip: {
                            formatter: function () {
                                switch (this.series.name) {
                                    case('بازديد'):
                                        return '<b>' + this.series.name + '</b><br/>' + this.x + ': ' + this.y + 'بار';
                                        break;
                                    case('اخراج'):
                                    case('عضويت'):
                                        return '<b>' + this.series.name + '</b><br/>' + this.x + ': ' + this.y + 'نفر';
                                        break;
                                    case('پيام هاي ارسالي'):
                                        return '<b>' + this.series.name + '</b><br/>' + this.x + ': ' + this.y + 'عدد';
                                        break;

                                }

                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -10,
                            y: 95,
                            borderWidth: 0
                        },
                        series: [{
                                name: 'بازديد',
                                data: [<?php
            $x = 0;
            foreach ($days as $day) {
                if ($x > 0)
                    echo(',');
                echo($day['visit']);
                $x++;
            }
            ?>]
                            }, {
                                name: 'اخراج',
                                data: [<?php
            $x = 0;
            foreach ($days as $day) {
                if ($x > 0)
                    echo(',');
                echo($day['bann']);
                $x++;
            }
            ?>]
                            }, {
                                name: 'پيام هاي ارسالي',
                                data: [<?php
            $x = 0;
            foreach ($days as $day) {
                if ($x > 0)
                    echo(',');
                echo($day['msgs']);
                $x++;
            }
            ?>]
                            }, {
                                name: 'عضويت',
                                data: [<?php
            $x = 0;
            foreach ($days as $day) {
                if ($x > 0)
                    echo(',');
                echo($day['register']);
                $x++;
            }
            ?>]
                            }]
                    });


                });




            </script>
        </div>
    </div>

    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/table.png')); ?>">
                    آخرين بازديد ها
                </h2>
            </div>
            <div class="content">
                <div class="tabletools">
                </div>
                <table class="dynamic styled" data-table-tools='{"display":true}'>
                    <thead>
                        <tr>
                            <th>آي پي</th>
                            <th>مرورگر</th>
                            <th>ساعت</th>
                            <th>نام کاربري</th>
                            <th>آدرس</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = db::query("SELECT * FROM {prefix}stats ORDER BY `ahyir_stats`.`time` DESC LIMIT 0, 50");
                        while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <tr class="gradeX">
                                <td><?php echo($row['ip']); ?></td>
                                <td><?php echo($row['browser']); ?></td>
                                <td><?php echo(date("H:i:s", $row['time'])); ?></td>
                                <td class="center"><?php echo($row['user'] == '0' ? 'مهمان' : Users::get('username', $row['user'])); ?></td>
                                <td class="center"><?php echo($row['adress']); ?></td>
                            </tr>
                            <?php
                        }
                        mysqli_free_result($query);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<?php include('footer.php'); ?>
