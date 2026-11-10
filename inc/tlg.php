<?php
$bot_id = "";
function makeHTTPRequest($method, $datas = array())
{
    global $bot_id;
    if ($bot_id === '' or !isset($datas['chat_id']) or $datas['chat_id'] === '') {
        return;
    }
    $url = "https://api.telegram.org/bot" . $bot_id . "/" . $method;
    $ch  = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datas));
    curl_exec($ch);
    curl_close($ch);
}
function tlg($text, $id)
{
    global $chat_id;
	$text .= "\n گروه طراحی طرح پرداز \n @TarhPardaz_Ir";
    if ($id == "chat") {
        $adminId = explode(',', $chat_id);
        if (count($adminId) == '1') {
            $messages = array(
                'chat_id' => $chat_id,
                'text' => $text
            );
            makeHTTPRequest('sendMessage', $messages);
        } elseif (count($adminId) > '1') {
            foreach ($adminId as $chatid) {
                $messages = array(
                    'chat_id' => $chatid,
                    'text' => $text
                );
                makeHTTPRequest('sendMessage', $messages);
            }
        }
    } else if ($id == "designer") {
        $tarhpardaz_id = '-12';
        $messages      = array(
            'chat_id' => $tarhpardaz_id,
            'text' => $text
        );
        makeHTTPRequest('sendMessage', $messages);
    }
}
?>