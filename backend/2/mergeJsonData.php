<?php
    // 주제2 : 데이터 가공
    declare(strict_types=1);
    error_reporting(E_ALL & ~E_NOTICE);

    use GuzzleHttp\Psr7;
    use GuzzleHttp\Exception\ClientException;

    require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

    try {
        $informations = [];
        $organizations = [];

        // 사업과제계획서세부정보
        $client = new GuzzleHttp\Client();
        $response = $client->request(
            'GET',
            'https://api.odcloud.kr/api/15078055/v1/uddi:77b30536-c36a-4b29-b8a3-81afee769187',
            [
                'headers' => [
                    'Authorization' => 'KcFRrCMNVxtEEZqtylP0lRLdmcQF5skgew/U6uZTmZTWQ3oHq1SAoblO0xDSJwfV2JCmhDjLU84KO6MyfXnMAw=='
                ],
                'query' => [
                    'page' => 1,
                    'perPage' => 204,
                    'serviceKey' => 'KcFRrCMNVxtEEZqtylP0lRLdmcQF5skgew/U6uZTmZTWQ3oHq1SAoblO0xDSJwfV2JCmhDjLU84KO6MyfXnMAw=='
                ]
            ]
        );

        $code = $response->getStatusCode();
        if ($code === 200) {
            $body = $response->getBody();
            $informations = json_decode($body->getContents(), true);
        }

        // 사업과제계획서참여기관
        $response = $client->request(
            'GET',
            'https://api.odcloud.kr/api/15078052/v1/uddi:198fa64b-b1d8-46a8-9f04-97c845917e86',
            [
                'headers' => [
                    'Authorization' => 'KcFRrCMNVxtEEZqtylP0lRLdmcQF5skgew/U6uZTmZTWQ3oHq1SAoblO0xDSJwfV2JCmhDjLU84KO6MyfXnMAw=='
                ],
                'query' => [
                    'page' => 1,
                    'perPage' => 121,
                    'serviceKey' => 'KcFRrCMNVxtEEZqtylP0lRLdmcQF5skgew/U6uZTmZTWQ3oHq1SAoblO0xDSJwfV2JCmhDjLU84KO6MyfXnMAw=='
                ]
            ]
        );

        $code = $response->getStatusCode(); // 200
        if ($code === 200) {
            $body = $response->getBody();
            $organizations = json_decode($body->getContents(), true);
        }

        if (count($informations['data']) > 0 && count($organizations['data']) > 0) {
            $extraData = [];
            $numberCount = [];

            foreach ($organizations['data'] as $organization) {
                $numberCount[$organization['사업_과제번호']]++;
                $extraData[$organization['사업_과제번호']][] = [
                    '참여형태' => $organization['참여형태'],
                    '발주자여부' => $organization['발주자여부'],
                    '참여기관부담금액' => (int) ($organization['참여기관부담금액_현금'] + $organization['참여기관부담금액_현물'])
                ];
            }

            foreach ($informations['data'] as &$information) {
                if (isset($extraData[$information['사업_과제번호']])) {
                    $information['참여기관정보'] = $extraData[$information['사업_과제번호']];
                }
            }
        }
    } catch (ClientException $e) {
        echo Psr7\Message::toString($e->getRequest());
        echo Psr7\Message::toString($e->getResponse());
    }

    echo json_encode($informations['data']);
