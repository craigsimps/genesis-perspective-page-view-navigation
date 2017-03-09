<?php
/**
 * Genesis Perspective Page View Navigation
 *
 * @package    Genesis_Perspective_Page_View_Navigation
 * @author     Craig Simpson <craig@craigsimpson.scot>
 * @license    GPL-2.0+
 */
?>
        </div>
    </div>
    <?php wp_nav_menu( [
        'theme_location'  => 'perspective-page-menu',
        'container'       => 'nav',
        'container_class' => 'gppvn__outer-nav',
        'depth'           => 1
    ] ); ?>
</div>
