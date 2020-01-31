# laradock
Laravel5.8ベースのシンプルなDocker環境です。

* nginx
* php-fpm(php7.2)
* mysql5.7
* redis

随時アップデートしていきます。

## 使い方
### インストール
```
$ git clone https://github.com/shinjiezumi/laradock.git
$ cd laradock
$ docker-compose up -d
$ docker-compose exec app bash

# sh ./init.sh
# service supervisor start
```

### ブラウザアクセス
http://localhost:8000
