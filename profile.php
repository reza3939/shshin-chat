<?php
$avatars=array();
$sql->where("id", $user_id);
$profile_avatars = $sql->getOne('profiles');
$last_avatars=$profile_avatars["last_avatars"]!==""?(array)json_decode($profile_avatars["last_avatars"]):array();
$avatars[]=$profile_avatars["avatar"];
foreach($last_avatars as $avatar):
    if($avatar!=""&&$avatar!="photo.png"):
        $avatars[]=$avatar;
    else:
        continue;
    endif;
endforeach;
?>
<!DOCTYPE HTML>
<html dir="rtl">
    <head>
        <title>پروفایل <?= $profile['name']; ?></title>
     
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <link href="<?php echo(theme::url('theme/microblog/css/bootstrap.min.css')); ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo(theme::url('theme/microblog/css/bootstrap-rtl.min.css')); ?>">
	<link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo(theme::url('theme/microblog/css/profile.css')); ?>">
        <link href='<?php echo(url('theme/fonts/fonts.css')); ?>' rel='stylesheet' type='text/css'>
       
        <link href="<?php echo(url('theme/microblog/sweetalert/sweetalert.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo(url('theme/microblog/css/microblog.css')); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo(url('theme/microblog/css/jquery-ui.css')); ?>">
		
		<link rel="stylesheet" href="<?php echo(url('theme/jplayer/css/player.css')); ?>">
		
		
        <style type="text/css">
     
            #rating .like { background: #fff url("<?php echo(theme::url('theme/microblog/images/like-dislike.png')); ?>")  no-repeat scroll -28px 0px;
          	border-left: 1px solid #cccccc;$				border-right: 3px solid #13ab00;
			}
			#rating .dislike {
				 background: #fff url("<?php echo(theme::url('theme/microblog/images/like-dislike.png')); ?>") no-repeat scroll 10px 3px;
           	border-left: 3px solid #ff0000;
				border-right: 0px solid #cccccc;
			}
			.h-cover img{
				cursor: pointer;
				width: 100%;
				height: 100%;
				position: absolute;
				right: 0;
			}
			.avatar a {
				 background: #fff url("<?php echo(Profile::ShowResizedAvatar(is_file('theme/images/avatars/' . $profile['avatar']) ? $profile['avatar'] : ($profile['gender'] == '1' ? 'no_avatar_male.png' : 'no_avatar_female.jpg'))); ?>")  no-repeat scroll 0 0 / cover ;
          		cursor: pointer;
			} 

        </style>

     
    </head>
    <body>
        <nav role="navigation" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                        <span class="sr-only">منو</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" target="_blank" href="https://www.tarhpardaz.ir/">طرح پرداز</a>
                </div>
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/profile/<?= $MySessionId; ?>">پروفایل من</a></li>
                        <li><a href="/profile/edit">ویرایش پروفایل</a></li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">پیام ها <b class="caret"></b>	<?php if ($MySessionId == $profile['id']) { ?><span class="off-msg"><?php $sql->where("userid", $profile['id']); echo($sql->getValue('offline_message',"count(*)")); ?></span>  <?php } ?></a>
							
                            <ul role="menu" class="dropdown-menu">
                                <?php if ($MySessionId == $profile['id']) { ?>
                                    <li><a onclick="OfflineMessage();
                                            return false;" href="javascript:void(0);">مشاهده پیام ها</a></li>
                                    <?php }if ($MySessionId != $profile['id']) { ?>
                                    <li><a href="javascript:void(0);" data-toggle="modal" data-target=".bs-sendpm-lg">ارسال پیام</a></li>
                                <?php } ?>
                                <?php if ($MySessionId == $profile['id']) { ?>
                                    <li class="divider"></li>
                                    <li><a href="javascript:void(0);" onclick="DeleteOfflineMessage();
                                            return false;">حذف پیام ها</a></li>
                                    <?php } ?>
                            </ul>
                        </li>
                    </ul>
      <ul class="nav navbar-nav">
                     <li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);"><font color="white">لینک ها</font> <b class="caret"></b></a>
						<ul role="menu" class="dropdown-menu">
							<li><a target="_blank" href="/rank/likes">برترین کاربران براساس لایک پروفایل</a></li>
							<li><a target="_blank" href="/rank/posts">برترین کاربران براساس مطالب ارسالی</a></li>
							<li><a target="_blank" href="/rank/ldposts">برترین کاربران براساس لایک مطالب</a></li>
							<li><a target="_blank" href="/rank/ldavatar">برترین کاربران براساس لایک آواتار</a></li>
							<li><a target="_blank" href="/rank/ldmusic">برترین کاربران براساس آهنگ مورد علاقه</a></li>
							<li><a target="_blank" href="/users">امتیازات کاربران</a></li>
						</ul>
					</li>
				</ul>
                    <form role="search" class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" id="autocomplete" placeholder="جستجوی کاربر" class="form-control">
                            <span id="loading-user"><img src="<?php echo(url('theme/microblog/images/ajax-loader.gif?ver=1')); ?>"></span>
                        </div>
                    </form>
            
