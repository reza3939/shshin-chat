<?php
// پاسخ هوشمند کاربر مجازی - نسخه ۸ (فقط هوش مصنوعی جواب می‌دهد)
class aibot {

    const enabled = true;
    const debug   = true;
    const api     = 'https://text.pollinations.ai/';
    const model   = 'openai-fast';
    const timeout = 25;
    const maxlen  = 300;

    static $last_code = 0;
    static $wait_hint = 0;

    // جواب‌های آماده‌ای که اگر هوش مصنوعی جواب نداد، یکی‌شان فرستاده می‌شود
    static $fallback = array(
        'الان یه کم سرم شلوغه، بعداً با هم حرف می‌زنیم',
        'راستش الان نمی‌تونم خوب جواب بدم، بگو بعداً',
        'هوم... بذار فکر کنم، الان در خدمتم',
        'ببخشید، الان یه کم کلمه‌ها قاطیه، دوباره بگو',
    );

    // زندگی‌نامه‌ی ثابت هر کاربر مجازی، از روی شماره‌ی کاربر ساخته می‌شود
    static $city  = array('تهران', 'مشهد', 'اصفهان', 'شیراز', 'تبریز', 'رشت', 'یزد', 'کرج');
    static $job   = array('دانشجو', 'برنامه‌نویس', 'طراح گرافیک', 'حسابدار', 'معلم', 'پرستار', 'عکاس', 'فروشنده');
    static $food  = array('پیتزا', 'قورمه‌سبزی', 'جوجه‌کباب', 'کوفته', 'پلو‌میگو', 'کتلت', 'آش رشته', 'زرشک‌پلو');
    static $hobby = array('فوتبال', 'سینما', 'کتاب خواندن', 'موسیقی', 'کوه‌نوردی', 'عکاسی', 'برنامه‌نویسی', 'آشپزی');
    static $pet   = array('گربه', 'سگ', 'ماهی', 'طوطی', 'هیچ');

    // جایِ وصل‌شدن به فرستنده‌ی پیام؛ همه‌ی تصمیم‌ها اینجاست
    static function handle() {
        global $sql, $id, $runAutoanswer, $time;
        if ($runAutoanswer != 1 or !class_exists('aibot')) {
            return;
        }
        if (!isset($_REQUEST['to']) or $_REQUEST['to'] == '-1' or !isset($_REQUEST['text'])) {
            return;
        }
        $bot = $sql->where("id", safe::number($_REQUEST['to']))->getOne("onlines", array("id", "time", "inputs", "name"));
        if (!$bot) {
            self::trace('to=' . safe::number($_REQUEST['to']) . ' row=no');
            return;
        }
        if ($bot['time'] != 0) {
            return;
        }
        $inputs = json_decode($bot['inputs'], true);
        if (!is_array($inputs)) {
            $inputs = array();
        }
        $box = isset($inputs['autoanswer']) and $inputs['autoanswer'] == true;
        self::trace('to=' . $bot['id'] . ' box=' . ($box ? 'on' : 'off'));
        if (!$box) {
            return;
        }
        self::ai($bot['id'], safe::string($_REQUEST['text']));
    }

