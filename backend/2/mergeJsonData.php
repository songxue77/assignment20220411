<?php
    // 주제2 : 데이터 가공
    declare(strict_types=1);
    require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'https://www.data.go.kr/cmm/cmm/fileDownload.do?atchFileId=FILE_000000002374984&fileDetailSn=1&insertDataPrcus=N', [

    ]);
    //echo $res->getStatusCode();
    // "200"
    //echo $res->getHeader('content-type')[0];
    // 'application/json; charset=utf8'
    $body = $res->getBody()->getContents();
    //$body = iconv('UTF8', 'EUCKR', $res->getBody()->getContents());
    $bodyParsed = explode("\r\n", $body);
    dump($bodyParsed);
    foreach ($bodyParsed as $data) {
        $dataArray = explode(',', $data);
        dump($dataArray);
        dump(gettype($dataArray[0]));
        dump(mb_detect_encoding($dataArray[0]));
        dump(iconv('UTF-8', 'UTF-16//TRANSLIT', $dataArray[0]));
        exit;
    }
    exit;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.data.go.kr/cmm/cmm/fileDownload.do?atchFileId=FILE_000000002374984&fileDetailSn=1&insertDataPrcus=N');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $fp = fopen('1234.csv', 'w');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    $response = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    var_dump($response);
    var_dump($header_size);
    exit;
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
    curl_close($ch);
    fclose($fp);

    var_dump($header);
    var_dump($body);

    exit;

    $newfname = $_SERVER['DOCUMENT_ROOT'].'/2';
    $file = fopen ('http://www.data.go.kr/cmm/cmm/fileDownload.do?atchFileId=FILE_000000002374984&fileDetailSn=1&insertDataPrcus=N', 'rb');
    var_dump($file);
    exit;
    if ($file) {
        $newf = fopen ($newfname, 'wb');
        if ($newf) {
            while(!feof($file)) {
                fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
            }
        }
    }
    if ($file) {
        fclose($file);
    }
    if ($newf) {
        fclose($newf);
    }

    exit;

    // 한국기계연구원_연구관리_사업과제계획서참여기관
    //$file1JsonData = file_get_contents('https://www.data.go.kr/cmm/cmm/fileDownload.do?atchFileId=FILE_000000002374984&fileDetailSn=1&insertDataPrcus=N');
    $file1JsonData = readfile('http://www.data.go.kr/cmm/cmm/fileDownload.do?atchFileId=FILE_000000002374984&fileDetailSn=1&insertDataPrcus=N');
    var_dump($file1JsonData);
    exit;
    $file1ArrayData = json_decode($file1JsonData, true);
    // 한국기계연구원_연구관리_사업과제계획서세부정보
    $file2JsonData = file_get_contents('https://www.data.go.kr/cmm/cmm/fileDownload.do?atchFileId=FILE_000000002375029&fileDetailSn=1&insertDataPrcus=N');
    $file1ArrayData = json_decode($file2JsonData, true);

    echo "<pre>"; print_r($file1ArrayData); echo "</pre>";
    echo "<pre>"; print_r($file1ArrayData); echo "</pre>";
    exit;
