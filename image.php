<?php
    /**
     * The template for displaying image attachments
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
                <?php if (have_posts()) : ?>
                <h1 class="archive-title"><?php the_title(); ?></h1>
                <?php else:  ?>
                <h1 class="archive-title"><?php _e( 'Archives', 'retouch' ); ?></h1>
                <?php endif; ?>
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
<?php rewind_posts(); ?>
<div id="main" class="wrapper">
    <div class="container">
        <div id="primary" class="site-content">
            <div id="content" role="main">
                <?php while ( have_posts() ) : the_post(); ?>
                <nav id="image-navigation" class="navigation" role="navigation">
                    <ul class="image-navigation-list">
                        <li><span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'retouch' ) ); ?></span></li>
                        <li><span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'retouch' ) ); ?></span></li>
                    </ul>


                </nav><!-- #image-navigation -->
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
                    <div class="entry-wrap">
                        <header class="entry-header">



                        </header><!-- .entry-header -->
                        <div class="entry-content">
                            <div class="entry-attachment">
                                <div class="attachment">
                                    <?php
                                        /*
                                         * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
                                         * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
                                         */
                                        $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
                                        foreach ( $attachments as $k => $attachment ) :
                                            if ( $attachment->ID == $post->ID )
                                                break;
                                        endforeach;
                                        $k++;
                                        // If there is more than 1 attachment in a gallery
                                        if ( count( $attachments ) > 1 ) :
                                            if ( isset( $attachments[ $k ] ) ) :
                                                // get the URL of the next image attachment
                                                $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                                            else :
                                                // or get the URL of the first image attachment
                                                $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                                            endif;
                                        else :
                                            // or, if there's only 1 image, get the URL of the image
                                            $next_attachment_url = wp_get_attachment_url();
                                        endif;
                                    ?>
                                    <a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
                                        /**
                                         * Filter the image attachment size to use.
                                         *
                                         * @since ReTouch 1.0
                                         *
                                         * @param array $size {
                                         *     @type int The attachment height in pixels.
                                         *     @type int The attachment width in pixels.
                                         * }
                                         */
                                        $attachment_size = apply_filters( 'retouch_attachment_size', array( 1020, 960 ) );
                                        echo wp_get_attachment_image( $post->ID, $attachment_size );
                                        ?></a>
                                    <?php if ( ! empty( $post->post_excerpt ) ) : ?>
                                    <div class="entry-caption">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <?php endif; ?>
                                </div><!-- .attachment -->
                            </div><!-- .entry-attachment -->
                            <div class="entry-description">
                                <?php the_content(); ?>
                                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'retouch' ), 'after' => '</div>' ) ); ?>
                            </div><!-- .entry-description -->
                        </div><!-- .entry-content -->
                        <footer class="entry-meta">
                            <?php
                                $metadata = wp_get_attachment_metadata();
                                printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>.', 'retouch' ),
                                    esc_attr( get_the_date( 'c' ) ),
                                    esc_html( get_the_date() ),
                                    esc_url( wp_get_attachment_url() ),
                                    $metadata['width'],
                                    $metadata['height'],
                                    esc_url( get_permalink( $post->post_parent ) ),
                                    esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
                                    get_the_title( $post->post_parent )
                                );
                            ?>
                            <?php edit_post_link( __( 'Edit', 'retouch' ), '<span class="edit-link">', '</span>' ); ?>
                        </footer><!-- .entry-meta -->
                    </div>
                </article><!-- #post -->
                <?php comments_template(); ?>
                <?php endwhile; // end of the loop. ?>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>
<?php get_footer(); ?>