# Designces Core — inc/

This directory contains PHP files used to extend and configure
the Designces Core WordPress theme.

## File Origin

Files in this directory come from two sources:

### 1. Underscores (_s)

The following files were included with the original
Underscores (_s) starter theme:

- `custom-header.php`
- `customizer.php`
- `jetpack.php`
- `template-functions.php`
- `template-tags.php`
- `woocommerce.php`

These files may be adapted when required by Designces Core.

### 2. Designces Core

The following file was created specifically for
Designces Core:

- `enqueue.php`

`enqueue.php` handles the theme's custom CSS, JavaScript,
Google Fonts, Bootstrap, and Bootstrap Icons assets.

---

## Important Notes

- Do not delete `_s` files simply because they are not currently
  being used directly by a template.
- Before adding a new PHP file, check whether the functionality
  already exists in one of the files above.
- Keep functionality separated by responsibility.
- Avoid creating duplicate functions, hooks, or filters.
- When adapting an `_s` file, preserve useful WordPress/WooCommerce
  compatibility functionality unless there is a specific reason
  to replace it.

---

## Current Customizations

### `enqueue.php`

Created by Designces Core.

Responsible for:

- Google Fonts
- Bootstrap 5.3.8 CSS
- Bootstrap Icons 1.13.1
- Theme `style.css`
- Compiled `main.css`
- Underscores navigation JavaScript
- Bootstrap JavaScript
- Custom theme JavaScript

### `woocommerce.php`

Originally provided by `_s`.

Currently retained and adapted where required for
Designces Core's WooCommerce implementation.

The WooCommerce cart fragment functionality has been adapted
to work with the custom header cart markup:

`site-header__cart-summary`

---

## Maintenance Rule

When modifying an `_s` file:

1. Keep the original purpose of the file.
2. Make only the changes required by Designces Core.
3. Prefer modern WordPress/WooCommerce APIs where appropriate.
4. Avoid duplicating functionality that already exists.
5. Document significant customizations when necessary.