</li>
<ul class="nav navbar-nav navbar-left">

      <?php if ($usertype[$profile['type']]['admin'] == '0' && session('id') != $profile['id']) { ?><li class="dropdown"><a id="blacklistmanager" onclick="BlackList('<?php echo $ProfileUserInMyBlackList ? 'del' : 'add'; ?>');
                                                    return false;" href="javascript:void(0);"><?php echo $ProfileUserInMyBlackList ? '<font color="white">برقراری ارتباط</font>' : '<font color="red">قطع ارتباط</font>'; ?></a></li><?php } ?>
  </ul>
                    <?php if (chatroom::checkPermission('modprofile')) { ?>
                        <ul class="nav navbar-nav navbar-left">
                            <?php if (CheckAdminType($profile['type']) && $profile['id'] != $MySessionId) { ?>
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);"><font color="white">مدیریت</font> <b class="caret"></b></a>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a onclick="ProfileReset('avatar');
                                                return false;" href="javascript:void(0);">حذف تمام آواتارها</a></li>
   <li><a onclick="ProfileReset('cover');
                                                return false;" href="javascript:void(0);">حذف کاور</a></li>
                                        <li><a onclick="ProfileReset('shout');
                                                return false;" href="javascript:void(0);">حذف فریاد</a></li>
                                        <li><a onclick="ProfileReset('music');
                                                return false;" href="javascript:void(0);">حذف آهنگ مورد علاقه</a></li>
                                        <li><a onclick="ProfileReset('info');
                                                return false;" href="javascript:void(0);">حذف توضیحات</a></li>
                                        <li><a onclick="ProfileReset('posts');
                                                return false;" href="javascript:void(0);">حذف تمام مطالب ارسالی</a></li>
                                        <li class="divider"></li>
                                        <li><a onclick="ProfileReset('all');
                                                return false;" href="javascript:void(0);">حذف کامل اطلاعات</a></li>
                                        <li><a id="profileresetmanager" onclick="ProfileReset('<?php echo $profile['active'] == '1' ? 'disable' : 'enable'; ?>');
                                                return false;" href="javascript:void(0);"><?php echo $profile['active'] == '1' ? '<font color="red">غیر فعال کردن پروفایل</font>' : '<font color="green">فعال کردن پروفایل</font>'; ?></a></li>
                                     <li class="divider"></li>
                                    <?php if (session('id') != $profile['id']) { ?><li><a id="blacklistmanager" onclick="BlackList('<?php echo $ProfileUserInMyBlackList ? 'del' : 'add'; ?>');
                                                    return false;" href="javascript:void(0);"><?php echo $ProfileUserInMyBlackList ? '<font color="green">برقراری ارتباط</font>' : '<font color="red">قطع ارتباط</font>'; ?></a></li><?php } ?>
                                </ul>
                            </li>
                            <?php } elseif ($usertype[$profile['type']]['admin'] == '0' && session('id') != $profile['id']) { ?>
                                <li><a id="blacklistmanager" onclick="BlackList('<?php echo $ProfileUserInMyBlackList ? 'del' : 'add'; ?>');
                                        return false;" href="javascript:void(0);"><?php echo $ProfileUserInMyBlackList ? '<font color="green">برقراری ارتباط</font>' : '<font color="red">قطع ارتباط</font>'; ?></a></li>
                                <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>
        <div class="container hcon">
            <div class="row header">
                <div class="col-lg-12 h-cover cover" data-target=".bs-avatar-lg">
                    <a data-toggle="modal" data-target=".bs-cover-lg"><img src="<?php echo($MyCover); ?>"></a>
<div class="follow_friends">
				 <ul class="nav navbar-nav">
                        <?php if ($MySessionId != $profile['id']) { ?>
                            <li><a id="userfollowmanager" onclick="UserFollowers('<?php echo!Profile::MeInFollower($ProfileFollowers) ? 'add' : 'del'; ?>');
                                    return false;" href="javascript:void(0);"><i class="fa fa-chain-broken"></i><?php echo!Profile::MeInFollower($ProfileFollowers) ? 'دنبال کردن ' : 'حذف از دنبال شدگان '; ?></a></li>
                                <?php if (!Profile::IsMyFriend($_ProfileFriends)) { ?>
                                <li><a onclick="SendReques2friend('add');
                                        return false;" href="javascript:void(0);"><i class="fa fa-user-plus"></i>ارسال درخواست دوستی</a></li>
                                <?php } else { ?>
                                <li><a onclick="SendReques2friend('del');
                                        return false;" href="javascript:void(0);"><i class="fa fa-user-plus"></i>حذف از دوستی</a></li>
                                    <?php
                                }
                            }
                            ?>
				</div>
                    <div class="avatar <?php if ($hide == '0' and $online == "online") echo "on"; ?>">
                        <a data-toggle="modal" data-target=".bs-avatar-lg"></a>
                    </div>

                    <?php if ($user_settings['ldconfig'] == '1') { ?>
                        <div id="likes">
                            <div id="rating"><b class="like"><a onclick="ShowLDMain('liked');
                                    return false"><div id="ValueLikeUser"><?= $profile['like']; ?></div></a></b><span onclick="ProfilePoint('like')" class="like"></span><span onclick="ProfilePoint('dislike')" class="dislike"></span><b class="dislike"><a onclick="ShowLDMain('disliked');
                                            return false;"><div id="ValueDisLikeUser"><?= $profile['dislike'] * -1; ?></div></a></b></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row status">
                <div class="col-lg-12">
                    <div id="hiddenshout"><b><li class="fa fa-bullhorn fa-flip-horizontal fa-lg"></li> </b><span><?php echo bbcode::SmileComment($profile['shout']); ?></span><?php if ($profile['id'] == session('id')) { ?><div class="pull-left"><li onclick="$('#hiddenshout').hide();
                                $('#showshout').show();" class="fa fa-pencil fa-lg cursor"></li></div><?php } ?></div>
                    <div id="showshout" style="display:none;"><input style="width: 93%;" type="text" placeholder="متن خود را وارد کنید" />&nbsp;<i onclick="SingleEdit('shout');" class="fa fa-send-o fa-2x cursor">&nbsp;</i><li onclick="ShowSmileShout();" class="fa fa-smile-o fa-2x cursor"></li></div>
                </div>
                <div id="showsmileshout-loader"></div>
                <div class="loadsmiley" style="display:none;" id="showsmileshout"></div>
            </div> 
        </div>
        <div class="container">
            <div class="row content">
                <div class="col-lg-3 righinfo">
                   <div class="panel info">
                        <div class="panel-body">
                            <div class="task-thumb-details">
                                <h1><a href="/profile/<?= $profile['id']; ?>" <?php if (strlen($profile['name']) > 10) echo "style=\"font-size: 30px;\"";elseif (strlen($profile['name']) > 15) echo "style=\"font-size: 28px;\""; ?>><?php echo($profile['name']); ?></a></h1>
                                <img <?php if ($hide == '0' and $online == "online") echo "class=\"on\""; ?> alt="" src="<?php echo(Profile::ShowResizedAvatar(is_file('theme/images/avatars/' . $profile['avatar']) ? $profile['avatar'] : ($profile['gender'] == '1' ? 'no_avatar_male.png' : 'no_avatar_female.jpg'))); ?>" data-toggle="modal" data-target=".bs-avatar-lg">
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><b><i class="fa fa-signal">  </i> درجه : <img alt="<?= $usertype[$profile['type']]['title']; ?>" title="<?= $usertype[$profile['type']]['title']; ?>" src="/<?= $usertype[$profile['type']]['icon']; ?>"></b></li>
                            <li class="list-group-item"><b><i class="fa fa-newspaper-o"> </i> مطالب ارسالی : <font color="#000">&nbsp;<?php
                                if ($profile['cposts']) {
                                    echo $profile['cposts'];
                                } else {
                                    echo '0';
                                }
                                ?></font></b></li>
                            <?php if ($_ShowInfos) { ?>
                                <li class="list-group-item"><b><i class="fa fa-calendar-plus-o"></i> تاریخ عضویت </b><?php echo($user['registerDate']); ?></li>
                                <li class="list-group-item"><b><i class="fa fa-calendar"></i> آخرین حضور </b><span><?php echo($user['lastAcivity']); ?> ساعت : <?php echo($user['lastAcivityTime']); ?></span></li>
                                <li class="list-group-item"><b><i class="fa fa-calendar-check-o"></i> تاریخ تولد </b><?php echo($birthDate); ?></li>
<li class="list-group-item"><b><i class="fa fa-heartbeat"></i> وضعیت رابطه  :  <?php echo($tie); ?></b></li>
                                <li class="list-group-item"><b><i class="fa fa-user-circle"></i> جنسیت : &nbsp; <font color="#000"><?php echo($gender); ?></font></b></li>
                                <li class="list-group-item"><b><i class="fa fa-map-marker"></i> شهر : <?php echo($profile['city'] ? '<a id="showmapcity" onclick="return showmapcity();" href="http://maps.google.com/maps?q=' . $profile['city'] . ',+' . $profile['country'] . '">' . $profile['city'] . '</a>' : 'وارد نشده'); ?></b></li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>

                <div id="results" class="col-lg-5 centercontents">
                    <?php if ($profile['id'] == $MySessionId) { ?>
                        <div class="send-post no-padding blank">
                            <div class="send-upload">
                                <form id="postform">
                                    <textarea id="postval" placeholder="متن خود را بنویسید ..." ></textarea>
                                    <ul style="display: none;">
                                        <li><a title="" data-toggle="tooltip" data-placement="top" data-original-title="موزیک"><i class="fa fa-music"></i></a></li>
                                        <li><a title="" data-toggle="tooltip" data-placement="top" data-original-title="ویدئو"><i class="fa fa-video-camera"></i></a></li>
                                        <li><a title="" data-toggle="tooltip" data-placement="top" data-original-title="لینک"><i class="fa fa-link"></i></a></li>
                                        <li><a title="" data-toggle="tooltip" data-placement="top" data-original-title="تصویر"><i class="fa fa-picture-o"></i></a></li>
                                    </ul>
                                    <button id="sendpostbtn" onclick="sendpost();" type="submit" class="btn btn-success green"><i class="fa fa-share"></i> ارسال</button>
                                </form>
                            </div>
					<center><button id="helpsec" type="button" class="btn btn-md btn-primary" style="font-size: 17px;margin-top: 10px;"><i class="fa fa-info-circle"></i>  راهنمای ارسال مطلب</button></center>
					<center><button id="closehelpsec" type="button" class="btn btn-md btn-primary" style="font-size: 17px;margin-top: 10px;display: none;"><i class="fa fa-info-circle"></i> بستن راهنمای ارسال مطلب</button></center>
<div id="helpinfo" style="font-size:18px;display: none;">
					<p style="color:#F00;">
						<br>* اگر میخواهید مطالب دوستان و بقیه در پروفایل شما مشاهده نشود از قسمت ویرایش پروفایل تیک گزینه های مشاهده پروفایل دوستان را برداشته و سپس ذخیره کنید.
						<br><br><span style="font-size:20px;">* درصورت مشاهده مطالب زشت پروفایل شما غیرفعال  و امتیاز شما صفر و از چت اخراج می شوید.</span>
					</p>
					<center><h1>آموزش آپلود عکس</h1></center>
					<br>آپلود عکس : <a href="http://uupload.ir" target="_blank"> کلیک کنید </a>
					<br> بعد از آپلود عکس آدرس مستقیم عکس را از سایتی که آپلود کردید کپی کنید و سپس مانند عکس زیر انجام دهید.<br> 
					<img src="/theme/microblog/images/amoz.png" /> 
					</div>
                        </div>
                        <div id="show-ajax-w8"></div>
                        <div id="getajaxposts"></div>
                        <?php
                    }
                    $limit = null;
                    $c = 0;
                    if($giu3){
                        $sql->where("p.id", $giu3);
                    }else{
                        $sql->where("p.userid", $profile['id']);
                        if($friends_followers and $profile['id'] == $MySessionId){
                            $sql->orWhere("p.userid", $friends_followers, 'in');
                        }
                        $sql->orderBy('p.id', 'DESC');
                       $limit = 4;
                    }
                    $c = 0;
                    $sql->join('users u', 'u.id=p.userid', 'LEFT');
                    $sql->join('profiles pr', 'pr.id=p.userid', 'LEFT');
                    $sql->join('onlines o', 'o.id=p.userid', 'LEFT');
                    foreach($sql->get('profile_posts p', $limit, array('o.hide','p.*', 'u.name', 'u.type', 'u.gender', 'pr.avatar', 'o.id as online')) as $row){
                        $c++;
                        $comments = count((array) json_decode($row['comments'], true));
                        $uonline = $row['hide'] == '0' ? 'class="on"' : '';
                        $Access2DeletePost = $row['userid'] != $MySessionId ? CheckAdminType($row['type']) : true;
                        $pdisabled = false;
                        if ($row['disabled'] == '1') {
                            $pdisabled = true;
                            ?>
                            <style type="text/css">
                                #panelid-<?= $row['id'] ?> > .panel-heading ,#panelid-<?= $row['id'] ?> > .panel-footer{
                                    background-color: #FFE6E6;
                                }
                            </style>
                        <?php } ?>
                        <div id="panelid-<?= $row['id'] ?>" class="panel panel-default">
                            <div class="panel-heading"><img <?= $uonline; ?> data-toggle="tooltip" data-placement="bottom" title="<?= $row['name']; ?> - <?= $usertype[$row['type']]['title']; ?>" src="<?php echo(Profile::ShowAvatarPostSender($row['avatar'], $row['gender'])); ?>"><span> <a target="_blank" href="/profile/<?= $row['userid']; ?>"><?= $row['name'] ?></a> در <?= jdate::start('l d F Y ساعت H:i:s', $row['time']) ?> نوشت:</span>
                                <div class="btn-toolbar navbar-left">
                                    <div class="btn-group">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="/theme/microblog/images/gears.png" alt=""></a>
                                        <ul class="dropdown-menu">
                                            <?php if ($row['userid'] != $MySessionId) { ?>
                                                <li><a onclick="PostReport('<?= $row['id'] ?>');" href="javascript:void(0);"><center>گزارش تخلف به مدیران</center></a></li>
                                            <?php } if ($row['userid'] == $MySessionId || $Access2DeletePost) { ?>

                                                <li class="divider"></li>
                                                <?php if ($pdisabled) { ?>
                                                    <li><a id="postmanager-<?= $row['id'] ?>" onclick="ProfilePostManager('<?= $row['id'] ?>', '0');" href="javascript:void(0);"><center><font color="green">فعال کردن نظرات</font></center></a></li>
                                                <?php } else { ?>
                                                    <li><a id="postmanager-<?= $row['id'] ?>" onclick="ProfilePostManager('<?= $row['id'] ?>', '1');" href="javascript:void(0);"><center><font color="red">غیر فعال کردن نظرات</font></center></a></li>
                                                <?php } ?>
                                                <li><a onclick="ProfileDeletePost('<?= $row['id'] ?>');" href="javascript:void(0);"><center>حذف این مطلب</center></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <span><div class="break-word"><?php echo bbcode::tohtml($row['content'], true); ?></div></span>
                            </div>
     <div class="panel-footer">
						<div class="row">
					<div class="col-lg-12 likes">
								<div class="p-comments" data-toggle="collapse" href="#comments-<?= $row['id']; ?>" aria-expanded="true" aria-controls="#comments-<?= $row['id']; ?>">
									<a data-toggle="collapse" href="#comments-<?= $row['id']; ?>" aria-expanded="false" aria-controls="#comments-<?= $row['id']; ?>" class="collapsed">
									<i class="fa fa-send fa-lg"></i></a><span>نظرات [<?= $comments; ?>]</span>
								</div>
                                        <div class="pull-left post-pull">
									<span class="postlikes" data-html="true" data-toggle="tooltip" data-placement="top" title="<?= $row['likes']; ?>" onclick="ShowLDUser('<?= $row['id']; ?>','liked','posts');" id="plikeid-<?= $row['id']; ?>"><?= $row['likes']; ?></span>
									<a class="post-prlikes" onclick="postlike('<?= $row['id']; ?>','like');return false;"><i class="fa fa-thumbs-up fa-lg"></i></a>
									<a class="post-pllikes" onclick="postlike('<?= $row['id']; ?>','dislike');return false;"><i class="fa fa-thumbs-down fa-lg"></i></a>
									<span class="postdislikes" data-html="true" data-toggle="tooltip" data-placement="top" title="<?= $row['dislikes']; ?>" onclick="ShowLDUser('<?= $row['id']; ?>','disliked','posts');" id="pdislikeid-<?= $row['id']; ?>"><?= $row['dislikes']; ?></span>
						
                                  	</div>
							</div>
						</div>
                                <div class="row">
                                    <div id="comments-<?= $row['id']; ?>" class="collapse commentsbox">
                                        <div class="col-lg-12 comments" id="comments-list-<?= $row['id']; ?>">
                                            <div class="pull-right"><a class="cursor" onclick="ShowCommentsProfile('<?= $row['id']; ?>', '');
                                                    return false;"><li class="fa fa-comments fa-lg"></li> (<?= $comments; ?>)</a></div>
                                            <hr>
                                            <div id="append-comments-<?= $row['id']; ?>"></div>
                                            <div id="showw8-<?= $row['id']; ?>"></div>

                                            <div id="hidden-show-post-<?= $row['id']; ?>" style="<?php echo $pdisabled ? 'display:none;' : 'display:block;'; ?>">
                                                <div class="pull-right"><a id="reloadtime-<?= $row['id'] ?>" class="cursor" onclick="ShowCommentsProfile('<?= $row['id']; ?>', '');
                                                        return false;"><i class="fa fa-refresh fa-lg"></i></a></div>
                                                <hr>
                                                <div id="reply-<?= $row['id']; ?>"></div>
                                                <div class="row" id="comments-form-<?= $row['id']; ?>">
                                                    <div class="send-upload">
                                                        <form class="commentsend" id="postid-<?= $row['id']; ?>">
                                                            <textarea placeholder="نظر خود را وارد کنید ..." ></textarea>
                                                            <button type="submit" onclick="SendCommentUser('<?= $row['id'] ?>', '');
                                                                    return false;" class="btn btn-success green"><i class="fa fa-share"></i> ارسال</button>
                                                            <button onclick="SmileArea('<?php echo $row['id']; ?>');
                                                                    return false;" class="btn btn-warning"><i class="fa fa-smile-o"></i>شکلک</button>
                                                        </form>
                                                    </div>
                                                </div><br>
                                                <div id="smilearea-loader-<?php echo $row['id']; ?>"></div>
                                                <div class="loadsmiley" id="smilearea-<?php echo $row['id']; ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } //mysqli_free_result($query); ?>
                    <?php if ($c == 0 && $MySessionId != $profile['id']) { ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <center><span>این پروفایل فاقد مطلب است.</span></center>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-lg-4 leftdetail">

                    <?php if (!empty($mymusic['music']) && ($user_settings['music_config'] != '0' || !isset($user_settings['music_config']))) { ?>
                        <div class="panel panel-details" id="mymusic">
                            <div class="panel-heading"><span><b>آهنگ مورد علاقه</b></span></div>

                            <div class="panel-body"><center>
                                 <div id="uniquePlayer-1" class="webPlayer light">
			                            <div id="uniqueContainer-1" class="videoPlayer"></div>
	                         	</div> </center>

                                <div class="more" onclick='ProfileCountPlayedMusic("<?= preg_replace('/\?rand=(\d+)/', '', $mymusic['music']); ?>");
                                        return false;'><span><li class="fa fa-cloud-download fa-2x"></li><small>(<font color="red"><?= $CountDownlodedMusic; ?> دانلود</font>)</small></span></div>
                                <div class="more-right"><span><li class="fa fa-comments-o fa-2x"></li><small>(<font color="red"><?= $commentsMusic; ?> نظر</font>)</small></span></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($profile['info']) && $_ShowInfos) { ?>
                        <div class="panel panel-details" id="userinfo">
                            <div class="panel-heading"><span><b>توضیحات</b></span></div>
                            <div class="panel-body"><p><div class="break-word"><?php echo Profile::ShowInfo($profile['info']); ?></div></p>
                                <div class="more"><span>بیشتر</span></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($_ShowFriends) { ?>
                        <div class="panel panel-details" id="myfriends">
                            <div class="panel-heading"><i class="fa fa-user-circle"></i><span><b>لیست دوستان</b></span></div>
                            <div class="panel-body">
                                <ul class="list-group friends">
                                    <?php Profile::ShowUsers($ProfileFriends); ?>
                                </ul>
                                <?php if (count($ProfileFriends) > '12') { ?>
                                    <div class="more"><span>بیشتر</span></div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($_ShowFollowers) { ?>
                        <div class="panel panel-details" id="myfollowers">
                            <div class="panel-heading"><i class="fa fa-users"></i><span><b>لیست دنبال کنندگان</b></span></div>
                            <div class="panel-body">
                                <ul class="list-group friends">
                                    <?php Profile::ShowUsers($ProfileFollowers); ?>
                                </ul>
                                <?php if (count($ProfileFollowers) > '12') { ?>
                                    <div class="more" onclick="UserFollowers('show');
                                            return false;"><span>بیشتر</span></div>
                                     <?php } ?>
                            </div>
                        </div>
                    <?php } ?>	


	
                    <?php if (true) { ?>
                        <div class="panel panel-details" id="myfollowers">
                            <div class="panel-heading"><i class="fa fa-newspaper-o"></i><span><b>آخرین مطالب ارسالی</b></span></div>
                            <div class="panel-body">
                                <ul class="list-group friends">
                                    <?php Profile::ShowLastPosts(); ?>
                                </ul>
                                <?php if (true) { ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($_ShowLastView) { ?>
                        <div class="panel panel-details">
                            <div class="panel-heading"><i class="fa fa-eye"></i><span><b>آخرین بازدید کننده ها</b></span></div>
                            <div class="panel-body">
                                <ul class="list-group friends">
                                    <?php Profile::ShowUsers($ProfileLastViewUsers); ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>

<?php 
   $off=0;
$sql->where("id", $profile['id']);
$qu = $sql->getOne('users', array('score'));
$sql->where("userid", $profile['id']);
foreach($sql->get('offline_message', null, array('text')) as $row2){
$pf = explode(',', $row2['text']);
foreach ($pf as $pfs) {
            if (!empty($pfs)) {
                    $off+=1;
            }            
       }  
}

?>
<?php if (true) { ?>
                        <div class="panel panel-details" id="myfollowers">
					<div class="panel-heading"><i class="fa fa-envira"></i><span><b>جزئیات این پروفایل</b></span></div>
                            <div class="panel-body">
                                <ul class="list-group friends">
                                    <table align="center">
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>نام</b></td><td style="text-align: left;"><?php echo $profile['name']; ?></b></td></tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>امتیاز</b></td><td style="text-align: left;"><?php echo $qu['score']; ?></b></td></tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>وضعیت کاربر</b></td><td style="text-align: left;"><?= ($hide == '0' and $online == "online") ? 'آنلاین' : 'آفلاین';?></b></td></tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>تعداد دوستان</b></td><td style="text-align: left;"><?php echo count($ProfileFriends); ?></b></td></tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>تعداد دنبال کنندگان</b></td><td style="text-align: left;"><?php echo count($ProfileFollowers); ?></b></td></tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>تعداد لایک ها</b></td><td style="text-align: left;"><?php echo $profile['like']; ?></b></td></tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>تعداد دیسلایک ها</b></td><td style="text-align: left;"><?php echo $profile['dislike']; ?></b></td></tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>تعداد لایک های واقعی</b></td><td style="text-align: left;"><?php echo $profile['like']-$profile['dislike']; ?></b></td></tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>پیام های آفلاین</b></td><td style="text-align: left;"><?php if($off != 0) echo $off; else echo 0; ?></b></td></tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>پیام های دریافتی</b></td><td style="text-align: left;"><?=($hide == '0' and $online == "online") ? $sql->where("to", $profile['id'])->getValue('message',"count(*)") : '0'; ?></b></td></tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;color: #337ab7;display: block;margin: 1px 0 6px;"><b>پیام های ارسالی</b></td><td style="text-align: left;"><?=($hide == '0' and $online == "online") ? $sql->where("user", $profile['id'])->getValue('message',"count(*)") : '0'; ?></b></td></tr>
</table>
                                </ul>
                                <?php if (true) { ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row footer">
            </div>
        </div>
        <div class="modal fade bs-sendpm-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="panel">
                        <div class="panel-heading"><span><b>ارسال پیام خصوصی</b></span></div>
                        <div class="panel-body">
                            <div class="send-upload">
                                <form id="messageform">
                                    <textarea id="messageval" placeholder="متن خود را وارد کنید . کاراکتر محدود است ..." ></textarea>
                                    <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> ارسال</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-profile-ldmain-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group friends">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-avatar-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img id="img_avatar_show" src="<?php echo(is_file('theme/images/avatars/' . $profile['avatar']) && $profile['avatar'] != 'photo.png' ? theme::url('theme/images/avatars/' . $profile['avatar']) : ($profile['gender'] == '1' ? theme::url('theme/images/avatars/no_avatar_male.png') : theme::url('theme/images/avatars/no_avatar_female.jpg'))); ?>" class="img-responsive">
<?php if($user_id==session("id")&&$profile["avatar"]!=="photo.png"): ?>
                    <br>
                    <center>
                        <input type="hidden" id="now_profile_avatar" value="<?=$profile["avatar"];?>" />
          <button style="margin:5px !important;" class="btn btn-md btn-success"><?=jdate::start("l d F Y ساعت H:i:s",time());?></button><br>
                        <button class="btn btn-md btn-primary" onclick="set_avatar();">انتخاب این آواتار برای آواتار اصلی</button>
                        <button class="btn btn-md btn-danger" onclick="delete_avatar();">حذف این آواتار</button>
                    </center>
                    <br>
<?php endif; ?>

                    <div class="panel-footer">
						<div class="row">
					<div class="col-lg-12 likes">
								<div class="p-comments" data-toggle="collapse" href="#comments-avatar-<?= $profile['id'] ?>" aria-expanded="true" aria-controls="#comments-avatar-<?= $profile['id'] ?>">
									<a data-toggle="collapse" href="#comments-avatar-<?= $profile['id'] ?>" aria-expanded="false" aria-controls="#comments-avatar-<?= $profile['id'] ?>" class="collapsed">
									<i class="fa fa-send fa-lg"></i></a><span>نظرات [<?= $commentsAvatar; ?>]</span>
								</div>
                                        <div class="pull-left post-pull">
									<span class="postlikes" data-html="true" data-toggle="tooltip" data-placement="top" title="<?= $profile['likes'] ?>" onclick="ShowLDUser('<?= $profile['id'] ?>', 'liked', 'avatar');" id="plikeidav-<?= $profile['id'] ?>"><?= $ldavatar['likes']; ?></span>
									<a class="post-prlikes" onclick="UserLike('<?= $profile['id']; ?>', 'like', 'avatar');return false;"><i class="fa fa-thumbs-up fa-lg"></i></a>
									<a class="post-pllikes" onclick="UserLike('<?= $profile['id']; ?>', 'dislike', 'avatar');return false;"><i class="fa fa-thumbs-down fa-lg"></i></a>
									<span class="postdislikes" data-html="true" data-toggle="tooltip" data-placement="top" title="<?= $profile['id'] ?>" onclick="ShowLDUser('<?= $profile['id'] ?>', 'disliked', 'avatar');" id="pdislikeidav-<?= $profile['id'] ?>"><?= $ldavatar['dislikes']; ?></span>
                                    <a onclick="show_pic_avatar('next');return false;"><i class="fa fa-chevron-right fa-lg"></i></a>
                                    <a onclick="return false;">
                                        <span id="span_show_picture_current">1</span>
                                        <span>از</span>
                                        <span id="span_show_picture_all"><?=count($avatars);?></span>
                                    </a>
                                    <a onclick="show_pic_avatar('prev');return false;"><i class="fa fa-chevron-left fa-lg"></i></a>
						
                                  	</div>
							</div>
						</div>
                                <div class="row">
                                    <div id="comments-avatar-<?= $profile['id'] ?>" class="collapse commentsbox">
                                        <div class="col-lg-12 comments" id="comments-list-avatar-<?= $profile['id'] ?>">
                                            <div class="pull-right"><a class="cursor" onclick="ShowCommentsProfile('<?= $profile['id']; ?>', 'avatar-');return false;"><li class="fa fa-comments fa-lg"></li> (<?= $commentsAvatar; ?>)</a></div>
                                            <hr>
                                            <div id="append-comments-avatar-<?= $profile['id'] ?>"></div>
                                            <div id="showw8-avatar-<?= $profile['id'] ?>"></div>

                                            <div id="hidden-show-post-avatar-<?= $profile['id'] ?>" style="<?php echo $pdisabled ? 'display:none;' : 'display:block;'; ?>">
                                                <div class="pull-right"><a id="reloadtime-<?= $profile['id'] ?>" class="cursor" onclick="ShowCommentsProfile('<?= $profile['id']; ?>', 'avatar-');return false;"><i class="fa fa-refresh fa-lg"></i></a></div>
                                                <hr>
                                                <div id="reply-<?= $profile['id'] ?>"></div>
                                                <div class="row" id="comments-form-avatar-<?= $profile['id'] ?>">
                                                    <div class="send-upload">
                                                        <form class="commentsend" id="postid-avatar-<?= $profile['id'] ?>">
                                                            <textarea placeholder="نظر خود را وارد کنید ..." ></textarea>
                                                            <button type="submit" onclick="SendCommentUser('<?= $profile['id'] ?>', 'avatar-');return false;" class="btn btn-success green"><i class="fa fa-share"></i> ارسال</button>
                                                        </form>
                                                    </div>
                                                </div><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                </div>
            </div>
        </div>	
        <div class="modal fade bs-cover-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <img src="<?php echo($MyCover); ?>" class="img-responsive">

                         <div class="panel-footer">
						<div class="row">
					<div class="col-lg-12 likes">
								<div class="p-comments" data-toggle="collapse" href="#comments-cover-<?= $profile['id'] ?>" aria-expanded="true" aria-controls="#comments-cover-<?= $profile['id'] ?>">
									<a data-toggle="collapse" href="#comments-cover-<?= $profile['id'] ?>" aria-expanded="false" aria-controls="#comments-cover-<?= $profile['id'] ?>" class="collapsed">
									<i class="fa fa-send fa-lg"></i></a><span>نظرات [<?= $commentsCover; ?>]</span>
								</div>
                                        <div class="pull-left post-pull">
									<span class="postlikes" data-html="true" data-toggle="tooltip" data-placement="top" title="<?= $profile['likes'] ?>" onclick="ShowLDUser('<?= $profile['id'] ?>', 'liked', 'cover');" id="plikeidco-<?= $profile['id'] ?>"><?= $ldcover['likes']; ?></span>
									<a class="post-prlikes" onclick="UserLike('<?= $profile['id']; ?>', 'like', 'cover');return false;"><i class="fa fa-thumbs-up fa-lg"></i></a>
									<a class="post-pllikes" onclick="UserLike('<?= $profile['id']; ?>', 'dislike', 'cover');return false;"><i class="fa fa-thumbs-down fa-lg"></i></a>
									<span class="postdislikes" data-html="true" data-toggle="tooltip" data-placement="top" title="<?= $profile['id'] ?>" onclick="ShowLDUser('<?= $profile['id'] ?>', 'disliked', 'cover');" id="pdislikeidco-<?= $profile['id'] ?>"><?= $ldcover['dislikes']; ?></span>
						
                                  	</div>
							</div>
						</div>
                                <div class="row">
                                    <div id="comments-cover-<?= $profile['id'] ?>" class="collapse commentsbox">
                                        <div class="col-lg-12 comments" id="comments-list-cover-<?= $profile['id'] ?>">
                                            <div class="pull-right"><a class="cursor" onclick="ShowCommentsProfile('<?= $profile['id']; ?>', 'cover-');return false;"><li class="fa fa-comments fa-lg"></li> (<?= $commentsCover; ?>)</a></div>
                                            <hr>
                                            <div id="append-comments-cover-<?= $profile['id'] ?>"></div>
                                            <div id="showw8-cover-<?= $profile['id'] ?>"></div>

                                            <div id="hidden-show-post-cover-<?= $profile['id'] ?>" style="<?php echo $pdisabled ? 'display:none;' : 'display:block;'; ?>">
                                                <div class="pull-right"><a id="reloadtime-<?= $profile['id'] ?>" class="cursor" onclick="ShowCommentsProfile('<?= $profile['id']; ?>', 'cover-');return false;"><i class="fa fa-refresh fa-lg"></i></a></div>
                                                <hr>
                                                <div id="reply-<?= $profile['id'] ?>"></div>
                                                <div class="row" id="comments-form-cover-<?= $profile['id'] ?>">
                                                    <div class="send-upload">
                                                        <form class="commentsend" id="postid-cover-<?= $profile['id'] ?>">
                                                            <textarea placeholder="نظر خود را وارد کنید ..." ></textarea>
                                                            <button type="submit" onclick="SendCommentUser('<?= $profile['id'] ?>', 'cover-');return false;" class="btn btn-success green"><i class="fa fa-share"></i> ارسال</button>
                                                        </form>
                                                    </div>
                                                </div><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                </div>
            </div>
        </div>
        <div class="modal fade bs-more" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group friends">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade offlinemsg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body comments">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade ldposts" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group friends">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade followers" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group friends">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade userinfo-more" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        <p><div class="break-word"><?= str_replace("\n", '<br>', $profile['info']); ?></div></p>
                    </div>

                <div class="panel-footer">
						<div class="row">
					<div class="col-lg-12 likes">
								<div class="p-comments" data-toggle="collapse" href="#comments-info-<?= $profile['id'] ?>" aria-expanded="true" aria-controls="#comments-info-<?= $profile['id'] ?>">
									<a data-toggle="collapse" href="#comments-info-<?= $profile['id'] ?>" aria-expanded="false" aria-controls="#comments-info-<?= $profile['id'] ?>" class="collapsed">
									<i class="fa fa-send fa-lg"></i></a><span>نظرات [<?= $commentsInfo; ?>]</span>
								</div>
                                        <div class="pull-left post-pull">
									<span class="postlikes" data-html="true" data-toggle="tooltip" data-placement="top" title="<?= $profile['likes'] ?>" onclick="ShowLDUser('<?= $profile['id'] ?>', 'liked', 'info');" id="plikeidinf-<?= $profile['id'] ?>"><?= $ldinfo['likes']; ?></span>
									<a class="post-prlikes" onclick="UserLike('<?= $profile['id']; ?>', 'like', 'info');return false;"><i class="fa fa-thumbs-up fa-lg"></i></a>
									<a class="post-pllikes" onclick="UserLike('<?= $profile['id']; ?>', 'dislike', 'info');return false;"><i class="fa fa-thumbs-down fa-lg"></i></a>
									<span class="postdislikes" data-html="true" data-toggle="tooltip" data-placement="top" title="<?= $profile['id'] ?>" onclick="ShowLDUser('<?= $profile['id'] ?>', 'disliked', 'info');" id="pdislikeidinf-<?= $profile['id'] ?>"><?= $ldinfo['dislikes']; ?></span>
						
                                  	</div>
							</div>
						</div>
                                <div class="row">
                                    <div id="comments-info-<?= $profile['id'] ?>" class="collapse commentsbox">
                                        <div class="col-lg-12 comments" id="comments-list-info-<?= $profile['id'] ?>">
                                            <div class="pull-right"><a class="cursor" onclick="ShowCommentsProfile('<?= $profile['id']; ?>', 'info-');return false;"><li class="fa fa-comments fa-lg"></li> (<?= $commentsInfo; ?>)</a></div>
                                            <hr>
                                            <div id="append-comments-info-<?= $profile['id'] ?>"></div>
                                            <div id="showw8-info-<?= $profile['id'] ?>"></div>

                                            <div id="hidden-show-post-info-<?= $profile['id'] ?>" style="<?php echo $pdisabled ? 'display:none;' : 'display:block;'; ?>">
                                                <div class="pull-right"><a id="reloadtime-<?= $profile['id'] ?>" class="cursor" onclick="ShowCommentsProfile('<?= $profile['id']; ?>', 'info-');return false;"><i class="fa fa-refresh fa-lg"></i></a></div>
                                                <hr>
                                                <div id="reply-<?= $profile['id'] ?>"></div>
                                                <div class="row" id="comments-form-info-<?= $profile['id'] ?>">
                                                    <div class="send-upload">
                                                        <form class="commentsend" id="postid-info-<?= $profile['id'] ?>">
                                                            <textarea placeholder="نظر خود را وارد کنید ..." ></textarea>
                                                            <button type="submit" onclick="SendCommentUser('<?= $profile['id'] ?>', 'info-');return false;" class="btn btn-success green"><i class="fa fa-share"></i> ارسال</button>
                                                        </form>
                                                    </div>
                                                </div><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                </div>
            </div>
        </div>
        <div class="modal fade comments-mymusic" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        <p><div class="break-word"><?php echo!empty($mymusic['music_info']) && isset($mymusic['music_info']) ? str_replace("\n", '<br>', $mymusic['music_info']) : 'توضیحی برای این آهنگ توسط کاربر ثبت نشده است'; ?></div></p>
                    </div>

                                    <div class="panel-footer">
						<div class="row">
					<div class="col-lg-12 likes">
								<div class="p-comments" data-toggle="collapse" href="#comments-music-<?= $profile['id'] ?>" aria-expanded="true" aria-controls="#comments-music-<?= $profile['id'] ?>">
									<a data-toggle="collapse" href="#comments-music-<?= $profile['id'] ?>" aria-expanded="false" aria-controls="#comments-music-<?= $profile['id'] ?>" class="collapsed">
									<i class="fa fa-send fa-lg"></i></a><span>نظرات [<?= $commentsMusic; ?>]</span>
								</div>
                                        <div class="pull-left post-pull">
									<span class="postlikes" data-html="true" data-toggle="tooltip" data-placement="top" title="<?= $profile['likes'] ?>" onclick="ShowLDUser('<?= $profile['id'] ?>', 'liked', 'music');" id="plikeidmu-<?= $profile['id'] ?>"><?= $ldmusic['likes']; ?></span>
									<a class="post-prlikes" onclick="UserLike('<?= $profile['id']; ?>', 'like', 'music');return false;"><i class="fa fa-thumbs-up fa-lg"></i></a>
									<a class="post-pllikes" onclick="UserLike('<?= $profile['id']; ?>', 'dislike', 'music');return false;"><i class="fa fa-thumbs-down fa-lg"></i></a>
									<span class="postdislikes" data-html="true" data-toggle="tooltip" data-placement="top" title="<?= $profile['id'] ?>" onclick="ShowLDUser('<?= $profile['id'] ?>', 'disliked', 'music');" id="pdislikeidmu-<?= $profile['id'] ?>"><?= $ldmusic['dislikes']; ?></span>
						
                                  	</div>
							</div>
						</div>
                                <div class="row">
                                    <div id="comments-music-<?= $profile['id'] ?>" class="collapse commentsbox">
                                        <div class="col-lg-12 comments" id="comments-list-music-<?= $profile['id'] ?>">
                                            <div class="pull-right"><a class="cursor" onclick="ShowCommentsProfile('<?= $profile['id']; ?>', 'music-');return false;"><li class="fa fa-comments fa-lg"></li> (<?= $commentsMusic; ?>)</a></div>
                                            <hr>
                                            <div id="append-comments-music-<?= $profile['id'] ?>"></div>
                                            <div id="showw8-music-<?= $profile['id'] ?>"></div>

                                            <div id="hidden-show-post-music-<?= $profile['id'] ?>" style="<?php echo $pdisabled ? 'display:none;' : 'display:block;'; ?>">
                                                <div class="pull-right"><a id="reloadtime-<?= $profile['id'] ?>" class="cursor" onclick="ShowCommentsProfile('<?= $profile['id']; ?>', 'music-');return false;"><i class="fa fa-refresh fa-lg"></i></a></div>
                                                <hr>
                                                <div id="reply-<?= $profile['id'] ?>"></div>
                                                <div class="row" id="comments-form-music-<?= $profile['id'] ?>">
                                                    <div class="send-upload">
                                                        <form class="commentsend" id="postid-music-<?= $profile['id'] ?>">
                                                            <textarea placeholder="نظر خود را وارد کنید ..." ></textarea>
                                                            <button type="submit" onclick="SendCommentUser('<?= $profile['id'] ?>', 'music-');return false;" class="btn btn-success green"><i class="fa fa-share"></i> ارسال</button>
                                                        </form>
                                                    </div>
                                                </div><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                    
                </div>
            </div>
        </div>
    <div class="modal fade bs-editpost-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">ویرایش پست</h4>
                    </div>
                    <div class="modal-body mb">
                        <div class="send-upload">
                            <form id="editpost">
                                <input name="postid" id="editpostid" type="hidden">
                                <textarea name="posttext" id="editposttext" placeholder="متن خود را وارد کنید ..." ></textarea>
                                <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> ارسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script type="text/javascript" src="<?php echo(theme::url('theme/microblog/js/jquery.min.js')); ?>"></script>
        <script src="<?php echo theme::url("theme/microblog/js/jquery-ui.js"); ?>"></script>     
        <script type="text/javascript" src="<?php echo(theme::url('theme/microblog/sweetalert/sweetalert.min.js')); ?>"></script>
        <link href="<?php echo(theme::url('theme/microblog/editor/themes/modern.min.css')); ?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo(theme::url('theme/microblog/editor/fa.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo(theme::url('theme/microblog/js/enscroll-0.6.1.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo(theme::url('theme/microblog/js/bootstrap.min.js')); ?>"></script>
		
		
		<script type="text/javascript" src="<?php echo(theme::url('theme/jplayer/js/jquery.jplayer.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo(theme::url('theme/jplayer/js/jplayer.cleanskin.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo(theme::url('theme/microblog/editor/jquery.sceditor.bbcode.min.js')); ?>"></script>  
        <script type="text/javascript">
                                                    $config = {
                                                        avatars: <?=json_encode($avatars,JSON_UNESCAPED_UNICODE);?>,
                                                        style_sceeditor: '<?= theme::url('theme/microblog/editor/jquery.sceditor.default.min.css'); ?>',
                                                        ajax_loader: '<?= theme::url('theme/microblog/images/ajax-loader.gif'); ?>',
                                                        avatar_dir: '<?='/' . $options['avatar_dir'] . '/';?>',
                                                        profile_id: '<?= $profile['id']; ?>',
                                                        myid: '<?= $MySessionId; ?>',
                                                        myavatar: '<?= $myavatar_sendcomment; ?>',
                                                        myname: '<?= session('name'); ?>',
                                                        token: '<?= session('changepw'); ?>',
							jplayer : '<?= url('theme/jplayer/img/Jplayer.swf'); ?>',						
                                                        music_title: '<?= $mymusic['music_title']; ?>',
                                                        music_url: '<?= url() . $mymusic['music']; ?>',
                                                        scroll_loding_url: '<?= url('ajax/chat.profile.getmoreposts'); ?>',
                                                        total_groups: '<?= $total_groups; ?>'
          <?php if ($profile['id'] == $MySessionId) { ?>
                                                            , emoticons: ''
          <?php } ?>
                                                    }
			$(document).ready(function() {			 
				$('.webPlayer').videoPlayer({
					name: '<?php echo($mymusic['music_title']); ?>',
					media: {
						mp3: '<?php echo($mymusic['music']); ?>',
                                                poster: '<?php echo($MyCover); ?>'							
					},				 
					size: {
						width: '100%',
						height: '150px'
					},				 
				});						 
			});	
        </script>
        <script type="text/javascript" src="<?php echo(theme::url('theme/microblog/js/microblog.js')); ?>?ver=8.0"></script>
      
    </body>

</html>