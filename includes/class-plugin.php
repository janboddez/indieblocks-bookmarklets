<?php
/**
 * @package IndieBlocks\Bookmarklets
 */

namespace IndieBlocks\Bookmarklets;

class Plugin {
	const PLUGIN_VERSION = '0.1.0';

	/**
	 * @var Plugin $instance Plugin instance.
	 */
	private static $instance;

	/**
	 * @return Plugin This class's single instance.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function register() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'create_menu' ) );
	}

	public function enqueue_scripts() {
		$current_screen = get_current_screen();
		if ( empty( $current_screen->base ) || 'post' !== $current_screen->base ) {
			return;
		}

		wp_enqueue_script(
			'indieblocks-bookmarklets',
			plugins_url( '/assets/bookmarklets.js', __DIR__ ),
			array(
				'wp-blocks',
				'wp-block-editor',
				'wp-notices',
				'wp-element',
				'wp-data',
				'wp-plugins',
				'wp-escape-html',
			),
			self::PLUGIN_VERSION,
			true
		);
	}

	public function create_menu() {
		add_management_page(
			__( 'IndieBlocks Bookmarklets', 'indieblocks-bookmarklets' ),
			__( 'IndieBlocks Bookmarklets', 'indieblocks-bookmarklets' ),
			'edit_posts',
			'indieblocks-bookmarklets',
			array( $this, 'render_tools_page' )
		);
	}

	public function render_tools_page() {
		?>
		<div class="card">
			<h2 class="title"><?php esc_html_e( 'IndieBlocks Bookmarklets', 'indieblocks-bookmarklets' ); ?></h2>
			<p><?php esc_html_e( 'Drag ’n drop these to your browser’s bookmarks toolbar.', 'indieblocks-bookmarklets' ); ?></p>
			<p>
				<a class="button" href="javascript:( () => { window.open( '<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>?post_type=indieblocks_note&indieblocks_bookmark_of=' + encodeURIComponent( window.location.href ) + '&indieblocks_selected_text=' + encodeURIComponent( window.getSelection()?.toString().replace( /(?:\r\n|\r|\n)/g, '<br />' ) ) ); } )();"><?php esc_html_e( 'Bookmark', 'indieblocks-bookmarklets' ); ?></a>
				<a class="button" href="javascript:( () => { window.open( '<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>?post_type=indieblocks_like&indieblocks_like_of=' + encodeURIComponent( window.location.href ) + '&indieblocks_selected_text=' + encodeURIComponent( window.getSelection()?.toString().replace( /(?:\r\n|\r|\n)/g, '<br />' ) ) ); } )();"><?php esc_html_e( 'Like', 'indieblocks-bookmarklets' ); ?></a>
				<a class="button" href="javascript:( () => { window.open( '<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>?post_type=indieblocks_note&indieblocks_in_reply_to=' + encodeURIComponent( window.location.href ) + '&indieblocks_selected_text=' + encodeURIComponent( window.getSelection()?.toString().replace( /(?:\r\n|\r|\n)/g, '<br />' ) ) ); } )();"><?php esc_html_e( 'Reply', 'indieblocks-bookmarklets' ); ?></a>
				<a class="button" href="javascript:( () => { window.open( '<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>?post_type=indieblocks_note&indieblocks_repost_of=' + encodeURIComponent( window.location.href ) + '&indieblocks_selected_text=' + encodeURIComponent( window.getSelection()?.toString().replace( /(?:\r\n|\r|\n)/g, '<br />' ) ) ); } )();"><?php esc_html_e( 'Repost', 'indieblocks-bookmarklets' ); ?></a>
			</p>
		</div>
		<?php
	}
}
