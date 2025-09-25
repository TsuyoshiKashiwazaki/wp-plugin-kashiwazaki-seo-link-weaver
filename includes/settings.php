<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * 管理メニューに設定ページを追加
 */
function kswl_add_admin_menu() {
	add_menu_page(
		'Kashiwazaki SEO Link Weaver 設定',
		'Kashiwazaki SEO Link Weaver',
		'manage_options',
		'kswl_settings_page',
		'kswl_render_settings_page',
		'dashicons-admin-links',
		81
	);
}

/**
 * 設定APIを登録
 */
function kswl_register_settings() {
	register_setting(
		KSWL_OPTION_NAME,
		KSWL_OPTION_NAME,
		'kswl_sanitize_options' // サニタイズ関数は共通
	);

	// --- 一般設定セクション ---
	add_settings_section(
		'kswl_general_section',
		'一般設定',
		'kswl_general_section_callback',
		'kswl_settings_page'
	);
	// URL難読化フィールド
	add_settings_field(
		'kswl_encode_urls_field',
		'URLを難読化する',
		'kswl_encode_urls_field_callback',
		'kswl_settings_page',
		'kswl_general_section'
	);

	// --- デザイン設定セクション ---
	add_settings_section(
		'kswl_design_section',
		'デフォルトデザイン設定', // セクションタイトル変更
		'kswl_design_section_callback',
		'kswl_settings_page'
	);
	// テキスト風スタイルフィールド
	add_settings_field(
		'kswl_text_styles_field',
		'テキスト風スタイル (CSS)',
		'kswl_text_styles_field_callback',
		'kswl_settings_page',
		'kswl_design_section'
	);
	// ボタン風スタイルフィールド
	add_settings_field(
		'kswl_button_styles_field',
		'ボタン風スタイル (CSS)',
		'kswl_button_styles_field_callback',
		'kswl_settings_page',
		'kswl_design_section'
	);

	// --- 使い方ガイドセクション ---
	add_settings_section(
		'kswl_usage_guide_section',
		'使い方ガイド',
		'kswl_usage_guide_section_callback', // 使い方ガイドの内容を表示
		'kswl_settings_page'
	);
}

/**
 * 設定ページのHTMLを描画
 */
function kswl_render_settings_page() {
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( KSWL_OPTION_NAME );
			do_settings_sections( 'kswl_settings_page' ); // 登録した全セクションを表示
			submit_button( '変更を保存' );
			?>
		</form>
	</div>
	<?php
}

// --- 各セクション・フィールドのコールバック関数 ---

/** 一般設定セクションの説明 (空) */
function kswl_general_section_callback() {}

/** デフォルトデザイン設定セクションの説明 */
function kswl_design_section_callback() {
	echo '<p>ショートコードで <code>class</code> 属性を指定しない場合に適用される、デフォルトのCSSスタイルを設定します。</p>';
}

/** URL難読化フィールドのHTML */
function kswl_encode_urls_field_callback() {
	$options = get_option( KSWL_OPTION_NAME, kswl_get_default_options() );
	$encode_urls = isset( $options['encode_urls'] ) ? (bool) $options['encode_urls'] : false;
	?>
	<label for="kswl_encode_urls">
		<input type="checkbox" id="kswl_encode_urls" name="<?php echo KSWL_OPTION_NAME; ?>[encode_urls]" value="1" <?php checked( $encode_urls, true ); ?>>
		URL処理を有効にして、ページソース内で直接読みにくくします。
	</label>
	<p class="description">これは基本的な難読化を行いますが、<strong>実際の暗号化ではありません</strong>。技術的な知識があれば元に戻すことができます。セキュリティ目的で使用しないでください。</p>
	<?php
}

