<?php
    // 주제1 : 백엔드 영역에서의 이미지 가공
    declare(strict_types=1);

    // 시작좌표
    $sourceCoordinate = [10, 10];
    // 종료좌표
    $destinationCoordinate = [400, 150];
    // 너비
    $newWidth = 336;
    // 높이
    $newHeight = 92;
    // 회전각도
    $degrees = 45;
    // 퀄리티(해상도)
    $quality = [100, 50];

    // 1) 이미지 생성
    $image = imagecreatefrompng(__DIR__.'/geeksforgeeks-13.png'); // 667, 184

    // 2) 기존 이미지 너비&높이
    list($width, $height) = getimagesize(__DIR__.'/geeksforgeeks-13.png');

    // 3) Resample
    $imageAfterProcess = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled(
        $imageAfterProcess,
        $image,
        0,
        0,
        0,
        0,
        $newWidth,
        $newHeight,
        $width,
        $height
    );

    // 4) 이미지 회전
    //$imageAfterProcess = imagerotate($imageAfterProcess, $degrees, 0);

    // 5) 해상도 변경
    $result = imageresolution($imageAfterProcess, $quality[0], $quality[1]);

    header('Content-type:image/png');
    imagepng($imageAfterProcess);