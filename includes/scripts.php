<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * 収集されたデータ配列と、クリックイベントを処理するJavaScriptをフッターに出力する
 */
function kswl_print_footer_script() {
    global $kswl_link_data; // グローバル変数名

    // 収集されたデータがない場合は何も出力しない
    if ( empty( $kswl_link_data ) ) {
        return;
    }

    // オプションを取得
    $options = get_option( KSWL_OPTION_NAME, kswl_get_default_options() );
    $process_urls_enabled = $options['encode_urls'] ?? false;

    // データ配列をJSON形式にエンコードしてJavaScript変数に渡す
    $json_data = wp_json_encode( $kswl_link_data );
     if ( $json_data === false ) {
        echo "<!-- Kashiwazaki SEO Link Weaver Error: Failed to prepare link data for JavaScript. -->";
        return;
    }

    ?>
    <script id="kswl-link-script">
        (function() {
            // PHPから渡されたデータ配列と設定
            const kswlLinkData = <?php echo $json_data; ?>;
            const kswlProcessUrls = <?php echo $process_urls_enabled ? 'true' : 'false'; ?>;

            if ( !kswlLinkData || kswlLinkData.length === 0 ) {
                return;
            }

            /**
             * 処理されたURL文字列を元の形式に戻す関数。
             */
            function kswlRevealUrl(processedStr) {
                try {
                    const urlProcessor = window['a' + 'to' + 'b'];
                    if (typeof urlProcessor === 'function') {
                         return urlProcessor(processedStr);
                    } else {
                        console.error('Kashiwazaki SEO Link Weaver Error: URL processing function not available.');
                        return processedStr;
                    }
                } catch (e) {
                    console.error('Kashiwazaki SEO Link Weaver Error: Failed to process URL string:', processedStr, e);
                    return null;
                }
            }

            document.body.addEventListener('click', function(event) {
                // ★★★ 検出対象をクラス名ではなくデータ属性に変更 ★★★
                const linkElement = event.target.closest('[data-kswl-link-id]');

                // ★★★ 属性名も変更 ★★★
                if (linkElement && linkElement.hasAttribute('data-kswl-link-id')) {
                    // ★★★ 属性名も変更 ★★★
                    const linkId = parseInt(linkElement.getAttribute('data-kswl-link-id'), 10);

                    if (!isNaN(linkId) && linkId >= 0 && linkId < kswlLinkData.length) {
                        const linkInfo = kswlLinkData[linkId];
                        if (linkInfo && linkInfo.url) {
                            let url;
                            if (kswlProcessUrls) {
                                url = kswlRevealUrl(linkInfo.url);
                            } else {
                                url = linkInfo.url;
                            }

                            if (url) {
                                // ★★★ linkInfo から target を取得 ★★★
                                const target = linkInfo.target || '_self';

                                if (target && target !== '_self' && target !== '') {
                                    window.open(url, target);
                                } else {
                                    window.location.href = url;
                                }
                            } else if (kswlProcessUrls) {
                                console.warn('Kashiwazaki SEO Link Weaver Warning: Could not reveal URL for link ID:', linkId);
                            }
                        }
                    } else {
                        console.warn('Kashiwazaki SEO Link Weaver Warning: Invalid link ID found:', linkId);
                    }
                }
            });
        })();
    </script>
    <?php
    // グローバル変数クリア
    $kswl_link_data = [];
}