/** テキスト風スタイルフィールドのHTML */
function kswl_text_styles_field_callback() {
	$options = get_option( KSWL_OPTION_NAME, kswl_get_default_options() );
	$text_styles = $options['text_styles'] ?? kswl_get_default_options()['text_styles'];
	?>
	<textarea id="kswl_text_styles" name="<?php echo KSWL_OPTION_NAME; ?>[text_styles]" rows="5" cols="50" class="large-text code"><?php echo esc_textarea( $text_styles ); ?></textarea>
	<p class="description">
		ショートコードで <code>class</code> 属性を指定せず、<code>design="text"</code> を指定した場合（または design 属性を省略した場合）に適用されるデフォルトのCSSルール。例:
		<code>cursor: pointer; text-decoration: underline; color: #0073aa;</code><br>
		<code>span</code> タグの style 属性として出力されます。
	</p>
	<?php
}

/** ボタン風スタイルフィールドのHTML */
function kswl_button_styles_field_callback() {
	$options = get_option( KSWL_OPTION_NAME, kswl_get_default_options() );
	$button_styles = $options['button_styles'] ?? kswl_get_default_options()['button_styles'];
	?>
	<textarea id="kswl_button_styles" name="<?php echo KSWL_OPTION_NAME; ?>[button_styles]" rows="7" cols="50" class="large-text code"><?php echo esc_textarea( $button_styles ); ?></textarea>
	<p class="description">
		ショートコードで <code>class</code> 属性を指定せず、<code>design="button"</code> を指定した場合に適用されるデフォルトのCSSルール。例:
		<code>cursor: pointer; display: inline-block; padding: 8px 15px; background-color: #2271b1; color: white; text-decoration: none; border-radius: 4px; border: none; font-size: 14px; line-height: 1.5;</code><br>
		<code>span</code> タグの style 属性として出力されます。ホバー効果などは別途CSSファイルで <code>.kswl-link-button:hover</code> に対して定義してください。
	</p>
	<?php
}

/**
 * 使い方ガイドセクションのコールバック関数 (HTML表示修正)
 */
