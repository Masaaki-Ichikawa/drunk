# drunk
PHP自作

## 概要
お酒のレシピを共有し、その投稿にいいね、コメントができるアプリです。

管理者と一般ユーザに分け、
それぞれでログインできるようにしています。

## 使い方
管理者

ユーザー、管理者の削除、追加、ジャンルの追加ができます

テストアカウント：

メールアドレス→admin1@test.com

パスワードadminuser1

一般ユーザ

レシピの投稿、編集、削除、閲覧、いいね。コメントの投稿、削除ができます。

テストアカウント：

メールアドレス→user1@test.jp

パスワード→user1password

## 環境
Xampp/MySQL/PHP

## データベース

データベース名：drunk 

テーブル

お使いのphpMyAdminに上のデータベースを作り、

php artisan migrate<br>
php artisan db:seed<br>

上記のコマンドを、ターミナルやコマンドプロンプトにて入力いただくとユーザーのテストデータが作成されます。