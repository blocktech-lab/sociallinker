<?php
/**
 * Add to content
 *
 * This is the code that adds the sharing links to the bottom of the content.
 *
 * @package sociallinker
 */

// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add sharing links to bottom of content.
 *
 * @param    string $content  Post/page content.
 * @return   string           Updated content.
 */
function sociallinker_add_to_content( $content ) {

	$settings = sociallinker_get_settings();

	// Work out if posts or pages are needed.

	$post = false;
	$page = false;

	if ( 'post' === $settings['type'] || 'postpage' === $settings['type'] ) {
		$post = true;
	}
	if ( 'page' === $settings['type'] || 'postpage' === $settings['type'] ) {
		$page = true;
	}

	// Now generate the shared output if we're on the right output type.

	if ( ( is_single() && $post ) || ( is_page() && $page ) ) {

		$title = rawurlencode( esc_html( get_the_title() ) );

		global $wp;
		$url = home_url( add_query_arg( array(), $wp->request ) );

		$content .= '<div class="sociallinker">
                        <svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m8.5 4c.27614 0 .5.22386.5.5 0 .24545778-.17687704.4496079-.41012499.49194425l-.08987501.00805575h-3c-.77969882 0-1.420449.59488554-1.49313345 1.35553954l-.00686655.14446046v8c0 .7796706.59488554 1.4204457 1.35553954 1.4931332l.14446046.0068668h8c.7796706 0 1.4204457-.5949121 1.4931332-1.3555442l.0068668-.1444558v-1c0-.2761.2239-.5.5-.5.2454222 0 .4496.1769086.4919429.4101355l.0080571.0898645v1c0 1.325472-1.0315469 2.4100378-2.3356256 2.4946823l-.1643744.0053177h-8c-1.3254816 0-2.41003853-1.0315469-2.49468231-2.3356256l-.00531769-.1643744v-8c0-1.3254816 1.03153766-2.41003853 2.33562452-2.49468231l.16437548-.00531769zm3.8776-.42218c0-.44778533.4618631-.70274151.8163008-.51603855l.0740992.04685855.0617.05301 4.4971 4.42118c.1865778.18340444.2224.46564543.1074667.68700565l-.0501667.07984435-.0572.06544-4.4971 4.42258c-.31528.3100533-.8146258.1449156-.9285862-.2465427l-.0183138-.0872573-.0053-.0823v-2.0955l-.2577.0232c-.2489.0266-.4963.0654-.7423.1164-1.53378.3183-3.01312 1.1122-4.44499 2.3907-.38943.3478-.99194.019-.92789-.5063.486252-3.98795475 2.48231514-6.23076163 5.8838529-6.60251607l.2644271-.02490393.2246-.01511zm1 1.03322v2.03152l-1.1513.07744c-1.5737.12605-2.73395.67426-3.5631 1.56852-.66903.72156-1.17827 1.72888-1.47646 3.06698 1.41552133-1.0608267 2.9105751-1.7256288 4.4876574-1.95751891l.3476026-.04395109 1.3556-.1218v2.15597l3.4462-3.38915z" fill="#212121"/></svg>
                        <a href="https://share1openly.org/share/?url=' . $url . '&text=' . $title . '">' . $settings['text'] . '</a>
                     </div>';
	}

	return $content;
}

$settings = sociallinker_get_settings();

add_filter( 'the_content', 'sociallinker_add_to_content', $settings['priority'] );
