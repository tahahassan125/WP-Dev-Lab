# Designces Core — Template Parts

This directory contains the template parts used to structure and
render different sections of the Designces Core WordPress theme.

Template parts are organized by meaningful sections and
responsibilities rather than individual HTML elements.

---

## Directory Structure

```text
template-parts/
│
├── footer/                         ← Designces Core
│   ├── footer-bottom.php           ← Created by Designces Core
│   └── footer-widgets.php         ← Created by Designces Core
│
├── front-page/                     ← Designces Core
│   ├── categories.php              ← Created by Designces Core
│   ├── hero-carousel.php           ← Created by Designces Core
│   ├── popular-products.php        ← Created by Designces Core
│   └── special-offers.php          ← Created by Designces Core
│
├── header/                         ← Designces Core
│   ├── announcement-bar.php        ← Created by Designces Core
│   ├── main-header.php             ← Created by Designces Core
│   └── navigation.php              ← Created by Designces Core
│
├── content-none.php                ← Original _s file
├── content-page.php                ← Original _s file
├── content-search.php              ← Original _s file
└── content.php                     ← Original _s file




## Theek hai mai front page kay popular products sai start leta hoon given image meray front-page kay section ki hai


Hum is section ko is flow mein karenge
front-page.php
      ↓
popular-products.php
      ↓
[products popularity columns=4 limit=4]
      ↓
WooCommerce product loop
      ↓
WooCommerce baseline: woocommerce.css
      ↓
Designces custom styling: main.scss