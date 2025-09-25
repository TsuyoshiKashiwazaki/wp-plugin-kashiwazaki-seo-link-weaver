# 🚀 Kashiwazaki SEO Link Weaver

[![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-blue.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-7.2%2B-purple.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-GPL--2.0--or--later-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![Version](https://img.shields.io/badge/Version-1.0.0-orange.svg)](https://github.com/TsuyoshiKashiwazaki/wp-plugin-kashiwazaki-seo-link-weaver/releases)

JavaScript駆動のカスタマイズ可能なリンクを作成するWordPressプラグイン。SEO対策やデザイン制御に最適なショートコードソリューション。

> 🎯 **通常のHTMLリンクとは異なる、JavaScript制御のスマートリンクを簡単に実装**

## 主な機能

- 🔗 **JavaScript駆動リンク** - `<span>`タグとデータ属性を使用した安全なリンク管理
- 🎨 **柔軟なデザイン** - テキスト風・ボタン風のプリセット、カスタムCSSクラス対応
- 🔒 **URL難読化** - Base64エンコーディングによる基本的な視認性対策
- ⚡ **簡単実装** - `[kswl_link]`ショートコードで即座に利用可能
- 🎯 **ターゲット制御** - 新しいタブ/同じタブでの開き方を指定
- 📱 **レスポンシブ対応** - モバイル・デスクトップ両対応

## 🚀 クイックスタート

### インストール

1. プラグインファイルを `/wp-content/plugins/` にアップロード
2. WordPress管理画面でプラグインを有効化
3. メニュー「Kashiwazaki SEO Link Weaver」から設定

### 基本的な使い方

```
[kswl_link text="詳細を見る" url="/details"]
```

## 使い方

### ショートコード属性

| 属性 | 必須 | 説明 | 例 |
|------|------|------|-----|
| text | ✅ | 表示するテキスト | `text="クリック"` |
| url | ✅ | リンク先URL | `url="https://example.com"` |
| design | ❌ | デザインタイプ（text/button） | `design="button"` |
| class | ❌ | カスタムCSSクラス | `class="my-button"` |
| target | ❌ | 開き方（_blank/_self） | `target="_blank"` |

### 使用例

**テキストリンク：**
```
[kswl_link text="続きを読む" url="/article/123"]
```

**ボタンスタイル：**
```
[kswl_link text="お申し込み" url="/apply" design="button"]
```

**新しいタブで開く：**
```
[kswl_link text="外部サイト" url="https://example.com" target="_blank"]
```

**カスタムデザイン：**
```
[kswl_link text="特別オファー" url="/offer" class="custom-cta"]
```

## 技術仕様

### システム要件
- WordPress 5.0以上
- PHP 7.2以上
- モダンブラウザ（Chrome, Firefox, Safari, Edge）

### プラグイン構成
- メインファイル: `kashiwazaki-seo-link-weaver.php`
- 設定管理: `includes/settings.php`
- ショートコード処理: `includes/shortcode.php`
- JavaScript出力: `includes/scripts.php`

### データ保存
- オプション名: `kswl_options`
- 保存内容: URL難読化設定、デフォルトスタイル

## 更新履歴

### Version 1.0.0 (2025-09-25)
- 初回リリース
- ショートコード `[kswl_link]` の実装
- JavaScript駆動のリンク生成機能
- テキスト/ボタンデザインプリセット
- カスタムCSSクラス対応
- URL難読化オプション
- 管理画面での詳細設定
- プラグイン一覧に設定リンク追加

## ライセンス

GPL-2.0-or-later

このプラグインはフリーソフトウェアです。Free Software Foundationが公開したGNU General Public Licenseのバージョン2またはそれ以降のバージョンの条件に基づいて、再配布および/または変更することができます。

## サポート・開発者

**開発者**: 柏崎剛 (Tsuyoshi Kashiwazaki)
**ウェブサイト**: https://www.tsuyoshikashiwazaki.jp/
**サポート**: プラグインに関するご質問や不具合報告は、開発者ウェブサイトまでお問い合わせください。

## 🤝 貢献

バグ報告や機能提案は [Issues](https://github.com/TsuyoshiKashiwazaki/wp-plugin-kashiwazaki-seo-link-weaver/issues) からお願いします。

プルリクエストも歓迎します：
1. このリポジトリをフォーク
2. 機能ブランチを作成 (`git checkout -b feature/AmazingFeature`)
3. 変更をコミット (`git commit -m 'Add some AmazingFeature'`)
4. ブランチにプッシュ (`git push origin feature/AmazingFeature`)
5. プルリクエストを作成

## 📞 サポート

- **不具合報告**: [GitHub Issues](https://github.com/TsuyoshiKashiwazaki/wp-plugin-kashiwazaki-seo-link-weaver/issues)
- **機能リクエスト**: [GitHub Issues](https://github.com/TsuyoshiKashiwazaki/wp-plugin-kashiwazaki-seo-link-weaver/issues)
- **一般的な質問**: 開発者ウェブサイトからお問い合わせください

---

<div align="center">

**🔍 Keywords**: WordPress, Plugin, SEO, Link, JavaScript, Shortcode, Custom Link, URL Obfuscation

Made with ❤️ by [Tsuyoshi Kashiwazaki](https://github.com/TsuyoshiKashiwazaki)

</div>