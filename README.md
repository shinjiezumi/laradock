# laradock
Laravel6ベースのシンプルなDocker環境です。

* nginx
* php-fpm(php7.2)
* mysql5.7
* redis

随時アップデートしていきます。

# 環境構築
```
$ git clone https://github.com/shinjiezumi/laradock.git
$ cd laradock
$ docker-compose up -d
$ docker-compose exec app bash

# sh ./init.sh
# service supervisor start
```

# ide-helperファイル生成
```shell
php artisan clear-compiled

php artisan ide-helper:generate

php artisan ide-helper:meta

php artisan ide-helper:model
```

# 動作確認
http://localhost:8000

# 公開環境
https://lara-dock.herokuapp.com/
