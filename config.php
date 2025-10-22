<?php
// فين غادي نخزن المستخدمين (خليه خارج htdocs باش ما يشوفوش الناس)
define('USER_STORAGE', 'C:/xampp/private_users.jsonl');

// مفتاح باش تشوف اللائحة فقط انت
define('ADMIN_KEY', '67677');

function save_user(array $user): bool {
    $line = json_encode($user, JSON_UNESCAPED_UNICODE) . PHP_EOL;
    $fp = fopen(USER_STORAGE, 'a');
    if (!$fp) return false;
    if (flock($fp, LOCK_EX)) {
        fwrite($fp, $line);
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
        return true;
    }
    fclose($fp);
    return false;
}
