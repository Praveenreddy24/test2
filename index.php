<?php
    /**
     * The main template file
     *
     * This is the most generic template file in a WordPress theme
     * and one of the two required files for a theme (the other being style.css).
     * It is used to display a page when nothing more specific matches a query.
     * For example, it puts together the home page when no home.php file exists.
     *
     * @link http://codex.wordpress.org/Template_Hierarchy
     *
     * @package WordPress
     * @subpackage Re_Touch
     * @since ReTouch 1.0
     */
    get_header();
?>
<header class="archive-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="archive-title">Blog</h1>
            </div>
            <!-- /.col-sm-6 -->
            <div class="col-xs-6 hidden-xs">
                <?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail(); ?>
            </div>
            <!-- /.col-xs-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</header>
<!-- .archive-header -->
<div id="main" class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div id="primary" class="site-content">
                    <div id="content" role="main">

                        <?php if ( have_posts() ) : ?>
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                        <?php endwhile; ?>
                        <?php retouch_content_nav( 'nav-below' ); ?>
                        <?php else : ?>
                        <article id="post-0" class="post no-results not-found">
                            <?php
                                if ( current_user_can( 'edit_posts' ) ) :
                                               // Show a different message to a logged-in user who can add posts.
                            ?>
                            <div class="entry-wrap">
                                <header class="entry-header">
                                    <h3><?php _e( 'No posts to display!', 'retouch' ); ?></h3>
                                </header>
                                <div class="entry-content">
                                    <p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'retouch' ), admin_url( 'post-new.php' ) ); ?></p>
                                </div><!-- .entry-content -->
                            </div>
                            <?php
                                else :
                                               // Show the default message to everyone else.
                            ?>
                            <div class="entry-wrap">
                                <header class="entry-header">
                                    <h3><?php _e( 'Nothing Found!', 'retouch' ); ?></h3>
                                </header>
                                <div class="entry-content">
                                    <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'retouch' ); ?></p>
                                    <?php get_search_form(); ?>
                                </div><!-- .entry-content -->
                            </div>
                            <?php endif; // end current_user_can() check ?>
                        </article><!-- #post-0 -->
                        <?php endif; // end have_posts() check ?>
                    </div><!-- #content -->
                </div><!-- #primary -->
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div><!-- #main .wrapper -->
<?php get_footer(); ?>