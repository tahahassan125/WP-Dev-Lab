<?php

/**
 * Front page campaign section.
 *
 * Displays an active campaign with manually selected or
 * automatically retrieved WooCommerce sale products.
 *
 * Reuses the shared WooCommerce product-card component.
 *
 * @package Designces_Core
 */

// ACF is required for campaign configuration.
if (! function_exists('get_field')) {
    return;
}

// Campaign must be enabled in the homepage settings.
if (! get_field('enable_campaign')) {
    return;
}

// WooCommerce is required to retrieve and display products.
if (! class_exists('WooCommerce')) {
    return;
}

/*
 * ---------------------------------------------------------
 * CAMPAIGN DATE VALIDATION
 * ---------------------------------------------------------
 *
 * ACF Date Time Picker return format:
 * Y-m-d H:i:s
 *
 * Dates are interpreted using the WordPress timezone.
 *
 * Blank start date = campaign can start immediately.
 * Blank end date   = campaign has no expiry.
 */

$campaign_start_value = get_field('campaign_start_date');
$campaign_end_value   = get_field('campaign_end_date');

$campaign_start = null;
$campaign_end   = null;

/**
 * Convert an ACF date string into a DateTime object.
 *
 * Returns null when the date is empty or invalid.
 */
$parse_campaign_date = static function ($date_value) {

    if (empty($date_value) || ! is_string($date_value)) {
        return null;
    }

    $date = DateTimeImmutable::createFromFormat(
        '!Y-m-d H:i:s',
        trim($date_value),
        wp_timezone()
    );

    $errors = DateTimeImmutable::getLastErrors();

    if (
        ! $date ||
        (false !== $errors && ($errors['warning_count'] > 0 || $errors['error_count'] > 0)) ||
        $date->format('Y-m-d H:i:s') !== trim($date_value)
    ) {
        return null;
    }

    return $date;
};

// Parse dates only when values are provided.
if (! empty($campaign_start_value)) {
    $campaign_start = $parse_campaign_date($campaign_start_value);

    if (! $campaign_start) {
        return;
    }
}

if (! empty($campaign_end_value)) {
    $campaign_end = $parse_campaign_date($campaign_end_value);

    if (! $campaign_end) {
        return;
    }
}

// Current date and time in the WordPress timezone.
$current_datetime = current_datetime();

// Invalid date range: start date must not be after end date.
if (
    $campaign_start &&
    $campaign_end &&
    $campaign_start > $campaign_end
) {
    return;
}

// Campaign has not started yet.
if ($campaign_start && $current_datetime < $campaign_start) {
    return;
}

// Campaign has already expired.
if ($campaign_end && $current_datetime >= $campaign_end) {
    return;
}

/*
 * ---------------------------------------------------------
 * CAMPAIGN CONTENT
 * ---------------------------------------------------------
 */

$campaign_label       = get_field('campaign_label');
$campaign_title       = get_field('campaign_title');
$campaign_description = get_field('campaign_description');
$enable_countdown     = get_field('enable_countdown');

/*
 * ---------------------------------------------------------
 * PRODUCT CONFIGURATION
 * ---------------------------------------------------------
 */

// Product selection mode: sale_products or manual.
$product_source = get_field('product_source');

// Allow only supported product selection modes.
if (! in_array($product_source, array('manual', 'sale_products'), true)) {
    return;
}

// Products limit. Default to 4 when the field is empty.
$products_limit = absint(get_field('products_limit'));

if (! $products_limit) {
    $products_limit = 4;
}

/*
 * ---------------------------------------------------------
 * PRODUCT RETRIEVAL
 * ---------------------------------------------------------
 */

$campaign_products = array();

if ('manual' === $product_source) {

    /*
	 * Manual mode:
	 * Retrieve products selected through the ACF Relationship field.
	 *
	 * ACF is configured to return Post Objects.
	 */

    $manual_products = get_field('manual_products');

    if (is_array($manual_products)) {

        foreach ($manual_products as $manual_product) {

            // Accept an existing WooCommerce product object.
            if ($manual_product instanceof WC_Product) {

                $product = $manual_product;
            } else {

                // Convert an ACF Post Object or product ID.
                $product_id = 0;

                if ($manual_product instanceof WP_Post) {
                    $product_id = $manual_product->ID;
                } elseif (is_numeric($manual_product)) {
                    $product_id = absint($manual_product);
                }

                if (! $product_id) {
                    continue;
                }

                $product = wc_get_product($product_id);
            }

            // Only published WooCommerce products are allowed.
            if (
                ! ($product instanceof WC_Product) ||
                'publish' !== $product->get_status()
            ) {
                continue;
            }

            $campaign_products[$product->get_id()] = $product;

            // Stop when the configured product limit is reached.
            if (count($campaign_products) >= $products_limit) {
                break;
            }
        }
    }
} else {

    /*
	 * Automatic mode:
	 * Retrieve currently published WooCommerce sale products.
	 */

    $campaign_products = wc_get_products(
        array(
            'limit'   => $products_limit,
            'status'  => 'publish',
            'on_sale' => true,
            'return'  => 'objects',
        )
    );
}

