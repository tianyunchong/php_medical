<?php
/**
 * php 增加信息入索引
 */
$dbConfig = array(
    "host"   => "localhost",
    "user"   => "root",
    'pass'   => "123456",
    "char"   => 'utf8',
    "dbname" => "medical",
);

$pdo = new pdo("mysql:host=" . $dbConfig["host"] . ";dbname=" . $dbConfig["dbname"],
    $dbConfig["user"],
    $dbConfig["pass"],
    array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $dbConfig["char"],
    )
);
$id = 0;
while (1) {
    $query = $pdo->query("select * from medical.hospital where id > '{$id}' order by id asc limit 1");
    $rs    = $query->fetch(PDO::FETCH_ASSOC);
    if (empty($rs)) {
        break;
    }
    $location = json_decode($rs["location"], true);
    $data     = array(
        "title"     => $rs["name"],
        "address"   => $rs["address"],
        "lon"       => $location["lng"],
        "lat"       => $location["lat"],
        "telephone" => $rs["telephone"],
    );
    $headers = array(
        "Accept: application/json",
    );
    $data = json_encode($data);
    //写入es数据
    echo "写入数据:\t" . $rs["name"] . "\n";
    $res = curl_put("http://192.168.33.10:9200/medical/products/" . $rs["id"], $data, $headers);
    echo $res . "\n";
    $id = $rs["id"];
}

function curl_put($url, $data, $header = array(), $timeOut = 3)
{
    $header  = empty($header) ? array() : (array) $header;
    $timeOut = empty($timeOut) ? 0 : (int) $timeOut;
    $curl    = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_PORT, 9200);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0); 360Spider");
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeOut);
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeOut);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    if ($header) {
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }
    curl_setopt($curl, CURLOPT_FORBID_REUSE, 0);
    $str      = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return $str;
}
