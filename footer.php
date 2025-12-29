        <footer class="site-footer">
            <nav class="footer-navigation">
                <?php 
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'container'      => false,        
                        'menu_class'     => 'footer-links'
                    )); 
                ?>
            </nav>
            <p class="copy-right">
                © SozAI-Video <?php echo date('Y'); ?>
            </p>
        </footer>
    <?php wp_footer(); ?> </body>
</html>