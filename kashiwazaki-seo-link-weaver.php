<?php
/**
 * Plugin Name: Kashiwazaki SEO Link Weaver
 * Description: ショートコード [kswl_link] を使用して、カスタマイズ可能なJavaScript駆動のクリック可能要素を作成します。リンクのターゲット、スタイル、クラスを制御し、オプションでURLを難読化できます。
 * Version: 1.0.1
 * Author: 柏崎剛
 * Author URI: https://www.tsuyoshikashiwazaki.jp
 * Text Domain: kashiwazaki-seo-link-weaver
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // 直接アクセス禁止
}

// 定数
define( 'KSWL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'KSWL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'KSWL_OPTION_NAME', 'kswl_options' );

/**
 * 設定のデフォルト値を取得する関数
 */
function kswl_get_default_options() {
	return array(
		'encode_urls'   => false,
		'text_styles'   => 'cursor: pointer; text-decoration: underline; color: #0073aa;',
		'button_styles' => 'cursor: pointer; display: inline-block; padding: 8px 15px; background-color: #2271b1; color: white; text-decoration: none; border-radius: 4px; border: none; font-size: 14px; line-height: 1.5;',
	);
}

/**
 * プラグインが有効化されたときに実行される関数
 */
function kswl_activate() {
	$current_options = get_option( KSWL_OPTION_NAME );
	$default_options = kswl_get_default_options();

	if ( $current_options === false ) {
		add_option( KSWL_OPTION_NAME, $default_options );
	} else {
		$merged_options = array_merge( $default_options, $current_options );
		 if (!isset($current_options['text_styles'])) {
			$merged_options['text_styles'] = $default_options['text_styles'];
		}
		 if (!isset($current_options['button_styles'])) {
			$merged_options['button_styles'] = $default_options['button_styles'];
		}
		if ($merged_options !== $current_options) {
			update_option( KSWL_OPTION_NAME, $merged_options );
		}
	}
}
register_activation_hook( __FILE__, 'kswl_activate' );

/**
 * プラグインが無効化されたときに実行される関数
 */
function kswl_deactivate() {
	// delete_option( KSWL_OPTION_NAME );
}
register_deactivation_hook( __FILE__, 'kswl_deactivate' );

// 必要なファイルを読み込む
require_once KSWL_PLUGIN_DIR . 'includes/settings.php';
require_once KSWL_PLUGIN_DIR . 'includes/shortcode.php';
require_once KSWL_PLUGIN_DIR . 'includes/scripts.php';

// WordPressのアクションフックに関数を登録
add_action( 'admin_init', 'kswl_register_settings' );
add_action( 'admin_menu', 'kswl_add_admin_menu' );
add_shortcode( 'kswl_link', 'kswl_shortcode_handler' );
add_action( 'wp_footer', 'kswl_print_footer_script' );

// プラグイン一覧に設定リンクを追加
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'kswl_add_settings_link' );

/**
 * プラグイン一覧ページに設定リンクを追加
 */
function kswl_add_settings_link( $links ) {
	$settings_link = '<a href="' . admin_url( 'admin.php?page=kswl_settings_page' ) . '">設定</a>';
	array_unshift( $links, $settings_link );
	return $links;
}

// --- オプション: 古いショートコード [makslink] をサポートする場合 ---
/*
function kswl_legacy_shortcode_handler( $atts, $content = null ) {
    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        trigger_error( sprintf( 'ショートコード [makslink] は Kashiwazaki SEO Link Weaver バージョン 1.0.0 以降で非推奨になりました。[kswl_link] を使用してください。ファイル: %s', __FILE__ ), E_USER_DEPRECATED );
    }
    return kswl_shortcode_handler( $atts, $content );
}
add_shortcode( 'makslink', 'kswl_legacy_shortcode_handler' );
*/
// -------------------------------------------------------------------