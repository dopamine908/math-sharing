#/bin/bash

# 紅色
red=`tput setaf 1`
# 綠色
green=`tput setaf 2`
# 原始顏色（白色）
original=`tput sgr0`

# 下載 laradock & 清除 laradock 的版控
echo "${green}[初始化專案...] 下載 laradock & 清除 laradock 的版控${original}"
rm -rf laradock/
git clone https://github.com/Laradock/laradock.git
rm -rf laradock/.git/
echo "${green}[初始化專案...] 執行完畢${original}"

# 覆蓋 laradock 需要使用的設定檔
echo "${green}[初始化專案...] 覆蓋 laradock 需要使用的設定檔${original}"
cp laradock-setting/.env.example laradock/.env
cp laradock-setting/laravel.conf.example laradock/nginx/sites/laravel.test.conf
cp laradock-setting/docker-compose.yml laradock/docker-compose.yml
cp laradock-setting/xdebug.ini laradock/php-fpm/xdebug.ini
cp laradock-setting/xdebug.ini laradock/workspace/xdebug.ini
echo "${green}[初始化專案...] 執行完畢${original}"

# laradock 環境建置中(docker-compose build)
echo "${green}[初始化專案...] laradock 環境建置中${original}"
cd laradock
docker-compose build --no-cache nginx php-fpm redis mysql workspace
echo "${green}[初始化專案...] laradock 環境建置完畢${original}"

# laradock 環境啟動中 (docker-compose up)
echo "${green}[初始化專案...] laradock 環境啟動中${original}"
docker-compose up -d nginx php-fpm redis mysql workspace
echo "${green}[初始化專案...] laradock 環境啟動完畢${original}"

# 複製 .env
echo "${green}[初始化專案...] 複製 .env${original}"
docker exec -it math-sharing_workspace_1 cp .env.example .env
echo "${green}[初始化專案...] 複製完成${original}"

# composer install
echo "${green}[初始化專案...] composer install${original}"
docker exec -it math-sharing_workspace_1 composer install
echo "${green}[初始化專案...] composer install done${original}"

# php artisan key:generate
echo "${green}[初始化專案...] php artisan key:generate${original}"
docker exec -it math-sharing_workspace_1 php artisan key:generate
echo "${green}[初始化專案...] key generate done${original}"

