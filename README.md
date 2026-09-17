# WP-Dev-Lab

Junction Concept — Designces Core

GitHub
└── WP-Dev-Lab
      └── designces-core/     ← ORIGINAL / Git-managed theme

LocalWP
└── designces-dev
      └── app
          └── public
              └── wp-content
                  └── themes/

Problem

Agar hum designces-core ko manually copy kar dein:

E:\WP-Dev-Lab\designces-core

C:\Users\ONLINE\Local Sites\designces-dev\...\themes\designces-core


# Bilkul — is step ka main purpose Junction banana nahi, balki Git Bash ko correct Git repository ke andar le jaana aur verify karna hai.

Step 1 — Git Bash open karein

Git Bash mein ye command run karein:

cd /e/WP-Dev-Lab

Phir:

pwd

Expected:

/e/WP-Dev-Lab

Aur:

ls

Expected:

README.md
designces-core

Step 2 — LocalWP themes folder mein junction banayein

Git Bash mein ye exact command run karein:


For Home :
cmd //c mklink /J "C:\Users\ONLINE\Local Sites\designces-dev\app\public\wp-content\themes\designces-core" "E:\WP-Dev-Lab\designces-core"





### Plugins i installed 

1. woocommerce  (but prducts mainay filhaal sample-data folder sai products import kiay thay -- C:\Users\Taha\Local Sites\designces-dev\app\public\wp-content\plugins\woocommerce\sample-data )
2. advanced woo search
3. WP SVG Images   --  for logo



## Designces Core — Development Progress






1. Theme Foundation
Created a custom WordPress theme named designces-core.
Theme is based on the Underscores (_s) starter theme.
Existing Underscores theme structure has been retained as the foundation.
Theme development is being done as a custom-coded WordPress theme.

2. Assets Structure

Created an assets directory for frontend assets:

assets/
├── css/
├── images/
└── js/

CSS/SCSS structure
assets/
└── css/
    ├── bootstrap-5.3.8/
    ├── main.scss
    ├── main.css
    └── main.css.map

bootstrap-5.3.8/ contains the Bootstrap source package.
main.scss is the main SCSS source/entry file.
main.css is the compiled CSS output.
main.css.map is the generated source map.

3. Bootstrap Integration
Downloaded and integrated Bootstrap 5.3.8.
The complete Bootstrap package is kept inside:

assets/css/bootstrap-5.3.8/
Bootstrap's original source files are kept separate from custom theme code.
Bootstrap is imported into main.scss using:
@import "bootstrap-5.3.8/scss/bootstrap";

4. SCSS → CSS Compilation
Installed Live Sass Compiler extension in VS Code.
Configured the development workflow so main.scss is compiled into main.css.
main.css and main.css.map are generated automatically when Sass is compiled.
main.css is treated as a generated/output file and should not be manually edited.

5. Bootstrap Compilation Verification

Bootstrap compilation has been successfully tested.

Current main.scss:
@import "bootstrap-5.3.8/scss/bootstrap";

body {
    color: aqua;
}
6. WordPress Enqueue System

Created:
inc/
└── enqueue.php


https://github.com/RaddyTheBrand/PawsGang-eCommerce-Theme-WooCommerce/blob/main/header.php



🎯 Design Rule

### Reference website
→ same visual output

### Yani hum reference ki actual values ko preserve karenge:

colors
font sizes
font weights
spacing
margins/padding
icon size
icon background
borders
Bootstrap breakpoints
column widths
alignment
responsive behavior
visibility rules

Lekin implementation better hogi:
Reference HTML
      ↓
Semantic analysis
      ↓
Better custom class names
      ↓
Clean WordPress/PHP
      ↓
Same CSS values
      ↓
Same visual result

### Ek important distinction

"Better code" ≠ "different design."

Code quality       → improve
Naming             → improve
Structure           → improve
Accessibility       → improve
WordPress practices → improve
Maintainability     → improve

Visual values       → preserve
Visual spacing      → preserve
Visual behavior     → preserve

### Current main.scss flow

Theme Variables
      ↓
Theme Colors
      ↓
Custom Colors
      ↓
Custom Utilities
      ↓
Bootstrap 5.3.8
      ↓
Custom Components
      ↓
Announcement Bar


### Ek important WooCommerce improvement

Reference directly karta hai:
wc_get_cart_url()
aur:
WC()->cart

#### Humne guard rakha:
if ( function_exists( 'WC' ) && WC()->cart ) :






### Pehle existing _s WooCommerce implementation ko samjhenge

