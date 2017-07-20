# wordpress-frontplate

フロントエンド開発の効率を上げるテンプレートのWordpress版の派生版です。

[CHANGELOG](https://github.com/frontainer/wp-frontplate/blob/master/CHANGELOG.md)

## Dependence

* [NodeJS](https://nodejs.org/) 5.0以上
* [frontplate-cli](https://www.npmjs.com/package/frontplate-cli)
* [Docker for Mac](https://docs.docker.com/docker-for-mac/) または [Docker for Windows](https://docs.docker.com/docker-for-windows/)

## Get Started

`$ cp env-sample .env`

and 

`$ npm install`

`$ npm start`

## Dump SQL

`$ docker-compose exec mysql bash -c 'mysqldump -uroot -p$MYSQL_ROOT_PASSWORD -hlocalhost -B $MYSQL_DATABASE -v -r /docker-entrypoint-initdb.d/dump.sql && gzip -9vf /docker-entrypoint-initdb.d/dump.sql'
 `

## Changelog

### Dependence

* [conventional-changelog-cli](https://www.npmjs.com/package/conventional-changelog-cli) Require global option.

### Create changelog

`$ npm run changelog`

