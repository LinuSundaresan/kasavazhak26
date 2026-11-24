@php
    $themeColor = !empty($settings->theme_color) ? $settings->theme_color : '#0088cc';
    $headerBgColor = !empty($settings->header_bg_color) ? $settings->header_bg_color : '#0088cc';
    $headerTextColor = !empty($settings->header_text_color) ? $settings->header_text_color : '#ffffff';
    $footerBgColor = !empty($settings->footer_bg_color) ? $settings->footer_bg_color : '#0b2c3d';
    $footerTextColor = !empty($settings->footer_text_color) ? $settings->footer_text_color : '#ffffff';
    $footerBottomColor = !empty($settings->footer_bottom_color) ? $settings->footer_bottom_color : '#0088cc';
    $buttonColor = !empty($settings->button_color) ? $settings->button_color : '#0088cc';
    $buttonTextColor = !empty($settings->button_text_color) ? $settings->button_text_color : '#ffffff';
    $buttonHoverColor = !empty($settings->button_hover_color) ? $settings->button_hover_color : '#02527a';
@endphp

<style>
:root {
    --site-theme-color: {{ $themeColor }};
    --site-header-bg: {{ $headerBgColor }};
    --site-header-text: {{ $headerTextColor }};
    --site-footer-bg: {{ $footerBgColor }};
    --site-footer-text: {{ $footerTextColor }};
    --site-footer-bottom: {{ $footerBottomColor }};
    --site-btn-bg: {{ $buttonColor }};
    --site-btn-text: {{ $buttonTextColor }};
    --site-btn-hover: {{ $buttonHoverColor }};
}

/* ==========================================================
   1. SITE THEME & PRIMARY ACCENT COLORS
   ========================================================== */
/* Category bar & category toggle */
.wsus_menu_category_bar {
    background: {{ $themeColor }} !important;
}

/* Main Navigation link hover & active state */
.wsus__menu_item > li:hover > a,
.wsus__menu_item li a.active {
    color: {{ $themeColor }} !important;
}

/* Category dropdown item hover */
.wsus_menu_cat_item > li:hover > a,
.wsus_menu_cat_item li:hover .wsus__droap_arrow::after,
.wsus_menu_cat_droapdown li a:hover,
.wsus__sub_category li a:hover {
    color: {{ $themeColor }} !important;
}

/* Scroll-to-top floating button */
.wsus__scroll_btn {
    background: {{ $themeColor }} !important;
}

/* Outline / See button */
.see_btn {
    color: {{ $themeColor }} !important;
}
.see_btn:hover {
    background: {{ $themeColor }} !important;
    color: #ffffff !important;
    border-color: {{ $themeColor }} !important;
}

/* Badges & Counters */
.wsus__icon_area li a span,
#wishlist_count,
#cart-count {
    background: {{ $themeColor }} !important;
    color: #ffffff !important;
}

.wsus__hot_deals__single_img .hot_deals__discount,
.wsus__single_banner_text .shop_btn {
    background: {{ $themeColor }} !important;
}

/* Pagination */
.page-item.active .page-link {
    background-color: {{ $themeColor }} !important;
    border-color: {{ $themeColor }} !important;
    color: #ffffff !important;
}
.page-link:hover {
    color: {{ $themeColor }} !important;
}

/* Tabs & Pills */
.nav-pills .nav-link.active,
.nav-pills .show > .nav-link,
.wsus__tab .nav-link.active {
    background-color: {{ $themeColor }} !important;
    color: #ffffff !important;
}
.wsus__tab .nav-link:hover {
    color: {{ $themeColor }} !important;
}

/* Flash Countdown Boxes */
.wsus__flash_coundown,
.simply-section {
    background: {{ $themeColor }} !important;
}

/* Price Ranger slider */
.ranger_slider .ui-slider-range,
.ui-slider-range {
    background: {{ $themeColor }} !important;
}
.ranger_slider .ui-slider-handle,
.ui-slider-handle {
    border-color: {{ $themeColor }} !important;
}

/* Product item hover & names */
.wsus__pro_name:hover,
.wsus__pro_details_text h4 a:hover,
.wsus__cart_text a:hover,
.wsus__single_blog_text a:hover,
.wsus__mini_cart .wsus__cart_text a:hover {
    color: {{ $themeColor }} !important;
}

/* Buy now / Product Details button */
.wsus__pro_details_text .buy_now {
    background: {{ $themeColor }} !important;
    color: #ffffff !important;
}
.wsus__pro_details_text .buy_now:hover {
    background: {{ $buttonHoverColor }} !important;
    color: #ffffff !important;
}

/* Slider dots */
.slick-dots li.slick-active button {
    background: {{ $themeColor }} !important;
}

