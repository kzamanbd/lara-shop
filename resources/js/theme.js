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

// You will need a ResizeObserver polyfill for browsers that don't support it! (iOS Safari, Edge, ...)
import ResizeObserver from 'resize-observer-polyfill';
window.ResizeObserver = ResizeObserver;

// quill editor
import Quill from 'quill';
window.Quill = Quill;

(function () {
    const selector = (el, all = false) => {
        return all ? document.querySelectorAll(el) : document.querySelector(el);
    };

    const twWrapper = selector('.tw--wrapper');
    const verticalMenu = selector('.vertical-menu');
    const verticalContent = selector('.vertical-content');
    const navbar = selector('.navbar-nav');
    const footer = selector('footer.footer');
    const SETTINGS_KEY = 'themeConfig';

    const initialize = {
        theme: 'light',
        themeVariant: 'default',
        rtlClass: 'ltr',
        menu: 'vertical',
        layout: 'full-layout',
        animation: 'animate__fadeIn',
        navbar: 'navbar-fixed',
        footer: 'footer-fixed',
        semiDark: false,
        hiddenSidebar: false,
    };

    const saveSettings = (key, value) => {
        const settings = {
            ...initialize,
            ...(JSON.parse(localStorage.getItem(SETTINGS_KEY)) || {}),
        };
        if (key) settings[key] = value;
        localStorage.setItem(SETTINGS_KEY, JSON.stringify(settings));
    };

    const loadSettings = () => {
        const settings = JSON.parse(localStorage.getItem(SETTINGS_KEY)) || initialize;
        if (!settings) return;

        if (!twWrapper) return;

        twWrapper.classList.add(settings.theme);
        twWrapper.classList.add(`theme-${settings.themeVariant}`);
        twWrapper.classList.add(settings.layout);
        navbar.classList.add(settings.navbar);
        footer.classList.add(settings.footer);
        settings.semiDark && verticalContent.classList.add('semi-dark');
        settings.hiddenSidebar && twWrapper.classList.add('toggle-menu');
        document.documentElement.setAttribute('dir', settings.rtlClass);

        // active state
        selector(`.theme-switcher[value="${settings.theme}"]`).checked = true;
        selector(`.color-schema[value="${settings.themeVariant}"]`).checked = true;
        selector(`.navigation-position[value="${settings.menu}"]`).checked = true;
        selector(`.layout-style[value="${settings.layout}"]`).checked = true;
        selector(`.layout-direction[value="${settings.rtlClass}"]`).checked = true;
        selector('.sidebar-semi-dark').checked = settings.semiDark;
        selector(`[name="navbarType"][value="${settings.navbar}"]`).checked = true;
        selector(`[name="footerType"][value="${settings.footer}"]`).checked = true;
        const sidebar = selector('.hidden-sidebar');
        if (sidebar.type == 'checkbox') {
            sidebar.checked = settings.hiddenSidebar;
        }
    };

    // Set footer year
    const footerText = selector('#footer-year');
    if (footerText) {
        footerText.innerHTML = `© 2023 - ${new Date().getFullYear()}`;
    }

    // Remove screen loader
    selector('.loading')?.remove();

    // Active menu logic
    const currentPath = window.location.href;
    const menuItem = selector(`.tw-nav-menu a[href="${currentPath}"]`);
    if (menuItem) {
        menuItem.classList.add('active');
        const target = menuItem.closest('.twd--menu')?.closest('.tw-menu-item')?.querySelector('.tw-menu-link');
        if (target) {
            target.parentElement.classList.add('active');
            target.nextElementSibling.style.display = 'block';
        }
        let parentMenu = menuItem.closest('.twd--menu-item.hs-accordion');
        while (parentMenu) {
            parentMenu.classList.add('active');
            parentMenu.querySelector('.hs-accordion-toggle')?.classList.add('active');
            parentMenu.querySelector('.hs-accordion-content')?.style.setProperty('display', 'block');
            parentMenu = parentMenu.closest('.twd--menu-item.hs-accordion')?.parentElement.closest('.hs-accordion');
        }
    }

    // Scroll sidebar menu into view
    const activeSubmenu = selector('.tw-nav-menu .twd--link.active') || selector('.tw-nav-menu .tw-menu-link.active');
    activeSubmenu?.scrollIntoView({ block: 'center', behavior: 'smooth' });

    // Sidebar toggle on resize
    window.addEventListener('resize', () => {
        if (!verticalMenu) return;
        window.innerWidth < 1024
            ? verticalMenu.classList.remove('collapsed')
            : verticalMenu.classList.remove('expanded');
    });

    // Scroll header effect
    window.addEventListener('scroll', () => {
        navbar?.classList.toggle('scrollable', document.documentElement.scrollTop > 0);
    });

    // Sidebar toggle buttons
    [...selector('.hidden-sidebar', true), ...selector('.toggle-sidebar', true)].forEach(item => {
        item.addEventListener('click', () => {
            if (item.classList.contains('hidden-sidebar')) {
                const status = !twWrapper.classList.toggle('toggle-menu');
                saveSettings('hiddenSidebar', status);
            } else {
                if (window.innerWidth < 1024) {
                    selector('.menu-shadow')?.classList.toggle('hidden');
                    verticalMenu.classList.toggle('expanded');
                } else {
                    verticalMenu.classList.toggle('collapsed');
                }
            }
        });
    });

    // Theme switcher
    selector('.theme-switcher', true).forEach(item => {
        item.addEventListener('change', () => {
            const newTheme = item.value || (twWrapper.classList.contains('dark') ? 'light' : 'dark');
            twWrapper.classList.remove('light', 'dark', 'system');
            twWrapper.classList.add(newTheme);
            saveSettings('theme', newTheme);
        });
    });

    // Fullscreen toggle
    selector('.fullscreen-toggle')?.addEventListener('click', () => {
        document.fullscreenElement ? document.exitFullscreen() : document.documentElement.requestFullscreen();
    });

    // Color schema switcher
    selector('.color-schema', true).forEach(item => {
        item.addEventListener('click', () => {
            const variant = item.value;
            twWrapper.classList.remove(
                'theme-default',
                'theme-amber',
                'theme-rose',
                'theme-purple',
                'theme-sky',
                'theme-teal',
            );
            twWrapper.classList.add(`theme-${variant}`);
            saveSettings('themeVariant', variant);
        });
    });

    // Semi-dark sidebar toggle
    selector('.sidebar-semi-dark')?.addEventListener('change', () => {
        verticalContent.classList.toggle('semi-dark');
        saveSettings('semiDark', verticalContent.classList.contains('semi-dark'));
    });

    // Navbar type toggle
    selector('[name="navbarType"]', true).forEach(item => {
        item.addEventListener('change', () => {
            navbar.className = `navbar-nav ${item.value}`;
            saveSettings('navbar', item.value);
        });
    });

    // Footer type toggle
    selector('[name="footerType"]', true).forEach(item => {
        item.addEventListener('change', () => {
            footer.className = `footer ${item.value}`;
            saveSettings('footer', item.value);
        });
    });

    // Layout type toggle
    selector('.layout-style', true).forEach(item => {
        item.addEventListener('change', () => {
            twWrapper.classList.remove('boxed-layout', 'full');
            twWrapper.classList.add(item.value);
            saveSettings('layout', item.value);
        });
    });

    // Layout direction toggle
    selector('.layout-direction', true).forEach(item => {
        item.addEventListener('change', () => {
            document.documentElement.setAttribute('dir', item.value);
            saveSettings('rtlClass', item.value);
        });
    });

    // Navigation position toggle
    selector('.navigation-position', true).forEach(item => {
        item.addEventListener('change', () => {
            const position = item.value;
            saveSettings('menu', position);
            if (position === 'collapsible') {
                verticalMenu.classList.replace('expanded', 'collapsed');
            } else if (position === 'horizontal' && !window.location.pathname.includes('horizontal')) {
                window.location.href = '/pages/layouts/horizontal.html';
            } else {
                verticalMenu.classList.remove('collapsed');
            }
        });
    });

    // Quill editor initialization
    selector('.quill-editor', true).forEach(item => {
        const editor = new Quill(item, {
            theme: 'snow',
            placeholder: 'Compose an epic...',
        });
        const toolbar = editor.container.previousSibling;
        const tooltips = {
            '.ql-picker': 'Font Size',
            'button.ql-bold': 'Bold',
            'button.ql-italic': 'Italic',
            'button.ql-link': 'Link',
            'button.ql-underline': 'Underline',
            'button.ql-clean': 'Clear Formatting',
            '[value=ordered]': 'Ordered List',
            '[value=bullet]': 'Bullet List',
        };
        for (let selector in tooltips) {
            toolbar.querySelector(selector)?.setAttribute('title', tooltips[selector]);
        }
    });

    // Load settings on page load
    loadSettings();
})();

// Create a new MutationObserver instance
const observer = new MutationObserver(() => {
    window.HSStaticMethods.autoInit();
    // Remove screen loader
    document.querySelector('.loading')?.remove();
    console.log('DOM changed, re-initializing components');
});
// Start observing the target node
observer.observe(document.body, {
    attributes: true,
    childList: true,
    subtree: true,
});

// add analytics code here
import 'https://www.googletagmanager.com/gtag/js?id=G-NB5NCE8041';
window.dataLayer = window.dataLayer || [];
function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());
gtag('config', 'G-NB5NCE8041');
