<?php include('header.php'); include('sidebar.php'); ?>

<section id="content" class="container_12 clearfix" data-sort=true>




<?php



$id = $_GET['id'];

$delete = db::query("DELETE FROM {prefix}lottery WHERE id = '$id' ");

if($delete) {

echo "<p style=\"text-align: center; font-size: 1.5em;\">با موفقیت حذف شد.</p>";
}
 
else
{
echo "<p style=\"text-align: center; font-size: 1.5em;\">خطایی به وجود امده است.</p>";
}

?>










<center><input class="button red flat block" onclick="window.location='../../../admin/lotterycontorol'" type="button" value="بازگشت" /></center>
</section>

<?php include('footer.php'); ?>