Aapke woocommerce.php mein already:
WooCommerce theme support
WooCommerce CSS
WooCommerce wrappers
Related products
Cart link
Cart fragments
Mini cart

sab موجود hain.
Reference ka Ajax cart code same problem solve karta hai jo _s already solve kar raha hai.




### Comments Rule -- code readability/documentation
Jee, bilkul. Aapka point code readability/documentation ka hai, aur is case mein comments aise hone chahiye ke future mein sirf comment dekh kar immediately samajh aa jaye ke kaunsi file/source ko enqueue kiya ja raha hai aur uska role kya hai.

Is tarah enqueue.php future mein read karte waqt source → purpose → relationship teenon immediately clear rahenge.



###  WooCommerce ka built-in [products] shortcode hai.

 https://woocommerce.com/document/woocommerce-shortcodes/products/

 https://woocommerce.com/document/woocommerce-shortcodes/products/



















 # Designces Core

A custom WordPress theme developed for Designces.

Designces Core is based on the Underscores (`_s`) starter theme and
has been progressively customized and structured around a reusable,
component-based WordPress architecture.

The visual direction of the theme follows the PawsGang reference
design while the implementation is adapted for Designces using
modern WordPress, WooCommerce, Bootstrap, and custom theme code.

---

# Project Foundation

## Base Theme

**Underscores (`_s`)**

The initial theme structure and several core WordPress template files
were provided by the Underscores starter theme.

Original `_s` files have been retained where they provide useful
WordPress functionality and compatibility.

They may be adapted when required by Designces Core.

---

# Theme Architecture

The theme follows a meaningful component-based architecture.

The goal is to keep the code:

- Clean
- Reusable
- Maintainable
- Easy to understand
- Easy to locate
- Compatible with WordPress conventions

Components are created for meaningful sections or responsibilities,
not for every individual HTML element or `<div>`.

---

# Main Directory Structure

```text
designces-core/
│
├── assets/
│   ├── css/
│   │   ├── bootstrap-5.3.8/
│   │   ├── main.scss
│   │   ├── main.css
│   │   └── main.css.map
│   │
│   ├── icons/
│   │   └── bootstrap-icons-1.13.1/
│   │
│   ├── images/
│   │   ├── categories/
│   │   ├── slider/
│   │   └── payment-methods.png
│   │
│   └── js/
│       └── script.js
│
├── inc/
│   ├── README.md
│   ├── custom-header.php
│   ├── customizer.php
│   ├── enqueue.php
│   ├── jetpack.php
│   ├── template-functions.php
│   ├── template-tags.php
│   └── woocommerce.php
│
├── js/
│   └── navigation.js
│
├── languages/
│
├── template-parts/
│   ├── README.md
│   │
│   ├── footer/
│   │   ├── footer-bottom.php
│   │   └── footer-widgets.php
│   │
│   ├── front-page/
│   │   ├── categories.php
│   │   ├── hero-carousel.php
│   │   ├── popular-products.php
│   │   └── special-offers.php
│   │
│   ├── header/
│   │   ├── announcement-bar.php
│   │   ├── main-header.php
│   │   └── navigation.php
│   │
│   ├── content-none.php
│   ├── content-page.php
│   ├── content-search.php
│   └── content.php
│
├── 404.php
├── archive.php
├── comments.php
├── composer.json
├── footer.php
├── front-page.php
├── functions.php
├── header-original.php
├── header.php
├── index.php
├── page.php
├── package.json
├── search.php
├── sidebar.php
├── single.php
├── style.css
├── style-rtl.css
├── woocommerce.css
├── screenshot.png
└── README.md




### Aur agar future mein SCSS bohat bara ho jaye to tab partials mein split karenge:

assets/css/
├── main.scss
└── scss/
    ├── _header.scss
    ├── _footer.scss
    ├── _front-page.scss
    └── _woocommerce.scss






### woocommerce related

Lekin 2026 mein hum kya karenge?

Yahan official WooCommerce documentation hamari approach ko support karti hai.

WooCommerce ke current classic-theme docs ke mutabiq:

WooCommerce ki default CSS assets/css/woocommerce.css se aati hai.
WooCommerce khud recommend karta hai ke in core CSS files ko directly modify na karein.
Agar sirf styling changes chahiye hon, to theme stylesheet mein overriding styles add karein.
Agar major custom styling karni ho to default WooCommerce stylesheet completely disable karke apna CSS system banana bhi possible hai.

Yani reference ka lecture humein concept deta hai, lekin hum us concept ko modern architecture mein implement karenge.