function kswl_usage_guide_section_callback() {
	?>
	<div style="background-color: #f0f0f1; padding: 20px; border-radius: 4px; margin-top: 20px;">
		<h2 style="margin-top: 0;"><span class="dashicons dashicons-book-alt" style="vertical-align: middle;"></span> ショートコードの使い方ガイド</h2>

		<div style="background: white; padding: 15px; border-radius: 4px; margin: 15px 0;">
			<h3 style="margin-top: 0; color: #2271b1;">基本の使い方</h3>
			<p style="font-size: 14px;">投稿や固定ページに以下のショートコードを記述してください：</p>
			<div style="background: #f6f7f7; padding: 10px; border-left: 4px solid #2271b1; font-family: monospace; font-size: 14px;">
				[kswl_link text="表示テキスト" url="リンク先URL"]
			</div>
		</div>

		<div style="background: white; padding: 15px; border-radius: 4px; margin: 15px 0;">
			<h3 style="margin-top: 0; color: #2271b1;">使用可能な属性</h3>
			<table style="width: 100%; border-collapse: collapse;">
				<tr style="background: #f6f7f7;">
					<th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd; width: 120px;">属性名</th>
					<th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd; width: 80px;">必須</th>
					<th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">説明</th>
				</tr>
				<tr>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;"><code>text</code></td>
					<td style="padding: 10px; border-bottom: 1px solid #ddd; color: #d63638;"><strong>必須</strong></td>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;">
						表示するテキスト<br>
						<span style="color: #666; font-size: 12px;">例: text="詳しくはこちら"</span>
					</td>
				</tr>
				<tr>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;"><code>url</code></td>
					<td style="padding: 10px; border-bottom: 1px solid #ddd; color: #d63638;"><strong>必須</strong></td>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;">
						リンク先のURL<br>
						<span style="color: #666; font-size: 12px;">例: url="https://example.com"</span>
					</td>
				</tr>
				<tr>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;"><code>design</code></td>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;">任意</td>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;">
						デザインタイプ（text または button）<br>
						<span style="color: #666; font-size: 12px;">※classを指定した場合は無効</span>
					</td>
				</tr>
				<tr>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;"><code>class</code></td>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;">任意</td>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;">
						カスタムCSSクラス<br>
						<span style="color: #666; font-size: 12px;">※指定するとプラグインのスタイルは適用されません</span>
					</td>
				</tr>
				<tr>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;"><code>target</code></td>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;">任意</td>
					<td style="padding: 10px; border-bottom: 1px solid #ddd;">
						リンクの開き方（_blank または _self）<br>
						<span style="color: #666; font-size: 12px;">_blank = 新しいタブ、_self = 同じタブ（デフォルト）</span>
					</td>
				</tr>
			</table>
		</div>

		<div style="background: white; padding: 15px; border-radius: 4px; margin: 15px 0;">
			<h3 style="margin-top: 0; color: #2271b1;">よく使うパターン</h3>

			<div style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 4px;">
				<h4 style="margin: 0 0 10px 0; font-size: 14px;">📝 シンプルなテキストリンク</h4>
				<code style="background: white; padding: 5px 10px; display: inline-block; border-radius: 3px;">
					[kswl_link text="続きを読む" url="/article/123"]
				</code>
			</div>

			<div style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 4px;">
				<h4 style="margin: 0 0 10px 0; font-size: 14px;">🔘 ボタン風のリンク</h4>
				<code style="background: white; padding: 5px 10px; display: inline-block; border-radius: 3px;">
					[kswl_link text="お問い合わせ" url="/contact" design="button"]
				</code>
			</div>

			<div style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 4px;">
				<h4 style="margin: 0 0 10px 0; font-size: 14px;">🔗 新しいタブで開く外部リンク</h4>
				<code style="background: white; padding: 5px 10px; display: inline-block; border-radius: 3px;">
					[kswl_link text="公式サイト" url="https://example.com" target="_blank"]
				</code>
			</div>

			<div style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 4px;">
				<h4 style="margin: 0 0 10px 0; font-size: 14px;">🎨 独自デザインのリンク</h4>
				<code style="background: white; padding: 5px 10px; display: inline-block; border-radius: 3px;">
					[kswl_link text="特別セール" url="/sale" class="my-custom-button"]
				</code>
				<p style="margin: 10px 0 0 0; font-size: 12px; color: #666;">
					※ classを指定すると、プラグインのスタイルは適用されません。<br>
					別途CSSでmy-custom-buttonクラスのスタイルを定義してください。
				</p>
			</div>
		</div>

		<div style="background: #fff4e5; padding: 15px; border-radius: 4px; margin: 15px 0; border-left: 4px solid #f0b849;">
			<h4 style="margin-top: 0; color: #996800;">💡 重要なポイント</h4>
			<ul style="margin: 0; padding-left: 20px; font-size: 14px;">
				<li style="margin-bottom: 8px;"><strong>classを指定しない場合</strong>：設定画面のスタイルが自動適用されます</li>
				<li style="margin-bottom: 8px;"><strong>classを指定した場合</strong>：プラグインのスタイルは一切適用されません</li>
				<li style="margin-bottom: 8px;"><strong>designオプション</strong>：classを指定していない場合のみ有効です</li>
				<li><strong>URL難読化</strong>：設定で有効にすると、HTMLソース内でURLが読みにくくなります</li>
			</ul>
		</div>
	</div>
	<?php
}


/** オプション保存時のサニタイズ関数 */
function kswl_sanitize_options( $input ) {
	$new_input = array();
	$defaults = kswl_get_default_options();

	$new_input['encode_urls'] = ( isset( $input['encode_urls'] ) && $input['encode_urls'] == '1' );

	if ( isset( $input['text_styles'] ) ) {
		$new_input['text_styles'] = wp_strip_all_tags( $input['text_styles'] );
	} else {
		$new_input['text_styles'] = $defaults['text_styles'];
	}

	if ( isset( $input['button_styles'] ) ) {
		$new_input['button_styles'] = wp_strip_all_tags( $input['button_styles'] );
	} else {
		$new_input['button_styles'] = $defaults['button_styles'];
	}

	return $new_input;
}