<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.11.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.11.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-categories">
                                <a href="#endpoints-GETcustomer-categories">GET customer/categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-register">
                                <a href="#endpoints-POSTcustomer-register">POST customer/register</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-login">
                                <a href="#endpoints-POSTcustomer-login">POST customer/login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-forgot-password">
                                <a href="#endpoints-POSTcustomer-forgot-password">POST customer/forgot-password</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-reset-password">
                                <a href="#endpoints-POSTcustomer-reset-password">POST customer/reset-password</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-shops--slug-">
                                <a href="#endpoints-GETcustomer-shops--slug-">Get single shop profile details and active shop products.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-marketplace-products">
                                <a href="#endpoints-GETcustomer-marketplace-products">Global product discovery feed using model relationships & custom scopes.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-logout">
                                <a href="#endpoints-POSTcustomer-logout">POST customer/logout</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-profile">
                                <a href="#endpoints-GETcustomer-profile">GET customer/profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-profile">
                                <a href="#endpoints-POSTcustomer-profile">POST customer/profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-deactivate">
                                <a href="#endpoints-POSTcustomer-deactivate">POST customer/deactivate</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-dashboard">
                                <a href="#endpoints-GETcustomer-dashboard">Get aggregate profile statistics and recent activity for the customer.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-dashboard-orders-history">
                                <a href="#endpoints-GETcustomer-dashboard-orders-history">Get paginated customer order history with filters.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-dashboard-orders-details--orderNumber-">
                                <a href="#endpoints-GETcustomer-dashboard-orders-details--orderNumber-">Get single order details for tracking and invoice view.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-addresses">
                                <a href="#endpoints-GETcustomer-addresses">GET customer/addresses</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-addresses">
                                <a href="#endpoints-POSTcustomer-addresses">POST customer/addresses</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTcustomer-addresses--customerAddress_id-">
                                <a href="#endpoints-PUTcustomer-addresses--customerAddress_id-">PUT customer/addresses/{customerAddress_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PATCHcustomer-addresses-default--customerAddress_id-">
                                <a href="#endpoints-PATCHcustomer-addresses-default--customerAddress_id-">PATCH customer/addresses/default/{customerAddress_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEcustomer-addresses--customerAddress_id-">
                                <a href="#endpoints-DELETEcustomer-addresses--customerAddress_id-">DELETE customer/addresses/{customerAddress_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-addresses-show--customerAddress_id-">
                                <a href="#endpoints-GETcustomer-addresses-show--customerAddress_id-">GET customer/addresses/show/{customerAddress_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-orders">
                                <a href="#endpoints-GETcustomer-orders">GET customer/orders</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-orders">
                                <a href="#endpoints-POSTcustomer-orders">POST customer/orders</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-orders--id-">
                                <a href="#endpoints-GETcustomer-orders--id-">GET customer/orders/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-orders--id--cancel">
                                <a href="#endpoints-POSTcustomer-orders--id--cancel">POST customer/orders/{id}/cancel</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-orders--id--confirm-received">
                                <a href="#endpoints-POSTcustomer-orders--id--confirm-received">POST customer/orders/{id}/confirm-received</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-orders--id--return">
                                <a href="#endpoints-POSTcustomer-orders--id--return">POST customer/orders/{id}/return</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-cart">
                                <a href="#endpoints-GETcustomer-cart">GET customer/cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-cart">
                                <a href="#endpoints-POSTcustomer-cart">POST customer/cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETcustomer-cart-count">
                                <a href="#endpoints-GETcustomer-cart-count">GET customer/cart/count</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTcustomer-cart--id-">
                                <a href="#endpoints-PUTcustomer-cart--id-">PUT customer/cart/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEcustomer-cart--id-">
                                <a href="#endpoints-DELETEcustomer-cart--id-">DELETE customer/cart/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEcustomer-cart-clear">
                                <a href="#endpoints-DELETEcustomer-cart-clear">DELETE customer/cart/clear</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTcustomer-cart-sync">
                                <a href="#endpoints-POSTcustomer-cart-sync">POST customer/cart/sync</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-register-request">
                                <a href="#endpoints-POSTadmin-register-request">POST admin/register-request</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-login">
                                <a href="#endpoints-POSTadmin-login">POST admin/login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-forgot-password">
                                <a href="#endpoints-POSTadmin-forgot-password">POST admin/forgot-password</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-reset-password">
                                <a href="#endpoints-POSTadmin-reset-password">POST admin/reset-password</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-logout">
                                <a href="#endpoints-POSTadmin-logout">POST admin/logout</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-change-password">
                                <a href="#endpoints-POSTadmin-change-password">POST admin/change-password</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTadmin-update">
                                <a href="#endpoints-PUTadmin-update">PUT admin/update</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-update-image">
                                <a href="#endpoints-POSTadmin-update-image">POST admin/update-image</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEadmin-delete">
                                <a href="#endpoints-DELETEadmin-delete">DELETE admin/delete</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-upload-kyc">
                                <a href="#endpoints-POSTadmin-upload-kyc">POST admin/upload-kyc</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-shops">
                                <a href="#endpoints-GETadmin-shops">GET admin/shops</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-shops">
                                <a href="#endpoints-POSTadmin-shops">POST admin/shops</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-dashboard-stats">
                                <a href="#endpoints-GETadmin-dashboard-stats">Get aggregate statistics (Revenue, Orders, Low Stock, Balance).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-dashboard-chart">
                                <a href="#endpoints-GETadmin-dashboard-chart">Get chart sales trends over the last 7 days.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-dashboard-recent-orders">
                                <a href="#endpoints-GETadmin-dashboard-recent-orders">Get recent orders list with pagination.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-dashboard-toggle-status">
                                <a href="#endpoints-GETadmin-dashboard-toggle-status">Toggle shop status (open/closed).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-shop-all">
                                <a href="#endpoints-GETadmin-shop-all">GET admin/shop/all</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-shop-profile">
                                <a href="#endpoints-GETadmin-shop-profile">GET admin/shop/profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTadmin-shop-profile">
                                <a href="#endpoints-PUTadmin-shop-profile">PUT admin/shop/profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-shop-profile-branding">
                                <a href="#endpoints-POSTadmin-shop-profile-branding">POST admin/shop/profile/branding</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEadmin-shop-profile">
                                <a href="#endpoints-DELETEadmin-shop-profile">DELETE admin/shop/profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEadmin-shop-profile-force">
                                <a href="#endpoints-DELETEadmin-shop-profile-force">DELETE admin/shop/profile/force</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-shop-payout-requests">
                                <a href="#endpoints-GETadmin-shop-payout-requests">List payout requests.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-shop-payout-requests">
                                <a href="#endpoints-POSTadmin-shop-payout-requests">Vendor submits a payout request.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-shop-category-requests-my-requests">
                                <a href="#endpoints-GETadmin-shop-category-requests-my-requests">GET admin/shop/category-requests/my-requests</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-shop-category-requests">
                                <a href="#endpoints-POSTadmin-shop-category-requests">POST admin/shop/category-requests</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTadmin-shop-category-requests--id-">
                                <a href="#endpoints-PUTadmin-shop-category-requests--id-">PUT admin/shop/category-requests/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEadmin-shop-category-requests--id-">
                                <a href="#endpoints-DELETEadmin-shop-category-requests--id-">DELETE admin/shop/category-requests/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-shop-orders">
                                <a href="#endpoints-GETadmin-shop-orders">GET admin/shop/orders</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-shop-orders--id-">
                                <a href="#endpoints-GETadmin-shop-orders--id-">GET admin/shop/orders/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PATCHadmin-shop-orders--id--status">
                                <a href="#endpoints-PATCHadmin-shop-orders--id--status">PATCH admin/shop/orders/{id}/status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-shop-orders--id--approve-cancellation">
                                <a href="#endpoints-POSTadmin-shop-orders--id--approve-cancellation">POST admin/shop/orders/{id}/approve-cancellation</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-shop-orders--id--reject-cancellation">
                                <a href="#endpoints-POSTadmin-shop-orders--id--reject-cancellation">POST admin/shop/orders/{id}/reject-cancellation</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-shop-orders--id--process-return">
                                <a href="#endpoints-POSTadmin-shop-orders--id--process-return">POST admin/shop/orders/{id}/process-return</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-products-store">
                                <a href="#endpoints-POSTadmin-products-store">POST admin/products/store</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-products-all">
                                <a href="#endpoints-GETadmin-products-all">GET admin/products/all</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-products-single--product_id-">
                                <a href="#endpoints-GETadmin-products-single--product_id-">GET admin/products/single/{product_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTadmin-products-local--id-">
                                <a href="#endpoints-PUTadmin-products-local--id-">PUT admin/products/local/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-products-local-image--product_id-">
                                <a href="#endpoints-POSTadmin-products-local-image--product_id-">POST admin/products/local/image/{product_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEadmin-products-local--product_id-">
                                <a href="#endpoints-DELETEadmin-products-local--product_id-">DELETE admin/products/local/{product_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEadmin-products-local-force-delete--product_id-">
                                <a href="#endpoints-DELETEadmin-products-local-force-delete--product_id-">DELETE admin/products/local/force-delete/{product_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTadmin-products-global--product_id-">
                                <a href="#endpoints-PUTadmin-products-global--product_id-">PUT admin/products/global/{product_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-products-global-image--product_id-">
                                <a href="#endpoints-POSTadmin-products-global-image--product_id-">POST admin/products/global/image/{product_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEadmin-products-global--product_id-">
                                <a href="#endpoints-DELETEadmin-products-global--product_id-">DELETE admin/products/global/{product_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEadmin-products-global-force-delete--product_id-">
                                <a href="#endpoints-DELETEadmin-products-global-force-delete--product_id-">DELETE admin/products/global/force-delete/{product_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-dashboard-index">
                                <a href="#endpoints-GETadmin-dashboard-index">Return admin overview & shop contextual details for the logged-in admin.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETsuperadmin-super-dashboard">
                                <a href="#endpoints-GETsuperadmin-super-dashboard">Show Superadmin Control Panel metrics.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETsuperadmin-list">
                                <a href="#endpoints-GETsuperadmin-list">GET superadmin/list</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETsuperadmin-kyc-view--id---type-">
                                <a href="#endpoints-GETsuperadmin-kyc-view--id---type-">GET superadmin/kyc/view/{id}/{type}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTsuperadmin-kyc-change-status--id-">
                                <a href="#endpoints-POSTsuperadmin-kyc-change-status--id-">POST superadmin/kyc/change-status/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTsuperadmin-change-status--id-">
                                <a href="#endpoints-POSTsuperadmin-change-status--id-">POST superadmin/change-status/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEsuperadmin-delete--id-">
                                <a href="#endpoints-DELETEsuperadmin-delete--id-">DELETE superadmin/delete/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEsuperadmin-force-delete--id-">
                                <a href="#endpoints-DELETEsuperadmin-force-delete--id-">DELETE superadmin/force-delete/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTsuperadmin-restore--id-">
                                <a href="#endpoints-POSTsuperadmin-restore--id-">POST superadmin/restore/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PATCHsuperadmin-payout-requests--id--status">
                                <a href="#endpoints-PATCHsuperadmin-payout-requests--id--status">Update payout request status (Superadmin Action).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETsuperadmin-payouts">
                                <a href="#endpoints-GETsuperadmin-payouts">List payout requests.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETsuperadmin-category-requests">
                                <a href="#endpoints-GETsuperadmin-category-requests">GET superadmin/category-requests</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTsuperadmin-category-requests-approve--id-">
                                <a href="#endpoints-POSTsuperadmin-category-requests-approve--id-">POST superadmin/category-requests/approve/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTsuperadmin-category-requests-reject--id-">
                                <a href="#endpoints-POSTsuperadmin-category-requests-reject--id-">POST superadmin/category-requests/reject/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETsuperadmin-categories">
                                <a href="#endpoints-GETsuperadmin-categories">GET superadmin/categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTsuperadmin-categories">
                                <a href="#endpoints-POSTsuperadmin-categories">POST superadmin/categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETsuperadmin-categories--category_id-">
                                <a href="#endpoints-GETsuperadmin-categories--category_id-">GET superadmin/categories/{category_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTsuperadmin-categories--category_id-">
                                <a href="#endpoints-PUTsuperadmin-categories--category_id-">PUT superadmin/categories/{category_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEsuperadmin-categories--category_id-">
                                <a href="#endpoints-DELETEsuperadmin-categories--category_id-">DELETE superadmin/categories/{category_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTpayments-esewa-initiate">
                                <a href="#endpoints-POSTpayments-esewa-initiate">Initiate eSewa Payment for an unpaid order.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpayments-esewa-success">
                                <a href="#endpoints-GETpayments-esewa-success">Handle eSewa Redirect Callback on Payment Success.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpayments-esewa-failure">
                                <a href="#endpoints-GETpayments-esewa-failure">Handle eSewa Redirect Callback on Payment Failure/Cancellation.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: August 6, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETcustomer-categories">GET customer/categories</h2>

<p>
</p>



<span id="example-requests-GETcustomer-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-categories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Categories retrieved successfully.&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Men&#039;s Shoes&quot;,
                &quot;slug&quot;: &quot;mens-shoes&quot;,
                &quot;image&quot;: &quot;categories/mens_shoes.jpg&quot;,
                &quot;banner&quot;: &quot;categories/banners/mens_shoes_banner.jpg&quot;,
                &quot;icon&quot;: &quot;fa-shoe-prints&quot;,
                &quot;is_menu&quot;: true,
                &quot;is_active&quot;: true,
                &quot;is_featured&quot;: true,
                &quot;parent_id&quot;: 4,
                &quot;depth&quot;: 1,
                &quot;order_priority&quot;: 1,
                &quot;commission_rate&quot;: 12,
                &quot;meta_title&quot;: &quot;Men&#039;s Sneakers, Boots &amp; Formal Shoes&quot;,
                &quot;meta_description&quot;: &quot;Step up your style with athletic sneakers and formal shoes.&quot;,
                &quot;meta_keywords&quot;: &quot;shoes, sneakers, jordan, boots, footwear&quot;,
                &quot;attributes&quot;: &quot;[\&quot;Shoe Size\&quot;,\&quot;Outer Material\&quot;,\&quot;Sole Material\&quot;]&quot;,
                &quot;deleted_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-08-01T19:38:56.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-08-01T19:38:56.000000Z&quot;,
                &quot;parent&quot;: {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Fashion&quot;,
                    &quot;slug&quot;: &quot;fashion&quot;,
                    &quot;image&quot;: &quot;categories/fashion.jpg&quot;,
                    &quot;banner&quot;: &quot;categories/banners/fashion_banner.jpg&quot;,
                    &quot;icon&quot;: &quot;fa-shirt&quot;,
                    &quot;is_menu&quot;: true,
                    &quot;is_active&quot;: true,
                    &quot;is_featured&quot;: true,
                    &quot;parent_id&quot;: null,
                    &quot;depth&quot;: 0,
                    &quot;order_priority&quot;: 2,
                    &quot;commission_rate&quot;: 15,
                    &quot;meta_title&quot;: &quot;Fashion &amp; Lifestyle Products&quot;,
                    &quot;meta_description&quot;: &quot;Trending shoes, clothing, and stylish accessories.&quot;,
                    &quot;meta_keywords&quot;: &quot;clothing, footwear, shoes, fashion, apparel&quot;,
                    &quot;attributes&quot;: &quot;[\&quot;Size\&quot;,\&quot;Color\&quot;,\&quot;Material\&quot;,\&quot;Gender\&quot;]&quot;,
                    &quot;deleted_at&quot;: null,
                    &quot;created_at&quot;: &quot;2026-08-01T19:38:55.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-08-01T19:38:55.000000Z&quot;
                },
                &quot;children&quot;: []
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Computers &amp; Laptops&quot;,
                &quot;slug&quot;: &quot;computers-laptops&quot;,
                &quot;image&quot;: &quot;categories/computers.jpg&quot;,
                &quot;banner&quot;: &quot;categories/banners/computers_banner.jpg&quot;,
                &quot;icon&quot;: &quot;fa-desktop&quot;,
                &quot;is_menu&quot;: true,
                &quot;is_active&quot;: true,
                &quot;is_featured&quot;: true,
                &quot;parent_id&quot;: 1,
                &quot;depth&quot;: 1,
                &quot;order_priority&quot;: 1,
                &quot;commission_rate&quot;: 8,
                &quot;meta_title&quot;: &quot;Computers &amp; Laptops | Professional Workstations&quot;,
                &quot;meta_description&quot;: &quot;Find ultrabooks, MacBooks, and business PCs.&quot;,
                &quot;meta_keywords&quot;: &quot;laptop, pc, macbook, desktop, workstation&quot;,
                &quot;attributes&quot;: &quot;[\&quot;RAM\&quot;,\&quot;Storage\&quot;,\&quot;Processor\&quot;,\&quot;Display Size\&quot;]&quot;,
                &quot;deleted_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-08-01T19:38:54.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-08-01T19:38:54.000000Z&quot;,
                &quot;parent&quot;: {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Electronics&quot;,
                    &quot;slug&quot;: &quot;electronics&quot;,
                    &quot;image&quot;: &quot;categories/electronics.jpg&quot;,
                    &quot;banner&quot;: &quot;categories/banners/electronics_banner.jpg&quot;,
                    &quot;icon&quot;: &quot;fa-laptop&quot;,
                    &quot;is_menu&quot;: true,
                    &quot;is_active&quot;: true,
                    &quot;is_featured&quot;: true,
                    &quot;parent_id&quot;: null,
                    &quot;depth&quot;: 0,
                    &quot;order_priority&quot;: 1,
                    &quot;commission_rate&quot;: 10,
                    &quot;meta_title&quot;: &quot;Buy Electronics Online | Laptops, Monitors &amp; Tech&quot;,
                    &quot;meta_description&quot;: &quot;Explore tech products from leading global brands with warranty.&quot;,
                    &quot;meta_keywords&quot;: &quot;tech, electronics, monitors, laptops, gadgets&quot;,
                    &quot;attributes&quot;: &quot;[\&quot;Brand\&quot;,\&quot;Warranty Period\&quot;,\&quot;Power Consumption\&quot;]&quot;,
                    &quot;deleted_at&quot;: null,
                    &quot;created_at&quot;: &quot;2026-08-01T19:38:53.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-08-01T19:38:53.000000Z&quot;
                },
                &quot;children&quot;: [
                    {
                        &quot;id&quot;: 3,
                        &quot;name&quot;: &quot;Gaming Laptops&quot;,
                        &quot;slug&quot;: &quot;gaming-laptops&quot;,
                        &quot;image&quot;: &quot;categories/gaming_laptops.jpg&quot;,
                        &quot;banner&quot;: &quot;categories/banners/gaming_laptops_banner.jpg&quot;,
                        &quot;icon&quot;: &quot;fa-gamepad&quot;,
                        &quot;is_menu&quot;: false,
                        &quot;is_active&quot;: true,
                        &quot;is_featured&quot;: true,
                        &quot;parent_id&quot;: 2,
                        &quot;depth&quot;: 2,
                        &quot;order_priority&quot;: 1,
                        &quot;commission_rate&quot;: 12,
                        &quot;meta_title&quot;: &quot;High-End Gaming Laptops | RTX Graphics PCs&quot;,
                        &quot;meta_description&quot;: &quot;Powerful gaming laptops featuring high refresh rate displays.&quot;,
                        &quot;meta_keywords&quot;: &quot;gaming, rtx, rog, alienware, gaming-laptop&quot;,
                        &quot;attributes&quot;: &quot;[\&quot;GPU\&quot;,\&quot;Screen Refresh Rate\&quot;,\&quot;Cooling Tech\&quot;]&quot;,
                        &quot;deleted_at&quot;: null,
                        &quot;created_at&quot;: &quot;2026-08-01T19:38:54.000000Z&quot;,
                        &quot;updated_at&quot;: &quot;2026-08-01T19:38:54.000000Z&quot;
                    }
                ]
            },
            {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Gaming Laptops&quot;,
                &quot;slug&quot;: &quot;gaming-laptops&quot;,
                &quot;image&quot;: &quot;categories/gaming_laptops.jpg&quot;,
                &quot;banner&quot;: &quot;categories/banners/gaming_laptops_banner.jpg&quot;,
                &quot;icon&quot;: &quot;fa-gamepad&quot;,
                &quot;is_menu&quot;: false,
                &quot;is_active&quot;: true,
                &quot;is_featured&quot;: true,
                &quot;parent_id&quot;: 2,
                &quot;depth&quot;: 2,
                &quot;order_priority&quot;: 1,
                &quot;commission_rate&quot;: 12,
                &quot;meta_title&quot;: &quot;High-End Gaming Laptops | RTX Graphics PCs&quot;,
                &quot;meta_description&quot;: &quot;Powerful gaming laptops featuring high refresh rate displays.&quot;,
                &quot;meta_keywords&quot;: &quot;gaming, rtx, rog, alienware, gaming-laptop&quot;,
                &quot;attributes&quot;: &quot;[\&quot;GPU\&quot;,\&quot;Screen Refresh Rate\&quot;,\&quot;Cooling Tech\&quot;]&quot;,
                &quot;deleted_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-08-01T19:38:54.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-08-01T19:38:54.000000Z&quot;,
                &quot;parent&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Computers &amp; Laptops&quot;,
                    &quot;slug&quot;: &quot;computers-laptops&quot;,
                    &quot;image&quot;: &quot;categories/computers.jpg&quot;,
                    &quot;banner&quot;: &quot;categories/banners/computers_banner.jpg&quot;,
                    &quot;icon&quot;: &quot;fa-desktop&quot;,
                    &quot;is_menu&quot;: true,
                    &quot;is_active&quot;: true,
                    &quot;is_featured&quot;: true,
                    &quot;parent_id&quot;: 1,
                    &quot;depth&quot;: 1,
                    &quot;order_priority&quot;: 1,
                    &quot;commission_rate&quot;: 8,
                    &quot;meta_title&quot;: &quot;Computers &amp; Laptops | Professional Workstations&quot;,
                    &quot;meta_description&quot;: &quot;Find ultrabooks, MacBooks, and business PCs.&quot;,
                    &quot;meta_keywords&quot;: &quot;laptop, pc, macbook, desktop, workstation&quot;,
                    &quot;attributes&quot;: &quot;[\&quot;RAM\&quot;,\&quot;Storage\&quot;,\&quot;Processor\&quot;,\&quot;Display Size\&quot;]&quot;,
                    &quot;deleted_at&quot;: null,
                    &quot;created_at&quot;: &quot;2026-08-01T19:38:54.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-08-01T19:38:54.000000Z&quot;
                },
                &quot;children&quot;: []
            },
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Electronics&quot;,
                &quot;slug&quot;: &quot;electronics&quot;,
                &quot;image&quot;: &quot;categories/electronics.jpg&quot;,
                &quot;banner&quot;: &quot;categories/banners/electronics_banner.jpg&quot;,
                &quot;icon&quot;: &quot;fa-laptop&quot;,
                &quot;is_menu&quot;: true,
                &quot;is_active&quot;: true,
                &quot;is_featured&quot;: true,
                &quot;parent_id&quot;: null,
                &quot;depth&quot;: 0,
                &quot;order_priority&quot;: 1,
                &quot;commission_rate&quot;: 10,
                &quot;meta_title&quot;: &quot;Buy Electronics Online | Laptops, Monitors &amp; Tech&quot;,
                &quot;meta_description&quot;: &quot;Explore tech products from leading global brands with warranty.&quot;,
                &quot;meta_keywords&quot;: &quot;tech, electronics, monitors, laptops, gadgets&quot;,
                &quot;attributes&quot;: &quot;[\&quot;Brand\&quot;,\&quot;Warranty Period\&quot;,\&quot;Power Consumption\&quot;]&quot;,
                &quot;deleted_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-08-01T19:38:53.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-08-01T19:38:53.000000Z&quot;,
                &quot;parent&quot;: null,
                &quot;children&quot;: [
                    {
                        &quot;id&quot;: 2,
                        &quot;name&quot;: &quot;Computers &amp; Laptops&quot;,
                        &quot;slug&quot;: &quot;computers-laptops&quot;,
                        &quot;image&quot;: &quot;categories/computers.jpg&quot;,
                        &quot;banner&quot;: &quot;categories/banners/computers_banner.jpg&quot;,
                        &quot;icon&quot;: &quot;fa-desktop&quot;,
                        &quot;is_menu&quot;: true,
                        &quot;is_active&quot;: true,
                        &quot;is_featured&quot;: true,
                        &quot;parent_id&quot;: 1,
                        &quot;depth&quot;: 1,
                        &quot;order_priority&quot;: 1,
                        &quot;commission_rate&quot;: 8,
                        &quot;meta_title&quot;: &quot;Computers &amp; Laptops | Professional Workstations&quot;,
                        &quot;meta_description&quot;: &quot;Find ultrabooks, MacBooks, and business PCs.&quot;,
                        &quot;meta_keywords&quot;: &quot;laptop, pc, macbook, desktop, workstation&quot;,
                        &quot;attributes&quot;: &quot;[\&quot;RAM\&quot;,\&quot;Storage\&quot;,\&quot;Processor\&quot;,\&quot;Display Size\&quot;]&quot;,
                        &quot;deleted_at&quot;: null,
                        &quot;created_at&quot;: &quot;2026-08-01T19:38:54.000000Z&quot;,
                        &quot;updated_at&quot;: &quot;2026-08-01T19:38:54.000000Z&quot;
                    }
                ]
            },
            {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Fashion&quot;,
                &quot;slug&quot;: &quot;fashion&quot;,
                &quot;image&quot;: &quot;categories/fashion.jpg&quot;,
                &quot;banner&quot;: &quot;categories/banners/fashion_banner.jpg&quot;,
                &quot;icon&quot;: &quot;fa-shirt&quot;,
                &quot;is_menu&quot;: true,
                &quot;is_active&quot;: true,
                &quot;is_featured&quot;: true,
                &quot;parent_id&quot;: null,
                &quot;depth&quot;: 0,
                &quot;order_priority&quot;: 2,
                &quot;commission_rate&quot;: 15,
                &quot;meta_title&quot;: &quot;Fashion &amp; Lifestyle Products&quot;,
                &quot;meta_description&quot;: &quot;Trending shoes, clothing, and stylish accessories.&quot;,
                &quot;meta_keywords&quot;: &quot;clothing, footwear, shoes, fashion, apparel&quot;,
                &quot;attributes&quot;: &quot;[\&quot;Size\&quot;,\&quot;Color\&quot;,\&quot;Material\&quot;,\&quot;Gender\&quot;]&quot;,
                &quot;deleted_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-08-01T19:38:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-08-01T19:38:55.000000Z&quot;,
                &quot;parent&quot;: null,
                &quot;children&quot;: [
                    {
                        &quot;id&quot;: 5,
                        &quot;name&quot;: &quot;Men&#039;s Shoes&quot;,
                        &quot;slug&quot;: &quot;mens-shoes&quot;,
                        &quot;image&quot;: &quot;categories/mens_shoes.jpg&quot;,
                        &quot;banner&quot;: &quot;categories/banners/mens_shoes_banner.jpg&quot;,
                        &quot;icon&quot;: &quot;fa-shoe-prints&quot;,
                        &quot;is_menu&quot;: true,
                        &quot;is_active&quot;: true,
                        &quot;is_featured&quot;: true,
                        &quot;parent_id&quot;: 4,
                        &quot;depth&quot;: 1,
                        &quot;order_priority&quot;: 1,
                        &quot;commission_rate&quot;: 12,
                        &quot;meta_title&quot;: &quot;Men&#039;s Sneakers, Boots &amp; Formal Shoes&quot;,
                        &quot;meta_description&quot;: &quot;Step up your style with athletic sneakers and formal shoes.&quot;,
                        &quot;meta_keywords&quot;: &quot;shoes, sneakers, jordan, boots, footwear&quot;,
                        &quot;attributes&quot;: &quot;[\&quot;Shoe Size\&quot;,\&quot;Outer Material\&quot;,\&quot;Sole Material\&quot;]&quot;,
                        &quot;deleted_at&quot;: null,
                        &quot;created_at&quot;: &quot;2026-08-01T19:38:56.000000Z&quot;,
                        &quot;updated_at&quot;: &quot;2026-08-01T19:38:56.000000Z&quot;
                    }
                ]
            },
            {
                &quot;id&quot;: 6,
                &quot;name&quot;: &quot;Digital Services&quot;,
                &quot;slug&quot;: &quot;digital-services&quot;,
                &quot;image&quot;: &quot;categories/services.jpg&quot;,
                &quot;banner&quot;: null,
                &quot;icon&quot;: &quot;fa-globe&quot;,
                &quot;is_menu&quot;: true,
                &quot;is_active&quot;: true,
                &quot;is_featured&quot;: false,
                &quot;parent_id&quot;: null,
                &quot;depth&quot;: 0,
                &quot;order_priority&quot;: 3,
                &quot;commission_rate&quot;: 20,
                &quot;meta_title&quot;: &quot;Professional Digital &amp; IT Services&quot;,
                &quot;meta_description&quot;: &quot;Web development, consultations, and digital strategy.&quot;,
                &quot;meta_keywords&quot;: &quot;seo, web design, consultation, development&quot;,
                &quot;attributes&quot;: &quot;[\&quot;Delivery Time\&quot;,\&quot;Revision Limit\&quot;,\&quot;Service Type\&quot;]&quot;,
                &quot;deleted_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-08-01T19:38:56.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-08-01T19:38:56.000000Z&quot;,
                &quot;parent&quot;: null,
                &quot;children&quot;: []
            }
        ],
        &quot;first_page_url&quot;: &quot;http://localhost/customer/categories?page=1&quot;,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;last_page_url&quot;: &quot;http://localhost/customer/categories?page=1&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/customer/categories?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: null,
        &quot;path&quot;: &quot;http://localhost/customer/categories&quot;,
        &quot;per_page&quot;: 15,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: 6,
        &quot;total&quot;: 6
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-categories" data-method="GET"
      data-path="customer/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-categories"
                    onclick="tryItOut('GETcustomer-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-categories"
                    onclick="cancelTryOut('GETcustomer-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTcustomer-register">POST customer/register</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"email\": \"kunde.eloisa@example.com\",
    \"password\": \"4[*UyPJ\\\"}6\",
    \"phone\": \"hdtqtqxbajwbpilpm\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "email": "kunde.eloisa@example.com",
    "password": "4[*UyPJ\"}6",
    "phone": "hdtqtqxbajwbpilpm"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-register">
</span>
<span id="execution-results-POSTcustomer-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-register" data-method="POST"
      data-path="customer/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-register"
                    onclick="tryItOut('POSTcustomer-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-register"
                    onclick="cancelTryOut('POSTcustomer-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTcustomer-register"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTcustomer-register"
               value="kunde.eloisa@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>kunde.eloisa@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTcustomer-register"
               value="4[*UyPJ"}6"
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>4[*UyPJ"}6</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTcustomer-register"
               value="hdtqtqxbajwbpilpm"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>hdtqtqxbajwbpilpm</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTcustomer-login">POST customer/login</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"login\": \"consequatur\",
    \"password\": \"[2UZ5ij-e\\/dl4\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "login": "consequatur",
    "password": "[2UZ5ij-e\/dl4"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-login">
</span>
<span id="execution-results-POSTcustomer-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-login" data-method="POST"
      data-path="customer/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-login"
                    onclick="tryItOut('POSTcustomer-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-login"
                    onclick="cancelTryOut('POSTcustomer-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>login</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="login"                data-endpoint="POSTcustomer-login"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTcustomer-login"
               value="[2UZ5ij-e/dl4"
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>[2UZ5ij-e/dl4</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTcustomer-forgot-password">POST customer/forgot-password</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-forgot-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/forgot-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"qkunze@example.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/forgot-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "qkunze@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-forgot-password">
</span>
<span id="execution-results-POSTcustomer-forgot-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-forgot-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-forgot-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-forgot-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-forgot-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-forgot-password" data-method="POST"
      data-path="customer/forgot-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-forgot-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-forgot-password"
                    onclick="tryItOut('POSTcustomer-forgot-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-forgot-password"
                    onclick="cancelTryOut('POSTcustomer-forgot-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-forgot-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/forgot-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTcustomer-forgot-password"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must match an existing stored value. Example: <code>qkunze@example.com</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTcustomer-reset-password">POST customer/reset-password</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-reset-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/reset-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"qkunze@example.com\",
    \"token\": \"consequatur\",
    \"password\": \"[2UZ5ij-e\\/dl4\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/reset-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "qkunze@example.com",
    "token": "consequatur",
    "password": "[2UZ5ij-e\/dl4"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-reset-password">
</span>
<span id="execution-results-POSTcustomer-reset-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-reset-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-reset-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-reset-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-reset-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-reset-password" data-method="POST"
      data-path="customer/reset-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-reset-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-reset-password"
                    onclick="tryItOut('POSTcustomer-reset-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-reset-password"
                    onclick="cancelTryOut('POSTcustomer-reset-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-reset-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/reset-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTcustomer-reset-password"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must match an existing stored value. Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTcustomer-reset-password"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTcustomer-reset-password"
               value="[2UZ5ij-e/dl4"
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>[2UZ5ij-e/dl4</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETcustomer-shops--slug-">Get single shop profile details and active shop products.</h2>

<p>
</p>

<p>Route: GET /api/v1/shops/{slug}</p>

<span id="example-requests-GETcustomer-shops--slug-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/shops/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/shops/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-shops--slug-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Shop].&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-shops--slug-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-shops--slug-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-shops--slug-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-shops--slug-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-shops--slug-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-shops--slug-" data-method="GET"
      data-path="customer/shops/{slug}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-shops--slug-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-shops--slug-"
                    onclick="tryItOut('GETcustomer-shops--slug-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-shops--slug-"
                    onclick="cancelTryOut('GETcustomer-shops--slug-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-shops--slug-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/shops/{slug}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-shops--slug-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-shops--slug-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="GETcustomer-shops--slug-"
               value="consequatur"
               data-component="url">
    <br>
<p>The slug of the shop. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETcustomer-marketplace-products">Global product discovery feed using model relationships &amp; custom scopes.</h2>

<p>
</p>

<p>Route: GET /api/v1/marketplace/products</p>

<span id="example-requests-GETcustomer-marketplace-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/marketplace/products" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/marketplace/products"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-marketplace-products">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 5,
                &quot;product_id&quot;: 5,
                &quot;shop_id&quot;: 3,
                &quot;price&quot;: &quot;5000.00&quot;,
                &quot;sale_price&quot;: null,
                &quot;stock&quot;: 999,
                &quot;min_order&quot;: 1,
                &quot;max_order&quot;: 10,
                &quot;local_image&quot;: null,
                &quot;last_stock_update&quot;: &quot;2026-08-01T19:39:16.000000Z&quot;,
                &quot;is_available&quot;: true,
                &quot;sale_start&quot;: null,
                &quot;sale_end&quot;: null,
                &quot;deleted_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-08-01T19:39:17.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-08-01T19:39:17.000000Z&quot;,
                &quot;effective_price&quot;: 5000,
                &quot;product&quot;: {
                    &quot;id&quot;: 5,
                    &quot;category_id&quot;: 6,
                    &quot;brand_id&quot;: null,
                    &quot;name&quot;: &quot;Full Stack Web Architecture Consultation&quot;,
                    &quot;slug&quot;: &quot;web-dev-consultation&quot;,
                    &quot;catalog_image&quot;: &quot;products/web_consultation.jpg&quot;,
                    &quot;category&quot;: {
                        &quot;id&quot;: 6,
                        &quot;name&quot;: &quot;Digital Services&quot;,
                        &quot;slug&quot;: &quot;digital-services&quot;
                    },
                    &quot;brand&quot;: null
                },
                &quot;shop&quot;: {
                    &quot;id&quot;: 3,
                    &quot;shop_name&quot;: &quot;Sarah&#039;s Boutique&quot;,
                    &quot;slug&quot;: &quot;sarahs-boutique&quot;,
                    &quot;logo&quot;: &quot;shops/logos/sarahs_boutique.png&quot;,
                    &quot;rating&quot;: 4.95,
                    &quot;address&quot;: &quot;Lazimpat Rd, Near Standard Chartered, Kathmandu&quot;,
                    &quot;latitude&quot;: &quot;27.72150000&quot;,
                    &quot;longitude&quot;: &quot;85.32100000&quot;,
                    &quot;is_open&quot;: true
                }
            },
            {
                &quot;id&quot;: 4,
                &quot;product_id&quot;: 4,
                &quot;shop_id&quot;: 3,
                &quot;price&quot;: &quot;1500.00&quot;,
                &quot;sale_price&quot;: &quot;1200.00&quot;,
                &quot;stock&quot;: 250,
                &quot;min_order&quot;: 5,
                &quot;max_order&quot;: 50,
                &quot;local_image&quot;: null,
                &quot;last_stock_update&quot;: &quot;2026-08-01T19:39:15.000000Z&quot;,
                &quot;is_available&quot;: true,
                &quot;sale_start&quot;: null,
                &quot;sale_end&quot;: null,
                &quot;deleted_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-08-01T19:39:16.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-08-01T19:39:16.000000Z&quot;,
                &quot;effective_price&quot;: 1200,
                &quot;product&quot;: {
                    &quot;id&quot;: 4,
                    &quot;category_id&quot;: 4,
                    &quot;brand_id&quot;: null,
                    &quot;name&quot;: &quot;Heavyweight Organic Cotton T-Shirt&quot;,
                    &quot;slug&quot;: &quot;generic-cotton-tshirt&quot;,
                    &quot;catalog_image&quot;: &quot;products/cotton_tshirt.jpg&quot;,
                    &quot;category&quot;: {
                        &quot;id&quot;: 4,
                        &quot;name&quot;: &quot;Fashion&quot;,
                        &quot;slug&quot;: &quot;fashion&quot;
                    },
                    &quot;brand&quot;: null
                },
                &quot;shop&quot;: {
                    &quot;id&quot;: 3,
                    &quot;shop_name&quot;: &quot;Sarah&#039;s Boutique&quot;,
                    &quot;slug&quot;: &quot;sarahs-boutique&quot;,
                    &quot;logo&quot;: &quot;shops/logos/sarahs_boutique.png&quot;,
                    &quot;rating&quot;: 4.95,
                    &quot;address&quot;: &quot;Lazimpat Rd, Near Standard Chartered, Kathmandu&quot;,
                    &quot;latitude&quot;: &quot;27.72150000&quot;,
                    &quot;longitude&quot;: &quot;85.32100000&quot;,
                    &quot;is_open&quot;: true
                }
            },
            {
                &quot;id&quot;: 2,
                &quot;product_id&quot;: 3,
                &quot;shop_id&quot;: 3,
                &quot;price&quot;: &quot;22000.00&quot;,
                &quot;sale_price&quot;: &quot;17500.00&quot;,
                &quot;stock&quot;: 25,
                &quot;min_order&quot;: 1,
                &quot;max_order&quot;: 5,
                &quot;local_image&quot;: &quot;shops/boutique/jordan_promo.jpg&quot;,
                &quot;last_stock_update&quot;: &quot;2026-08-01T19:39:14.000000Z&quot;,
                &quot;is_available&quot;: true,
                &quot;sale_start&quot;: &quot;2026-07-30T19:39:14.000000Z&quot;,
                &quot;sale_end&quot;: &quot;2026-08-06T19:39:14.000000Z&quot;,
                &quot;deleted_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-08-01T19:39:14.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-08-01T19:39:14.000000Z&quot;,
                &quot;effective_price&quot;: 17500,
                &quot;product&quot;: {
                    &quot;id&quot;: 3,
                    &quot;category_id&quot;: 5,
                    &quot;brand_id&quot;: 3,
                    &quot;name&quot;: &quot;Nike Air Jordan 1 Low OG&quot;,
                    &quot;slug&quot;: &quot;nike-air-jordan-1-low&quot;,
                    &quot;catalog_image&quot;: &quot;products/nike_jordan_1.jpg&quot;,
                    &quot;category&quot;: {
                        &quot;id&quot;: 5,
                        &quot;name&quot;: &quot;Men&#039;s Shoes&quot;,
                        &quot;slug&quot;: &quot;mens-shoes&quot;
                    },
                    &quot;brand&quot;: {
                        &quot;id&quot;: 3,
                        &quot;name&quot;: &quot;Nike&quot;,
                        &quot;slug&quot;: &quot;nike&quot;,
                        &quot;logo&quot;: &quot;brands/logos/nike.png&quot;
                    }
                },
                &quot;shop&quot;: {
                    &quot;id&quot;: 3,
                    &quot;shop_name&quot;: &quot;Sarah&#039;s Boutique&quot;,
                    &quot;slug&quot;: &quot;sarahs-boutique&quot;,
                    &quot;logo&quot;: &quot;shops/logos/sarahs_boutique.png&quot;,
                    &quot;rating&quot;: 4.95,
                    &quot;address&quot;: &quot;Lazimpat Rd, Near Standard Chartered, Kathmandu&quot;,
                    &quot;latitude&quot;: &quot;27.72150000&quot;,
                    &quot;longitude&quot;: &quot;85.32100000&quot;,
                    &quot;is_open&quot;: true
                }
            },
            {
                &quot;id&quot;: 1,
                &quot;product_id&quot;: 1,
                &quot;shop_id&quot;: 1,
                &quot;price&quot;: &quot;185000.00&quot;,
                &quot;sale_price&quot;: null,
                &quot;stock&quot;: 8,
                &quot;min_order&quot;: 1,
                &quot;max_order&quot;: 2,
                &quot;local_image&quot;: null,
                &quot;last_stock_update&quot;: &quot;2026-08-01T19:39:13.000000Z&quot;,
                &quot;is_available&quot;: true,
                &quot;sale_start&quot;: null,
                &quot;sale_end&quot;: null,
                &quot;deleted_at&quot;: null,
                &quot;created_at&quot;: &quot;2026-08-01T19:39:14.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-08-01T19:39:14.000000Z&quot;,
                &quot;effective_price&quot;: 185000,
                &quot;product&quot;: {
                    &quot;id&quot;: 1,
                    &quot;category_id&quot;: 3,
                    &quot;brand_id&quot;: 1,
                    &quot;name&quot;: &quot;Samsung Odyssey G9 49\&quot; Curved Gaming Monitor&quot;,
                    &quot;slug&quot;: &quot;samsung-odyssey-g9-49&quot;,
                    &quot;catalog_image&quot;: &quot;products/samsung_odyssey_g9.jpg&quot;,
                    &quot;category&quot;: {
                        &quot;id&quot;: 3,
                        &quot;name&quot;: &quot;Gaming Laptops&quot;,
                        &quot;slug&quot;: &quot;gaming-laptops&quot;
                    },
                    &quot;brand&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Samsung&quot;,
                        &quot;slug&quot;: &quot;samsung&quot;,
                        &quot;logo&quot;: &quot;brands/logos/samsung.png&quot;
                    }
                },
                &quot;shop&quot;: {
                    &quot;id&quot;: 1,
                    &quot;shop_name&quot;: &quot;Johns Tech World&quot;,
                    &quot;slug&quot;: &quot;johns-tech-world&quot;,
                    &quot;logo&quot;: &quot;shops/logos/johns_tech.png&quot;,
                    &quot;rating&quot;: 4.85,
                    &quot;address&quot;: &quot;New Road Plaza, 2nd Floor, Kathmandu&quot;,
                    &quot;latitude&quot;: &quot;27.70070000&quot;,
                    &quot;longitude&quot;: &quot;85.31230000&quot;,
                    &quot;is_open&quot;: true
                }
            }
        ],
        &quot;first_page_url&quot;: &quot;http://localhost/customer/marketplace/products?page=1&quot;,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;last_page_url&quot;: &quot;http://localhost/customer/marketplace/products?page=1&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/customer/marketplace/products?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: null,
        &quot;path&quot;: &quot;http://localhost/customer/marketplace/products&quot;,
        &quot;per_page&quot;: 20,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: 4,
        &quot;total&quot;: 4
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-marketplace-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-marketplace-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-marketplace-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-marketplace-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-marketplace-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-marketplace-products" data-method="GET"
      data-path="customer/marketplace/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-marketplace-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-marketplace-products"
                    onclick="tryItOut('GETcustomer-marketplace-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-marketplace-products"
                    onclick="cancelTryOut('GETcustomer-marketplace-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-marketplace-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/marketplace/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-marketplace-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-marketplace-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTcustomer-logout">POST customer/logout</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-logout">
</span>
<span id="execution-results-POSTcustomer-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-logout" data-method="POST"
      data-path="customer/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-logout"
                    onclick="tryItOut('POSTcustomer-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-logout"
                    onclick="cancelTryOut('POSTcustomer-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETcustomer-profile">GET customer/profile</h2>

<p>
</p>



<span id="example-requests-GETcustomer-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-profile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-profile" data-method="GET"
      data-path="customer/profile"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-profile"
                    onclick="tryItOut('GETcustomer-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-profile"
                    onclick="cancelTryOut('GETcustomer-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTcustomer-profile">POST customer/profile</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/profile" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "name=vmqeopfuudtdsufvyvddq"\
    --form "phone=amniihfqcoynlazgh"\
    --form "city=dtqtqxbajwbpilpmufinl"\
    --form "address=lwloauydlsmsjuryvojcy"\
    --form "avatar=@C:\Users\Lenovo\AppData\Local\Temp\php9E6B.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/profile"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'vmqeopfuudtdsufvyvddq');
body.append('phone', 'amniihfqcoynlazgh');
body.append('city', 'dtqtqxbajwbpilpmufinl');
body.append('address', 'lwloauydlsmsjuryvojcy');
body.append('avatar', document.querySelector('input[name="avatar"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-profile">
</span>
<span id="execution-results-POSTcustomer-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-profile" data-method="POST"
      data-path="customer/profile"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-profile"
                    onclick="tryItOut('POSTcustomer-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-profile"
                    onclick="cancelTryOut('POSTcustomer-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-profile"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTcustomer-profile"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTcustomer-profile"
               value="amniihfqcoynlazgh"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>amniihfqcoynlazgh</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTcustomer-profile"
               value="dtqtqxbajwbpilpmufinl"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>dtqtqxbajwbpilpmufinl</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTcustomer-profile"
               value="lwloauydlsmsjuryvojcy"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>lwloauydlsmsjuryvojcy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>avatar</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="avatar"                data-endpoint="POSTcustomer-profile"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\Lenovo\AppData\Local\Temp\php9E6B.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTcustomer-deactivate">POST customer/deactivate</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-deactivate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/deactivate" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/deactivate"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-deactivate">
</span>
<span id="execution-results-POSTcustomer-deactivate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-deactivate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-deactivate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-deactivate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-deactivate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-deactivate" data-method="POST"
      data-path="customer/deactivate"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-deactivate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-deactivate"
                    onclick="tryItOut('POSTcustomer-deactivate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-deactivate"
                    onclick="cancelTryOut('POSTcustomer-deactivate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-deactivate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/deactivate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-deactivate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-deactivate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETcustomer-dashboard">Get aggregate profile statistics and recent activity for the customer.</h2>

<p>
</p>

<p>Route: GET /api/v1/customer/dashboard</p>

<span id="example-requests-GETcustomer-dashboard">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/dashboard" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/dashboard"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-dashboard">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-dashboard" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-dashboard"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-dashboard"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-dashboard" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-dashboard">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-dashboard" data-method="GET"
      data-path="customer/dashboard"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-dashboard', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-dashboard"
                    onclick="tryItOut('GETcustomer-dashboard');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-dashboard"
                    onclick="cancelTryOut('GETcustomer-dashboard');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-dashboard"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/dashboard</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETcustomer-dashboard-orders-history">Get paginated customer order history with filters.</h2>

<p>
</p>

<p>Route: GET /api/v1/customer/orders</p>

<span id="example-requests-GETcustomer-dashboard-orders-history">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/dashboard/orders-history" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/dashboard/orders-history"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-dashboard-orders-history">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-dashboard-orders-history" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-dashboard-orders-history"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-dashboard-orders-history"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-dashboard-orders-history" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-dashboard-orders-history">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-dashboard-orders-history" data-method="GET"
      data-path="customer/dashboard/orders-history"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-dashboard-orders-history', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-dashboard-orders-history"
                    onclick="tryItOut('GETcustomer-dashboard-orders-history');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-dashboard-orders-history"
                    onclick="cancelTryOut('GETcustomer-dashboard-orders-history');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-dashboard-orders-history"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/dashboard/orders-history</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-dashboard-orders-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-dashboard-orders-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETcustomer-dashboard-orders-details--orderNumber-">Get single order details for tracking and invoice view.</h2>

<p>
</p>

<p>Route: GET /api/v1/customer/orders/{order_number}</p>

<span id="example-requests-GETcustomer-dashboard-orders-details--orderNumber-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/dashboard/orders-details/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/dashboard/orders-details/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-dashboard-orders-details--orderNumber-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-dashboard-orders-details--orderNumber-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-dashboard-orders-details--orderNumber-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-dashboard-orders-details--orderNumber-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-dashboard-orders-details--orderNumber-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-dashboard-orders-details--orderNumber-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-dashboard-orders-details--orderNumber-" data-method="GET"
      data-path="customer/dashboard/orders-details/{orderNumber}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-dashboard-orders-details--orderNumber-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-dashboard-orders-details--orderNumber-"
                    onclick="tryItOut('GETcustomer-dashboard-orders-details--orderNumber-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-dashboard-orders-details--orderNumber-"
                    onclick="cancelTryOut('GETcustomer-dashboard-orders-details--orderNumber-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-dashboard-orders-details--orderNumber-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/dashboard/orders-details/{orderNumber}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-dashboard-orders-details--orderNumber-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-dashboard-orders-details--orderNumber-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>orderNumber</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="orderNumber"                data-endpoint="GETcustomer-dashboard-orders-details--orderNumber-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETcustomer-addresses">GET customer/addresses</h2>

<p>
</p>



<span id="example-requests-GETcustomer-addresses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/addresses" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/addresses"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-addresses">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-addresses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-addresses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-addresses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-addresses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-addresses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-addresses" data-method="GET"
      data-path="customer/addresses"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-addresses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-addresses"
                    onclick="tryItOut('GETcustomer-addresses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-addresses"
                    onclick="cancelTryOut('GETcustomer-addresses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-addresses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/addresses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTcustomer-addresses">POST customer/addresses</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-addresses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/addresses" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"full_name\": \"vmqeopfuudtdsufvyvddq\",
    \"phone\": \"amniihfqcoynlazgh\",
    \"address_line_1\": \"dtqtqxbajwbpilpmufinl\",
    \"address_line_2\": \"lwloauydlsmsjuryvojcy\",
    \"city\": \"bzvrbyickznkygloigmkw\",
    \"state\": \"xphlvazjrcnfbaqywuxhg\",
    \"postal_code\": \"jjmzuxjubqouzswiw\",
    \"country\": \"xtrkimfcatbxspzmrazsr\",
    \"is_default\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/addresses"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "full_name": "vmqeopfuudtdsufvyvddq",
    "phone": "amniihfqcoynlazgh",
    "address_line_1": "dtqtqxbajwbpilpmufinl",
    "address_line_2": "lwloauydlsmsjuryvojcy",
    "city": "bzvrbyickznkygloigmkw",
    "state": "xphlvazjrcnfbaqywuxhg",
    "postal_code": "jjmzuxjubqouzswiw",
    "country": "xtrkimfcatbxspzmrazsr",
    "is_default": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-addresses">
</span>
<span id="execution-results-POSTcustomer-addresses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-addresses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-addresses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-addresses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-addresses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-addresses" data-method="POST"
      data-path="customer/addresses"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-addresses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-addresses"
                    onclick="tryItOut('POSTcustomer-addresses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-addresses"
                    onclick="cancelTryOut('POSTcustomer-addresses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-addresses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/addresses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>full_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="full_name"                data-endpoint="POSTcustomer-addresses"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTcustomer-addresses"
               value="amniihfqcoynlazgh"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>amniihfqcoynlazgh</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address_line_1</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address_line_1"                data-endpoint="POSTcustomer-addresses"
               value="dtqtqxbajwbpilpmufinl"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>dtqtqxbajwbpilpmufinl</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address_line_2</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address_line_2"                data-endpoint="POSTcustomer-addresses"
               value="lwloauydlsmsjuryvojcy"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>lwloauydlsmsjuryvojcy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTcustomer-addresses"
               value="bzvrbyickznkygloigmkw"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>bzvrbyickznkygloigmkw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>state</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="state"                data-endpoint="POSTcustomer-addresses"
               value="xphlvazjrcnfbaqywuxhg"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>xphlvazjrcnfbaqywuxhg</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>postal_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="postal_code"                data-endpoint="POSTcustomer-addresses"
               value="jjmzuxjubqouzswiw"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>jjmzuxjubqouzswiw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="country"                data-endpoint="POSTcustomer-addresses"
               value="xtrkimfcatbxspzmrazsr"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>xtrkimfcatbxspzmrazsr</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_default</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTcustomer-addresses" style="display: none">
            <input type="radio" name="is_default"
                   value="true"
                   data-endpoint="POSTcustomer-addresses"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTcustomer-addresses" style="display: none">
            <input type="radio" name="is_default"
                   value="false"
                   data-endpoint="POSTcustomer-addresses"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTcustomer-addresses--customerAddress_id-">PUT customer/addresses/{customerAddress_id}</h2>

<p>
</p>



<span id="example-requests-PUTcustomer-addresses--customerAddress_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/customer/addresses/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"full_name\": \"vmqeopfuudtdsufvyvddq\",
    \"phone\": \"amniihfqcoynlazgh\",
    \"address_line_1\": \"dtqtqxbajwbpilpmufinl\",
    \"address_line_2\": \"lwloauydlsmsjuryvojcy\",
    \"city\": \"bzvrbyickznkygloigmkw\",
    \"state\": \"xphlvazjrcnfbaqywuxhg\",
    \"postal_code\": \"jjmzuxjubqouzswiw\",
    \"country\": \"xtrkimfcatbxspzmrazsr\",
    \"is_default\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/addresses/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "full_name": "vmqeopfuudtdsufvyvddq",
    "phone": "amniihfqcoynlazgh",
    "address_line_1": "dtqtqxbajwbpilpmufinl",
    "address_line_2": "lwloauydlsmsjuryvojcy",
    "city": "bzvrbyickznkygloigmkw",
    "state": "xphlvazjrcnfbaqywuxhg",
    "postal_code": "jjmzuxjubqouzswiw",
    "country": "xtrkimfcatbxspzmrazsr",
    "is_default": false
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTcustomer-addresses--customerAddress_id-">
</span>
<span id="execution-results-PUTcustomer-addresses--customerAddress_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTcustomer-addresses--customerAddress_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTcustomer-addresses--customerAddress_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTcustomer-addresses--customerAddress_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTcustomer-addresses--customerAddress_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTcustomer-addresses--customerAddress_id-" data-method="PUT"
      data-path="customer/addresses/{customerAddress_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTcustomer-addresses--customerAddress_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTcustomer-addresses--customerAddress_id-"
                    onclick="tryItOut('PUTcustomer-addresses--customerAddress_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTcustomer-addresses--customerAddress_id-"
                    onclick="cancelTryOut('PUTcustomer-addresses--customerAddress_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTcustomer-addresses--customerAddress_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>customer/addresses/{customerAddress_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>customerAddress_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="customerAddress_id"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the customerAddress. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>full_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="full_name"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="amniihfqcoynlazgh"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>amniihfqcoynlazgh</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address_line_1</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address_line_1"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="dtqtqxbajwbpilpmufinl"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>dtqtqxbajwbpilpmufinl</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address_line_2</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address_line_2"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="lwloauydlsmsjuryvojcy"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>lwloauydlsmsjuryvojcy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="bzvrbyickznkygloigmkw"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>bzvrbyickznkygloigmkw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>state</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="state"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="xphlvazjrcnfbaqywuxhg"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>xphlvazjrcnfbaqywuxhg</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>postal_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="postal_code"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="jjmzuxjubqouzswiw"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>jjmzuxjubqouzswiw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="country"                data-endpoint="PUTcustomer-addresses--customerAddress_id-"
               value="xtrkimfcatbxspzmrazsr"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>xtrkimfcatbxspzmrazsr</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_default</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTcustomer-addresses--customerAddress_id-" style="display: none">
            <input type="radio" name="is_default"
                   value="true"
                   data-endpoint="PUTcustomer-addresses--customerAddress_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTcustomer-addresses--customerAddress_id-" style="display: none">
            <input type="radio" name="is_default"
                   value="false"
                   data-endpoint="PUTcustomer-addresses--customerAddress_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PATCHcustomer-addresses-default--customerAddress_id-">PATCH customer/addresses/default/{customerAddress_id}</h2>

<p>
</p>



<span id="example-requests-PATCHcustomer-addresses-default--customerAddress_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/customer/addresses/default/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/addresses/default/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHcustomer-addresses-default--customerAddress_id-">
</span>
<span id="execution-results-PATCHcustomer-addresses-default--customerAddress_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHcustomer-addresses-default--customerAddress_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHcustomer-addresses-default--customerAddress_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHcustomer-addresses-default--customerAddress_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHcustomer-addresses-default--customerAddress_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHcustomer-addresses-default--customerAddress_id-" data-method="PATCH"
      data-path="customer/addresses/default/{customerAddress_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHcustomer-addresses-default--customerAddress_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHcustomer-addresses-default--customerAddress_id-"
                    onclick="tryItOut('PATCHcustomer-addresses-default--customerAddress_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHcustomer-addresses-default--customerAddress_id-"
                    onclick="cancelTryOut('PATCHcustomer-addresses-default--customerAddress_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHcustomer-addresses-default--customerAddress_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>customer/addresses/default/{customerAddress_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHcustomer-addresses-default--customerAddress_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHcustomer-addresses-default--customerAddress_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>customerAddress_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="customerAddress_id"                data-endpoint="PATCHcustomer-addresses-default--customerAddress_id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the customerAddress. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEcustomer-addresses--customerAddress_id-">DELETE customer/addresses/{customerAddress_id}</h2>

<p>
</p>



<span id="example-requests-DELETEcustomer-addresses--customerAddress_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/customer/addresses/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/addresses/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEcustomer-addresses--customerAddress_id-">
</span>
<span id="execution-results-DELETEcustomer-addresses--customerAddress_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEcustomer-addresses--customerAddress_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEcustomer-addresses--customerAddress_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEcustomer-addresses--customerAddress_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEcustomer-addresses--customerAddress_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEcustomer-addresses--customerAddress_id-" data-method="DELETE"
      data-path="customer/addresses/{customerAddress_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEcustomer-addresses--customerAddress_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEcustomer-addresses--customerAddress_id-"
                    onclick="tryItOut('DELETEcustomer-addresses--customerAddress_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEcustomer-addresses--customerAddress_id-"
                    onclick="cancelTryOut('DELETEcustomer-addresses--customerAddress_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEcustomer-addresses--customerAddress_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>customer/addresses/{customerAddress_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEcustomer-addresses--customerAddress_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEcustomer-addresses--customerAddress_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>customerAddress_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="customerAddress_id"                data-endpoint="DELETEcustomer-addresses--customerAddress_id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the customerAddress. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETcustomer-addresses-show--customerAddress_id-">GET customer/addresses/show/{customerAddress_id}</h2>

<p>
</p>



<span id="example-requests-GETcustomer-addresses-show--customerAddress_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/addresses/show/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/addresses/show/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-addresses-show--customerAddress_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-addresses-show--customerAddress_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-addresses-show--customerAddress_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-addresses-show--customerAddress_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-addresses-show--customerAddress_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-addresses-show--customerAddress_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-addresses-show--customerAddress_id-" data-method="GET"
      data-path="customer/addresses/show/{customerAddress_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-addresses-show--customerAddress_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-addresses-show--customerAddress_id-"
                    onclick="tryItOut('GETcustomer-addresses-show--customerAddress_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-addresses-show--customerAddress_id-"
                    onclick="cancelTryOut('GETcustomer-addresses-show--customerAddress_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-addresses-show--customerAddress_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/addresses/show/{customerAddress_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-addresses-show--customerAddress_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-addresses-show--customerAddress_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>customerAddress_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="customerAddress_id"                data-endpoint="GETcustomer-addresses-show--customerAddress_id-"
               value="17"
               data-component="url">
    <br>
<p>The ID of the customerAddress. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETcustomer-orders">GET customer/orders</h2>

<p>
</p>



<span id="example-requests-GETcustomer-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/orders" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/orders"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-orders">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-orders" data-method="GET"
      data-path="customer/orders"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-orders"
                    onclick="tryItOut('GETcustomer-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-orders"
                    onclick="cancelTryOut('GETcustomer-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTcustomer-orders">POST customer/orders</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/orders" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"customer_name\": \"vmqeopfuudtdsufvyvddq\",
    \"customer_phone\": \"amniihfqcoynlazgh\",
    \"shipping_address\": [],
    \"payment_method\": \"cod\",
    \"customer_note\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/orders"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "customer_name": "vmqeopfuudtdsufvyvddq",
    "customer_phone": "amniihfqcoynlazgh",
    "shipping_address": [],
    "payment_method": "cod",
    "customer_note": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-orders">
</span>
<span id="execution-results-POSTcustomer-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-orders" data-method="POST"
      data-path="customer/orders"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-orders"
                    onclick="tryItOut('POSTcustomer-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-orders"
                    onclick="cancelTryOut('POSTcustomer-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>customer_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="customer_name"                data-endpoint="POSTcustomer-orders"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>customer_phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="customer_phone"                data-endpoint="POSTcustomer-orders"
               value="amniihfqcoynlazgh"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>amniihfqcoynlazgh</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>shipping_address</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shipping_address"                data-endpoint="POSTcustomer-orders"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>billing_address</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="billing_address"                data-endpoint="POSTcustomer-orders"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method"                data-endpoint="POSTcustomer-orders"
               value="cod"
               data-component="body">
    <br>
<p>Example: <code>cod</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>cod</code></li> <li><code>stripe</code></li> <li><code>khalti</code></li> <li><code>esewa</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>customer_note</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="customer_note"                data-endpoint="POSTcustomer-orders"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETcustomer-orders--id-">GET customer/orders/{id}</h2>

<p>
</p>



<span id="example-requests-GETcustomer-orders--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/orders/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/orders/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-orders--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-orders--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-orders--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-orders--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-orders--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-orders--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-orders--id-" data-method="GET"
      data-path="customer/orders/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-orders--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-orders--id-"
                    onclick="tryItOut('GETcustomer-orders--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-orders--id-"
                    onclick="cancelTryOut('GETcustomer-orders--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-orders--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/orders/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETcustomer-orders--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTcustomer-orders--id--cancel">POST customer/orders/{id}/cancel</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-orders--id--cancel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/orders/consequatur/cancel" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"cancel_reason\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/orders/consequatur/cancel"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "cancel_reason": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-orders--id--cancel">
</span>
<span id="execution-results-POSTcustomer-orders--id--cancel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-orders--id--cancel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-orders--id--cancel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-orders--id--cancel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-orders--id--cancel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-orders--id--cancel" data-method="POST"
      data-path="customer/orders/{id}/cancel"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-orders--id--cancel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-orders--id--cancel"
                    onclick="tryItOut('POSTcustomer-orders--id--cancel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-orders--id--cancel"
                    onclick="cancelTryOut('POSTcustomer-orders--id--cancel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-orders--id--cancel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/orders/{id}/cancel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-orders--id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-orders--id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTcustomer-orders--id--cancel"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cancel_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="cancel_reason"                data-endpoint="POSTcustomer-orders--id--cancel"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTcustomer-orders--id--confirm-received">POST customer/orders/{id}/confirm-received</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-orders--id--confirm-received">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/orders/consequatur/confirm-received" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/orders/consequatur/confirm-received"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-orders--id--confirm-received">
</span>
<span id="execution-results-POSTcustomer-orders--id--confirm-received" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-orders--id--confirm-received"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-orders--id--confirm-received"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-orders--id--confirm-received" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-orders--id--confirm-received">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-orders--id--confirm-received" data-method="POST"
      data-path="customer/orders/{id}/confirm-received"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-orders--id--confirm-received', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-orders--id--confirm-received"
                    onclick="tryItOut('POSTcustomer-orders--id--confirm-received');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-orders--id--confirm-received"
                    onclick="cancelTryOut('POSTcustomer-orders--id--confirm-received');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-orders--id--confirm-received"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/orders/{id}/confirm-received</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-orders--id--confirm-received"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-orders--id--confirm-received"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTcustomer-orders--id--confirm-received"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTcustomer-orders--id--return">POST customer/orders/{id}/return</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-orders--id--return">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/orders/consequatur/return" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"return_reason\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/orders/consequatur/return"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "return_reason": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-orders--id--return">
</span>
<span id="execution-results-POSTcustomer-orders--id--return" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-orders--id--return"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-orders--id--return"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-orders--id--return" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-orders--id--return">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-orders--id--return" data-method="POST"
      data-path="customer/orders/{id}/return"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-orders--id--return', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-orders--id--return"
                    onclick="tryItOut('POSTcustomer-orders--id--return');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-orders--id--return"
                    onclick="cancelTryOut('POSTcustomer-orders--id--return');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-orders--id--return"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/orders/{id}/return</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-orders--id--return"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-orders--id--return"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTcustomer-orders--id--return"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>return_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="return_reason"                data-endpoint="POSTcustomer-orders--id--return"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETcustomer-cart">GET customer/cart</h2>

<p>
</p>



<span id="example-requests-GETcustomer-cart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/cart" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/cart"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-cart">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;A valid user authentication token or X-Session-ID header is required.&quot;,
    &quot;errors&quot;: {
        &quot;session&quot;: [
            &quot;A valid user authentication token or X-Session-ID header is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-cart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-cart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-cart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-cart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-cart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-cart" data-method="GET"
      data-path="customer/cart"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-cart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-cart"
                    onclick="tryItOut('GETcustomer-cart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-cart"
                    onclick="cancelTryOut('GETcustomer-cart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-cart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/cart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTcustomer-cart">POST customer/cart</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-cart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/cart" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"shop_product_id\": \"consequatur\",
    \"quantity\": 45
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/cart"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "shop_product_id": "consequatur",
    "quantity": 45
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-cart">
</span>
<span id="execution-results-POSTcustomer-cart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-cart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-cart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-cart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-cart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-cart" data-method="POST"
      data-path="customer/cart"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-cart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-cart"
                    onclick="tryItOut('POSTcustomer-cart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-cart"
                    onclick="cancelTryOut('POSTcustomer-cart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-cart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/cart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>shop_product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shop_product_id"                data-endpoint="POSTcustomer-cart"
               value="consequatur"
               data-component="body">
    <br>
<p>Must match an existing stored value. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="quantity"                data-endpoint="POSTcustomer-cart"
               value="45"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>45</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attributes</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="attributes"                data-endpoint="POSTcustomer-cart"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

                    <h2 id="endpoints-GETcustomer-cart-count">GET customer/cart/count</h2>

<p>
</p>



<span id="example-requests-GETcustomer-cart-count">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/customer/cart/count" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/cart/count"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETcustomer-cart-count">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;A valid user authentication token or X-Session-ID header is required.&quot;,
    &quot;errors&quot;: {
        &quot;session&quot;: [
            &quot;A valid user authentication token or X-Session-ID header is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETcustomer-cart-count" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETcustomer-cart-count"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETcustomer-cart-count"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETcustomer-cart-count" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETcustomer-cart-count">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETcustomer-cart-count" data-method="GET"
      data-path="customer/cart/count"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETcustomer-cart-count', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETcustomer-cart-count"
                    onclick="tryItOut('GETcustomer-cart-count');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETcustomer-cart-count"
                    onclick="cancelTryOut('GETcustomer-cart-count');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETcustomer-cart-count"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>customer/cart/count</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETcustomer-cart-count"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETcustomer-cart-count"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PUTcustomer-cart--id-">PUT customer/cart/{id}</h2>

<p>
</p>



<span id="example-requests-PUTcustomer-cart--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/customer/cart/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"quantity\": 73
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/cart/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "quantity": 73
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTcustomer-cart--id-">
</span>
<span id="execution-results-PUTcustomer-cart--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTcustomer-cart--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTcustomer-cart--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTcustomer-cart--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTcustomer-cart--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTcustomer-cart--id-" data-method="PUT"
      data-path="customer/cart/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTcustomer-cart--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTcustomer-cart--id-"
                    onclick="tryItOut('PUTcustomer-cart--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTcustomer-cart--id-"
                    onclick="cancelTryOut('PUTcustomer-cart--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTcustomer-cart--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>customer/cart/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTcustomer-cart--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTcustomer-cart--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTcustomer-cart--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cart. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="quantity"                data-endpoint="PUTcustomer-cart--id-"
               value="73"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>73</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attributes</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="attributes"                data-endpoint="PUTcustomer-cart--id-"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

                    <h2 id="endpoints-DELETEcustomer-cart--id-">DELETE customer/cart/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEcustomer-cart--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/customer/cart/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/cart/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEcustomer-cart--id-">
</span>
<span id="execution-results-DELETEcustomer-cart--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEcustomer-cart--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEcustomer-cart--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEcustomer-cart--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEcustomer-cart--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEcustomer-cart--id-" data-method="DELETE"
      data-path="customer/cart/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEcustomer-cart--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEcustomer-cart--id-"
                    onclick="tryItOut('DELETEcustomer-cart--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEcustomer-cart--id-"
                    onclick="cancelTryOut('DELETEcustomer-cart--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEcustomer-cart--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>customer/cart/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEcustomer-cart--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEcustomer-cart--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEcustomer-cart--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the cart. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEcustomer-cart-clear">DELETE customer/cart/clear</h2>

<p>
</p>



<span id="example-requests-DELETEcustomer-cart-clear">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/customer/cart/clear" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/cart/clear"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEcustomer-cart-clear">
</span>
<span id="execution-results-DELETEcustomer-cart-clear" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEcustomer-cart-clear"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEcustomer-cart-clear"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEcustomer-cart-clear" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEcustomer-cart-clear">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEcustomer-cart-clear" data-method="DELETE"
      data-path="customer/cart/clear"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEcustomer-cart-clear', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEcustomer-cart-clear"
                    onclick="tryItOut('DELETEcustomer-cart-clear');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEcustomer-cart-clear"
                    onclick="cancelTryOut('DELETEcustomer-cart-clear');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEcustomer-cart-clear"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>customer/cart/clear</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEcustomer-cart-clear"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEcustomer-cart-clear"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTcustomer-cart-sync">POST customer/cart/sync</h2>

<p>
</p>



<span id="example-requests-POSTcustomer-cart-sync">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/customer/cart/sync" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"items\": [
        {
            \"shop_product_id\": \"consequatur\",
            \"quantity\": 45
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/customer/cart/sync"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "items": [
        {
            "shop_product_id": "consequatur",
            "quantity": 45
        }
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTcustomer-cart-sync">
</span>
<span id="execution-results-POSTcustomer-cart-sync" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTcustomer-cart-sync"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTcustomer-cart-sync"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTcustomer-cart-sync" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTcustomer-cart-sync">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTcustomer-cart-sync" data-method="POST"
      data-path="customer/cart/sync"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTcustomer-cart-sync', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTcustomer-cart-sync"
                    onclick="tryItOut('POSTcustomer-cart-sync');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTcustomer-cart-sync"
                    onclick="cancelTryOut('POSTcustomer-cart-sync');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTcustomer-cart-sync"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>customer/cart/sync</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTcustomer-cart-sync"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTcustomer-cart-sync"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>items</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Must have at least 1 items.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>shop_product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="items.0.shop_product_id"                data-endpoint="POSTcustomer-cart-sync"
               value="consequatur"
               data-component="body">
    <br>
<p>Must match an existing stored value. Example: <code>consequatur</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="items.0.quantity"                data-endpoint="POSTcustomer-cart-sync"
               value="45"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>45</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>attributes</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="items.0.attributes"                data-endpoint="POSTcustomer-cart-sync"
               value=""
               data-component="body">
    <br>

                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="endpoints-POSTadmin-register-request">POST admin/register-request</h2>

<p>
</p>



<span id="example-requests-POSTadmin-register-request">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/register-request" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"email\": \"kunde.eloisa@example.com\",
    \"password\": \"4[*UyPJ\\\"}6\",
    \"contact_no\": \"consequatur\",
    \"address\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/register-request"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "email": "kunde.eloisa@example.com",
    "password": "4[*UyPJ\"}6",
    "contact_no": "consequatur",
    "address": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-register-request">
</span>
<span id="execution-results-POSTadmin-register-request" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-register-request"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-register-request"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-register-request" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-register-request">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-register-request" data-method="POST"
      data-path="admin/register-request"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-register-request', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-register-request"
                    onclick="tryItOut('POSTadmin-register-request');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-register-request"
                    onclick="cancelTryOut('POSTadmin-register-request');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-register-request"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/register-request</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-register-request"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-register-request"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTadmin-register-request"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTadmin-register-request"
               value="kunde.eloisa@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>kunde.eloisa@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTadmin-register-request"
               value="4[*UyPJ"}6"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>4[*UyPJ"}6</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>contact_no</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contact_no"                data-endpoint="POSTadmin-register-request"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTadmin-register-request"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTadmin-login">POST admin/login</h2>

<p>
</p>



<span id="example-requests-POSTadmin-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"qkunze@example.com\",
    \"password\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "qkunze@example.com",
    "password": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-login">
</span>
<span id="execution-results-POSTadmin-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-login" data-method="POST"
      data-path="admin/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-login"
                    onclick="tryItOut('POSTadmin-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-login"
                    onclick="cancelTryOut('POSTadmin-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTadmin-login"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTadmin-login"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTadmin-forgot-password">POST admin/forgot-password</h2>

<p>
</p>



<span id="example-requests-POSTadmin-forgot-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/forgot-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"qkunze@example.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/forgot-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "qkunze@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-forgot-password">
</span>
<span id="execution-results-POSTadmin-forgot-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-forgot-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-forgot-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-forgot-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-forgot-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-forgot-password" data-method="POST"
      data-path="admin/forgot-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-forgot-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-forgot-password"
                    onclick="tryItOut('POSTadmin-forgot-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-forgot-password"
                    onclick="cancelTryOut('POSTadmin-forgot-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-forgot-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/forgot-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTadmin-forgot-password"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>qkunze@example.com</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTadmin-reset-password">POST admin/reset-password</h2>

<p>
</p>



<span id="example-requests-POSTadmin-reset-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/reset-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"qkunze@example.com\",
    \"token\": \"consequatur\",
    \"password\": \"[2UZ5ij-e\\/dl4\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/reset-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "qkunze@example.com",
    "token": "consequatur",
    "password": "[2UZ5ij-e\/dl4"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-reset-password">
</span>
<span id="execution-results-POSTadmin-reset-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-reset-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-reset-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-reset-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-reset-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-reset-password" data-method="POST"
      data-path="admin/reset-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-reset-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-reset-password"
                    onclick="tryItOut('POSTadmin-reset-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-reset-password"
                    onclick="cancelTryOut('POSTadmin-reset-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-reset-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/reset-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTadmin-reset-password"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTadmin-reset-password"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTadmin-reset-password"
               value="[2UZ5ij-e/dl4"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>[2UZ5ij-e/dl4</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTadmin-logout">POST admin/logout</h2>

<p>
</p>



<span id="example-requests-POSTadmin-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-logout">
</span>
<span id="execution-results-POSTadmin-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-logout" data-method="POST"
      data-path="admin/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-logout"
                    onclick="tryItOut('POSTadmin-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-logout"
                    onclick="cancelTryOut('POSTadmin-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTadmin-change-password">POST admin/change-password</h2>

<p>
</p>



<span id="example-requests-POSTadmin-change-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/change-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"old_password\": \"consequatur\",
    \"new_password\": \"mqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjuryv\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/change-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "old_password": "consequatur",
    "new_password": "mqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjuryv"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-change-password">
</span>
<span id="execution-results-POSTadmin-change-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-change-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-change-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-change-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-change-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-change-password" data-method="POST"
      data-path="admin/change-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-change-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-change-password"
                    onclick="tryItOut('POSTadmin-change-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-change-password"
                    onclick="cancelTryOut('POSTadmin-change-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-change-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/change-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-change-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-change-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>old_password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="old_password"                data-endpoint="POSTadmin-change-password"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>new_password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="new_password"                data-endpoint="POSTadmin-change-password"
               value="mqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjuryv"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>mqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjuryv</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTadmin-update">PUT admin/update</h2>

<p>
</p>



<span id="example-requests-PUTadmin-update">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/admin/update" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"contact_no\": \"amniihfqcoynl\",
    \"address\": \"consequatur\",
    \"email\": \"carolyne.luettgen@example.org\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/update"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "contact_no": "amniihfqcoynl",
    "address": "consequatur",
    "email": "carolyne.luettgen@example.org"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTadmin-update">
</span>
<span id="execution-results-PUTadmin-update" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTadmin-update"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTadmin-update"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTadmin-update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTadmin-update">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTadmin-update" data-method="PUT"
      data-path="admin/update"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTadmin-update', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTadmin-update"
                    onclick="tryItOut('PUTadmin-update');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTadmin-update"
                    onclick="cancelTryOut('PUTadmin-update');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTadmin-update"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>admin/update</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTadmin-update"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTadmin-update"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTadmin-update"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>contact_no</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contact_no"                data-endpoint="PUTadmin-update"
               value="amniihfqcoynl"
               data-component="body">
    <br>
<p>Must not be greater than 15 characters. Example: <code>amniihfqcoynl</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTadmin-update"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTadmin-update"
               value="carolyne.luettgen@example.org"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>carolyne.luettgen@example.org</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTadmin-update-image">POST admin/update-image</h2>

<p>
</p>



<span id="example-requests-POSTadmin-update-image">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/update-image" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "image=@C:\Users\Lenovo\AppData\Local\Temp\phpAADF.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/update-image"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-update-image">
</span>
<span id="execution-results-POSTadmin-update-image" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-update-image"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-update-image"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-update-image" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-update-image">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-update-image" data-method="POST"
      data-path="admin/update-image"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-update-image', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-update-image"
                    onclick="tryItOut('POSTadmin-update-image');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-update-image"
                    onclick="cancelTryOut('POSTadmin-update-image');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-update-image"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/update-image</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-update-image"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-update-image"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTadmin-update-image"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\Lenovo\AppData\Local\Temp\phpAADF.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEadmin-delete">DELETE admin/delete</h2>

<p>
</p>



<span id="example-requests-DELETEadmin-delete">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/admin/delete" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/delete"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEadmin-delete">
</span>
<span id="execution-results-DELETEadmin-delete" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEadmin-delete"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEadmin-delete"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEadmin-delete" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEadmin-delete">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEadmin-delete" data-method="DELETE"
      data-path="admin/delete"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEadmin-delete', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEadmin-delete"
                    onclick="tryItOut('DELETEadmin-delete');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEadmin-delete"
                    onclick="cancelTryOut('DELETEadmin-delete');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEadmin-delete"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>admin/delete</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEadmin-delete"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEadmin-delete"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTadmin-upload-kyc">POST admin/upload-kyc</h2>

<p>
</p>



<span id="example-requests-POSTadmin-upload-kyc">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/upload-kyc" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "business_license=@C:\Users\Lenovo\AppData\Local\Temp\phpAB10.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/upload-kyc"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('business_license', document.querySelector('input[name="business_license"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-upload-kyc">
</span>
<span id="execution-results-POSTadmin-upload-kyc" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-upload-kyc"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-upload-kyc"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-upload-kyc" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-upload-kyc">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-upload-kyc" data-method="POST"
      data-path="admin/upload-kyc"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-upload-kyc', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-upload-kyc"
                    onclick="tryItOut('POSTadmin-upload-kyc');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-upload-kyc"
                    onclick="cancelTryOut('POSTadmin-upload-kyc');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-upload-kyc"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/upload-kyc</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-upload-kyc"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-upload-kyc"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_proof</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id_proof"                data-endpoint="POSTadmin-upload-kyc"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>business_license</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="business_license"                data-endpoint="POSTadmin-upload-kyc"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 5120 kilobytes. Example: <code>C:\Users\Lenovo\AppData\Local\Temp\phpAB10.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_proof_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id_proof_type"                data-endpoint="POSTadmin-upload-kyc"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

                    <h2 id="endpoints-GETadmin-shops">GET admin/shops</h2>

<p>
</p>



<span id="example-requests-GETadmin-shops">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/shops" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shops"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-shops">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-shops" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-shops"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-shops"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-shops" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-shops">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-shops" data-method="GET"
      data-path="admin/shops"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-shops', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-shops"
                    onclick="tryItOut('GETadmin-shops');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-shops"
                    onclick="cancelTryOut('GETadmin-shops');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-shops"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/shops</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-shops"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-shops"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTadmin-shops">POST admin/shops</h2>

<p>
</p>



<span id="example-requests-POSTadmin-shops">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/shops" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "shop_name=vmqeopfuudtdsufvyvddq"\
    --form "description=Dolores dolorum amet iste laborum eius est dolor."\
    --form "business_email=reynolds.monty@example.net"\
    --form "contact_no=fvyvddqamniihfqco"\
    --form "address=ynlazghdtqtqxbajwbpil"\
    --form "theme_color=pmufin"\
    --form "logo=@C:\Users\Lenovo\AppData\Local\Temp\phpABFC.tmp" \
    --form "cover_image=@C:\Users\Lenovo\AppData\Local\Temp\phpABFD.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shops"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('shop_name', 'vmqeopfuudtdsufvyvddq');
body.append('description', 'Dolores dolorum amet iste laborum eius est dolor.');
body.append('business_email', 'reynolds.monty@example.net');
body.append('contact_no', 'fvyvddqamniihfqco');
body.append('address', 'ynlazghdtqtqxbajwbpil');
body.append('theme_color', 'pmufin');
body.append('logo', document.querySelector('input[name="logo"]').files[0]);
body.append('cover_image', document.querySelector('input[name="cover_image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-shops">
</span>
<span id="execution-results-POSTadmin-shops" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-shops"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-shops"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-shops" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-shops">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-shops" data-method="POST"
      data-path="admin/shops"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-shops', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-shops"
                    onclick="tryItOut('POSTadmin-shops');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-shops"
                    onclick="cancelTryOut('POSTadmin-shops');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-shops"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/shops</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-shops"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-shops"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>shop_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shop_name"                data-endpoint="POSTadmin-shops"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTadmin-shops"
               value="Dolores dolorum amet iste laborum eius est dolor."
               data-component="body">
    <br>
<p>Example: <code>Dolores dolorum amet iste laborum eius est dolor.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>business_email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="business_email"                data-endpoint="POSTadmin-shops"
               value="reynolds.monty@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>reynolds.monty@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>contact_no</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contact_no"                data-endpoint="POSTadmin-shops"
               value="fvyvddqamniihfqco"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>fvyvddqamniihfqco</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTadmin-shops"
               value="ynlazghdtqtqxbajwbpil"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>ynlazghdtqtqxbajwbpil</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>theme_color</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="theme_color"                data-endpoint="POSTadmin-shops"
               value="pmufin"
               data-component="body">
    <br>
<p>Must not be greater than 7 characters. Example: <code>pmufin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>opening_hours</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="opening_hours"                data-endpoint="POSTadmin-shops"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>logo</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="logo"                data-endpoint="POSTadmin-shops"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\Lenovo\AppData\Local\Temp\phpABFC.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cover_image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="cover_image"                data-endpoint="POSTadmin-shops"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 4096 kilobytes. Example: <code>C:\Users\Lenovo\AppData\Local\Temp\phpABFD.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETadmin-dashboard-stats">Get aggregate statistics (Revenue, Orders, Low Stock, Balance).</h2>

<p>
</p>



<span id="example-requests-GETadmin-dashboard-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/dashboard/stats" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/dashboard/stats"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-dashboard-stats">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-dashboard-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-dashboard-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-dashboard-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-dashboard-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-dashboard-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-dashboard-stats" data-method="GET"
      data-path="admin/dashboard/stats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-dashboard-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-dashboard-stats"
                    onclick="tryItOut('GETadmin-dashboard-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-dashboard-stats"
                    onclick="cancelTryOut('GETadmin-dashboard-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-dashboard-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/dashboard/stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-dashboard-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-dashboard-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-dashboard-chart">Get chart sales trends over the last 7 days.</h2>

<p>
</p>



<span id="example-requests-GETadmin-dashboard-chart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/dashboard/chart" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/dashboard/chart"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-dashboard-chart">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-dashboard-chart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-dashboard-chart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-dashboard-chart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-dashboard-chart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-dashboard-chart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-dashboard-chart" data-method="GET"
      data-path="admin/dashboard/chart"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-dashboard-chart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-dashboard-chart"
                    onclick="tryItOut('GETadmin-dashboard-chart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-dashboard-chart"
                    onclick="cancelTryOut('GETadmin-dashboard-chart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-dashboard-chart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/dashboard/chart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-dashboard-chart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-dashboard-chart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-dashboard-recent-orders">Get recent orders list with pagination.</h2>

<p>
</p>



<span id="example-requests-GETadmin-dashboard-recent-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/dashboard/recent-orders" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/dashboard/recent-orders"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-dashboard-recent-orders">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-dashboard-recent-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-dashboard-recent-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-dashboard-recent-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-dashboard-recent-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-dashboard-recent-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-dashboard-recent-orders" data-method="GET"
      data-path="admin/dashboard/recent-orders"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-dashboard-recent-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-dashboard-recent-orders"
                    onclick="tryItOut('GETadmin-dashboard-recent-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-dashboard-recent-orders"
                    onclick="cancelTryOut('GETadmin-dashboard-recent-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-dashboard-recent-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/dashboard/recent-orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-dashboard-recent-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-dashboard-recent-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-dashboard-toggle-status">Toggle shop status (open/closed).</h2>

<p>
</p>



<span id="example-requests-GETadmin-dashboard-toggle-status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/dashboard/toggle-status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/dashboard/toggle-status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-dashboard-toggle-status">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-dashboard-toggle-status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-dashboard-toggle-status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-dashboard-toggle-status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-dashboard-toggle-status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-dashboard-toggle-status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-dashboard-toggle-status" data-method="GET"
      data-path="admin/dashboard/toggle-status"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-dashboard-toggle-status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-dashboard-toggle-status"
                    onclick="tryItOut('GETadmin-dashboard-toggle-status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-dashboard-toggle-status"
                    onclick="cancelTryOut('GETadmin-dashboard-toggle-status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-dashboard-toggle-status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/dashboard/toggle-status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-dashboard-toggle-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-dashboard-toggle-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-shop-all">GET admin/shop/all</h2>

<p>
</p>



<span id="example-requests-GETadmin-shop-all">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/shop/all" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/all"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-shop-all">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-shop-all" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-shop-all"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-shop-all"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-shop-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-shop-all">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-shop-all" data-method="GET"
      data-path="admin/shop/all"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-shop-all', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-shop-all"
                    onclick="tryItOut('GETadmin-shop-all');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-shop-all"
                    onclick="cancelTryOut('GETadmin-shop-all');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-shop-all"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/shop/all</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-shop-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-shop-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-shop-profile">GET admin/shop/profile</h2>

<p>
</p>



<span id="example-requests-GETadmin-shop-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/shop/profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-shop-profile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-shop-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-shop-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-shop-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-shop-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-shop-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-shop-profile" data-method="GET"
      data-path="admin/shop/profile"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-shop-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-shop-profile"
                    onclick="tryItOut('GETadmin-shop-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-shop-profile"
                    onclick="cancelTryOut('GETadmin-shop-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-shop-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/shop/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-shop-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-shop-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PUTadmin-shop-profile">PUT admin/shop/profile</h2>

<p>
</p>



<span id="example-requests-PUTadmin-shop-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/admin/shop/profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"description\": \"Dolores dolorum amet iste laborum eius est dolor.\",
    \"theme_color\": \"dtdsuf\",
    \"business_email\": \"vwilliamson@example.com\",
    \"contact_no\": \"dqamniihfqcoynlaz\",
    \"address\": \"consequatur\",
    \"map_location\": \"consequatur\",
    \"latitude\": -90,
    \"longitude\": -179,
    \"is_open\": true,
    \"meta_title\": \"eopfuudtdsufvyvddqamn\",
    \"meta_description\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "description": "Dolores dolorum amet iste laborum eius est dolor.",
    "theme_color": "dtdsuf",
    "business_email": "vwilliamson@example.com",
    "contact_no": "dqamniihfqcoynlaz",
    "address": "consequatur",
    "map_location": "consequatur",
    "latitude": -90,
    "longitude": -179,
    "is_open": true,
    "meta_title": "eopfuudtdsufvyvddqamn",
    "meta_description": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTadmin-shop-profile">
</span>
<span id="execution-results-PUTadmin-shop-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTadmin-shop-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTadmin-shop-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTadmin-shop-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTadmin-shop-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTadmin-shop-profile" data-method="PUT"
      data-path="admin/shop/profile"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTadmin-shop-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTadmin-shop-profile"
                    onclick="tryItOut('PUTadmin-shop-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTadmin-shop-profile"
                    onclick="cancelTryOut('PUTadmin-shop-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTadmin-shop-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>admin/shop/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTadmin-shop-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTadmin-shop-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>shop_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="shop_name"                data-endpoint="PUTadmin-shop-profile"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTadmin-shop-profile"
               value="Dolores dolorum amet iste laborum eius est dolor."
               data-component="body">
    <br>
<p>Example: <code>Dolores dolorum amet iste laborum eius est dolor.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>theme_color</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="theme_color"                data-endpoint="PUTadmin-shop-profile"
               value="dtdsuf"
               data-component="body">
    <br>
<p>Must not be greater than 7 characters. Example: <code>dtdsuf</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>business_email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="business_email"                data-endpoint="PUTadmin-shop-profile"
               value="vwilliamson@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>vwilliamson@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>contact_no</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contact_no"                data-endpoint="PUTadmin-shop-profile"
               value="dqamniihfqcoynlaz"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>dqamniihfqcoynlaz</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTadmin-shop-profile"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>map_location</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="map_location"                data-endpoint="PUTadmin-shop-profile"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>latitude</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="latitude"                data-endpoint="PUTadmin-shop-profile"
               value="-90"
               data-component="body">
    <br>
<p>Must be between -90 and 90. Example: <code>-90</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>longitude</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="longitude"                data-endpoint="PUTadmin-shop-profile"
               value="-179"
               data-component="body">
    <br>
<p>Must be between -180 and 180. Example: <code>-179</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_open</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTadmin-shop-profile" style="display: none">
            <input type="radio" name="is_open"
                   value="true"
                   data-endpoint="PUTadmin-shop-profile"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTadmin-shop-profile" style="display: none">
            <input type="radio" name="is_open"
                   value="false"
                   data-endpoint="PUTadmin-shop-profile"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>opening_hours</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="opening_hours"                data-endpoint="PUTadmin-shop-profile"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>social_links</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="social_links"                data-endpoint="PUTadmin-shop-profile"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta_title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="meta_title"                data-endpoint="PUTadmin-shop-profile"
               value="eopfuudtdsufvyvddqamn"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>eopfuudtdsufvyvddqamn</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>meta_description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="meta_description"                data-endpoint="PUTadmin-shop-profile"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTadmin-shop-profile-branding">POST admin/shop/profile/branding</h2>

<p>
</p>



<span id="example-requests-POSTadmin-shop-profile-branding">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/shop/profile/branding" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "logo=@C:\Users\Lenovo\AppData\Local\Temp\phpB13D.tmp" \
    --form "cover_image=@C:\Users\Lenovo\AppData\Local\Temp\phpB13E.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/profile/branding"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('logo', document.querySelector('input[name="logo"]').files[0]);
body.append('cover_image', document.querySelector('input[name="cover_image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-shop-profile-branding">
</span>
<span id="execution-results-POSTadmin-shop-profile-branding" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-shop-profile-branding"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-shop-profile-branding"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-shop-profile-branding" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-shop-profile-branding">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-shop-profile-branding" data-method="POST"
      data-path="admin/shop/profile/branding"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-shop-profile-branding', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-shop-profile-branding"
                    onclick="tryItOut('POSTadmin-shop-profile-branding');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-shop-profile-branding"
                    onclick="cancelTryOut('POSTadmin-shop-profile-branding');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-shop-profile-branding"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/shop/profile/branding</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-shop-profile-branding"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-shop-profile-branding"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>logo</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="logo"                data-endpoint="POSTadmin-shop-profile-branding"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\Lenovo\AppData\Local\Temp\phpB13D.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cover_image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="cover_image"                data-endpoint="POSTadmin-shop-profile-branding"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 4096 kilobytes. Example: <code>C:\Users\Lenovo\AppData\Local\Temp\phpB13E.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEadmin-shop-profile">DELETE admin/shop/profile</h2>

<p>
</p>



<span id="example-requests-DELETEadmin-shop-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/admin/shop/profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEadmin-shop-profile">
</span>
<span id="execution-results-DELETEadmin-shop-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEadmin-shop-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEadmin-shop-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEadmin-shop-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEadmin-shop-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEadmin-shop-profile" data-method="DELETE"
      data-path="admin/shop/profile"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEadmin-shop-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEadmin-shop-profile"
                    onclick="tryItOut('DELETEadmin-shop-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEadmin-shop-profile"
                    onclick="cancelTryOut('DELETEadmin-shop-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEadmin-shop-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>admin/shop/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEadmin-shop-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEadmin-shop-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-DELETEadmin-shop-profile-force">DELETE admin/shop/profile/force</h2>

<p>
</p>



<span id="example-requests-DELETEadmin-shop-profile-force">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/admin/shop/profile/force" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/profile/force"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEadmin-shop-profile-force">
</span>
<span id="execution-results-DELETEadmin-shop-profile-force" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEadmin-shop-profile-force"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEadmin-shop-profile-force"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEadmin-shop-profile-force" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEadmin-shop-profile-force">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEadmin-shop-profile-force" data-method="DELETE"
      data-path="admin/shop/profile/force"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEadmin-shop-profile-force', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEadmin-shop-profile-force"
                    onclick="tryItOut('DELETEadmin-shop-profile-force');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEadmin-shop-profile-force"
                    onclick="cancelTryOut('DELETEadmin-shop-profile-force');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEadmin-shop-profile-force"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>admin/shop/profile/force</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEadmin-shop-profile-force"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEadmin-shop-profile-force"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-shop-payout-requests">List payout requests.</h2>

<p>
</p>

<ul>
<li>Vendors: See only payouts for their active shop (via HasShopScope).</li>
<li>Superadmin: Sees all payouts across the platform (or filtered by status).</li>
</ul>

<span id="example-requests-GETadmin-shop-payout-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/shop/payout-requests" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/payout-requests"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-shop-payout-requests">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-shop-payout-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-shop-payout-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-shop-payout-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-shop-payout-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-shop-payout-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-shop-payout-requests" data-method="GET"
      data-path="admin/shop/payout-requests"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-shop-payout-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-shop-payout-requests"
                    onclick="tryItOut('GETadmin-shop-payout-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-shop-payout-requests"
                    onclick="cancelTryOut('GETadmin-shop-payout-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-shop-payout-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/shop/payout-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-shop-payout-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-shop-payout-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTadmin-shop-payout-requests">Vendor submits a payout request.</h2>

<p>
</p>

<p>Deducts balance immediately into a pending state to avoid double-withdrawal.</p>

<span id="example-requests-POSTadmin-shop-payout-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/shop/payout-requests" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"amount\": 98,
    \"payment_method\": \"BANK_TRANSFER\",
    \"payment_details\": []
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/payout-requests"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "amount": 98,
    "payment_method": "BANK_TRANSFER",
    "payment_details": []
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-shop-payout-requests">
</span>
<span id="execution-results-POSTadmin-shop-payout-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-shop-payout-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-shop-payout-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-shop-payout-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-shop-payout-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-shop-payout-requests" data-method="POST"
      data-path="admin/shop/payout-requests"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-shop-payout-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-shop-payout-requests"
                    onclick="tryItOut('POSTadmin-shop-payout-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-shop-payout-requests"
                    onclick="cancelTryOut('POSTadmin-shop-payout-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-shop-payout-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/shop/payout-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-shop-payout-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-shop-payout-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="POSTadmin-shop-payout-requests"
               value="98"
               data-component="body">
    <br>
<p>Must be at least 100. Example: <code>98</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method"                data-endpoint="POSTadmin-shop-payout-requests"
               value="BANK_TRANSFER"
               data-component="body">
    <br>
<p>Example: <code>BANK_TRANSFER</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>ESEWA</code></li> <li><code>KHALTI</code></li> <li><code>BANK_TRANSFER</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_details</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_details"                data-endpoint="POSTadmin-shop-payout-requests"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

                    <h2 id="endpoints-GETadmin-shop-category-requests-my-requests">GET admin/shop/category-requests/my-requests</h2>

<p>
</p>



<span id="example-requests-GETadmin-shop-category-requests-my-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/shop/category-requests/my-requests" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/category-requests/my-requests"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-shop-category-requests-my-requests">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-shop-category-requests-my-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-shop-category-requests-my-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-shop-category-requests-my-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-shop-category-requests-my-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-shop-category-requests-my-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-shop-category-requests-my-requests" data-method="GET"
      data-path="admin/shop/category-requests/my-requests"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-shop-category-requests-my-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-shop-category-requests-my-requests"
                    onclick="tryItOut('GETadmin-shop-category-requests-my-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-shop-category-requests-my-requests"
                    onclick="cancelTryOut('GETadmin-shop-category-requests-my-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-shop-category-requests-my-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/shop/category-requests/my-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-shop-category-requests-my-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-shop-category-requests-my-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTadmin-shop-category-requests">POST admin/shop/category-requests</h2>

<p>
</p>



<span id="example-requests-POSTadmin-shop-category-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/shop/category-requests" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"reason\": \"amniihfqcoynlazghdtqt\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/category-requests"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "reason": "amniihfqcoynlazghdtqt"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-shop-category-requests">
</span>
<span id="execution-results-POSTadmin-shop-category-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-shop-category-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-shop-category-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-shop-category-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-shop-category-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-shop-category-requests" data-method="POST"
      data-path="admin/shop/category-requests"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-shop-category-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-shop-category-requests"
                    onclick="tryItOut('POSTadmin-shop-category-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-shop-category-requests"
                    onclick="cancelTryOut('POSTadmin-shop-category-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-shop-category-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/shop/category-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-shop-category-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-shop-category-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTadmin-shop-category-requests"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTadmin-shop-category-requests"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>suggested_parent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="suggested_parent_id"                data-endpoint="POSTadmin-shop-category-requests"
               value=""
               data-component="body">
    <br>
<p>Must match an existing stored value.</p>
        </div>
        </form>

                    <h2 id="endpoints-PUTadmin-shop-category-requests--id-">PUT admin/shop/category-requests/{id}</h2>

<p>
</p>



<span id="example-requests-PUTadmin-shop-category-requests--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/admin/shop/category-requests/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"reason\": \"amniihfqcoynlazghdtqt\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/category-requests/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "reason": "amniihfqcoynlazghdtqt"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTadmin-shop-category-requests--id-">
</span>
<span id="execution-results-PUTadmin-shop-category-requests--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTadmin-shop-category-requests--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTadmin-shop-category-requests--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTadmin-shop-category-requests--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTadmin-shop-category-requests--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTadmin-shop-category-requests--id-" data-method="PUT"
      data-path="admin/shop/category-requests/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTadmin-shop-category-requests--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTadmin-shop-category-requests--id-"
                    onclick="tryItOut('PUTadmin-shop-category-requests--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTadmin-shop-category-requests--id-"
                    onclick="cancelTryOut('PUTadmin-shop-category-requests--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTadmin-shop-category-requests--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>admin/shop/category-requests/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTadmin-shop-category-requests--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTadmin-shop-category-requests--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTadmin-shop-category-requests--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the category request. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTadmin-shop-category-requests--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="PUTadmin-shop-category-requests--id-"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>suggested_parent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="suggested_parent_id"                data-endpoint="PUTadmin-shop-category-requests--id-"
               value=""
               data-component="body">
    <br>
<p>Must match an existing stored value.</p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEadmin-shop-category-requests--id-">DELETE admin/shop/category-requests/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEadmin-shop-category-requests--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/admin/shop/category-requests/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/category-requests/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEadmin-shop-category-requests--id-">
</span>
<span id="execution-results-DELETEadmin-shop-category-requests--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEadmin-shop-category-requests--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEadmin-shop-category-requests--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEadmin-shop-category-requests--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEadmin-shop-category-requests--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEadmin-shop-category-requests--id-" data-method="DELETE"
      data-path="admin/shop/category-requests/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEadmin-shop-category-requests--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEadmin-shop-category-requests--id-"
                    onclick="tryItOut('DELETEadmin-shop-category-requests--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEadmin-shop-category-requests--id-"
                    onclick="cancelTryOut('DELETEadmin-shop-category-requests--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEadmin-shop-category-requests--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>admin/shop/category-requests/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEadmin-shop-category-requests--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEadmin-shop-category-requests--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEadmin-shop-category-requests--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the category request. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETadmin-shop-orders">GET admin/shop/orders</h2>

<p>
</p>



<span id="example-requests-GETadmin-shop-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/shop/orders" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/orders"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-shop-orders">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-shop-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-shop-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-shop-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-shop-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-shop-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-shop-orders" data-method="GET"
      data-path="admin/shop/orders"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-shop-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-shop-orders"
                    onclick="tryItOut('GETadmin-shop-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-shop-orders"
                    onclick="cancelTryOut('GETadmin-shop-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-shop-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/shop/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-shop-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-shop-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-shop-orders--id-">GET admin/shop/orders/{id}</h2>

<p>
</p>



<span id="example-requests-GETadmin-shop-orders--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/shop/orders/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/orders/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-shop-orders--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-shop-orders--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-shop-orders--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-shop-orders--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-shop-orders--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-shop-orders--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-shop-orders--id-" data-method="GET"
      data-path="admin/shop/orders/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-shop-orders--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-shop-orders--id-"
                    onclick="tryItOut('GETadmin-shop-orders--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-shop-orders--id-"
                    onclick="cancelTryOut('GETadmin-shop-orders--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-shop-orders--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/shop/orders/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-shop-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-shop-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETadmin-shop-orders--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PATCHadmin-shop-orders--id--status">PATCH admin/shop/orders/{id}/status</h2>

<p>
</p>



<span id="example-requests-PATCHadmin-shop-orders--id--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/admin/shop/orders/consequatur/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"shipped\",
    \"payment_status\": \"partially_refunded\",
    \"tracking_number\": \"vmqeopfuudtdsufvyvddq\",
    \"admin_note\": \"amniihfqcoynlazghdtqt\",
    \"delivery_type\": \"shop_self\",
    \"courier_name\": \"qxbajwbpilpmufinllwlo\",
    \"courier_waybill_id\": \"auydlsmsjuryvojcybzvr\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/orders/consequatur/status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "shipped",
    "payment_status": "partially_refunded",
    "tracking_number": "vmqeopfuudtdsufvyvddq",
    "admin_note": "amniihfqcoynlazghdtqt",
    "delivery_type": "shop_self",
    "courier_name": "qxbajwbpilpmufinllwlo",
    "courier_waybill_id": "auydlsmsjuryvojcybzvr"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHadmin-shop-orders--id--status">
</span>
<span id="execution-results-PATCHadmin-shop-orders--id--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHadmin-shop-orders--id--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHadmin-shop-orders--id--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHadmin-shop-orders--id--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHadmin-shop-orders--id--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHadmin-shop-orders--id--status" data-method="PATCH"
      data-path="admin/shop/orders/{id}/status"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHadmin-shop-orders--id--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHadmin-shop-orders--id--status"
                    onclick="tryItOut('PATCHadmin-shop-orders--id--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHadmin-shop-orders--id--status"
                    onclick="cancelTryOut('PATCHadmin-shop-orders--id--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHadmin-shop-orders--id--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>admin/shop/orders/{id}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHadmin-shop-orders--id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHadmin-shop-orders--id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PATCHadmin-shop-orders--id--status"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PATCHadmin-shop-orders--id--status"
               value="shipped"
               data-component="body">
    <br>
<p>Example: <code>shipped</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>pending</code></li> <li><code>processing</code></li> <li><code>shipped</code></li> <li><code>delivered</code></li> <li><code>cancelled</code></li> <li><code>returned</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_status"                data-endpoint="PATCHadmin-shop-orders--id--status"
               value="partially_refunded"
               data-component="body">
    <br>
<p>Example: <code>partially_refunded</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>unpaid</code></li> <li><code>paid</code></li> <li><code>partially_refunded</code></li> <li><code>refunded</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tracking_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tracking_number"                data-endpoint="PATCHadmin-shop-orders--id--status"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>admin_note</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="admin_note"                data-endpoint="PATCHadmin-shop-orders--id--status"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>delivery_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="delivery_type"                data-endpoint="PATCHadmin-shop-orders--id--status"
               value="shop_self"
               data-component="body">
    <br>
<p>Example: <code>shop_self</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>shop_self</code></li> <li><code>platform_courier</code></li> <li><code>third_party</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>courier_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="courier_name"                data-endpoint="PATCHadmin-shop-orders--id--status"
               value="qxbajwbpilpmufinllwlo"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>qxbajwbpilpmufinllwlo</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>courier_waybill_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="courier_waybill_id"                data-endpoint="PATCHadmin-shop-orders--id--status"
               value="auydlsmsjuryvojcybzvr"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>auydlsmsjuryvojcybzvr</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTadmin-shop-orders--id--approve-cancellation">POST admin/shop/orders/{id}/approve-cancellation</h2>

<p>
</p>



<span id="example-requests-POSTadmin-shop-orders--id--approve-cancellation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/shop/orders/consequatur/approve-cancellation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/orders/consequatur/approve-cancellation"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-shop-orders--id--approve-cancellation">
</span>
<span id="execution-results-POSTadmin-shop-orders--id--approve-cancellation" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-shop-orders--id--approve-cancellation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-shop-orders--id--approve-cancellation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-shop-orders--id--approve-cancellation" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-shop-orders--id--approve-cancellation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-shop-orders--id--approve-cancellation" data-method="POST"
      data-path="admin/shop/orders/{id}/approve-cancellation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-shop-orders--id--approve-cancellation', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-shop-orders--id--approve-cancellation"
                    onclick="tryItOut('POSTadmin-shop-orders--id--approve-cancellation');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-shop-orders--id--approve-cancellation"
                    onclick="cancelTryOut('POSTadmin-shop-orders--id--approve-cancellation');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-shop-orders--id--approve-cancellation"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/shop/orders/{id}/approve-cancellation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-shop-orders--id--approve-cancellation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-shop-orders--id--approve-cancellation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTadmin-shop-orders--id--approve-cancellation"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTadmin-shop-orders--id--reject-cancellation">POST admin/shop/orders/{id}/reject-cancellation</h2>

<p>
</p>



<span id="example-requests-POSTadmin-shop-orders--id--reject-cancellation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/shop/orders/consequatur/reject-cancellation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"admin_note\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/orders/consequatur/reject-cancellation"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "admin_note": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-shop-orders--id--reject-cancellation">
</span>
<span id="execution-results-POSTadmin-shop-orders--id--reject-cancellation" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-shop-orders--id--reject-cancellation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-shop-orders--id--reject-cancellation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-shop-orders--id--reject-cancellation" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-shop-orders--id--reject-cancellation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-shop-orders--id--reject-cancellation" data-method="POST"
      data-path="admin/shop/orders/{id}/reject-cancellation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-shop-orders--id--reject-cancellation', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-shop-orders--id--reject-cancellation"
                    onclick="tryItOut('POSTadmin-shop-orders--id--reject-cancellation');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-shop-orders--id--reject-cancellation"
                    onclick="cancelTryOut('POSTadmin-shop-orders--id--reject-cancellation');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-shop-orders--id--reject-cancellation"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/shop/orders/{id}/reject-cancellation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-shop-orders--id--reject-cancellation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-shop-orders--id--reject-cancellation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTadmin-shop-orders--id--reject-cancellation"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>admin_note</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="admin_note"                data-endpoint="POSTadmin-shop-orders--id--reject-cancellation"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTadmin-shop-orders--id--process-return">POST admin/shop/orders/{id}/process-return</h2>

<p>
</p>



<span id="example-requests-POSTadmin-shop-orders--id--process-return">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/shop/orders/consequatur/process-return" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"rejected\",
    \"admin_note\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/shop/orders/consequatur/process-return"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "rejected",
    "admin_note": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-shop-orders--id--process-return">
</span>
<span id="execution-results-POSTadmin-shop-orders--id--process-return" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-shop-orders--id--process-return"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-shop-orders--id--process-return"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-shop-orders--id--process-return" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-shop-orders--id--process-return">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-shop-orders--id--process-return" data-method="POST"
      data-path="admin/shop/orders/{id}/process-return"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-shop-orders--id--process-return', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-shop-orders--id--process-return"
                    onclick="tryItOut('POSTadmin-shop-orders--id--process-return');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-shop-orders--id--process-return"
                    onclick="cancelTryOut('POSTadmin-shop-orders--id--process-return');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-shop-orders--id--process-return"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/shop/orders/{id}/process-return</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-shop-orders--id--process-return"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-shop-orders--id--process-return"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTadmin-shop-orders--id--process-return"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTadmin-shop-orders--id--process-return"
               value="rejected"
               data-component="body">
    <br>
<p>Example: <code>rejected</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>approved</code></li> <li><code>rejected</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>admin_note</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="admin_note"                data-endpoint="POSTadmin-shop-orders--id--process-return"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTadmin-products-store">POST admin/products/store</h2>

<p>
</p>



<span id="example-requests-POSTadmin-products-store">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/products/store" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "name=vmqeopfuudtdsufvyvddq"\
    --form "unit=amniihfqcoynlazghdtqt"\
    --form "description=Dolores dolorum amet iste laborum eius est dolor."\
    --form "video_url=http://reynolds.com/"\
    --form "has_variants="\
    --form "sale_price=65"\
    --form "min_order=72"\
    --form "max_order=17"\
    --form "is_available="\
    --form "sale_start=2026-08-06T02:51:10"\
    --form "sale_end=2107-09-04"\
    --form "catalog_image=@C:\Users\Lenovo\AppData\Local\Temp\phpB4F8.tmp" \
    --form "local_image=@C:\Users\Lenovo\AppData\Local\Temp\phpB4F9.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/store"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'vmqeopfuudtdsufvyvddq');
body.append('unit', 'amniihfqcoynlazghdtqt');
body.append('description', 'Dolores dolorum amet iste laborum eius est dolor.');
body.append('video_url', 'http://reynolds.com/');
body.append('has_variants', '');
body.append('sale_price', '65');
body.append('min_order', '72');
body.append('max_order', '17');
body.append('is_available', '');
body.append('sale_start', '2026-08-06T02:51:10');
body.append('sale_end', '2107-09-04');
body.append('catalog_image', document.querySelector('input[name="catalog_image"]').files[0]);
body.append('local_image', document.querySelector('input[name="local_image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-products-store">
</span>
<span id="execution-results-POSTadmin-products-store" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-products-store"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-products-store"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-products-store" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-products-store">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-products-store" data-method="POST"
      data-path="admin/products/store"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-products-store', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-products-store"
                    onclick="tryItOut('POSTadmin-products-store');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-products-store"
                    onclick="cancelTryOut('POSTadmin-products-store');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-products-store"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/products/store</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-products-store"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-products-store"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="POSTadmin-products-store"
               value=""
               data-component="body">
    <br>
<p>Must match an existing stored value.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTadmin-products-store"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Base catalog specifications (Required if creating a new global product). This field is required when <code>product_id</code> is not present. Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category_id"                data-endpoint="POSTadmin-products-store"
               value=""
               data-component="body">
    <br>
<p>Must match an existing stored value.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brand_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brand_id"                data-endpoint="POSTadmin-products-store"
               value=""
               data-component="body">
    <br>
<p>Must match an existing stored value.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>unit</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="unit"                data-endpoint="POSTadmin-products-store"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>This field is required when <code>product_id</code> is not present. Must not be greater than 50 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTadmin-products-store"
               value="Dolores dolorum amet iste laborum eius est dolor."
               data-component="body">
    <br>
<p>Example: <code>Dolores dolorum amet iste laborum eius est dolor.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>video_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="video_url"                data-endpoint="POSTadmin-products-store"
               value="http://reynolds.com/"
               data-component="body">
    <br>
<p>Must be a valid URL. Example: <code>http://reynolds.com/</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>has_variants</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTadmin-products-store" style="display: none">
            <input type="radio" name="has_variants"
                   value="true"
                   data-endpoint="POSTadmin-products-store"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTadmin-products-store" style="display: none">
            <input type="radio" name="has_variants"
                   value="false"
                   data-endpoint="POSTadmin-products-store"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>catalog_image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="catalog_image"                data-endpoint="POSTadmin-products-store"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\Lenovo\AppData\Local\Temp\phpB4F8.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attributes</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="attributes"                data-endpoint="POSTadmin-products-store"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="price"                data-endpoint="POSTadmin-products-store"
               value=""
               data-component="body">
    <br>
<p>Local storefront parameters (Required if attached to a shop).</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>stock</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="stock"                data-endpoint="POSTadmin-products-store"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sale_price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="sale_price"                data-endpoint="POSTadmin-products-store"
               value="65"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>65</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>min_order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="min_order"                data-endpoint="POSTadmin-products-store"
               value="72"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>72</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>max_order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="max_order"                data-endpoint="POSTadmin-products-store"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_available</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTadmin-products-store" style="display: none">
            <input type="radio" name="is_available"
                   value="true"
                   data-endpoint="POSTadmin-products-store"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTadmin-products-store" style="display: none">
            <input type="radio" name="is_available"
                   value="false"
                   data-endpoint="POSTadmin-products-store"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sale_start</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sale_start"                data-endpoint="POSTadmin-products-store"
               value="2026-08-06T02:51:10"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-08-06T02:51:10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sale_end</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sale_end"                data-endpoint="POSTadmin-products-store"
               value="2107-09-04"
               data-component="body">
    <br>
<p>This field is required when <code>sale_start</code> is present. Must be a valid date. Must be a date after <code>sale_start</code>. Example: <code>2107-09-04</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>local_image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="local_image"                data-endpoint="POSTadmin-products-store"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\Lenovo\AppData\Local\Temp\phpB4F9.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETadmin-products-all">GET admin/products/all</h2>

<p>
</p>



<span id="example-requests-GETadmin-products-all">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/products/all" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/all"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-products-all">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-products-all" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-products-all"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-products-all"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-products-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-products-all">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-products-all" data-method="GET"
      data-path="admin/products/all"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-products-all', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-products-all"
                    onclick="tryItOut('GETadmin-products-all');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-products-all"
                    onclick="cancelTryOut('GETadmin-products-all');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-products-all"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/products/all</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-products-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-products-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-products-single--product_id-">GET admin/products/single/{product_id}</h2>

<p>
</p>



<span id="example-requests-GETadmin-products-single--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/products/single/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/single/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-products-single--product_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-products-single--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-products-single--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-products-single--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-products-single--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-products-single--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-products-single--product_id-" data-method="GET"
      data-path="admin/products/single/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-products-single--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-products-single--product_id-"
                    onclick="tryItOut('GETadmin-products-single--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-products-single--product_id-"
                    onclick="cancelTryOut('GETadmin-products-single--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-products-single--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/products/single/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-products-single--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-products-single--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="GETadmin-products-single--product_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTadmin-products-local--id-">PUT admin/products/local/{id}</h2>

<p>
</p>



<span id="example-requests-PUTadmin-products-local--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/admin/products/local/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/local/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTadmin-products-local--id-">
</span>
<span id="execution-results-PUTadmin-products-local--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTadmin-products-local--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTadmin-products-local--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTadmin-products-local--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTadmin-products-local--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTadmin-products-local--id-" data-method="PUT"
      data-path="admin/products/local/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTadmin-products-local--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTadmin-products-local--id-"
                    onclick="tryItOut('PUTadmin-products-local--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTadmin-products-local--id-"
                    onclick="cancelTryOut('PUTadmin-products-local--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTadmin-products-local--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>admin/products/local/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTadmin-products-local--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTadmin-products-local--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTadmin-products-local--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the local. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTadmin-products-local-image--product_id-">POST admin/products/local/image/{product_id}</h2>

<p>
</p>



<span id="example-requests-POSTadmin-products-local-image--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/products/local/image/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/local/image/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-products-local-image--product_id-">
</span>
<span id="execution-results-POSTadmin-products-local-image--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-products-local-image--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-products-local-image--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-products-local-image--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-products-local-image--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-products-local-image--product_id-" data-method="POST"
      data-path="admin/products/local/image/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-products-local-image--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-products-local-image--product_id-"
                    onclick="tryItOut('POSTadmin-products-local-image--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-products-local-image--product_id-"
                    onclick="cancelTryOut('POSTadmin-products-local-image--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-products-local-image--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/products/local/image/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-products-local-image--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-products-local-image--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="POSTadmin-products-local-image--product_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEadmin-products-local--product_id-">DELETE admin/products/local/{product_id}</h2>

<p>
</p>



<span id="example-requests-DELETEadmin-products-local--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/admin/products/local/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/local/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEadmin-products-local--product_id-">
</span>
<span id="execution-results-DELETEadmin-products-local--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEadmin-products-local--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEadmin-products-local--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEadmin-products-local--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEadmin-products-local--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEadmin-products-local--product_id-" data-method="DELETE"
      data-path="admin/products/local/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEadmin-products-local--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEadmin-products-local--product_id-"
                    onclick="tryItOut('DELETEadmin-products-local--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEadmin-products-local--product_id-"
                    onclick="cancelTryOut('DELETEadmin-products-local--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEadmin-products-local--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>admin/products/local/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEadmin-products-local--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEadmin-products-local--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="DELETEadmin-products-local--product_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEadmin-products-local-force-delete--product_id-">DELETE admin/products/local/force-delete/{product_id}</h2>

<p>
</p>



<span id="example-requests-DELETEadmin-products-local-force-delete--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/admin/products/local/force-delete/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/local/force-delete/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEadmin-products-local-force-delete--product_id-">
</span>
<span id="execution-results-DELETEadmin-products-local-force-delete--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEadmin-products-local-force-delete--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEadmin-products-local-force-delete--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEadmin-products-local-force-delete--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEadmin-products-local-force-delete--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEadmin-products-local-force-delete--product_id-" data-method="DELETE"
      data-path="admin/products/local/force-delete/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEadmin-products-local-force-delete--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEadmin-products-local-force-delete--product_id-"
                    onclick="tryItOut('DELETEadmin-products-local-force-delete--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEadmin-products-local-force-delete--product_id-"
                    onclick="cancelTryOut('DELETEadmin-products-local-force-delete--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEadmin-products-local-force-delete--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>admin/products/local/force-delete/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEadmin-products-local-force-delete--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEadmin-products-local-force-delete--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="DELETEadmin-products-local-force-delete--product_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTadmin-products-global--product_id-">PUT admin/products/global/{product_id}</h2>

<p>
</p>



<span id="example-requests-PUTadmin-products-global--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/admin/products/global/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/global/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTadmin-products-global--product_id-">
</span>
<span id="execution-results-PUTadmin-products-global--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTadmin-products-global--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTadmin-products-global--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTadmin-products-global--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTadmin-products-global--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTadmin-products-global--product_id-" data-method="PUT"
      data-path="admin/products/global/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTadmin-products-global--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTadmin-products-global--product_id-"
                    onclick="tryItOut('PUTadmin-products-global--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTadmin-products-global--product_id-"
                    onclick="cancelTryOut('PUTadmin-products-global--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTadmin-products-global--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>admin/products/global/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTadmin-products-global--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTadmin-products-global--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="PUTadmin-products-global--product_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTadmin-products-global-image--product_id-">POST admin/products/global/image/{product_id}</h2>

<p>
</p>



<span id="example-requests-POSTadmin-products-global-image--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/products/global/image/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/global/image/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmin-products-global-image--product_id-">
</span>
<span id="execution-results-POSTadmin-products-global-image--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-products-global-image--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-products-global-image--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTadmin-products-global-image--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-products-global-image--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTadmin-products-global-image--product_id-" data-method="POST"
      data-path="admin/products/global/image/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-products-global-image--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-products-global-image--product_id-"
                    onclick="tryItOut('POSTadmin-products-global-image--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-products-global-image--product_id-"
                    onclick="cancelTryOut('POSTadmin-products-global-image--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-products-global-image--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/products/global/image/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTadmin-products-global-image--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTadmin-products-global-image--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="POSTadmin-products-global-image--product_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEadmin-products-global--product_id-">DELETE admin/products/global/{product_id}</h2>

<p>
</p>



<span id="example-requests-DELETEadmin-products-global--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/admin/products/global/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/global/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEadmin-products-global--product_id-">
</span>
<span id="execution-results-DELETEadmin-products-global--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEadmin-products-global--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEadmin-products-global--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEadmin-products-global--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEadmin-products-global--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEadmin-products-global--product_id-" data-method="DELETE"
      data-path="admin/products/global/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEadmin-products-global--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEadmin-products-global--product_id-"
                    onclick="tryItOut('DELETEadmin-products-global--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEadmin-products-global--product_id-"
                    onclick="cancelTryOut('DELETEadmin-products-global--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEadmin-products-global--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>admin/products/global/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEadmin-products-global--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEadmin-products-global--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="DELETEadmin-products-global--product_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEadmin-products-global-force-delete--product_id-">DELETE admin/products/global/force-delete/{product_id}</h2>

<p>
</p>



<span id="example-requests-DELETEadmin-products-global-force-delete--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/admin/products/global/force-delete/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products/global/force-delete/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEadmin-products-global-force-delete--product_id-">
</span>
<span id="execution-results-DELETEadmin-products-global-force-delete--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEadmin-products-global-force-delete--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEadmin-products-global-force-delete--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEadmin-products-global-force-delete--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEadmin-products-global-force-delete--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEadmin-products-global-force-delete--product_id-" data-method="DELETE"
      data-path="admin/products/global/force-delete/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEadmin-products-global-force-delete--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEadmin-products-global-force-delete--product_id-"
                    onclick="tryItOut('DELETEadmin-products-global-force-delete--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEadmin-products-global-force-delete--product_id-"
                    onclick="cancelTryOut('DELETEadmin-products-global-force-delete--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEadmin-products-global-force-delete--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>admin/products/global/force-delete/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEadmin-products-global-force-delete--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEadmin-products-global-force-delete--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="DELETEadmin-products-global-force-delete--product_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETadmin-dashboard-index">Return admin overview &amp; shop contextual details for the logged-in admin.</h2>

<p>
</p>



<span id="example-requests-GETadmin-dashboard-index">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/dashboard/index" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/dashboard/index"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-dashboard-index">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-dashboard-index" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-dashboard-index"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-dashboard-index"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-dashboard-index" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-dashboard-index">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-dashboard-index" data-method="GET"
      data-path="admin/dashboard/index"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-dashboard-index', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-dashboard-index"
                    onclick="tryItOut('GETadmin-dashboard-index');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-dashboard-index"
                    onclick="cancelTryOut('GETadmin-dashboard-index');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-dashboard-index"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/dashboard/index</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-dashboard-index"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-dashboard-index"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETsuperadmin-super-dashboard">Show Superadmin Control Panel metrics.</h2>

<p>
</p>



<span id="example-requests-GETsuperadmin-super-dashboard">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/superadmin/super/dashboard" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/super/dashboard"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETsuperadmin-super-dashboard">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETsuperadmin-super-dashboard" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETsuperadmin-super-dashboard"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETsuperadmin-super-dashboard"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETsuperadmin-super-dashboard" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETsuperadmin-super-dashboard">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETsuperadmin-super-dashboard" data-method="GET"
      data-path="superadmin/super/dashboard"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETsuperadmin-super-dashboard', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETsuperadmin-super-dashboard"
                    onclick="tryItOut('GETsuperadmin-super-dashboard');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETsuperadmin-super-dashboard"
                    onclick="cancelTryOut('GETsuperadmin-super-dashboard');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETsuperadmin-super-dashboard"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>superadmin/super/dashboard</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETsuperadmin-super-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETsuperadmin-super-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETsuperadmin-list">GET superadmin/list</h2>

<p>
</p>



<span id="example-requests-GETsuperadmin-list">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/superadmin/list" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/list"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETsuperadmin-list">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETsuperadmin-list" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETsuperadmin-list"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETsuperadmin-list"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETsuperadmin-list" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETsuperadmin-list">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETsuperadmin-list" data-method="GET"
      data-path="superadmin/list"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETsuperadmin-list', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETsuperadmin-list"
                    onclick="tryItOut('GETsuperadmin-list');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETsuperadmin-list"
                    onclick="cancelTryOut('GETsuperadmin-list');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETsuperadmin-list"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>superadmin/list</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETsuperadmin-list"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETsuperadmin-list"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETsuperadmin-kyc-view--id---type-">GET superadmin/kyc/view/{id}/{type}</h2>

<p>
</p>



<span id="example-requests-GETsuperadmin-kyc-view--id---type-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/superadmin/kyc/view/consequatur/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/kyc/view/consequatur/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETsuperadmin-kyc-view--id---type-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETsuperadmin-kyc-view--id---type-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETsuperadmin-kyc-view--id---type-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETsuperadmin-kyc-view--id---type-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETsuperadmin-kyc-view--id---type-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETsuperadmin-kyc-view--id---type-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETsuperadmin-kyc-view--id---type-" data-method="GET"
      data-path="superadmin/kyc/view/{id}/{type}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETsuperadmin-kyc-view--id---type-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETsuperadmin-kyc-view--id---type-"
                    onclick="tryItOut('GETsuperadmin-kyc-view--id---type-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETsuperadmin-kyc-view--id---type-"
                    onclick="cancelTryOut('GETsuperadmin-kyc-view--id---type-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETsuperadmin-kyc-view--id---type-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>superadmin/kyc/view/{id}/{type}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETsuperadmin-kyc-view--id---type-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETsuperadmin-kyc-view--id---type-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETsuperadmin-kyc-view--id---type-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the view. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="GETsuperadmin-kyc-view--id---type-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTsuperadmin-kyc-change-status--id-">POST superadmin/kyc/change-status/{id}</h2>

<p>
</p>



<span id="example-requests-POSTsuperadmin-kyc-change-status--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/superadmin/kyc/change-status/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"verified\",
    \"reason\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/kyc/change-status/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "verified",
    "reason": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTsuperadmin-kyc-change-status--id-">
</span>
<span id="execution-results-POSTsuperadmin-kyc-change-status--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTsuperadmin-kyc-change-status--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTsuperadmin-kyc-change-status--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTsuperadmin-kyc-change-status--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTsuperadmin-kyc-change-status--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTsuperadmin-kyc-change-status--id-" data-method="POST"
      data-path="superadmin/kyc/change-status/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTsuperadmin-kyc-change-status--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTsuperadmin-kyc-change-status--id-"
                    onclick="tryItOut('POSTsuperadmin-kyc-change-status--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTsuperadmin-kyc-change-status--id-"
                    onclick="cancelTryOut('POSTsuperadmin-kyc-change-status--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTsuperadmin-kyc-change-status--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>superadmin/kyc/change-status/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTsuperadmin-kyc-change-status--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTsuperadmin-kyc-change-status--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTsuperadmin-kyc-change-status--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the change status. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTsuperadmin-kyc-change-status--id-"
               value="verified"
               data-component="body">
    <br>
<p>Example: <code>verified</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>verified</code></li> <li><code>rejected</code></li> <li><code>pending</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTsuperadmin-kyc-change-status--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>This field is required when <code>status</code> is <code>rejected</code>. Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTsuperadmin-change-status--id-">POST superadmin/change-status/{id}</h2>

<p>
</p>



<span id="example-requests-POSTsuperadmin-change-status--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/superadmin/change-status/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"pending\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/change-status/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "pending"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTsuperadmin-change-status--id-">
</span>
<span id="execution-results-POSTsuperadmin-change-status--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTsuperadmin-change-status--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTsuperadmin-change-status--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTsuperadmin-change-status--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTsuperadmin-change-status--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTsuperadmin-change-status--id-" data-method="POST"
      data-path="superadmin/change-status/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTsuperadmin-change-status--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTsuperadmin-change-status--id-"
                    onclick="tryItOut('POSTsuperadmin-change-status--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTsuperadmin-change-status--id-"
                    onclick="cancelTryOut('POSTsuperadmin-change-status--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTsuperadmin-change-status--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>superadmin/change-status/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTsuperadmin-change-status--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTsuperadmin-change-status--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTsuperadmin-change-status--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the change status. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTsuperadmin-change-status--id-"
               value="pending"
               data-component="body">
    <br>
<p>Example: <code>pending</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>active</code></li> <li><code>pending</code></li> <li><code>suspended</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEsuperadmin-delete--id-">DELETE superadmin/delete/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEsuperadmin-delete--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/superadmin/delete/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/delete/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEsuperadmin-delete--id-">
</span>
<span id="execution-results-DELETEsuperadmin-delete--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEsuperadmin-delete--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEsuperadmin-delete--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEsuperadmin-delete--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEsuperadmin-delete--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEsuperadmin-delete--id-" data-method="DELETE"
      data-path="superadmin/delete/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEsuperadmin-delete--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEsuperadmin-delete--id-"
                    onclick="tryItOut('DELETEsuperadmin-delete--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEsuperadmin-delete--id-"
                    onclick="cancelTryOut('DELETEsuperadmin-delete--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEsuperadmin-delete--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>superadmin/delete/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEsuperadmin-delete--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEsuperadmin-delete--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEsuperadmin-delete--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the delete. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEsuperadmin-force-delete--id-">DELETE superadmin/force-delete/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEsuperadmin-force-delete--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/superadmin/force-delete/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/force-delete/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEsuperadmin-force-delete--id-">
</span>
<span id="execution-results-DELETEsuperadmin-force-delete--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEsuperadmin-force-delete--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEsuperadmin-force-delete--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEsuperadmin-force-delete--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEsuperadmin-force-delete--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEsuperadmin-force-delete--id-" data-method="DELETE"
      data-path="superadmin/force-delete/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEsuperadmin-force-delete--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEsuperadmin-force-delete--id-"
                    onclick="tryItOut('DELETEsuperadmin-force-delete--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEsuperadmin-force-delete--id-"
                    onclick="cancelTryOut('DELETEsuperadmin-force-delete--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEsuperadmin-force-delete--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>superadmin/force-delete/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEsuperadmin-force-delete--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEsuperadmin-force-delete--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEsuperadmin-force-delete--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the force delete. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTsuperadmin-restore--id-">POST superadmin/restore/{id}</h2>

<p>
</p>



<span id="example-requests-POSTsuperadmin-restore--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/superadmin/restore/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/restore/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTsuperadmin-restore--id-">
</span>
<span id="execution-results-POSTsuperadmin-restore--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTsuperadmin-restore--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTsuperadmin-restore--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTsuperadmin-restore--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTsuperadmin-restore--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTsuperadmin-restore--id-" data-method="POST"
      data-path="superadmin/restore/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTsuperadmin-restore--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTsuperadmin-restore--id-"
                    onclick="tryItOut('POSTsuperadmin-restore--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTsuperadmin-restore--id-"
                    onclick="cancelTryOut('POSTsuperadmin-restore--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTsuperadmin-restore--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>superadmin/restore/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTsuperadmin-restore--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTsuperadmin-restore--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTsuperadmin-restore--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the restore. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PATCHsuperadmin-payout-requests--id--status">Update payout request status (Superadmin Action).</h2>

<p>
</p>



<span id="example-requests-PATCHsuperadmin-payout-requests--id--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/superadmin/payout-requests/consequatur/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"approved\",
    \"admin_note\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/payout-requests/consequatur/status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "approved",
    "admin_note": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHsuperadmin-payout-requests--id--status">
</span>
<span id="execution-results-PATCHsuperadmin-payout-requests--id--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHsuperadmin-payout-requests--id--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHsuperadmin-payout-requests--id--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHsuperadmin-payout-requests--id--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHsuperadmin-payout-requests--id--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHsuperadmin-payout-requests--id--status" data-method="PATCH"
      data-path="superadmin/payout-requests/{id}/status"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHsuperadmin-payout-requests--id--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHsuperadmin-payout-requests--id--status"
                    onclick="tryItOut('PATCHsuperadmin-payout-requests--id--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHsuperadmin-payout-requests--id--status"
                    onclick="cancelTryOut('PATCHsuperadmin-payout-requests--id--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHsuperadmin-payout-requests--id--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>superadmin/payout-requests/{id}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHsuperadmin-payout-requests--id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHsuperadmin-payout-requests--id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PATCHsuperadmin-payout-requests--id--status"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the payout request. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PATCHsuperadmin-payout-requests--id--status"
               value="approved"
               data-component="body">
    <br>
<p>Example: <code>approved</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>approved</code></li> <li><code>rejected</code></li> <li><code>completed</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>admin_note</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="admin_note"                data-endpoint="PATCHsuperadmin-payout-requests--id--status"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETsuperadmin-payouts">List payout requests.</h2>

<p>
</p>

<ul>
<li>Vendors: See only payouts for their active shop (via HasShopScope).</li>
<li>Superadmin: Sees all payouts across the platform (or filtered by status).</li>
</ul>

<span id="example-requests-GETsuperadmin-payouts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/superadmin/payouts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/payouts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETsuperadmin-payouts">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETsuperadmin-payouts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETsuperadmin-payouts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETsuperadmin-payouts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETsuperadmin-payouts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETsuperadmin-payouts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETsuperadmin-payouts" data-method="GET"
      data-path="superadmin/payouts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETsuperadmin-payouts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETsuperadmin-payouts"
                    onclick="tryItOut('GETsuperadmin-payouts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETsuperadmin-payouts"
                    onclick="cancelTryOut('GETsuperadmin-payouts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETsuperadmin-payouts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>superadmin/payouts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETsuperadmin-payouts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETsuperadmin-payouts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETsuperadmin-category-requests">GET superadmin/category-requests</h2>

<p>
</p>



<span id="example-requests-GETsuperadmin-category-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/superadmin/category-requests" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/category-requests"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETsuperadmin-category-requests">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETsuperadmin-category-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETsuperadmin-category-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETsuperadmin-category-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETsuperadmin-category-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETsuperadmin-category-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETsuperadmin-category-requests" data-method="GET"
      data-path="superadmin/category-requests"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETsuperadmin-category-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETsuperadmin-category-requests"
                    onclick="tryItOut('GETsuperadmin-category-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETsuperadmin-category-requests"
                    onclick="cancelTryOut('GETsuperadmin-category-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETsuperadmin-category-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>superadmin/category-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETsuperadmin-category-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETsuperadmin-category-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTsuperadmin-category-requests-approve--id-">POST superadmin/category-requests/approve/{id}</h2>

<p>
</p>



<span id="example-requests-POSTsuperadmin-category-requests-approve--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/superadmin/category-requests/approve/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\",
    \"commission_rate\": 1,
    \"admin_note\": \"mniihfqcoynlazghdtqtq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/category-requests/approve/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq",
    "commission_rate": 1,
    "admin_note": "mniihfqcoynlazghdtqtq"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTsuperadmin-category-requests-approve--id-">
</span>
<span id="execution-results-POSTsuperadmin-category-requests-approve--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTsuperadmin-category-requests-approve--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTsuperadmin-category-requests-approve--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTsuperadmin-category-requests-approve--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTsuperadmin-category-requests-approve--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTsuperadmin-category-requests-approve--id-" data-method="POST"
      data-path="superadmin/category-requests/approve/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTsuperadmin-category-requests-approve--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTsuperadmin-category-requests-approve--id-"
                    onclick="tryItOut('POSTsuperadmin-category-requests-approve--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTsuperadmin-category-requests-approve--id-"
                    onclick="cancelTryOut('POSTsuperadmin-category-requests-approve--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTsuperadmin-category-requests-approve--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>superadmin/category-requests/approve/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTsuperadmin-category-requests-approve--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTsuperadmin-category-requests-approve--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTsuperadmin-category-requests-approve--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the approve. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTsuperadmin-category-requests-approve--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="parent_id"                data-endpoint="POSTsuperadmin-category-requests-approve--id-"
               value=""
               data-component="body">
    <br>
<p>Must match an existing stored value.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>commission_rate</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="commission_rate"                data-endpoint="POSTsuperadmin-category-requests-approve--id-"
               value="1"
               data-component="body">
    <br>
<p>Must be at least 0. Must not be greater than 100. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>admin_note</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="admin_note"                data-endpoint="POSTsuperadmin-category-requests-approve--id-"
               value="mniihfqcoynlazghdtqtq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>mniihfqcoynlazghdtqtq</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTsuperadmin-category-requests-reject--id-">POST superadmin/category-requests/reject/{id}</h2>

<p>
</p>



<span id="example-requests-POSTsuperadmin-category-requests-reject--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/superadmin/category-requests/reject/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"admin_note\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/category-requests/reject/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "admin_note": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTsuperadmin-category-requests-reject--id-">
</span>
<span id="execution-results-POSTsuperadmin-category-requests-reject--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTsuperadmin-category-requests-reject--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTsuperadmin-category-requests-reject--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTsuperadmin-category-requests-reject--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTsuperadmin-category-requests-reject--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTsuperadmin-category-requests-reject--id-" data-method="POST"
      data-path="superadmin/category-requests/reject/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTsuperadmin-category-requests-reject--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTsuperadmin-category-requests-reject--id-"
                    onclick="tryItOut('POSTsuperadmin-category-requests-reject--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTsuperadmin-category-requests-reject--id-"
                    onclick="cancelTryOut('POSTsuperadmin-category-requests-reject--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTsuperadmin-category-requests-reject--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>superadmin/category-requests/reject/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTsuperadmin-category-requests-reject--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTsuperadmin-category-requests-reject--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTsuperadmin-category-requests-reject--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the reject. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>admin_note</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="admin_note"                data-endpoint="POSTsuperadmin-category-requests-reject--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETsuperadmin-categories">GET superadmin/categories</h2>

<p>
</p>



<span id="example-requests-GETsuperadmin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/superadmin/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETsuperadmin-categories">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETsuperadmin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETsuperadmin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETsuperadmin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETsuperadmin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETsuperadmin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETsuperadmin-categories" data-method="GET"
      data-path="superadmin/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETsuperadmin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETsuperadmin-categories"
                    onclick="tryItOut('GETsuperadmin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETsuperadmin-categories"
                    onclick="cancelTryOut('GETsuperadmin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETsuperadmin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>superadmin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETsuperadmin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETsuperadmin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTsuperadmin-categories">POST superadmin/categories</h2>

<p>
</p>



<span id="example-requests-POSTsuperadmin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/superadmin/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTsuperadmin-categories">
</span>
<span id="execution-results-POSTsuperadmin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTsuperadmin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTsuperadmin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTsuperadmin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTsuperadmin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTsuperadmin-categories" data-method="POST"
      data-path="superadmin/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTsuperadmin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTsuperadmin-categories"
                    onclick="tryItOut('POSTsuperadmin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTsuperadmin-categories"
                    onclick="cancelTryOut('POSTsuperadmin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTsuperadmin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>superadmin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTsuperadmin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTsuperadmin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETsuperadmin-categories--category_id-">GET superadmin/categories/{category_id}</h2>

<p>
</p>



<span id="example-requests-GETsuperadmin-categories--category_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/superadmin/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETsuperadmin-categories--category_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETsuperadmin-categories--category_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETsuperadmin-categories--category_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETsuperadmin-categories--category_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETsuperadmin-categories--category_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETsuperadmin-categories--category_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETsuperadmin-categories--category_id-" data-method="GET"
      data-path="superadmin/categories/{category_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETsuperadmin-categories--category_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETsuperadmin-categories--category_id-"
                    onclick="tryItOut('GETsuperadmin-categories--category_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETsuperadmin-categories--category_id-"
                    onclick="cancelTryOut('GETsuperadmin-categories--category_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETsuperadmin-categories--category_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>superadmin/categories/{category_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETsuperadmin-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETsuperadmin-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="GETsuperadmin-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTsuperadmin-categories--category_id-">PUT superadmin/categories/{category_id}</h2>

<p>
</p>



<span id="example-requests-PUTsuperadmin-categories--category_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/superadmin/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTsuperadmin-categories--category_id-">
</span>
<span id="execution-results-PUTsuperadmin-categories--category_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTsuperadmin-categories--category_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTsuperadmin-categories--category_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTsuperadmin-categories--category_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTsuperadmin-categories--category_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTsuperadmin-categories--category_id-" data-method="PUT"
      data-path="superadmin/categories/{category_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTsuperadmin-categories--category_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTsuperadmin-categories--category_id-"
                    onclick="tryItOut('PUTsuperadmin-categories--category_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTsuperadmin-categories--category_id-"
                    onclick="cancelTryOut('PUTsuperadmin-categories--category_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTsuperadmin-categories--category_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>superadmin/categories/{category_id}</code></b>
        </p>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>superadmin/categories/{category_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTsuperadmin-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTsuperadmin-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="PUTsuperadmin-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEsuperadmin-categories--category_id-">DELETE superadmin/categories/{category_id}</h2>

<p>
</p>



<span id="example-requests-DELETEsuperadmin-categories--category_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/superadmin/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/superadmin/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEsuperadmin-categories--category_id-">
</span>
<span id="execution-results-DELETEsuperadmin-categories--category_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEsuperadmin-categories--category_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEsuperadmin-categories--category_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEsuperadmin-categories--category_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEsuperadmin-categories--category_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEsuperadmin-categories--category_id-" data-method="DELETE"
      data-path="superadmin/categories/{category_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEsuperadmin-categories--category_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEsuperadmin-categories--category_id-"
                    onclick="tryItOut('DELETEsuperadmin-categories--category_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEsuperadmin-categories--category_id-"
                    onclick="cancelTryOut('DELETEsuperadmin-categories--category_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEsuperadmin-categories--category_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>superadmin/categories/{category_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEsuperadmin-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEsuperadmin-categories--category_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="DELETEsuperadmin-categories--category_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTpayments-esewa-initiate">Initiate eSewa Payment for an unpaid order.</h2>

<p>
</p>

<p>POST /api/payments/esewa/initiate</p>

<span id="example-requests-POSTpayments-esewa-initiate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/payments/esewa/initiate" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"order_id\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/payments/esewa/initiate"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "order_id": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpayments-esewa-initiate">
</span>
<span id="execution-results-POSTpayments-esewa-initiate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpayments-esewa-initiate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpayments-esewa-initiate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTpayments-esewa-initiate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpayments-esewa-initiate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTpayments-esewa-initiate" data-method="POST"
      data-path="payments/esewa/initiate"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpayments-esewa-initiate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpayments-esewa-initiate"
                    onclick="tryItOut('POSTpayments-esewa-initiate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpayments-esewa-initiate"
                    onclick="cancelTryOut('POSTpayments-esewa-initiate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpayments-esewa-initiate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>payments/esewa/initiate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTpayments-esewa-initiate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTpayments-esewa-initiate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_id"                data-endpoint="POSTpayments-esewa-initiate"
               value="consequatur"
               data-component="body">
    <br>
<p>Must match an existing stored value. Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETpayments-esewa-success">Handle eSewa Redirect Callback on Payment Success.</h2>

<p>
</p>

<p>GET /api/payments/esewa/success</p>

<span id="example-requests-GETpayments-esewa-success">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/payments/esewa/success" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/payments/esewa/success"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpayments-esewa-success">
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Invalid response payload from eSewa.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpayments-esewa-success" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpayments-esewa-success"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpayments-esewa-success"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpayments-esewa-success" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpayments-esewa-success">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpayments-esewa-success" data-method="GET"
      data-path="payments/esewa/success"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpayments-esewa-success', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpayments-esewa-success"
                    onclick="tryItOut('GETpayments-esewa-success');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpayments-esewa-success"
                    onclick="cancelTryOut('GETpayments-esewa-success');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpayments-esewa-success"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>payments/esewa/success</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpayments-esewa-success"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpayments-esewa-success"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETpayments-esewa-failure">Handle eSewa Redirect Callback on Payment Failure/Cancellation.</h2>

<p>
</p>

<p>GET /api/payments/esewa/failure</p>

<span id="example-requests-GETpayments-esewa-failure">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/payments/esewa/failure" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/payments/esewa/failure"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpayments-esewa-failure">
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Payment failed or was cancelled by user.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpayments-esewa-failure" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpayments-esewa-failure"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpayments-esewa-failure"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpayments-esewa-failure" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpayments-esewa-failure">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpayments-esewa-failure" data-method="GET"
      data-path="payments/esewa/failure"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpayments-esewa-failure', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpayments-esewa-failure"
                    onclick="tryItOut('GETpayments-esewa-failure');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpayments-esewa-failure"
                    onclick="cancelTryOut('GETpayments-esewa-failure');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpayments-esewa-failure"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>payments/esewa/failure</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpayments-esewa-failure"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpayments-esewa-failure"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
