# Mysql Command

這個套件編寫了一些 Mysql 相關的的 Artisan 命令，主要用來協助系統管理與設定。

### 安裝方式

`composer require nox0121/mysqlcommand`

### 設定 app.confg

	'providers' => [
	    ...
	    Nox0121\MysqlCommand\MysqlCommandServiceProvider::class,
	    ...
	];

### 發布設定檔 (config/mysql-command.php)

`php artisan vendor:publish --provider="Nox0121\MysqlCommand\MysqlCommandServiceProvider"`

### 支援指令如下：

1. `php artisan mysql:create-database` - 根據 .env 設定，建立資料庫。
2. `php artisan mysql:dump-database` - 根據 .env 的資料庫及 `APP_STORAGE_PATH` 設定，傾倒資料庫。
3. `php artisan mysql:mysql:restore-database` - 根據 .env 的資料庫及 `APP_STORAGE_PATH` 設定，還原資料庫。
