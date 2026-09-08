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