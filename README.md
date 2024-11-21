# coachtechフリマ
フリマアプリ
![image](https://github.com/user-attachments/assets/a3764021-ffa7-40b0-8932-9e8ee469efed)

## 作成した目的
アイテムの出品と購入を行うためのフリマアプリを開発する

## アプリケーションURL
https://github.com/ippei-oki/flea-market-app

## 機能一覧
・会員登録 ・ログイン ・ログアウト ・商品一覧取得　・商品詳細取得　・商品購入
・プロフィール　・商品出品

## 使用技術（実行環境）
・Laravel 8.83.27　・NGINX 1.21.1　・PHP 8.3.7　・MySQL 8.0.26

## テーブル設計
![image](https://github.com/user-attachments/assets/c780771b-5865-4e1c-9501-348bb8c16bcb)

## ER図
![image](https://github.com/user-attachments/assets/9cbaddbc-6c18-404b-9c6b-9b9eba3b6313)

## 環境構築
**Dockerビルド**
1. `git clone git@github.com/ippei-oki/flea-market-app.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```
6. マイグレーションの実行
``` bash
php artisan migrate
```
7. シーディングの実行
``` bash
php artisan db:seed
```
8. シンボリックリンクの作成
``` bash
php artisan storage:link
```
9. mailtrapの設定
mailtrapへ登録  
.envに以下の環境変数を追加
``` text
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="Your App Name"
```
10. stripeの設定
stripeへ登録  
.envに以下の環境変数を追加
``` text
STRIPE_SECRET=sk_test_**************************
STRIPE_KEY=pk_test_**************************
```
テスト用カード番号  
カード番号: 4242 4242 4242 4242  
有効期限: 現在の月/年以降  
CVC: 任意の3桁  

**ダミーデータ**
1. 山田 太郎 email: aaa@example.com  
2. 山田 次郎 email: bbb@example.com  
パスワードは全て"99999999"
