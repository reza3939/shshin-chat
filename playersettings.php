<?php
// نشانه: تنظیمات استوری جدا از پلیر + ارتفاع کادر - نسخه ۳
// صفحه تنظیمات پلیر؛ مستقل از پنل مدیریت (پنل مدیریت آن را از بین می‌برد). آدرس: /playersettings
if (session_status() !== PHP_SESSION_ACTIVE) { @session_start(); }
header('Content-Type: text/html; charset=utf-8');
header('X-Robots-Tag: noindex, nofollow');
$SETUP_KEY = '44d4681e4c';

if (!function_exists('cp_color')) {
    function cp_color($c, $d) { return (is_string($c) && preg_match('/^#[0-9a-fA-F]{6}$/', $c)) ? strtolower($c) : $d; }
    function cp_num($v, $min, $max, $d) { if (!is_numeric($v)) return $d; $v = (float)$v; return max($min, min($max, $v)); }
}
function ps_h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function ps_g($k, $d = '') { return isset($_POST[$k]) ? $_POST[$k] : $d; }
function ps_token() { return function_exists('random_bytes') ? bin2hex(random_bytes(16)) : md5(uniqid(mt_rand(), true)); }

$def = array(
    'p_c1' => '#3b82f6', 'p_c2' => '#7c3aed', 'p_h' => 52, 'p_radius' => 12, 'p_play' => '#4f46e5',
    'p_badge_on' => 1, 'p_badge_text' => 'Music', 'p_volume' => 80,
    'p_viz_on' => 1, 'p_viz_color' => '#ffffff', 'p_viz_bars' => 32, 'p_viz_alpha' => 35,
    'st_apply' => 0, 'st_face' => 60, 'st_ring' => 1, 'st_ring_color' => '#93a8bc', 'st_unseen' => '#ff7b00', 'st_bg' => '#000000', 'st_bg_alpha' => 25, 'st_height' => 70
);
$dir = dirname(__FILE__) . '/../theme/player';
$passFile = $dir . '/player-pass.php';
$setFile = $dir . '/player-settings.json';

$hash = '';
if (is_file($passFile)) { $hash = include $passFile; if (!is_string($hash)) $hash = ''; }
if (empty($_SESSION['ps_csrf'])) $_SESSION['ps_csrf'] = ps_token();
$csrf = $_SESSION['ps_csrf'];
$msg = ''; $err = '';
$action = isset($_POST['action']) ? $_POST['action'] : '';
$keyOk = (isset($_GET['k']) && $_GET['k'] === $SETUP_KEY) || (ps_g('k') === $SETUP_KEY);

if ($action === 'setpass' && $hash === '' && $keyOk) {
    $p1 = (string)ps_g('pass1'); $p2 = (string)ps_g('pass2');
    if (strlen($p1) < 6) { $err = 'رمز باید حداقل ۶ حرف باشد.'; }
    elseif ($p1 !== $p2) { $err = 'دو رمز یکسان نیستند.'; }
    else {
        $hash = password_hash($p1, PASSWORD_DEFAULT);
        if (@file_put_contents($passFile, "<?php\nreturn " . var_export($hash, true) . ";\n", LOCK_EX) === false) {
            $err = 'ذخیره رمز ممکن نشد؛ مجوز نوشتن پوشه theme/player را بررسی کن.'; $hash = '';
        } else { $_SESSION['ps_auth'] = true; session_regenerate_id(true); $msg = 'رمز ذخیره شد.'; }
    }
} elseif ($action === 'login' && $hash !== '') {
    if (password_verify((string)ps_g('pass'), $hash)) { $_SESSION['ps_auth'] = true; session_regenerate_id(true); }
    else { sleep(1); $err = 'رمز اشتباه است.'; }
}

$authed = !empty($_SESSION['ps_auth']) && $hash !== '';
$csrfOk = $authed && hash_equals($csrf, (string)ps_g('csrf'));

if ($authed && $action === 'logout' && $csrfOk) { $_SESSION['ps_auth'] = false; $authed = false; }

