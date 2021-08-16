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

---
## Step2. 

```zsh
> sh project_install.sh
```

該指令會做以下事項：
1. 安裝 docker 環境
2. composer install
3. php artisan key:generate

---
## Step3. 設定網址與IP的對應

```zsh
> vim /etc/hosts

// 加入這行
127.0.0.1 dev.math-sharing.com

// 儲存離開
:wq
```

試著用網址開啟: https://dev.math-sharing.com:58443/

NOTE.
- 若看到"你的連線不是私人連線"， 直接輸入【thisisunsafe】指令跳過


---
## Step4. 連接laradock的mysql 

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


