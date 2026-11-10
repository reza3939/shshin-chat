<?php
// نشانه: playerdata با تنظیمات استوری + ارتفاع کادر - نسخه ۳
// خروجی JSON لیست آهنگ‌ها و تنظیمات ظاهر پلیر (برای theme/player/cp-player.js)
if (!function_exists('cp_color')) {
    function cp_color($c, $d) { return (is_string($c) && preg_match('/^#[0-9a-fA-F]{6}$/', $c)) ? strtolower($c) : $d; }
    function cp_num($v, $min, $max, $d) { if (!is_numeric($v)) return $d; $v = (float)$v; return max($min, min($max, $v)); }
    function cp_rgb($h) { return array(hexdec(substr($h, 1, 2)), hexdec(substr($h, 3, 2)), hexdec(substr($h, 5, 2))); }
    function cp_hex($r) { return sprintf('#%02x%02x%02x', max(0, min(255, (int)round($r[0]))), max(0, min(255, (int)round($r[1]))), max(0, min(255, (int)round($r[2])))); }
    function cp_mix($a, $b) { $x = cp_rgb($a); $y = cp_rgb($b); return cp_hex(array(($x[0] + $y[0]) / 2, ($x[1] + $y[1]) / 2, ($x[2] + $y[2]) / 2)); }
}

$cp_tracks = array();
$cp_rows = $sql->get('player');
if (is_array($cp_rows)) {
    foreach ($cp_rows as $row) {
        $cp_tracks[] = array('title' => $row['title'], 'src' => url($row['src']));
    }
}

$cp_def = array(
    'p_c1' => '#3b82f6', 'p_c2' => '#7c3aed', 'p_h' => 52, 'p_radius' => 12, 'p_play' => '#4f46e5',
    'p_badge_on' => 1, 'p_badge_text' => 'Music', 'p_volume' => 80,
    'p_viz_on' => 1, 'p_viz_color' => '#ffffff', 'p_viz_bars' => 32, 'p_viz_alpha' => 35,
    'st_apply' => 0, 'st_face' => 60, 'st_ring' => 1, 'st_ring_color' => '#93a8bc', 'st_unseen' => '#ff7b00', 'st_bg' => '#000000', 'st_bg_alpha' => 25, 'st_height' => 70
);
$cp_raw = $cp_def;
$cp_file = dirname(__FILE__) . '/../theme/player/player-settings.json';
if (is_file($cp_file)) {
    $cp_j = json_decode(file_get_contents($cp_file), true);
    if (is_array($cp_j)) { $cp_raw = array_merge($cp_def, $cp_j); }
}
$story = null;
if (!empty($cp_raw['st_apply'])) {
    $bgrgb = cp_rgb(cp_color($cp_raw['st_bg'], '#000000'));
    $story = array(
        'face' => (int)cp_num($cp_raw['st_face'], 30, 100, 60),
        'ring' => (int)cp_num($cp_raw['st_ring'], 0, 6, 1),
        'ringc' => cp_color($cp_raw['st_ring_color'], '#93a8bc'),
        'unseen' => cp_color($cp_raw['st_unseen'], '#ff7b00'),
        'bg' => 'rgba(' . $bgrgb[0] . ',' . $bgrgb[1] . ',' . $bgrgb[2] . ',' . (cp_num($cp_raw['st_bg_alpha'], 0, 100, 25) / 100) . ')',
        'height' => empty($cp_raw['st_height']) ? 70 : (int)cp_num($cp_raw['st_height'], 10, 200, 70)
    );
}
$c1 = cp_color($cp_raw['p_c1'], '#3b82f6');
$c2 = cp_color($cp_raw['p_c2'], '#7c3aed');
$cfg = array(
    'c1' => $c1, 'c2' => $c2, 'mid' => cp_mix($c1, $c2),
    'h' => (int)cp_num($cp_raw['p_h'], 36, 120, 52),
    'r' => (int)cp_num($cp_raw['p_radius'], 0, 40, 12),
    'play' => cp_color($cp_raw['p_play'], '#4f46e5'),
    'badge' => !empty($cp_raw['p_badge_on']) ? 1 : 0,
    'btext' => (string)$cp_raw['p_badge_text'],
    'volume' => (int)cp_num($cp_raw['p_volume'], 0, 100, 80),
    'viz' => !empty($cp_raw['p_viz_on']) ? 1 : 0,
    'vbars' => (int)cp_num($cp_raw['p_viz_bars'], 8, 64, 32),
    'vcolor' => cp_color($cp_raw['p_viz_color'], '#ffffff'),
    'valpha' => cp_num($cp_raw['p_viz_alpha'], 10, 80, 35) / 100,
    'smove' => !empty($cp_raw['s_move']) ? 1 : 0,
    'sload' => (isset($cp_raw['s_load']) && empty($cp_raw['s_load'])) ? 0 : 1,
    'story' => $story
);

while (ob_get_level() > 0) { ob_end_clean(); }
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
echo json_encode(array('tracks' => $cp_tracks, 'cfg' => $cfg), JSON_UNESCAPED_UNICODE);
exit;