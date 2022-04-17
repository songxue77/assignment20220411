<?php
    // 주제1 : 백엔드 영역에서의 이미지 가공
    declare(strict_types=1);

    // 시작좌표
    $sourceCoordinateX = 100;
    $sourceCoordinateY = 300;
    // 종료좌표
    $destinationCoordinateX = 1200;
    $destinationCoordinateY = 700;
    // 너비
    $newWidth = 2500;
    // 높이
    $newHeight = 1500;
    // 회전각도
    $degrees = 5;
    // 퀄리티 (해상도)
    $quality = [1000, 900];

    // 1) 이미지 생성
    $image = imagecreatefromjpeg(__DIR__.'/sample_image.jpg');

    // 2) 기존 이미지 너비&높이
    list($width, $height) = getimagesize(__DIR__.'/sample_image.jpg'); // 3000 x 2000

    // 3) Resample
    $imageAfterProcess = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled(
        $imageAfterProcess,
        $image,
        $destinationCoordinateX,
        $destinationCoordinateY,
        $sourceCoordinateX,
        $sourceCoordinateY,
        $newWidth,
        $newHeight,
        $width,
        $height
    );

    // 4) 이미지 회전
    $imageAfterProcess = imagerotate($imageAfterProcess, $degrees, 0);


    // 5) 해상도 변경
    //print_r(imageresolution($imageAfterProcess));
    $result = imageresolution($imageAfterProcess, $quality[0], $quality[1]);
    //print_r(imageresolution($imageAfterProcess));

    header('Content-type:image/jpeg');
    imagejpeg($imageAfterProcess);
