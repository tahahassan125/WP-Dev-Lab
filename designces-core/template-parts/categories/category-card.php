
<?php
/**
 * WooCommerce Category Card.
 *
 * Displays one product category with its thumbnail,
 * name, product count and archive link.
 *
 * Expected input:
 * $args['category'] — WP_Term object for product_cat.
 *
 * @package Designces_Core
 */

// Get the category passed by get_template_part().
$category = isset( $args['category'] ) ? $args['category'] : null;

// Validate the supplied category before rendering.
if (
    ! $category instanceof WP_Term ||
    'product_cat' !== $category->taxonomy
) {
    return;
}

// Get the category archive URL.
$category_link = get_term_link( $category );

// Skip this card if WordPress cannot resolve the URL.
if ( is_wp_error( $category_link ) ) {
    return;
}

// Get the WooCommerce category thumbnail attachment ID.
$thumbnail_id = (int) get_term_meta(
    $category->term_id,
    'thumbnail_id',
    true
);
?>

<article class="category-card">

    <a
        class="category-card__link"
        href="<?php echo esc_url( $category_link ); ?>"
        aria-label="<?php
            echo esc_attr(
                sprintf(
                    __( 'Browse %s category', 'designces-core' ),
                    $category->name
                )
            );
        ?>"
    >

        <!-- Category thumbnail -->
        <div class="category-card__thumbnail">

            <?php if ( $thumbnail_id ) : ?>

                <?php
                // Display the assigned category image.
                echo wp_get_attachment_image(
                    $thumbnail_id,
                    'woocommerce_thumbnail',
                    false,
                    array(
                        'class'   => 'category-card__image',
                        'loading' => 'lazy',
                    )
                );
                ?>

            <?php else : ?>

                <?php
                // Use WooCommerce's placeholder if no image is assigned.
                echo wp_kses_post(
                    wc_placeholder_img(
                        'woocommerce_thumbnail',
                        array(
                            'class' => 'category-card__image',
                        )
                    )
                );
                ?>

            <?php endif; ?>

        </div>

        <!-- Category name -->
        <h3 class="category-card__title">
            <?php echo esc_html( $category->name ); ?>
        </h3>

        <!-- Category information -->
        <div class="category-card__meta">

            <span class="category-card__count">
                <?php
                printf(
                    esc_html(
                        _n(
                            '%s product',
                            '%s products',
                            (int) $category->count,
                            'designces-core'
                        )
                    ),
                    esc_html(
                        number_format_i18n( $category->count )
                    )
                );
                ?>
            </span>

            <span class="category-card__more">
                <?php esc_html_e( 'View category', 'designces-core' ); ?>
            </span>

        </div>

    </a>

</article>
