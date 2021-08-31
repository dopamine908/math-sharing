# 專案環境建置

---
## Step0. 啟動Docker Service

```
點選Docker Desktop的圖示 (藍色底的貨櫃鯨魚)
```

NOTE.
- terminal的作法，待其他人使用補充

---
## Step1. 執行project_install.sh

```zsh
> sh project_install.sh
```

該指令會做以下事項：
1. 安裝 docker 環境
2. composer install
3. php artisan key:generate

補充 : 如遇到 WINDOWS 10 出現
---

```
ERROR: for workspace Cannot start service workspace: Ports are not available: listen tcp 0.0.0.0:2222: bind: An attempt was made to access a socket in a way forbidden by its access permissions.
```

解決 :

```
net stop winnat 停用
net start winnat 重新啟用
```
---
## Step2. 設定網址與IP的對應

### mac or linux
```zsh
> vim /etc/hosts

// 加入這行
127.0.0.1 dev.math-sharing.com

// 儲存離開
:wq
```
### window
```
// 找到window host file
C:\WINDOWS\system32\drivers\etc\hosts
// 複製到桌面

// 加入這行
127.0.0.1 dev.math-sharing.com

// 用系統管理員覆蓋 C:\WINDOWS\system32\drivers\etc\hosts
```

試著用網址開啟: https://dev.math-sharing.com:58443/

NOTE.
- 若看到"你的連線不是私人連線"， 直接輸入【thisisunsafe】指令跳過


---
## Step3. 連接laradock的mysql

```
Host : 127.0.0.1
Port : 53306

DB_USERNAME=root
DB_PASSWORD=root
```

新增資料庫

```
math_sharing
```

---
# 以下為補充

## 連接laradock的Redis

```
Host : 127.0.0.1
Port : 56379

REDIS_HOST=redis
REDIS_PASSWORD=null
```

---
## 重新啟動math-sharing

先啟動Docker Service，然後執行以下指令

```zsh
> cd math-sharing/laradock

> docker-compose up -d nginx php-fpm redis mysql workspace
```

---

## Laravel ide helper

為求 trace code 方邊 專案有安裝 [laravel ide helper](https://github.com/barryvdh/laravel-ide-helper)

可以下指令

```
php artisan ide-helper:generate
```

產生 ```_ide_helper.php``` 以協助開發

如果失敗可以嘗試重新 ```composer install``` 再下指令看看

---

## Laravel debugbar

為輔助開發 專案有安裝 [laravel debugbar](https://github.com/barryvdh/laravel-debugbar)

可以下指令安裝啟用

```
composer install
```