$existing = array();
if (is_file($setFile)) { $j = json_decode(file_get_contents($setFile), true); if (is_array($j)) $existing = $j; }

if ($authed && $csrfOk && ($action === 'save' || $action === 'reset')) {
    if ($action === 'reset') {
        $changes = $def;
    } else {
        $b = trim((string)ps_g('p_badge_text', 'Music'));
        $b = function_exists('mb_substr') ? mb_substr($b, 0, 20, 'UTF-8') : substr($b, 0, 20);
        $changes = array(
            'p_c1' => cp_color(ps_g('p_c1'), $def['p_c1']), 'p_c2' => cp_color(ps_g('p_c2'), $def['p_c2']),
            'p_h' => (int)cp_num(ps_g('p_h'), 36, 120, 52), 'p_radius' => (int)cp_num(ps_g('p_radius'), 0, 40, 12),
            'p_play' => cp_color(ps_g('p_play'), $def['p_play']),
            'p_badge_on' => ps_g('p_badge_on') ? 1 : 0, 'p_badge_text' => $b,
            'p_volume' => (int)cp_num(ps_g('p_volume'), 0, 100, 80),
            'p_viz_on' => ps_g('p_viz_on') ? 1 : 0, 'p_viz_color' => cp_color(ps_g('p_viz_color'), '#ffffff'),
            'p_viz_bars' => (int)cp_num(ps_g('p_viz_bars'), 8, 64, 32), 'p_viz_alpha' => (int)cp_num(ps_g('p_viz_alpha'), 10, 80, 35),
            'st_apply' => ps_g('st_apply') ? 1 : 0, 'st_face' => (int)cp_num(ps_g('st_face'), 30, 100, 60),
            'st_ring' => (int)cp_num(ps_g('st_ring'), 0, 6, 1),
            'st_ring_color' => cp_color(ps_g('st_ring_color'), $def['st_ring_color']), 'st_unseen' => cp_color(ps_g('st_unseen'), $def['st_unseen']),
            'st_bg' => cp_color(ps_g('st_bg'), $def['st_bg']), 'st_bg_alpha' => (int)cp_num(ps_g('st_bg_alpha'), 0, 100, 25),
            'st_height' => (int)cp_num(ps_g('st_height'), 10, 200, 70)
        );
    }
    $new = array_merge($existing, $changes); // کلیدهای دیگر فایل (اگر هست) دست نمی‌خورد
    if (@file_put_contents($setFile, json_encode($new, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX) === false) {
        $err = 'ذخیره انجام نشد؛ مجوز نوشتن پوشه theme/player را بررسی کن (۷۵۵ یا ۷۷۵).';
    } else {
        $existing = $new;
        $msg = ($action === 'reset') ? 'تنظیمات به حالت اولیه برگشت.' : 'ذخیره شد. صفحه چت را با Ctrl+F5 تازه کن.';
    }
}
$cur = array_merge($def, $existing);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>تنظیمات پلیر</title>
<style>
  * { box-sizing:border-box; }
  body { margin:0; padding:20px; background:#f1f3f9; font-family:Tahoma, sans-serif; color:#1f2937; }
  .wrap { max-width:720px; margin:0 auto; }
  h1 { font-size:20px; margin:0 0 14px; }
  fieldset { border:1px solid #d6dbe8; border-radius:12px; background:#fff; margin:0 0 16px; padding:14px 16px; }
  legend { font-weight:700; padding:0 8px; }
  .row { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:8px 0; border-bottom:1px solid #eef0f6; }
  .row:last-child { border-bottom:0; }
  .row label { flex:1; font-size:14px; }
  .row small { display:block; color:#6b7280; font-size:12px; margin-top:2px; }
  .row input[type=number], .row input[type=text] { width:110px; padding:6px; border:1px solid #cbd2e1; border-radius:8px; }
  .row input[type=color] { width:54px; height:32px; border:1px solid #cbd2e1; border-radius:8px; padding:2px; background:#fff; }
  .row input[type=range] { width:150px; direction:ltr; }
  .val { min-width:34px; text-align:center; font-size:13px; color:#4b5563; direction:ltr; }
  .btns { display:flex; gap:10px; flex-wrap:wrap; }
  button { padding:10px 20px; border:0; border-radius:10px; cursor:pointer; font:inherit; }
  .primary { background:#4f46e5; color:#fff; }
  .ghost { background:#e5e7eb; }
  .msg { padding:10px 14px; border-radius:10px; margin-bottom:14px; font-size:14px; }
  .ok { background:#dcfce7; color:#166534; }
  .bad { background:#fee2e2; color:#991b1b; }
  .pv { display:flex; align-items:center; gap:10px; padding:0 14px; color:#fff; font-size:13px; direction:ltr; overflow:hidden; }
  .pv i { width:26px; height:26px; border-radius:50%; background:rgba(255,255,255,.3); flex:none; }
  .pv b { width:34px; height:34px; border-radius:50%; background:#fff; flex:none; }
  .pvbox { background:#2b1a40; padding:12px; border-radius:12px; margin-bottom:16px; }
  .pvbox p { color:#c7bfe0; font-size:12px; margin:0 0 6px; }
  .pass { max-width:380px; margin:60px auto; background:#fff; padding:20px; border-radius:14px; border:1px solid #d6dbe8; }
  .pass input { width:100%; padding:9px; margin:6px 0 12px; border:1px solid #cbd2e1; border-radius:8px; }
  .psbar { display:flex; gap:10px; margin:0 0 16px; }
  .psbar a { padding:8px 16px; border-radius:10px; border:1px solid #cbd2e1; background:#fff; color:#3b4252; text-decoration:none; font-size:13px; }
  .psbar a.on { background:#4f46e5; border-color:#4f46e5; color:#fff; }
</style>
</head>
<body>
<div class="wrap">
<?php if ($msg) echo '<div class="msg ok">' . ps_h($msg) . '</div>'; ?>
<?php if ($err) echo '<div class="msg bad">' . ps_h($err) . '</div>'; ?>

<?php if ($hash === '' && !$keyOk) { ?>
  <div class="pass"><h1>این صفحه هنوز راه‌اندازی نشده</h1>
  <p>برای اولین بار باید آدرس را همراه با کلید راه‌اندازی باز کنی (کلید داخل خود فایل نوشته شده است).</p></div>
<?php } elseif ($hash === '') { ?>
  <form method="post" class="pass">
    <h1>اولین بار: یک رمز برای این صفحه بگذار</h1>
    <input type="hidden" name="action" value="setpass">
    <input type="hidden" name="k" value="<?php echo ps_h($SETUP_KEY); ?>">
    <label>رمز (حداقل ۶ حرف)</label><input type="password" name="pass1" autocomplete="new-password">
    <label>تکرار رمز</label><input type="password" name="pass2" autocomplete="new-password">
    <button class="primary" type="submit">ذخیره رمز</button>
  </form>
<?php } elseif (!$authed) { ?>
  <form method="post" class="pass">
    <h1>ورود به تنظیمات پلیر</h1>
    <input type="hidden" name="action" value="login">
    <label>رمز</label><input type="password" name="pass" autocomplete="current-password">
    <button class="primary" type="submit">ورود</button>
  </form>
<?php } else { ?>
  <h1 id="ps-title">تنظیمات پلیر</h1>

  <div class="psbar">
    <a href="#" id="ps-link-player">تنظیمات پلیر</a>
    <a href="#" id="ps-link-story">تنظیمات استوری</a>
  </div>

  <div class="pvbox" id="ps-pv">
    <p>پیش‌نمایش</p>
    <div id="pvp" class="pv"><i></i><i></i><b></b><span>نوار پلیر</span></div>
  </div>

  <form method="post" id="f">
    <input type="hidden" name="csrf" value="<?php echo ps_h($csrf); ?>">

    <fieldset id="ps-player">
      <legend>پلیر</legend>
      <div class="row"><label>رنگ اول گرادیان</label><input type="color" name="p_c1" value="<?php echo ps_h($cur['p_c1']); ?>"></div>
      <div class="row"><label>رنگ دوم گرادیان</label><input type="color" name="p_c2" value="<?php echo ps_h($cur['p_c2']); ?>"></div>
      <div class="row"><label>رنگ علامت دکمه پخش</label><input type="color" name="p_play" value="<?php echo ps_h($cur['p_play']); ?>"></div>
      <div class="row"><label>ارتفاع پلیر (پیکسل)<small>بین ۳۶ تا ۱۲۰</small></label><input type="number" name="p_h" min="36" max="120" value="<?php echo (int)$cur['p_h']; ?>"></div>
      <div class="row"><label>گردی گوشه‌ها<small>۰ = تیز</small></label><input type="number" name="p_radius" min="0" max="40" value="<?php echo (int)$cur['p_radius']; ?>"></div>
      <div class="row"><label>صدای پیش‌فرض</label><input type="range" name="p_volume" min="0" max="100" value="<?php echo (int)$cur['p_volume']; ?>"><span class="val"></span></div>
      <div class="row"><label>نمایش برچسب سبز</label><input type="checkbox" name="p_badge_on" value="1" <?php echo !empty($cur['p_badge_on']) ? 'checked' : ''; ?>></div>
      <div class="row"><label>نوشته برچسب</label><input type="text" name="p_badge_text" maxlength="20" value="<?php echo ps_h($cur['p_badge_text']); ?>"></div>
    </fieldset>

    <fieldset id="ps-viz">
      <legend>رقص صوت</legend>
      <div class="row"><label>روشن</label><input type="checkbox" name="p_viz_on" value="1" <?php echo !empty($cur['p_viz_on']) ? 'checked' : ''; ?>></div>
      <div class="row"><label>رنگ</label><input type="color" name="p_viz_color" value="<?php echo ps_h($cur['p_viz_color']); ?>"></div>
      <div class="row"><label>تعداد ستون‌ها</label><input type="range" name="p_viz_bars" min="8" max="64" value="<?php echo (int)$cur['p_viz_bars']; ?>"><span class="val"></span></div>
      <div class="row"><label>شفافیت (درصد)<small>هرچه بیشتر، پررنگ‌تر</small></label><input type="range" name="p_viz_alpha" min="10" max="80" value="<?php echo (int)$cur['p_viz_alpha']; ?>"><span class="val"></span></div>
    </fieldset>

    <fieldset id="story">
      <legend>ظاهر استوری</legend>
      <div class="row"><label>اعمال این تنظیمات روی استوری<small>خاموش = ظاهر خود چت‌روم دست نمی‌خورد. روشن بودن استوری برای هر سطح کاربری از «مدیریت دسترسی ها ← گزینه‌های کاربری» تنظیم می‌شود.</small></label><input type="checkbox" name="st_apply" value="1" <?php echo !empty($cur['st_apply']) ? 'checked' : ''; ?>></div>
      <div class="row"><label>اندازه عکس استوری‌ها (پیکسل)<small>پیش‌فرض ۶۰</small></label><input type="range" name="st_face" min="30" max="100" value="<?php echo (int)$cur['st_face']; ?>"><span class="val"></span></div>
      <div class="row"><label>ضخامت حلقه دور عکس (پیکسل)</label><input type="range" name="st_ring" min="0" max="6" value="<?php echo (int)$cur['st_ring']; ?>"><span class="val"></span></div>
      <div class="row"><label>رنگ حلقه استوری دیده‌شده</label><input type="color" name="st_ring_color" value="<?php echo ps_h($cur['st_ring_color']); ?>"></div>
      <div class="row"><label>رنگ حلقه استوری جدید (دیده‌نشده)</label><input type="color" name="st_unseen" value="<?php echo ps_h($cur['st_unseen']); ?>"></div>
      <div class="row"><label>رنگ زمینه نوار استوری</label><input type="color" name="st_bg" value="<?php echo ps_h($cur['st_bg']); ?>"></div>
      <div class="row"><label>شفافیت زمینه (درصد)<small>۰ = بی‌رنگ</small></label><input type="range" name="st_bg_alpha" min="0" max="100" value="<?php echo (int)$cur['st_bg_alpha']; ?>"><span class="val"></span></div>
      <div class="row"><label>ارتفاع کادر زمینه (پیکسل)<small>بین ۱۰ تا ۲۰۰</small></label><input type="range" name="st_height" min="10" max="200" value="<?php echo (int)$cur['st_height'] >= 10 ? (int)$cur['st_height'] : 70; ?>"><span class="val"></span></div>
    </fieldset>

    <div class="btns">
      <button class="primary" type="submit" name="action" value="save">ذخیره</button>
      <button class="ghost" type="submit" name="action" value="reset" onclick="return confirm('همه تنظیمات به حالت اولیه برگردد؟')">برگشت به حالت اولیه</button>
      <button class="ghost" type="submit" name="action" value="logout">خروج</button>
    </div>
  </form>

<script>
  var f = document.getElementById("f");
  function el(n) { return f.elements[n]; }
  function rgb(h) { return [parseInt(h.substr(1,2),16), parseInt(h.substr(3,2),16), parseInt(h.substr(5,2),16)]; }
  function hex(r) { return "#" + r.map(function (v) { v = Math.max(0, Math.min(255, Math.round(v))); return (v < 16 ? "0" : "") + v.toString(16); }).join(""); }
  function mix(a, b) { var x = rgb(a), y = rgb(b); return hex([(x[0]+y[0])/2, (x[1]+y[1])/2, (x[2]+y[2])/2]); }
  function upd() {
    var c1 = el("p_c1").value, c2 = el("p_c2").value, pv = document.getElementById("pvp");
    pv.style.background = "linear-gradient(90deg," + c1 + "," + mix(c1, c2) + "," + c2 + ")";
    pv.style.height = (+el("p_h").value || 52) + "px";
    pv.style.borderRadius = el("p_radius").value + "px";
    var ranges = f.querySelectorAll("input[type=range]");
    for (var i = 0; i < ranges.length; i++) ranges[i].parentNode.querySelector(".val").textContent = ranges[i].value;
  }
  f.addEventListener("input", upd);
  f.addEventListener("change", upd);
  upd();

  function psMode() {
    var m = null;
    if (typeof URLSearchParams !== "undefined") { m = new URLSearchParams(location.search).get("tab"); }
    if (m !== "story" && m !== "player") { m = (location.hash === "#story") ? "story" : "player"; }
    return m;
  }
  function psApply() {
    var m = psMode(), story = (m === "story");
    document.getElementById("ps-player").style.display = story ? "none" : "";
    document.getElementById("ps-viz").style.display = story ? "none" : "";
    document.getElementById("ps-pv").style.display = story ? "none" : "";
    document.getElementById("story").style.display = story ? "" : "none";
    document.getElementById("ps-title").textContent = story ? "تنظیمات ظاهر استوری" : "تنظیمات پلیر";
    document.title = story ? "تنظیمات استوری" : "تنظیمات پلیر";
    document.getElementById("ps-link-story").className = story ? "on" : "";
    document.getElementById("ps-link-player").className = story ? "" : "on";
    document.getElementById("ps-link-story").href = location.pathname + "?tab=story";
    document.getElementById("ps-link-player").href = location.pathname + "?tab=player";
    var hasTab = (typeof URLSearchParams !== "undefined") && new URLSearchParams(location.search).has("tab");
    if (!hasTab && window.history && history.replaceState) {
      history.replaceState(null, "", location.pathname + "?tab=" + m);
    }
    window.scrollTo(0, 0);
  }
  psApply();
  window.addEventListener("hashchange", psApply);
</script>
<?php } ?>
</div>
</body>
</html>
