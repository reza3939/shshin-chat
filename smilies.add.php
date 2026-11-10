<?php
$el4 = giu('el4');
switch ($el4) {
    case('single'):include(theme::file('smilies.add.single.php'));
        break;
    case('tuple'):include(theme::file('smilies.add.tuple.php'));
        break;
    case('copy'):include(theme::file('smilies.add.copy.php'));
        break;
    default:
        include('header.php');
        include('sidebar.php');
        ?>
        <section id="content" class="container_12 clearfix" data-sort=true>
            <h1 class="grid_12 margin-top no-margin-top-phone">شکلک جدید</h1>
            <div class="grid_12">
                <div class="grid_12">
                    <p style="text-align: center;">ما چند روش برای افزودن شکلک برای شما محیا کرده ایم!شما انتخاب کنید:</p>
                    <center>
                        <a href="<?php echo(url('admin/smilies/add/single')); ?>"><button class="button blue flat block">افزودن تکی</button></a>
                        <a href="<?php echo(url('admin/smilies/add/tuple')); ?>"><button class="button red block">افزودن دسته جمعی</button></a>
                        <a href="<?php echo(url('admin/smilies/add/copy')); ?>"><button class="button grey block">کپی از چت روم دیگری</button></a>
                    </center>
                </div>
            </div>
        </section>
        <?php
        include('footer.php');
        break;
}
?>