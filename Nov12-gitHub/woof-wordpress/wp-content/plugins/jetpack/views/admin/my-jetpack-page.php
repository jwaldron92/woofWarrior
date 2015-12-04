<div class="clouds-sm"></div>

<div class="page-content landing">
	<?php Jetpack::init()->load_view( 'admin/network-activated-notice.php' ); ?>

	<?php do_action( 'jetpack_notices' ) ?>

	<div id="my-jetpack-page-template"></div>

	<script id="tmpl-connection-page" type="text/html">
		<div class="content-container">
			<div id="my-jetpack-content" class="content">
				<h2><?php _e( 'My Jetpack', 'jetpack' ); ?></h2>

				<?php
				/*
				 * 3-column row shown to non-masters
				 */
				?>
				<# if ( ! data.currentUser.isMasterUser || ( ! data.currentUser.isMasterUser && data.masterUser ) ) { #>
					<div class="connection-details local-user j-row">
						<?php // left col ?>
						<div class="j-col j-lrg-4 j-md-6 j-sm-12 jp-user">
							<h3 title="<?php esc_attr_e( 'Username', 'jetpack' ); ?>"><?php _e( 'Site Username', 'jetpack' ); ?></h3>
							<div class="user-01">
								{{{ data.currentUser.gravatar }}} {{{ data.currentUser.adminUsername }}}
							</div>
						</div>

						<?php // middle col ?>
						<div class="j-col j-lrg-4 j-m