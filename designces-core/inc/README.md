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



## `customizer.php`

**Origin:** Underscores (_s)

Handles WordPress Customizer functionality.

### Current Role
Registers Customizer settings and controls.
Provides the existing _s Customizer implementation.
Can be extended when Designces Core requires theme-admin customization options.

### Flow

WordPress Customizer
    ↓
customizer.php
    ↓
Theme settings / controls
    ↓
Theme output
```