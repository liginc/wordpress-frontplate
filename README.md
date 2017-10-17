# wordpress-frontplate

フロントエンド開発の効率を上げるテンプレートのWordpress版の派生版です。

[CHANGELOG](https://github.com/frontainer/wp-frontplate/blob/master/CHANGELOG.md)

## Dependence

* [NodeJS](https://nodejs.org/) 5.0以上
* [frontplate-cli](https://www.npmjs.com/package/frontplate-cli)
* [Docker for Mac](https://docs.docker.com/docker-for-mac/) または [Docker for Windows](https://docs.docker.com/docker-for-windows/)

## Get Started

必要に応じて、以下のファイルのテーマ名、テーマディレクトリ名を変更します。

- frp.config.js
- env-sample
- src/sampletheme
- wp/wp-content/themes/sampletheme

環境ファイルをコピーし、.envファイル作成します。

`$ cp env-sample .env`

必要なnpmパッケージをインストールします。

`$ npm install`

.envファイルの内容を元にして、WordPressがセットアップされます。
WordPressのバージョンの初期値が「最新版」から固定バージョンになりましたので、適宜変更してください。これは、WordPressの最新版に対応した日本語版がない場合があるためです。

phpバージョンの初期値は7.1になります。php5.6を利用したい場合は、docker-compose.ymlのwordpressイメージを下記の様に変更してください。
```
wordpress:
  image: liginccojp/wordpress:php5.6
  
```

`$ npm start`

## Dump SQL

Run npm scripts command, below.

`$ npm run sqldump`

現在のmysqlサービスコンテナのデータベース情報を共有ボリュームに保存し永続化します。
これにより、コンテナ作成時にデータベース情報が復元されるようになります。

## Changelog

### Dependence

* [conventional-changelog-cli](https://www.npmjs.com/package/conventional-changelog-cli) Require global option.

### Create changelog

`$ npm run changelog`

## Update style.css

`$ npm run wpstyle`

package.jsonのバージョン情報で、WordPressテーマのstyle.cssを更新します。
これにより、WordPressテーマからpackage.jsonのバージョン情報を参照できるようになります。
静的ファイルのキャッシュコントロール用のパラメータなどとして使えます。


