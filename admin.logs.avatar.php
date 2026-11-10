<?php
if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('notfound', 'deleteavatar');
if(isset($_POST['action']) || empty($_POST[''])){
    if($_POST['action']=='delete'){
        $user=isset($_POST['user'])?safe::number($_POST['user']):'';
        if($user=='' && $user<1){
            echo(json_encode(array('status'=>false,'error'=>'profile')));
            exit();
        }else{
            $sql->where("id",$user);
            $sql->where("avatar", $options['defaultavatar'], '!=');
            if($avatar= $sql->getValue('profiles','avatar')){
                $folder="theme/images/avatars/{$avatar}";
                if(is_file($folder)){
                    if($options['thumbavatar']=='true'){
                        $size=explode('*',$options['thumbavatarSize']);
                        if(count($size)>1){
                            $size[0]=safe::number($size[0]);
                            $size[1]=safe::number($size[1]);
                            if($size[0]=='' || $size[1]=='' || $size[0]==0 || $size[1]==0){
                                echo(json_encode(array('status'=>false,'error'=>'unexpectederror')));
                                exit();
                            }else{
                                $tmp_folder="theme/images/avatars/{$size[0]}-{$size[1]}/{$avatar}";
                                if(is_file($tmp_folder)){
                                    @unlink($tmp_folder);
                                }
                                unset($tmp_folder);
                            }
                        }else{
                            echo(json_encode(array('status'=>false,'error'=>'unexpectederror')));
                            exit();
                        }
                        unset($size);
                    }
                    @unlink($folder);
                    $sql->where("id", $user);
                    $sql->update('profiles', array(
                        'avatar' => $options['defaultavatar']
                    ));

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "اواتار .$user. را حذف کرد");}
					
                    echo(json_encode(array('status'=>true)));
                    exit();
                }else{
                    echo(json_encode(array('status'=>false,'error'=>'unexpectederror')));
                    exit();
                }
            }else{
                echo(json_encode(array('status'=>false,'error'=>'profile')));
                exit();
            }
        }
    }else{
        echo(json_encode(array('status'=>false,'error'=>'action')));
        exit();
    }
}else{
    echo(json_encode(array('status'=>false,'error'=>'action')));
    exit();
}
?>
