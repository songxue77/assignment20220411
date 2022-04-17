<?php
    // 주제3: 테이블 설계와 데이터 입출력
    declare(strict_types=1);

    use GuzzleHttp\Psr7;
    use GuzzleHttp\Exception\ClientException;

    require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

    /*
     * database: MySQL
     *
     * Create Query:
     * CREATE TABLE users(
  `user_idx` INT NOT NULL AUTO_INCREMENT COMMENT '회원 식별자',
  `id` VARCHAR(255) NOT NULL COMMENT '회원 아이디 ',
  `name` VARCHAR(255) NOT NULL COMMENT '회원 이름',
  `email` VARCHAR(255) NOT NULL COMMENT '회원 이메일',
  `address` VARCHAR(255) NOT NULL COMMENT '회원 주소',
  `gender` ENUM('male', 'female') NOT NULL COMMENT '회원 성별',
  `mobile_phone` VARCHAR(255) NOT NULL COMMENT '회원 휴대폰번호',
  `home_phone` VARCHAR(255) NOT NULL COMMENT '회원 휴대폰번호',
  `office_phone` VARCHAR(255) NOT NULL COMMENT '회원 휴대폰번호',
  `reg_datetime` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_id` (`user_idx`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

     */

    try {
        $client = new GuzzleHttp\Client();
        $response = $client->request(
            'GET',
            'https://api.androidhive.info/contacts/'
        );

        $code = $response->getStatusCode();
        if ($code === 200) {
            $body = $response->getBody();
            $contactData = json_decode($body->getContents(), true);
        }

        $insertQuery = 'INSERT INTO users (id, name, email, address, gender, mobile_phone, home_phone, office_phone, reg_datetime) VALUES ';
        if (count($contactData['contacts']) > 0) {
            foreach ($contactData['contacts'] as $data) {
                $dataQuery = "('".$data['id']."', '".$data['name']."', '".$data['email']."', '".$data['address']."', '".$data['gender']."', '".$data['phone']['mobile']."', '".$data['phone']['home']."', '".$data['phone']['office']."', NOW()),";
                $insertQuery .= $dataQuery;
            }
        }

        $insertQuery = substr($insertQuery, 0, -1);

        print_r($insertQuery);
    } catch (ClientException $e) {
        echo Psr7\Message::toString($e->getRequest());
        echo Psr7\Message::toString($e->getResponse());
    }