    // بعد از فرستادن پاسخ به فرستنده، جواب ساخته و فرستاده می‌شود
    static function ai($bot_id, $question) {
        global $sql, $id;
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        } else if (function_exists('litespeed_finish_request')) {
            litespeed_finish_request();
        }
        ignore_user_abort(true);
        sleep(rand(1, 3));
        $reply = self::ask($question, self::botname($bot_id), self::name($id), $bot_id);
        self::send($bot_id, self::botname($bot_id), $reply, self::inputs($bot_id), time());
    }

    static function send($bot_id, $bot_name, $reply, $inputs, $stamp) {
        global $sql, $id;
        if ($reply == '') {
            self::trace('empty reply');
            return;
        }
        if (self::window_open(isset($inputs['firstTime']) ? $inputs['firstTime'] : '', isset($inputs['lastTime']) ? $inputs['lastTime'] : '')) {
            $sql->insert('message', array(
                'user' => $bot_id,
                'username' => $bot_name,
                'color' => '000',
                'room' => session('room'),
                'text' => $reply,
                'date' => $stamp,
                'to' => $id,
                'into' => isset($_REQUEST['into']) ? $_REQUEST['into'] : 'pm',
                'type' => 0
            ));
            self::trace('sent=live to=' . $id);
        } else {
            Message::SendOfflineMessage($bot_id, $id, $reply);
            self::trace('sent=offline to=' . $id);
        }
        self::mark_idle($bot_id, $stamp);
    }

    // همان شمارنده‌ی «چند دقیقه است به کسی پیام نداده» که برای کاربر واقعی پر می‌شود
    static function mark_idle($bot_id, $stamp) {
        global $sql;
        if (!is_object($sql)) {
            return;
        }
        $inputs = self::inputs($bot_id);
        $inputs['idle'] = '1';
        $inputs['idle_time'] = $stamp;
        if (!isset($inputs['silent'])) {
            $inputs['silent'] = '0';
        }
        $sql->where('id', $bot_id);
        $sql->update('onlines', array('inputs' => json_encode($inputs, JSON_UNESCAPED_UNICODE)));
        self::trace('idle=marked at=' . $stamp);
    }

    static function botname($bot_id) {
        global $sql;
        if (!is_object($sql)) {
            return '';
        }
        $row = $sql->where("id", $bot_id)->getOne("onlines", array("name"));
        return $row ? $row['name'] : '';
    }

    static function inputs($bot_id) {
        global $sql;
        if (!is_object($sql)) {
            return array();
        }
        $row = $sql->where("id", $bot_id)->getOne("onlines", array("inputs"));
        $inputs = $row ? json_decode($row['inputs'], true) : null;
        return is_array($inputs) ? $inputs : array();
    }

    static function name($user_id) {
        global $sql;
        if (!is_object($sql)) {
            return '';
        }
        $row = $sql->where("id", $user_id)->getOne("onlines", array("name"));
        return $row ? $row['name'] : session('name');
    }

    static function persona($bot_id, $about) {
        $bot_id = (int) $bot_id;
        $lines = array(
            'شهر: ' . self::$city[$bot_id % count(self::$city)],
            'شغل: ' . self::$job[($bot_id + 3) % count(self::$job)],
            'سن: ' . (19 + ($bot_id * 7) % 20),
            'غذای مورد علاقه: ' . self::$food[($bot_id + 5) % count(self::$food)],
            'سرگرمی: ' . self::$hobby[($bot_id + 2) % count(self::$hobby)],
            'حیوان خانگی: ' . self::$pet[($bot_id + 1) % count(self::$pet)],
        );
        $about = self::clean($about, 120);
        if ($about !== '') {
            array_unshift($lines, 'درباره‌ی خودش نوشته: ' . $about);
        }
        return implode(' | ', $lines);
    }

    static function ask($question, $botname, $username, $bot_id = 0) {
        if (!self::enabled) {
            return '';
        }
        $inputs = self::inputs($bot_id);
        $q = self::clean($question, 500);
        if ($q === '') {
            return '';
        }
        $botname  = self::clean($botname, 40);
        $username = self::clean($username, 40);

        $system = 'تو «' . $botname . '» هستی و در یک چت‌روم فارسی با «' . $username . '» گفتگوی خصوصی می‌کنی. '
            . 'این مشخصات توست و همیشه به آن وفادار بمان: '
            . self::persona($bot_id, isset($inputs['stext']) ? $inputs['stext'] : '') . '. '
            . 'مثل یک آدم واقعی، صمیمی و خودمانی جواب بده: فقط یک جمله‌ی کوتاه، زبان محاوره‌ی فارسی، بدون لیست و بدون تعارف. '
            . 'مثل دستیار حرف نزن و نپرس چطور می‌توانم کمکت کنم. '
            . 'سؤال‌های معمولی زندگی را از روی همین مشخصات جواب بده و چیزی که با آن نمی‌خواند قطعی نگو. '
            . 'هرگز نگو ربات یا هوش مصنوعی هستی. اگر پیام بی‌ادبانه یا نامناسب بود مؤدبانه رد کن و بحث را عوض کن. فقط متن پاسخ را بفرست.';

        $body = json_encode(array(
            'model'       => self::model,
            'temperature' => 0.6,
            'messages'    => array(
                array('role' => 'system', 'content' => $system),
                array('role' => 'user', 'content' => $q),
            ),
        ), JSON_UNESCAPED_UNICODE);

        $reply = self::clean(self::fetch($body), self::maxlen);
        if ($reply === '') {
            $wait = 3;
            if (self::$last_code == 402) {
                $wait = self::$wait_hint > 0 ? self::$wait_hint + 1 : 30;
                $wait = min($wait, 30);
            }
            self::trace('retry=1 wait=' . $wait);
            sleep($wait);
            $reply = self::clean(self::fetch($body), self::maxlen);
        }
        self::trace('raw=' . ($reply === '' ? 'empty' : self::cut($reply)));

        if ($reply === '' or self::is_refusal($reply)) {
            self::trace('used=fallback');
            return self::$fallback[array_rand(self::$fallback)];
        }
        return $reply;
    }

    static function fetch($body) {
        self::$last_code = 0;
        self::$wait_hint = 0;
        $head = array('Content-Type: application/json', 'User-Agent: chatroom-aibot');
        if (function_exists('curl_init')) {
            $ch = curl_init(self::api);
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT        => self::timeout,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS      => 2,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => $body,
                CURLOPT_HTTPHEADER     => $head,
            ));
            $out = curl_exec($ch);
            $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            self::$last_code = $code;
            if ($code == 200 and is_string($out)) {
                return $out;
            }
            if (preg_match('/wait\s+(\d+)\s+second/i', (string) $out, $m)) {
                self::$wait_hint = (int) $m[1];
            }
            self::trace('http=' . $code . ' hint=' . self::$wait_hint);
            return '';
        }
        if (ini_get('allow_url_fopen')) {
            $ctx = stream_context_create(array('http' => array(
                'method'        => 'POST',
                'timeout'       => self::timeout,
                'header'        => implode("\r\n", $head) . "\r\n",
                'content'       => $body,
                'ignore_errors' => true,
            )));
            $out = @file_get_contents(self::api, false, $ctx);
            if (isset($http_response_header[0]) and preg_match('/\s(\d{3})\s/', $http_response_header[0], $m)) {
                self::$last_code = (int) $m[1];
            }
            return is_string($out) ? $out : '';
        }
        self::trace('no curl no fopen');
        return '';
    }

    // آیا کاربر مجازی الان داخل بازه‌ی ساعتی خودش است؛ بازه‌ی برابر یا خالی یعنی بیست‌وچهار ساعته
    static function window_open($from, $to) {
        $from = self::to_minutes($from);
        $to   = self::to_minutes($to);
        if ($from === null or $to === null or $from == $to) {
            return true;
        }
        $now = ((int) date('G')) * 60 + ((int) date('i'));
        if ($from < $to) {
            return ($now >= $from and $now < $to);
        }
        return ($now >= $from or $now < $to);
    }

    static function to_minutes($hm) {
        $hm = str_replace(array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'), array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), (string) $hm);
        $hm = trim($hm);
        if ($hm === '') {
            return null;
        }
        $p = explode(':', $hm);
        $h = (int) preg_replace('/\D/', '', $p[0]);
        $m = isset($p[1]) ? (int) preg_replace('/\D/', '', $p[1]) : 0;
        if ($h > 23) {
            $h = 23;
        }
        if ($m > 59) {
            $m = 59;
        }
        return $h * 60 + $m;
    }

    static function clean($text, $limit = 300) {
        $text = (string) $text;
        $text = strip_tags($text);
        $flat = preg_replace('/\s+/u', ' ', $text);
        $text = $flat === null ? preg_replace('/\s+/', ' ', $text) : $flat;
        $text = trim($text);
        if (function_exists('mb_substr')) {
            if (mb_strlen($text) > $limit) {
                $text = mb_substr($text, 0, $limit);
            }
        } else if (strlen($text) > $limit * 3) {
            $text = substr($text, 0, $limit * 3);
        }
        return $text;
    }

    static function is_refusal($reply) {
        $reply = function_exists('mb_strtolower') ? mb_strtolower($reply, 'UTF-8') : strtolower($reply);
        $bad = array('من یک مدل', 'به عنوان یک هوش', 'as an ai', "i'm an ai", 'نمی‌توانم پاسخ دهم', 'limitation');
        foreach ($bad as $word) {
            if (strpos($reply, $word) !== false) {
                return true;
            }
        }
        return false;
    }

    static function cut($text) {
        $text = self::clean($text, 80);
        return $text === '' ? '-' : $text;
    }

    // ردپای کوتاه برای فهمیدن اینکه کدام شرط جلوی جواب را گرفته؛ بعد از تمام‌شدن کار پاک می‌شود
    static function trace($text) {
        if (!self::debug) {
            return;
        }
        $dir = is_dir('inc') ? 'inc' : dirname(__DIR__);
        $file = $dir . '/_bot.sdb';
        if (is_file($file) and filesize($file) > 20000) {
            @unlink($file);
        }
        @file_put_contents($file, date('H:i:s') . ' ' . $text . "\n", FILE_APPEND | LOCK_EX);
    }
}
?>
