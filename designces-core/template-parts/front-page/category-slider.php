<?php

/**
 * Front-page Category Slider.
 *
 * Displays WooCommerce product categories with:
 * - Category thumbnail
 * - Category name
 * - Product count
 * - Category archive link
 *
 * The category cards will be displayed in a horizontal
 * scroll-snap slider styled by _category-slider.scss.
 *
 * @package Designces_Core
 */


/*
 * ---------------------------------------------------------
 * WOOCOMMERCE AVAILABILITY
 * ---------------------------------------------------------
 *
 * Do not render this component if WooCommerce is inactive.
 */
if (! class_exists('WooCommerce')) {
    return;
}


/*
 * ---------------------------------------------------------
 * CATEGORY QUERY OPTIONS
 * ---------------------------------------------------------
 *
 * taxonomy:
 *     Fetch WooCommerce product categories.
 *
 * hide_empty:
 *     true  = Only categories containing products.
 *     false = Include empty categories too.
 *
 * parent:
 *     0 = Only top-level categories.
 *     Remove this argument to include child categories too.
 *
 * orderby:
 *     name = Sort categories alphabetically.
 *     Other options include count, slug and term_id.
 *
 * order:
 *     ASC  = Ascending order.
 *     DESC = Descending order.
 *
 * These settings control which categories appear and
 * their display order in the slider.
 */
$category_args = array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => true,
    'parent'     => 0,
    'orderby'    => 'name',
    'order'      => 'ASC',
);


/*
 * Fetch the product categories using the options above.
 */
$product_categories = get_terms($category_args);


/*
 * Stop rendering if the query fails or returns no categories.
 */
if (is_wp_error($product_categories) || empty($product_categories)) {
    return;
}
?>

<section class="category-slider py-4">
    <div class="container-fluid">

        <?php
        /**
         * Slider navigation controls.
         *
         * These buttons sit outside the scrollable track,
         * so they remain stationary while categories scroll.
         */
        ?>
        <div class="category-slider__header d-flex justify-content-end mb-3">

            <div class="category-slider__controls d-flex gap-2">

                <button
                    type="button"
                    class="category-slider__prev"
                    aria-label="<?php esc_attr_e('Previous categories', 'designces-core'); ?>">
                    <i class="bi bi-chevron-left" aria-hidden="true"></i>
                </button>

                <button
                    type="button"
                    class="category-slider__next"
                    aria-label="<?php esc_attr_e('Next categories', 'designces-core'); ?>">
                    <i class="bi bi-chevron-right" aria-hidden="true"></i>
                </button>

            </div>

        </div>

        <!-- ===============================================
		     CATEGORY SLIDER TRACK
		     =============================================== -->

        <div class="category-slider__track">
            <!-- Dynamic category cards -->


            <?php foreach ($product_categories as $category) : ?>

                <?php
                /**
                 * Render the reusable category card component.
                 *
                 * Pass the current category to category-card.php
                 * using the template arguments array.
                 */
                get_template_part(
                    'template-parts/categories/category-card',
                    null,
                    array(
                        'category' => $category,
                    )
                );
                ?>

            <?php endforeach; ?>


        </div>

    </div>

</section>