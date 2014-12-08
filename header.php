<?php
    /**
     * The Header template for our theme
     *
     * Displays all of the <head> section and everything up till <div id="main">
     *
     * @package WordPress
     * @subpackage Re_Touch
     * @since ReTouch 1.0
     */
?>
<?php global $data; ?>
<?php $media_logo_upload = stripslashes($data['media_logo_upload']); ?>
<?php $media_favicon_upload = stripslashes($data['media_favicon_upload']); ?>
<?php $switch_affix_header = stripslashes($data['switch_affix_header']); ?>
<!DOCTYPE html>
    <!--[if IE 7]>
    <html class="ie ie7" <?php language_attributes(); ?>>
    <![endif]--><?php language_attributes(); ?>>
![endif]-->
    <!--[if IE 8]>
    <html class="ie ie8" <?php language_attributes(); ?>>
    <![endif]--><?php language_attributes(); ?>>
![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ($media_favicon_upload) { ?>
        <link rel="shortcut icon" href="<?php echo $media_favicon_upload; ?>" />
        <?php } else{ ?>
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/ico/favicon.png" />
        <?php } ?>
        <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
                    <!--[if lt IE 9]>
            <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
            <![endif]--><?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
![endif]-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <?php echo ( $switch_affix_header ) ? '<header id="masthead" class="site-header" role="banner" data-spy="affix" data-offset-top="10">' : '<header id="masthead" class="site-header" role="banner">'; ?>
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                            <?php if ($media_logo_upload) { ?>
                            <img src="<?php echo $media_logo_upload; ?>" class="logo-im">
                            <?php } else{ ?>
                            <?php bloginfo( 'name' ); ?>
                            <?php } ?>
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <?php
                            
                            if ( has_nav_menu( 'primary' ) ) {
                                wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav', 'depth' => 2, 'walker' => new wp_bootstrap_navwalker() ) );
                            }
                        ?>
                        <!-- /.nav -->
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>
            <!-- /.navbar -->
            <?php if ( get_header_image() ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
            <?php endif; ?>
</header><!-- #masthead -->
