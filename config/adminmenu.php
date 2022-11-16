<?php

return [
    [
        "header" => "Dashboard",
        "can" => ['dashboard-read']
    ],
    [
        "title" => "Dashboard",
        "icon" => "fas fa-tachometer-alt",
        "route" => "admin.dashboard.index",
        "patterns" => ["admin/dashboard*"],
        "can" => ['dashboard-read']
    ],
    [
        "title" => "Projects Plan",
        "icon" => "fas fa-project-diagram",
        "route" => "admin.projects.index",
        "patterns" => ["admin/projects*"],
        "can" => ['projects-read']
    ],
    [
        "title" => "Payout Methods",
        "icon" => "fas fa-money-check-alt",
        "route" => "admin.payout-methods.index",
        "patterns" => ["admin/payout-methods*"],
        "can" => ['payouts-method-create'],
    ],
    [
        "title" => "Payouts",
        "icon" => "fas fa-money-check-alt",
        "route" => "admin.payouts.index",
        "patterns" => ["admin/payouts*"],
        "can" => ['payouts-read'],
    ],
    [
        "header" => "User Management",
        "can" => ["users-read"]
    ],
    [
        "title" => "Customers",
        "icon" => "fas fa-users",
        "route" => "admin.customers.index",
        "patterns" => ["admin/customers*"],
        "can" => ['customers-read'],
    ],
    ["header" => "Reports", "can" => ['reports-read']],
    [
        "title" => "Deposit",
        "icon" => "fas fa-money-check",
        "route" => "admin.deposits.index",
        "patterns" => ["admin/deposits*"],
        "can" => ['reports-read'],
    ],
    [
        "title" => "Transactions",
        "icon" => "fas fa-exchange-alt",
        "route" => "admin.transactions.index",
        "patterns" => ["admin/transactions*"],
        "can" => ['reports-read']
    ],
    [
        "title" => "Installments",
        "icon" => "fab fa-instalod",
        "route" => "admin.installments.index",
        "patterns" => ["admin/installments*"],
        "can" => ['reports-read']
    ],
    [
        "title" => "Investments",
        "icon" => "fas fa-university",
        "route" => "admin.investments.index",
        "patterns" => ["admin/investments*"],
        "can" => ['reports-read']
    ],
    [
        "title" => "Return transactions",
        "icon" => "fas fa-money-bill-wave",
        "route" => "admin.return-transactions.index",
        "patterns" => ["admin/return-transactions*"],
        "can" => ['reports-read']
    ],
    ["header" => "Kyc Management", "can" => ['kyc-methods-read', 'kyc-requests-read']],
    [
        "title" => "Kyc Methods",
        "icon" => "fas fa-user-lock",
        "patterns" => ["admin/kyc-method*"],
        "can" => ['kyc-methods-read'],
        "submenu" => [
            [
                "title" => "Create Method",
                "route" => "admin.kyc-method.create",
                "patterns" => ["admin/kyc-method/create"],
                "can" => ['kyc-methods-create'],
            ],
            [
                "title" => "Manage Methods",
                "route" => "admin.kyc-method.index",
                "patterns" => ["admin/kyc-method"],
                "can" => ['kyc-methods-read'],
            ],
        ]
    ],
    [
        "title" => "Kyc Requests",
        "icon" => "fas fa-user-shield",
        "route" => "admin.kyc-requests.index",
        "patterns" => ["admin/kyc-requests*"],
        "can" => ['kyc-requests-read'],
    ],
    ["header" => "Website Management", "can" => ['website-read', 'website-update']],
    [
        "title" => "Supports",
        "icon" => "fas fa-headphones",
        "route" => "admin.supports.index",
        "patterns" => ["admin/supports*"],
        "can" => ['supports-read']
    ],
    [
        "title" => "Media",
        "icon" => "far fa-file-image",
        "route" => "admin.media.list",
        "patterns" => ["admin/media*"],
        "can" => ['media-read'],
    ],
    [
        "title" => "Blog",
        "icon" => "fab fa-blogger",
        "patterns" => ["admin/blog*"],
        "can" => ['blog-read', 'blog-create'],
        "submenu" => [
            [
                "title" => "Create Post",
                "route" => "admin.blog.create",
                "patterns" => ["admin/blog/create"],
                "can" => ['blog-create'],
            ],
            [
                "title" => "Manage Posts",
                "route" => "admin.blog.index",
                "patterns" => ["admin/blog"],
                "can" => ['blog-read'],
            ],
        ]
    ],
    [
        "title" => "Page",
        "icon" => "fas fa-file",
        "patterns" => ["admin/page*"],
        "can" => ['pages-read', 'pages-create'],
        "submenu" => [
            [
                "title" => "Create Page",
                "route" => "admin.page.create",
                "patterns" => ["admin/page/create"],
                "can" => ['pages-create'],
            ],
            [
                "title" => "Manage Pages",
                "route" => "admin.page.index",
                "patterns" => ["admin/page"],
                "can" => ['pages-read'],
            ],
        ]
    ],
    [
        "title" => "Website",
        "icon" => "fas fa-desktop",
        "patterns" => ["admin/settings/website/*"],
        "can" => ['website-read', 'website-update'],
        "submenu" => [
            [
                "title" => "Logo",
                "route" => "admin.settings.website.logo.index",
                "patterns" => ["admin/settings/website/logo/index"],
                "can" => ['website-read', 'website-update'],
            ],
            [
                "title" => "Headings",
                "route" => "admin.settings.website.heading.index",
                "patterns" => ["admin/settings/website./heading"],
                "can" => ['website-read', 'website-update'],
            ],
            [
                "title" => "Footer",
                "route" => "admin.settings.website.footer.index",
                "patterns" => ["admin/settings/website/footer"],
                "can" => ['website-read', 'website-update'],
            ],
            [
                "title" => "Faqs",
                "route" => "admin.settings.website.faq.index",
                "patterns" => ["admin/settings/website/faq"],
                "can" => ['website-read', 'website-update'],
            ],
            [
                "title" => "Announcement",
                "route" => "admin.settings.website.announcements.index",
                "patterns" => ["admin/settings/website/announcements"],
                "can" => ['website-read', 'website-update'],
            ],
        ]
    ],
    [
        "title" => "Settings",
        "icon" => "fas fa-cogs",
        "patterns" => ['admin/settings', 'admin/language/*', 'admin/menu/*'],
        "can" => ['settings-read', 'languages-read', 'menus-read', 'seo-read', 'system-settings-read', 'cron-settings', 'taxes-read', 'gateways-read', 'roles-read', 'roles-assign'],
        "submenu" => [
            [
                "title" => "Language",
                "route" => "admin.language.index",
                "patterns" => ["admin/language*"],
                "can" => ['languages-read'],
            ],
            [
                "title" => "Staff",
                "route" => "admin.staff.index",
                "patterns" => ["admin/staff*"],
                "can" => ['staff-read'],
            ],
            [
                "title" => "Menu Settings",
                "route" => "admin.menu.index",
                "patterns" => ["admin/menu*"],
                "can" => ['menus-read'],
            ],
            [
                "title" => "SEO Settings",
                "route" => "admin.seo.index",
                "patterns" => ["admin/seo*"],
                "can" => ['seo-read'],
            ],
            [
                "title" => "System Settings",
                "route" => "admin.env.index",
                "patterns" => ["admin/env*"],
                "can" => ['system-settings-read'],
            ],
            [
                "title" => "Cron Settings",
                "route" => "admin.cron.index",
                "patterns" => ["admin/cron*"],
                "can" => ['cron-settings-read'],
            ],
            [
                "title" => "Currencies Settings",
                "route" => "admin.currencies.index",
                "patterns" => ["admin/currencies*"],
                "can" => ['currencies-read'],
            ],
            [
                "title" => "Taxes Settings",
                "route" => "admin.taxes.index",
                "patterns" => ["admin/taxes*"],
                "can" => ['taxes-read'],
            ],
            [
                "title" => "Gateway Settings",
                "route" => "admin.payment-gateways.index",
                "patterns" => ["admin/payment-gateways*"],
                "can" => ['gateways-read'],
            ],
            [
                "title" => "Roles",
                "route" => "admin.roles.index",
                "patterns" => ["admin/roles*"],
                "can" => ['roles-read'],
            ],
            [
                "title" => "Assign Role",
                "route" => "admin.assign-role.index",
                "patterns" => ["admin/assign-role*"],
                "can" => ['roles-assign-read'],
            ],
        ]
    ],
];
