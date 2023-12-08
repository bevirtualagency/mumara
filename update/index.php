<?php


function GetIonCubeLoaderVersion() {
    if (function_exists('ioncube_loader_version')) {
        $version = ioncube_loader_version();
        return number_format($version,0,'.','');
    }
    return "";
}

function getCurlContent($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

$host_name  = "https://update.mumara.com";
$check_version = getCurlContent("https://update.mumara.com/campaigns/version");
if(strlen($check_version) > 10) {
    $host_name = "http://update.mumara.com";
}

$version_file = fopen('../version', "r");
$local_version = fread($version_file, filesize('../version'));

$ionCVersion = GetIonCubeLoaderVersion();

$php_version = substr(PHP_VERSION, 0, 3);


$curlDataJ = array();
$module = "";
$AStatus = "";
$phpCheck = 1;
$ionCubeCheck = 1;
$minimum_required = "74";
$icon_minimum_required = "10";
$domain = $_SERVER['SERVER_NAME'];
$curlData = getCurlContent("https://update.mumara.com/campaigns/checkdependencies.php?php_version=$php_version&ioncube_version=$ionCVersion&mumara_version=$local_version&domain=$domain");
if(!empty($curlData)) {
    $curlDataJ = json_decode($curlData , true);
}


if(!empty($curlDataJ)) {
    $alert = "alert-danger";
    $msg = $curlDataJ["message"];

    $AStatus = $curlDataJ["status"];
    if($curlDataJ["status"] == "failed") {
        echo "<b>Dependency Check to run this update:</b><br><br>";
        echo $curlDataJ["message"]. "<br><br>";
        echo '<a href="../dashboard">Go to Dashboard</a> | <a href="https://community.mumara.com/threads/updating-from-php7-x-to-php8-1-v5-5.399/">Read Community Topic</a>';
    } else {
        header("Location:update.php");
    }
}
