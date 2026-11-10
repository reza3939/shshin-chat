<?php
$el4 = giu('el4');
switch ($el4) {
    case('single'):include(theme::file('player.add.single.php'));
        break;
    case('tuple'):include(theme::file('player.add.tuple.php'));
        break;
    default:
        include('header.php');
        include('sidebar.php');
        ?>
        <section id="content" class="container_12 clearfix" data-sort=true>
            <h1 class="grid_12 margin-top no-margin-top-phone">موزیک جدید</h1>
            <div class="grid_12">
                <div class="grid_12">
                    <p style="text-align: center;">ما چند روش برای افزودن موزیک برای شما محیا کرده ایم!شما انتخاب کنید:</p>
                    <center>
                        <a href="<?php echo(url('admin/player/add/single')); ?>"><button class="button blue flat block">افزودن تکی</button></a>
                        <a href="<?php echo(url('admin/player/add/tuple')); ?>"><button class="button red block">افزودن دسته جمعی</button></a>
                    </center>
                </div>
            </div>
        </section>
        <?php
        include('footer.php');
        break;
}
?>