<!-- menu shadow -->
<div class="menu-shadow hidden"></div>
<!-- vertical-menu -->
<aside class="vertical-menu">
    <div class="vertical-content" :class="[$store.app.semiDark && 'semi-dark']">
        <!-- Menu Logo -->
        <div id="brand-logo" class="tw-brand-logo">
            <a href="/index.html" class="flex items-center">
                <svg class="tw-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 102.66 120.85">
                    <path class="twl-path"
                        d="M102.66,43.16h0v34.34c0,23.93-19.43,43.35-43.35,43.35h0v-34.34c0-23.93,19.43-43.35,43.35-43.35Z" />

                    <path class="twl-path"
                        d="M23.43,24.86h49.72c0,26.65-21.64,48.29-48.29,48.29H-24.86C-24.86,46.5-3.22,24.86,23.43,24.86Z"
                        transform="translate(73.14 24.86) rotate(90)" />
                    <circle class="twl-circle" cx="75.7" cy="20.66" r="16.39"
                        transform="translate(38.08 89.53) rotate(-76.62)" />
                </svg>
                <div class="app-name">Lara <span class="text-primary">SHOP</span></div>
            </a>
            <button type="button" class="toggle-sidebar">
                <span class="icon-[mdi--radiobox-marked] hidden lg:block"></span>
                <span class="icon-[mdi--close] lg:hidden"></span>
            </button>
        </div>
        <!-- Menu Content -->
        <nav data-simplebar class="tw-menu-content no-scrollbar">
            <ul class="tw-nav-menu">
                <!-- dashboard start -->
                <li class="tw-menu-item">
                    <button type="button" data-ripple class="tw-menu-link group">
                        <span class="icon-[mdi--square-rounded-badge-outline]"></span>
                        <span class="tw-link-label">Dashboard</span>
                        <span class="tw-arrow icon-[mdi--chevron-down]"></span>
                    </button>

                    <ul class="tw-dropdown-menu">
                        <li class="tw-dropdown-item group">
                            <a href="/index.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Sales</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/dashboard-crypto.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Crypto</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/dashboard-crm.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">CRM</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/dashboard-hrm.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">HRM</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/dashboard-analytics.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Analytics</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/dashboard-ecommerce.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">ECommerce</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- dashboard end -->

                <!-- page header -->
                <li class="tw-menu-header">
                    <span class="minus icon-[mdi--minus]"></span>
                    <span class="label">Sales & Distribution</span>
                </li>

                <li class="tw-menu-item">
                    <a href="{{ route('order.manage') }}" class="tw-menu-link">
                        <span class="icon-[mdi--shape-outline]"></span>
                        <span class="tw-link-label">Local Sales</span>
                    </a>
                </li>

                <li class="tw-menu-item">
                    <a href="{{ route('products.index') }}" class="tw-menu-link">
                        <span class="icon-[mdi--shape-outline]"></span>
                        <span class="tw-link-label">Products</span>
                    </a>
                </li>

                <li class="tw-menu-item">
                    <a href="{{ route('categories.index') }}" class="tw-menu-link">
                        <span class="icon-[mdi--shape-outline]"></span>
                        <span class="tw-link-label">Categories</span>
                    </a>
                </li>


                <!-- components start -->
                <li class="tw-menu-item">
                    <button type="button" data-ripple class="tw-menu-link group">
                        <span class="icon-[mdi--layers-outline]"></span>
                        <span class="tw-link-label">Components</span>
                        <span class="tw-arrow icon-[mdi--chevron-down]"></span>
                    </button>

                    <ul class="tw-dropdown-menu">
                        <li class="tw-dropdown-item group">
                            <a href="/components-accordions.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Accordion</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/components-cards.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Cards</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/components-carousel.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Carousel</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/components-lightbox.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Lightbox</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/components-modals.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Modals</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/components-progress.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Progress</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/components-sweetalert.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">SweetAlert2</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/components-tabs.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Tabs</span>
                            </a>
                        </li>
                        <li class="tw-dropdown-item group">
                            <a href="/components-toasts.html" class="tw-dropdown-link">
                                <span class="menu-bullet-dot"></span>
                                <span class="tw-link-label">Toasts</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- documentation -->
                <li>
                    <div class="documents-button">
                        <a href="https://twilightui-docs.vercel.app" target="_blank" class="documents-link">
                            <span class="icon-[mdi--text-box-search-outline]">description</span>
                            <span class="btn-label ml-2">Documentation</span>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</aside>
