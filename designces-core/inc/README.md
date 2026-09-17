# Designces Core — inc/

This directory contains PHP files used to extend, configure, and integrate functionality into the Designces Core WordPress theme.

The `inc/` directory is mainly responsible for theme-level functionality and integrations rather than page markup or visual styling.

---

## File Origin

Files in this directory come from two sources.

### 1. Underscores (\_s)

The following files were included with the original Underscores (\_s) starter theme:

- `custom-header.php`
- `customizer.php`
- `jetpack.php`
- `template-functions.php`
- `template-tags.php`
- `woocommerce.php`

These files are retained because they provide useful WordPress/WooCommerce theme functionality.

They may be adapted when required by Designces Core.

### 2. Designces Core

The following file was created specifically for Designces Core:

- `enqueue.php`

---

# Current File Flow

The following describes the current responsibility and general flow of each file in this directory.

---

## `custom-header.php`

**Origin:** Underscores (\_s)

Handles WordPress Custom Header functionality.

### Current Role

- Provides the `_s` Custom Header implementation.
- Registers and configures Custom Header support where required.
- Supports WordPress header-related functionality.

### Flow

```text
WordPress
    ↓
custom-header.php
    ↓
Custom Header functionality

Do not add general theme functionality here.

```

## `customizer.php`

**Origin:** Underscores (\_s)

Handles WordPress Customizer functionality.

### Current Role

Registers Customizer settings and controls.
Provides the existing \_s Customizer implementation.
Can be extended when Designces Core requires theme-admin customization options.

### Flow

WordPress Customizer
↓
customizer.php
↓
Theme settings / controls
↓
Theme output

Customizer-related functionality should remain here.

## `jetpack.php`

**Origin:** Underscores (\_s)

Contains Jetpack-specific theme compatibility functionality.

### Current Role
Provides the _s Jetpack integration.
Handles theme compatibility for Jetpack features.
### Flow
Jetpack
    ↓
jetpack.php
    ↓
Theme compatibility

Do not add general WordPress or WooCommerce functionality here.


## `template-functions.php`

**Origin**: Underscores (_s)

Contains theme-level template functions and compatibility functionality provided by Underscores.

### Current Role
Provides helper functions used by theme templates.
Handles theme-level functionality that supports template output.
Contains existing _s functionality that may be used by multiple templates.
### Flow

Theme templates
    ↓
template-functions.php
    ↓
Reusable theme functions

Before creating a new general-purpose template helper, check this file first.

## `template-tags.php`

**Origin:** Underscores (_s)

Contains reusable template tag functions.

### Current Role
Provides reusable functions for displaying common WordPress template information.
Handles presentation-related helper functions originally provided by _s.
### Flow
Theme templates
    ↓
template-tags.php
    ↓
Reusable template output helpers

Before creating a new reusable template tag or helper, check this file first to avoid duplicate functionality.

## `woocommerce.php`

**Origin:** Underscores (_s)

Provides WooCommerce theme integration and compatibility.

This file was originally supplied by Underscores (_s) and has been retained and adapted for the Designces Core WooCommerce implementation.

### Current Role
Declares WooCommerce theme support.
Enables WooCommerce product gallery features.
Enqueues the theme's WooCommerce baseline stylesheet.
Disables WooCommerce's default stylesheet.
Adds the woocommerce-active body class.
Configures related products.
Replaces WooCommerce's default content wrappers.
Provides WooCommerce header cart functionality.
Handles AJAX cart fragment updates for the custom header cart.
### Flow
WooCommerce
    ↓
inc/woocommerce.php
    ├── Theme support
    ├── Gallery features
    ├── WooCommerce hooks / filters
    ├── Content wrappers
    ├── Related products
    └── Header cart / AJAX fragments



WooCommerce Styling Flow

The current WooCommerce styling architecture is:

WooCommerce default stylesheet
        ↓
Disabled by `woocommerce_enqueue_styles`
        ↓
Theme root: `woocommerce.css`
        ↓
WooCommerce baseline / layout CSS
        ↓
assets/css/main.scss
        ↓
Designces custom visual styling
        ↓
assets/css/main.css

The root theme file:

woocommerce.css

is currently used as the WooCommerce baseline stylesheet.

Designces-specific visual styling should primarily be added to:

assets/css/main.scss

Do not modify WooCommerce core plugin CSS.




Product Presentation Flow

Homepage product sections can use reusable product presentation components located in:

template-parts/products/

For example:

WooCommerce product
        ↓
WC_Product
        ↓
template-parts/products/product-card.php
        ↓
Designces product card markup
        ↓
assets/css/main.scss
        ↓
Final visual presentation

The reusable product-card.php component is intended for Designces-specific product presentation and should not automatically be treated as a global WooCommerce template override.

Global WooCommerce template overrides should only be introduced when changing the actual WooCommerce template structure is necessary.



## `enqueue.php`

**Origin:** Designces Core

Handles the theme's frontend CSS and JavaScript assets.

### Current Role
Enqueues Google Fonts:
Source Sans Pro
Nunito
Enqueues Bootstrap 5.3.8 CSS.
Enqueues Bootstrap Icons 1.13.1.
Enqueues the theme style.css.
Enqueues the compiled main.css.
Enqueues Underscores navigation JavaScript.
Enqueues Bootstrap JavaScript.
Enqueues custom theme JavaScript.
Enqueues WordPress comment-reply JavaScript when required.
### Flow
WordPress
    ↓
enqueue.php
    ↓
Frontend assets
    ├── Google Fonts
    ├── Bootstrap 5.3.8
    ├── Bootstrap Icons 1.13.1
    ├── style.css
    ├── main.css
    ├── navigation.js
    ├── Bootstrap JavaScript
    └── Custom theme JavaScript
### CSS Source Flow
assets/css/main.scss
        ↓
Live Sass Compiler
        ↓
assets/css/main.css
        ↓
enqueue.php
        ↓
Frontend

main.scss is the source file.

main.css is the compiled output.

Do not make manual styling changes directly inside the compiled main.css.


## Responsibility Map
File	Main Responsibility
custom-header.php	WordPress Custom Header
customizer.php	WordPress Customizer
jetpack.php	Jetpack compatibility
template-functions.php	Theme-level template functions
template-tags.php	Reusable template tags and helpers
woocommerce.php	WooCommerce integration, hooks, cart and compatibility
enqueue.php	Frontend CSS and JavaScript assets