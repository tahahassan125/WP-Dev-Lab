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