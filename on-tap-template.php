<?php
/*
Template Name: On Tap App
*/

get_header(); ?>
<?php if ( !post_password_required( $post ) ) {  ?>
    <div id="page-body" class="custom-page">
        <?php
        global $theme_options;
        if(function_exists("redux_post_meta")){
            $show_title = redux_post_meta( "theme_options", $post->ID, "custom-page-show-title" );
            $show_title_shadow = redux_post_meta( "theme_options", $post->ID, "custom-page-show-title-shadow" );
            if($show_title) { $show_title = true; } else { $show_title = false; }
            if($show_title_shadow) { $show_title_shadow = "show-title-shadow"; } else { $show_title_shadow = ""; }
        }else{
            $show_title = false;
            $show_title_shadow = "";
        }

        while ( have_posts() ) : the_post();
            // Get the page's background image
            $featured_image = wp_get_attachment_url( get_post_thumbnail_id() );
            // Check to see if this is the cart or checkout page
            if( strlen( $featured_image ) == 0 && function_exists( 'is_cart' ) ){
                if( is_cart() || is_checkout() ) {
                    $featured_image = $theme_options['munich_shop_image']['url'];
                }
            }
            ?>
            <section class="image preload <?php echo esc_attr( $show_title_shadow ); ?>" data-image="<?php echo esc_attr( $featured_image ); ?>">
                <?php if($show_title){ ?>
                    <h1><?php the_title(); ?></h1>
                    <p><?php echo get_the_excerpt(); ?></p>
                <?php } ?>
            </section>
            <section class="content">
                <?php echo the_content(); ?>
            </section>
            <?php
        endwhile;
        ?>
    </div>
    <?php
} else {
    echo get_the_password_form();
} ?>
<?php get_footer(); ?>