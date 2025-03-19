/**
 * PrimeDash
 * @version 1.0.0
 * @description A simple UI framework for building beautiful responsive websites and web apps.
 * @license MIT
 * @see https://draftscripts.com/
 */

/**
 * Core Dependencies
 */
import 'preline/preline';
import 'simplebar';

// Alpine & Plugins
import persist from '@alpinejs/persist';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.plugin(persist);
// You will need a ResizeObserver polyfill for browsers that don't support it! (iOS Safari, Edge, ...)
import ResizeObserver from 'resize-observer-polyfill';
window.ResizeObserver = ResizeObserver;

// initialize quill editor
import Quill from 'quill';
window.Quill = Quill;

(function () {
    // set current year in footer
    const yearEle = document.querySelector('#footer-year');
    if (yearEle) {
        yearEle.innerHTML = `© 2023 - ${new Date().getFullYear()}`;
    }

    // screen loader
    const loading = document.querySelector('.loading');
    loading?.remove();

    // vertical menu active
    let currentPath = window.location.href;
    const menuItem = document.querySelector(`.tw-nav-menu a[href="${currentPath}"]`);

    if (menuItem) {
        // Add 'active' class to the selected menu item
        menuItem.classList.add('active');
        const targetElement = menuItem.closest('.twd--menu')?.closest('.tw-menu-item')?.querySelector('.tw-menu-link');

        if (targetElement) {
            targetElement.parentElement.classList.add('active');
            targetElement.nextElementSibling.style.display = 'block';
        }

        let parentMenu = menuItem.closest('.twd--menu-item.hs-accordion');

        while (parentMenu) {
            // Find the associated accordion toggle button
            const toggleButton = parentMenu.querySelector('.hs-accordion-toggle');
            const submenu = parentMenu.querySelector('.hs-accordion-content');

            if (toggleButton) {
                // Add 'active' class to the parent accordion button
                toggleButton.classList.add('active');
                parentMenu.classList.add('active');
            }

            if (submenu) {
                submenu.style.display = 'block';
            }
            // Move up to the next parent accordion if present
            parentMenu = parentMenu.closest('.twd--menu-item.hs-accordion')?.parentElement.closest('.hs-accordion');
        }
    }

    // for scroll sidebar menu
    const content = document.querySelector('.tw-nav-menu');
    const activeMenu = content?.querySelector('.tw-menu-link.active');
    const activeSubmenu = content?.querySelector('.twd--link.active');
    if (activeSubmenu) {
        activeSubmenu.scrollIntoView({ block: 'center', behavior: 'smooth' });
    } else if (activeMenu) {
        activeMenu.scrollIntoView({ block: 'center', behavior: 'smooth' });
    }

    const verticalMenu = document.querySelector('.vertical-menu');
    window.addEventListener('resize', () => {
        if (window.innerWidth < 1024) {
            verticalMenu.classList.remove('collapsed');
        } else {
            verticalMenu.classList.remove('expanded');
        }
    });
    // window scroll
    window.addEventListener('scroll', () => {
        const header = document.querySelector('.navbar-nav');
        if (!header) return;
        if (document.documentElement.scrollTop > 0) {
            // add class to header
            header.classList.add('scrollable');
        } else {
            // remove class from header
            header.classList.remove('scrollable');
        }
    });

    // theme config
    const initialize = {
        locale: 'en', // en, da, de, el, es, fr, hu, it, ja, pl, pt, ru, sv, tr, zh
        theme: 'light', // light, dark, system
        themeVariant: 'default',
        rtlClass: 'ltr', // rtl, ltr
        menu: 'vertical', // vertical, horizontal, collapsible
        layout: 'full', // full, boxed-layout
        animation: 'animate__fadeIn', // animate__fadeIn, animate__fadeInDown, animate__fadeInUp, animate__fadeInLeft
        navbar: 'navbar-fixed', // navbar-static, navbar-fixed, navbar-hidden
        footer: 'footer-fixed', // footer-static, footer-fixed, footer-hidden
        semiDark: false,
        sidebar: false,
    };

    // theme config persist with alpine js store
    Alpine.store('app', {
        name: 'PrimeDash',
        // theme
        theme: Alpine.$persist(initialize.theme),
        toggleTheme(val) {
            let theme = val && val !== 'toggle' ? val : this.theme === 'dark' ? 'light' : 'dark';
            this.semiDark = !theme === 'light';
            this.theme = theme;
        },
        themeVariant: Alpine.$persist(initialize.themeVariant),
        setThemeVariant(value) {
            this.themeVariant = value;
        },
        // sidebar
        sidebar: Alpine.$persist(initialize.sidebar),
        toggleVMenu() {
            this.sidebar = !this.sidebar;
        },
        sidebarCollapsed: 'compact', // expanded, compact, collapsed
        collapsibleMenu() {
            console.log('collapsibleMenu');
        },

        // navigation menu
        menu: Alpine.$persist(initialize.menu),
        toggleMenu(val) {
            this.menu = val || this.menu || initialize.menu;
            const verticalMenu = document.querySelector('.vertical-menu');
            if (!verticalMenu) return;

            switch (this.menu) {
                case 'collapsible':
                    verticalMenu.classList.replace('expanded', 'collapsed');
                    break;
                case 'horizontal':
                    if (!window.location.pathname.includes('horizontal')) {
                        window.location.href = '/pages/layouts/horizontal.html';
                    }
                    break;
                default:
                    verticalMenu.classList.remove('collapsed');
            }
        },

        // layout
        layout: Alpine.$persist(initialize.layout),
        toggleLayout(val) {
            this.layout = val || this.layout || initialize.layout;
        },

        // rtl support
        rtlClass: Alpine.$persist(initialize.rtlClass),
        toggleRTL(val) {
            this.rtlClass = val || this.rtlClass || initialize.rtlClass; // rtl, ltr;
            this.setRTLLayout();
        },

        setRTLLayout() {
            const value = this.rtlClass || initialize.rtlClass;
            document.querySelector('html').setAttribute('dir', value);
        },

        // animation
        animation: Alpine.$persist(initialize.animation),
        toggleAnimation(val) {
            this.animation = val || this.animation || initialize.animation;
        },

        // navbar type
        navbar: Alpine.$persist(initialize.navbar),
        toggleNavbar(val) {
            this.navbar = val || this.navbar || initialize.navbar;
        },
        // footer type
        footer: Alpine.$persist(initialize.footer),
        toggleFooter(val) {
            this.footer = val || this.footer || initialize.footer;
        },

        // semi dark
        semiDark: Alpine.$persist(initialize.semiDark),
        toggleSemiDark() {
            console.log('toggleSemiDark');
        },
    });

    //? alpine data
    Alpine.data('themeConfig', () => ({
        fullscreen: false,
        init() {
            this.$store.app.setRTLLayout();
            if (this.$store.app.menu != 'horizontal') {
                this.$store.app.toggleMenu(this.$store.app.menu);
            }
            // if url is horizontal then change the layout
            if (!window.location.pathname.includes('horizontal') && this.$store.app.menu == 'horizontal') {
                this.$store.app.toggleMenu('vertical');
            } else if (window.location.pathname.includes('horizontal')) {
                this.$store.app.toggleMenu('horizontal');
            }
        },

        toggleSidebar() {
            if (window.innerWidth < 1024) {
                this.$refs.menuShadow.classList.toggle('hidden');
                this.$refs.verticalMenu.classList.toggle('expanded');
            } else {
                this.$refs.verticalMenu.classList.toggle('collapsed');
            }
        },
        hiddenSidebar() {
            this.$store.app.toggleVMenu();
            if (window.innerWidth < 1024) {
                this.toggleSidebar();
            }
        },
        toggleTheme(value) {
            this.$store.app.toggleTheme(value);
        },
        setThemeVariant(value) {
            this.$store.app.setThemeVariant(value);
        },
        getCurrentVariant(value) {
            const classMap = {
                default: {
                    active: 'bg-indigo-500 text-white',
                    inactive: 'bg-indigo-50 text-indigo-500',
                },
                amber: {
                    active: 'bg-amber-500 text-white',
                    inactive: 'bg-amber-50 text-amber-500',
                },
                rose: {
                    active: 'bg-rose-500 text-white',
                    inactive: 'bg-rose-50 text-rose-500',
                },
                purple: {
                    active: 'bg-purple-500 text-white',
                    inactive: 'bg-purple-50 text-purple-500',
                },
                sky: {
                    active: 'bg-sky-500 text-white',
                    inactive: 'bg-sky-50 text-sky-500',
                },
                teal: {
                    active: 'bg-teal-500 text-white',
                    inactive: 'bg-teal-50 text-teal-500',
                },
            };
            return this.$store.app.themeVariant == value ? classMap[value].active : classMap[value].inactive;
        },
        toggleFullscreen() {
            if (this.fullscreen) {
                document.exitFullscreen();
            } else {
                document.documentElement.requestFullscreen();
            }
            this.fullscreen = !this.fullscreen;
        },
        get appTheme() {
            return this.$store.app.theme;
        },
        get appConfig() {
            const app = this.$store.app;
            let theme = this.appTheme;
            if (theme == 'system') {
                theme = !!window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            return [app.sidebar && 'toggle-menu', theme, app.menu, app.layout, `theme-${app.themeVariant}`].filter(
                Boolean,
            );
        },
        get semiDarkMenu() {
            return this.$store.app.semiDark ? 'semi-dark' : '';
        },
        get navbarType() {
            return this.$store.app.navbar;
        },
        get footerType() {
            return this.$store.app.footer;
        },
        get fullScreenIcon() {
            return {
                'icon-[mdi--fullscreen]': this.$store.app.fullscreen == 'fullscreen',
                'icon-[mdi--fullscreen-exit]': this.$store.app.fullscreen !== 'fullscreen',
            };
        },
        get brightnessIcon() {
            return {
                'icon-[mdi--brightness-6]': this.appTheme === 'light',
                'icon-[mdi--brightness-2]': this.appTheme === 'dark',
                'icon-[mdi--brightness-auto]': this.appTheme === 'system',
            };
        },
        get themeIcon() {
            return this.appTheme == 'system' ? 'brightness_auto' : `${this.appTheme}_mode`;
        },
        get appName() {
            return 'Prime<span class="text-primary">Dash</span>';
        },
        get appLink() {
            return 'https://draftscripts.com/prime-dash';
        },
        get themeDocs() {
            return 'https://theme-docs.vercel.app';
        },
        get repoLink() {
            return 'https://github.com/kzamanbd/prime-dash';
        },
    }));

    // Editor initialization
    Alpine.data('editor', () => ({
        editor: null,
        init() {
            this.editor = new Quill('.quill-editor', {
                theme: 'snow',
                placeholder: 'Compose an epic...',
            });
            var toolbar = this.editor.container.previousSibling;
            toolbar.querySelector('.ql-picker').setAttribute('title', 'Font Size');
            toolbar.querySelector('button.ql-bold').setAttribute('title', 'Bold');
            toolbar.querySelector('button.ql-italic').setAttribute('title', 'Italic');
            toolbar.querySelector('button.ql-link').setAttribute('title', 'Link');
            toolbar.querySelector('button.ql-underline').setAttribute('title', 'Underline');
            toolbar.querySelector('button.ql-clean').setAttribute('title', 'Clear Formatting');
            toolbar.querySelector('[value=ordered]').setAttribute('title', 'Ordered List');
            toolbar.querySelector('[value=bullet]').setAttribute('title', 'Bullet List');
        },
    }));

    Alpine.start();
})();

// Create a new MutationObserver instance
const observer = new MutationObserver(() => {
    window.HSStaticMethods.autoInit();
});
// Start observing the target node
observer.observe(document.body, { attributes: true, childList: true, subtree: true });