// Do not display an empty campaign section.
if (empty($campaign_products)) {
    return;
}

/*
 * ---------------------------------------------------------
 * COUNTDOWN CONFIGURATION
 * ---------------------------------------------------------
 *
 * Countdown is displayed only when:
 * - Countdown is enabled in ACF.
 * - A valid campaign end date exists.
 * - The campaign is currently active.
 */

$show_countdown = (
    $enable_countdown &&
    $campaign_end instanceof DateTimeImmutable
);

?>

<section class="container-fluid campaign-section">

    <!-- =====================================================
	     CAMPAIGN HEADER
	     ===================================================== -->

    <header class="campaign-section__header">

        <?php if ($campaign_label) : ?>

            <p class="campaign-section__eyebrow">
                <?php echo esc_html($campaign_label); ?>
            </p>

        <?php endif; ?>


        <?php if ($campaign_title) : ?>

            <h2 class="campaign-section__title">
                <?php echo esc_html($campaign_title); ?>
            </h2>

        <?php endif; ?>


        <?php if ($campaign_description) : ?>

            <div class="campaign-section__description">
                <?php echo wp_kses_post(wpautop($campaign_description)); ?>
            </div>

        <?php endif; ?>

    </header>


    <!-- =====================================================
	     CAMPAIGN COUNTDOWN
	     ===================================================== -->

    <?php if ($show_countdown) : ?>

        <div class="campaign-section__countdown">

            <p class="campaign-section__countdown-label">
                <?php esc_html_e('Offer ends in:', 'designces-core'); ?>
            </p>

            <div
                class="campaign-countdown"
                data-end-time="<?php echo esc_attr($campaign_end->format(DATE_ATOM)); ?>">

                <div class="campaign-countdown__item">
                    <span class="campaign-countdown__value" data-countdown-days>00</span>
                    <span class="campaign-countdown__label">
                        <?php esc_html_e('Days', 'designces-core'); ?>
                    </span>
                </div>

                <div class="campaign-countdown__item">
                    <span class="campaign-countdown__value" data-countdown-hours>00</span>
                    <span class="campaign-countdown__label">
                        <?php esc_html_e('Hours', 'designces-core'); ?>
                    </span>
                </div>

                <div class="campaign-countdown__item">
                    <span class="campaign-countdown__value" data-countdown-minutes>00</span>
                    <span class="campaign-countdown__label">
                        <?php esc_html_e('Minutes', 'designces-core'); ?>
                    </span>
                </div>

                <div class="campaign-countdown__item">
                    <span class="campaign-countdown__value" data-countdown-seconds>00</span>
                    <span class="campaign-countdown__label">
                        <?php esc_html_e('Seconds', 'designces-core'); ?>
                    </span>
                </div>

            </div>

        </div>

    <?php endif; ?>


    <!-- =====================================================
	     CAMPAIGN PRODUCTS
	     ===================================================== -->


    <!-- =====================================================
     CAMPAIGN PRODUCTS SLIDER
     ===================================================== -->

    <div class="campaign-section__products">

        <!-- Previous Navigation -->
        <button
            class="campaign-section__nav campaign-section__nav--prev"
            type="button"
            aria-label="<?php esc_attr_e('Previous products', 'designces-core'); ?>"
            data-campaign-prev
            hidden>
            <i class="bi bi-arrow-left" aria-hidden="true"></i>
        </button>

        <!-- Products Track -->
        <div class="campaign-section__products-grid" data-campaign-track>

            <?php foreach ($campaign_products as $product) : ?>

                <?php
                get_template_part(
                    'template-parts/products/product-card',
                    null,
                    array(
                        'product' => $product,
                    )
                );
                ?>

            <?php endforeach; ?>

        </div>

        <!-- Next Navigation -->
        <button
            class="campaign-section__nav campaign-section__nav--next"
            type="button"
            aria-label="<?php esc_attr_e('Next products', 'designces-core'); ?>"
            data-campaign-next
            hidden>
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </button>

    </div>


</section>