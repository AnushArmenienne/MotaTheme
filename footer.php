</main>
<?php get_sidebar(); ?>
</div>
<footer id="footer" role="contentinfo">
<?php
	wp_nav_menu(
		array(
			'theme_location' => 'footer-menu',
			'container_class' => 'footer-menu-class'
		)
	);
	?>
<p class="droits-reserves">TOUS DROITS RESERVES</p>
	
</footer>
</div>
<?php wp_footer(); ?>
<script src="scripts.js"></script>
</body>

</html>