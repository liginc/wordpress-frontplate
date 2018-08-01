# Wordpress Boilerplate for Frontplate CLI

フロントエンド開発の効率を上げるテンプレートのWordpress版の派生版です。

[CHANGELOG](https://github.com/frontainer/wp-frontplate/blob/master/CHANGELOG.md)

## Building Frontend Resources

🇬🇧 To build frontend resources, please run following command at the project root directory.

Frontend source files need to be built before publishing since they are not written as directly compatible with browsers.

Note that you need Docker to be installed on your machine to proceed this.

🇯🇵 フロントエンドリソースをビルドするには、プロジェクトルートディレクトリで下記のコマンドを実行してください。

フロントエンドのソースファイルはブラウザに対する直接的な互換性を持たないため、公開前にビルドを実行する必要があります。

この処理を実行するためにはお使いの端末に Docker がインストールされている必要があります。

```sh
sh scripts/build.sh

# More options available:
# sh scripts/build.sh --help
```

## Launching Testing Environment Locally

🇬🇧 To launch a testing environment on your local machine, please run following command at the project root directory.

This repository includes Docker Compose configuration file which lets you launch a virtual machine (container) to sandboxing and testing the application.

This feature simplily relys on Docker and Docker Compose so please refer to their documentation for detailed instructions and trouble shooting.

Note that this process also requires you to install Docker on your machine.

🇯🇵 テスト環境をローカルで起動するには、プロジェクトルートディレクトリで下記のコマンドを実行してください。

このリポジトリには Docker Compose の設定が含まれており、あなたの端末上で仮想マシン (コンテナ) を立ち上げ、安全な環境でアプリケーションのテストを可能にします。

この機能はシンプルに Docker および Docker Compose に依存しているので、詳細な利用方法およびトラブルシューティングはこれらの公式ドキュメントをご参照ください。

この処理もまた Docker のインストールを必要とします。

```sh
docker-compose up
```

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