/* Form focus border */
.form-control:focus,
input:focus,
textarea:focus,
select:focus {
    border-color: {{ $themeColor }} !important;
    box-shadow: 0 0 0 0.2rem {{ $themeColor }}33 !important;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: {{ $themeColor }} !important;
    color: #ffffff !important;
}

/* User Dashboard Accents */
.wsus__dashboard_menu {
    background: {{ $headerBgColor }} !important;
}
.dashboard_sidebar li a.active,
.dashboard_sidebar li a:hover {
    background: {{ $themeColor }} !important;
    color: #ffffff !important;
}

/* ==========================================================
   2. HEADER & TOPBAR COLORS
   ========================================================== */
header,
header.wsus__header,
header.wsus__header_2,
#wsus__topbar {
    background: {{ $headerBgColor }} !important;
}

/* Header text and icons */
.wsus__call,
.wsus__call i,
.wsus__call_text p,
.wsus__call_text a,
.wsus__icon_area li a,
.wsus__icon_area li a i,
.wsus__mobile_menu_icon,
.wsus__mobile_menu_icon i,
.wsus__topbar_left li,
.wsus__topbar_left li a,
.wsus__topbar_right li,
.wsus__topbar_right li a {
    color: {{ $headerTextColor }} !important;
}

/* Search input button */
.wsus__search button {
    color: {{ $headerBgColor }} !important;
}
.wsus__search button:hover {
    background: {{ $themeColor }} !important;
    color: #ffffff !important;
}

/* Mobile header background override (responsive) */
@media (max-width: 991px) {
    header {
        background: {{ $headerBgColor }} !important;
    }
}

/* ==========================================================
   3. FOOTER COLORS
   ========================================================== */
/* Main Footer Background */
.footer_2,
footer.footer_2,
footer {
    background: {{ $footerBgColor }} !important;
}

/* Footer Headings, Text, Paragraphs, and Links */
.footer_2 .wsus__footer_content h5,
.footer_2 .wsus__footer_content p,
.footer_2 .wsus__footer_menu li a,
.footer_2 .wsus__footer_content .action,
.wsus__footer_content_2 h3,
.footer_payment p {
    color: {{ $footerTextColor }} !important;
}

/* Footer section divider line */
.footer_2 .wsus__footer_content h5 {
    border-bottom: 2px solid {{ $footerTextColor }}40 !important;
}

/* Footer Link hover */
.footer_2 .wsus__footer_menu li a:hover,
.footer_2 .wsus__footer_content .action:hover {
    color: {{ $themeColor }} !important;
}

/* Footer Social Icons */
.footer_2 .wsus__footer_social li a {
    color: {{ $footerTextColor }} !important;
    background: rgba(255, 255, 255, 0.12) !important;
}
.footer_2 .wsus__footer_social li a:hover {
    background: {{ $themeColor }} !important;
    color: #ffffff !important;
}

/* Footer Bottom / Copyright Bar */
.wsus__footer_bottom {
    background: {{ $footerBottomColor }} !important;
}
.wsus__footer_bottom p,
.wsus__copyright p {
    color: {{ $footerTextColor }} !important;
}

/* ==========================================================
   4. BUTTON COLORS (Buttons, Cart, Modals, Forms)
   ========================================================== */
/* Primary Buttons */
.common_btn,
.add_cart,
.subscribe_btn,
.footer_2 form button,
.wsus__invoice_btn,
.wsus__login_form button[type="submit"],
.wsus__checkout_form button[type="submit"] {
    background: {{ $buttonColor }} !important;
    color: {{ $buttonTextColor }} !important;
    border-color: {{ $buttonColor }} !important;
}

.common_btn *,
.add_cart *,
.subscribe_btn * {
    color: {{ $buttonTextColor }} !important;
}

/* Button Hover State */
.common_btn:hover,
.add_cart:hover,
.subscribe_btn:hover,
.footer_2 form button:hover,
.shop_btn:hover,
.wsus__invoice_btn:hover,
.wsus__login_form button[type="submit"]:hover,
.wsus__checkout_form button[type="submit"]:hover {
    background: {{ $buttonHoverColor }} !important;
    color: {{ $buttonTextColor }} !important;
    border-color: {{ $buttonHoverColor }} !important;
}

/* Mini Cart & Modal Buttons */
.wsus__minicart_btn_area .common_btn,
.product-modal-content .common_btn {
    background: {{ $buttonColor }} !important;
    color: {{ $buttonTextColor }} !important;
}
.wsus__minicart_btn_area .common_btn:hover,
.product-modal-content .common_btn:hover {
    background: {{ $buttonHoverColor }} !important;
    color: {{ $buttonTextColor }} !important;
}
</style>
