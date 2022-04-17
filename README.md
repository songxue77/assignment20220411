# 개인 과제 설명

## 사용 PHP 버전
- php 7.4.27

## 프로젝트 초기화
- git clone https://github.com/songxue77/assignment20220411.git
- cd /assignment20220411/backend
- composer install

## 웹서버 실행
- cd /assignment20220411/backend
- php -S localhost:8000

## 백엔드 주제1: 백엔드 영역에서의 이미지 가공
- 웹 브라우저로 localhost:8000/1/imageProcess.php 접근
  - 이미지 가공인자는 코드 상위에 변수로 선언하였습니다.
  - 사용한 라이브러리는 php내장 GD 함수입니다.
  - 브라우저에 이미지로 출력되게 하였습니다.

## 백엔드 주제2 : 데이터 가공
- 웹 브라우저로 localhost:8000/2/mergeJsonData.php 접근

## 백엔드 주제3: 테이블 설계와 데이터 입출력
- 웹 브라우저로 localhost:8000/3/generateInsertQuery.php 접근
  - 테이블은 코드에 코멘트로 작성하였습니다.
  - 사용한 데이터베이스는 MySQL입니다.
