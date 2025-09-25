=== Kashiwazaki SEO Link Weaver ===
Contributors: tsuyoshikashiwazaki
Tags: link, shortcode, javascript, seo, custom link, button, style, obfuscation, url encoding
Requires at least: 5.0
Tested up to: 6.7
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

JavaScript駆動のカスタマイズ可能なリンクを作成。SEO対策やデザイン制御に最適なショートコードプラグイン。

== Description ==

**Kashiwazaki SEO Link Weaver** は、通常のHTMLリンクとは異なるJavaScript駆動のリンクを簡単に作成できるWordPressプラグインです。SEO戦略やユーザビリティ向上のために、リンクの動作と表示を細かく制御できます。

= 主な特徴 =

**🔗 JavaScript駆動のリンク生成**
* HTMLの `<a>` タグではなく `<span>` タグとしてレンダリング
* クリック動作はJavaScriptで制御
* データ属性を使用した安全なリンク管理

**🎨 柔軟なデザインオプション**
* テキスト風・ボタン風の2つのプリセットデザイン
* 管理画面から簡単にCSSスタイルをカスタマイズ
* 独自のCSSクラスを指定して完全なデザイン制御も可能

**🔒 URL難読化機能**
* HTMLソース内でURLを直接表示しない設定が可能
* Base64エンコーディングによる基本的な難読化
* ※セキュリティ機能ではなく、基本的な視認性対策です

**⚡ シンプルな使い方**
* `[kswl_link]` ショートコードで簡単実装
* 投稿、固定ページ、ウィジェットで利用可能
* 直感的な属性設定

= 使用例 =

**基本的なテキストリンク：**
`[kswl_link text="詳細を見る" url="/details"]`

**ボタンスタイルのリンク：**
`[kswl_link text="今すぐ申し込む" url="/apply" design="button"]`

**新しいタブで開く外部リンク：**
`[kswl_link text="公式サイト" url="https://example.com" target="_blank"]`

**独自デザインのリンク：**
`[kswl_link text="特別オファー" url="/offer" class="my-custom-button"]`

= こんな方におすすめ =

* SEO対策でリンクの見せ方を工夫したい
* アフィリエイトリンクを自然に配置したい
* サイト内のリンクデザインを統一したい
* HTMLを編集せずにリンクをカスタマイズしたい
* JavaScriptベースのリンク制御を実装したい

== Installation ==

= 自動インストール =

1. WordPress管理画面にログイン
2. プラグイン → 新規追加 へ移動
3. 「Kashiwazaki SEO Link Weaver」を検索
4. 「今すぐインストール」をクリック
5. インストール完了後「有効化」をクリック

= 手動インストール =

1. プラグインファイルをダウンロード
2. ZIPファイルを解凍
3. `/wp-content/plugins/` ディレクトリにアップロード
4. WordPress管理画面のプラグインページから有効化

= 初期設定 =

1. 管理画面のメニューから「Kashiwazaki SEO Link Weaver」を選択
2. デフォルトのテキスト・ボタンスタイルを設定
3. 必要に応じてURL難読化を有効化

== Frequently Asked Questions ==

= ショートコードの基本的な使い方は？ =

最も基本的な形：
`[kswl_link text="リンクテキスト" url="https://example.com"]`

必須属性は `text` と `url` の2つだけです。

= 利用可能な属性一覧 =

* **text** (必須) - 表示するテキスト
* **url** (必須) - リンク先のURL
* **design** (任意) - "text" または "button"（classがない場合のみ有効）
* **class** (任意) - カスタムCSSクラス（指定するとdesignは無効）
* **target** (任意) - "_blank" または "_self"（デフォルト）

= classとdesignの違いは？ =

**design属性を使う場合：**
* プラグインの設定画面で定義したスタイルが適用されます
* `kswl-link` などのプラグイン固有クラスが付与されます
* コーディング不要で簡単にスタイル変更可能

**class属性を使う場合：**
* プラグインのスタイルは一切適用されません
* 指定したクラス名のみが付与されます
* CSSで完全に独自のデザインを実装できます

= URL難読化は安全ですか？ =

URL難読化は基本的なBase64エンコーディングを使用しており、完全なセキュリティ機能ではありません。技術的な知識があれば復号可能です。重要な情報の保護には使用しないでください。

= SEOへの影響は？ =

このプラグインで作成されるリンクはJavaScript駆動のため、一部の検索エンジンクローラーには通常のリンクとして認識されない可能性があります。重要な内部リンクには通常の `<a>` タグの使用も検討してください。

= プラグインを無効化したらどうなりますか？ =

プラグインを無効化すると：
* ショートコードがそのまま表示されます
* 設定は保持されます（再有効化時に復元）
* 既存の投稿内容は変更されません

= エラーが表示される場合は？ =

以下を確認してください：
* WordPress 5.0以上、PHP 7.2以上を使用しているか
* JavaScriptエラーがコンソールに表示されていないか
* 他のプラグインとの競合がないか

== Screenshots ==

1. 管理画面の設定ページ - デフォルトスタイルの設定
2. ショートコードの使用例 - エディターでの入力
3. テキストリンクの表示例
4. ボタンリンクの表示例
5. 使い方ガイドセクション

== Changelog ==

= 1.0.0 =
* 初回リリース
* ショートコード `[kswl_link]` の実装
* JavaScript駆動のリンク生成機能
* テキスト/ボタンデザインプリセット
* カスタムCSSクラス対応
* URL難読化オプション
* 管理画面での詳細設定
* プラグイン一覧に設定リンク追加
* 使いやすい管理画面UI

== Upgrade Notice ==

= 1.0.0 =
Kashiwazaki SEO Link Weaverの初回リリースです。JavaScript駆動のカスタマイズ可能なリンクを作成できます。

== 開発者情報 ==

* **開発者:** 柏崎剛（Tsuyoshi Kashiwazaki）
* **ウェブサイト:** https://www.tsuyoshikashiwazaki.jp
* **サポート:** プラグインページのサポートフォーラムをご利用ください

== ライセンス ==

このプラグインはGPLv2またはそれ以降のバージョンでライセンスされています。

== 技術仕様 ==

* **必要環境:** WordPress 5.0以上、PHP 7.2以上
* **対応ブラウザ:** モダンブラウザ（Chrome, Firefox, Safari, Edge）
* **多言語対応:** 準備済み（textdomain: kashiwazaki-seo-link-weaver）
* **データベース:** オプションテーブルに設定を保存（kswl_options）