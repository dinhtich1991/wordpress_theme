		<footer id="footer">

			<div id="footer-sidebar" class="secondary">
				<div id="footer-sidebar1">
				<?php
					if(is_active_sidebar('footer-sidebar-1')){
						dynamic_sidebar('footer-sidebar-1');
					}
				?>
				</div>
				<div id="footer-sidebar2">
					<?php
						if(is_active_sidebar('footer-sidebar-2')){
							dynamic_sidebar('footer-sidebar-2');
						}
					?>
				</div>
				<div id="footer-sidebar3">
					<?php
						global $tp_options;
						if(isset($tp_options['editor-text'])){
							echo $tp_options['editor-text'];
						}
					?>
				</div>

					
				
			</div>

		</footer>
		</div> <!-- container -->
		<?php
			wp_footer();
		?>
	</body>
</html>