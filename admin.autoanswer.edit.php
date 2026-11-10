<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'editautoanswer');


$id = isset($_POST['quest']) ? safe::number($_POST['quest']) : '';
if ($id == '') {
    echo('id');
    return;
}


$question = isset($_POST['question']) ? safe::string($_POST['question']) : '';
if ($question == '') {
    echo('question');
    return;
}
$sql->where("id", $id, '!=');
$sql->where("question", $question);
if($sql->has('autoanswer')){
    echo("repeatquest");
    return;
}

$answer = isset($_POST['answer']) ? safe::string($_POST['answer']) : '';
if ($answer == '') {
    echo('answer');
    return;
}
$sql->where("id", $id);
$sql->update('autoanswer', array(
    'question' => $question,
    'answer' => $answer
));
chatroom::reloadautoanswer();

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "متن دریافتی را ویرایش کرد:$question");
}
echo('ok');
?>