<?php

/**
 * Plugin Name:       Local Structured Schema data for Articles
 * Plugin URI:        https://acceseo.com/
 * Description:       Datos estrucutrados según Schema.org para artículos
 * Version:           1.0.1
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            acceseo
 * Author URI:        https://www.acceseo.com/
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

function schema_data_article()
{
    if (is_single() && get_post_type() == "post") {
        $custom_logo_id = get_theme_mod('custom_logo');
        $image = wp_get_attachment_image_url($custom_logo_id, 'full');
        ?>
<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Article",
        "author": {
            "@type": "Organization",
            "name": "<?php esc_html(get_bloginfo('name')); ?>"
            "url": "<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
        },
        "headline": "<?php esc_html(the_title()); ?>",
        "image": {
            "@type": "ImageObject",
            "url": "<?php esc_html(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>"
        },
        "datePublished": "<?php esc_html(the_time(get_option('date_format'))); ?>",
        "publisher": {
            "@type": "Organization",
            "name": "<?php esc_html(get_the_author_meta('display_name', get_the_ID())); ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php esc_html($image); ?>"
            }
        }
    }
</script>
<?php
    }
}
add_action('template_redirect', 'schema_data_article');
?>
