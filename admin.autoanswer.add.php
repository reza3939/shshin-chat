<?php

if (!session('id') or session('admin') == '0') {
    exit();
}
adminpanel::check_Permission('exit', 'addautoanswer');


$question = isset($_POST['question']) ? safe::string($_POST['question']) : '';
if ($question == '') {
    echo('question');
    return;
}
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

$sql->insert('autoanswer', array(
    'question' => $question,
    'answer' => $answer
));
if ($sql->has('autoanswer')) {
    $sql->where('name', 'autoanswer');
    $sql->update('options', array(
        'value' => 1
    ));
    chatroom::reloadconfig();
}
chatroom::reloadautoanswer();
$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
chatroom::addlog('9', "یک پاسخ خودکار اضافه کرد:$question");
}
echo('ok');
?>