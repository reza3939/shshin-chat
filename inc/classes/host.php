<?php
class host
{
    static function refresh()
    {
		global $options, $sql;
        $host = json_decode($options['host'], true);
        if (time() - $host['refresh'] > 18000) {
            $host['spaceUsing'] = file::sizeConv(file::getSize($_SERVER['DOCUMENT_ROOT']), 'mb');
            $host['refresh']    = time();
            $host2              = json_encode($host, JSON_UNESCAPED_UNICODE);
			$sql->where('name', 'host')->update('options', array(
				'value' => $host2
			));
            if (($host['spaceUsing'] - $host['space']) > 300000000000000) {
				$sql->where('name', 'chat_close')->update('options', array(
					'value' => 'true'
				));
                $params                = json_decode($options['chat_closeparam'], true);
                $params['msg']         = 'چت روم شما به علت حجم زیاد تعطیل شد';
                $params['theme']       = 'close';
                $params['timetolunch'] = time() + 604800;
                $params                = json_encode($params, JSON_UNESCAPED_UNICODE);
				$sql->where('name', 'chat_closeparam')->update('options', array(
					'value' => $params
				));
            }
            chatroom::reloadconfig();
        }
    }
    static function get($request)
    {
        global $options;
        $host = json_decode($options['host'], true);
        return ($host[$request]);
    }
    static function expiration()
    {
		global $options, $sql;
        $host = json_decode($options['host'], true);
        if ((time() - $host['lastexpircheck']) > 86400) {
            $host['lastexpircheck'] = time();
            $host['expirationUsing'] += 1;
            if (($host['expirationUsing'] - $host['expiration']) > 5) {
				$sql->where('name', 'chat_close')->update('options', array(
					'value' => 'true'
				));
                $params                = json_decode($options['chat_closeparam'], true);
                $params['msg']         = 'چت روم شما به علت تمدید نشدن تعطیل شد';
                $params['theme']       = 'close';
                $params['timetolunch'] = time() + 604800;
                $params                = json_encode($params, JSON_UNESCAPED_UNICODE);
				$sql->where('name', 'chat_closeparam')->update('options', array(
					'value' => $params
				));
            }
            $host = json_encode($host, JSON_UNESCAPED_UNICODE);
			$sql->where('name', 'host')->update('options', array(
				'value' => $host
			));
            chatroom::reloadconfig();
        }
    }
}
?>