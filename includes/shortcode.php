<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// グローバル変数
global $kswl_link_data;
$kswl_link_data = [];

/**
 * ショートコード [kswl_link] のハンドラー関数
 */
function kswl_shortcode_handler( $atts, $content = null ) {
	global $kswl_link_data;

	// --- オプションを取得 ---
	$options = get_option( KSWL_OPTION_NAME, kswl_get_default_options() );
	$process_urls = $options['encode_urls'] ?? false;
	// 設定されたスタイルは、class属性が指定されない場合のみ使用
	$text_styles = $options['text_styles'] ?? kswl_get_default_options()['text_styles'];
	$button_styles = $options['button_styles'] ?? kswl_get_default_options()['button_styles'];

	// --- ショートコード属性の処理 ---
	$atts = shortcode_atts(
		array(
			'text'   => 'ここをクリック',
			'url'    => '#',
			'target' => '',
			'design' => 'text', // design 属性は class 属性がない場合のフォールバックとして残す
			'class'  => '',     // class 属性
			'idonly' => '',     // idonly 属性
		),
		$atts,
		'kswl_link'
	);

	// URLとテキストをサニタイズ
	$url = esc_url_raw( $atts['url'] );
	$text = sanitize_text_field( $atts['text'] );
	$target_attr_val = sanitize_html_class( $atts['target'] ); // target属性値
	$shortcode_design = sanitize_key( $atts['design'] );
	// ユーザー指定クラスをサニタイズ
	$user_classes = esc_attr( $atts['class'] );
	// ユーザー指定クラスがあるかどうかを判定
	$has_user_class = ! empty( $user_classes );

	// URLが無効ならテキストのみ表示
	if ( empty( $url ) || $url === '#' ) {
		return esc_html( $text );
	}

	// --- URL処理 ---
	$processed_url = $process_urls ? base64_encode( $url ) : $url;

	// --- データ収集 ---
	// target属性値もデータとして保持
	$current_data = ['url' => $processed_url, 'target' => $target_attr_val];
	$index = false;
	foreach ($kswl_link_data as $i => $data) {
		// URLとTargetの両方が一致するか確認
		if ($data['url'] === $current_data['url'] && $data['target'] === $current_data['target']) {
			$index = $i;
			break;
		}
	}
	if ( $index === false ) {
		$kswl_link_data[] = $current_data;
		$index = count( $kswl_link_data ) - 1;
	}

	// --- idonly モードの処理 ---
	if ( $atts['idonly'] === '1' || $atts['idonly'] === 'on' ) {
		return sprintf( 'data-kswl-link-id="%d"', absint( $index ) );
	}

	// --- スタイルとクラスの決定 ---
	$style_attribute = ''; // デフォルトはスタイルなし
	$final_classes = '';   // デフォルトはクラスなし（class属性指定時）

	if ( $has_user_class ) {
		// ユーザー指定クラスがある場合
		// 最終クラス = ユーザー指定クラスのみ
		$final_classes = $user_classes;
		// スタイル属性は適用しない (style="")
		$style_attribute = '';
	} else {
		// ユーザー指定クラスがない場合 (従来の動作)
        // design 属性に基づいてデザインタイプを決定
        $final_design_type = 'text'; // デフォルト
        if ( in_array( $shortcode_design, ['text', 'button'] ) ) {
            $final_design_type = $shortcode_design;
        }
		// 最終クラス = kswl-link + デザインタイプクラス
		// (kswl-link はデザイン目的でのみ使用される)
		$design_class = 'kswl-link-' . esc_attr($final_design_type);
		$final_classes = 'kswl-link ' . $design_class; // kswl-link を追加
		// 設定画面のスタイルを適用
		$style_to_apply = ($final_design_type === 'button') ? $button_styles : $text_styles;
		$style_attribute = !empty($style_to_apply) ? sprintf('style="%s"', esc_attr( $style_to_apply )) : '';
	}

	// --- HTML生成 ---
	// data属性名を data-kswl-link-id に変更
	return sprintf(
		'<span class="%s" data-kswl-link-id="%d" %s>%s</span>',
		esc_attr( $final_classes ),
		absint( $index ),
		$style_attribute, // class指定時は空になる
		esc_html( $text )
	);
}