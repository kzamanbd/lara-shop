/**
 * TwilightUI
 * @version 1.0.0
 * @description A simple UI framework for building beautiful responsive websites and web apps.
 * @license MIT
 * @see https://twilightui.com/
 * @Alpine Config
 */

import collapse from "@alpinejs/collapse";
import persist from "@alpinejs/persist";
import {
    autoUpdate,
    computePosition,
    flip,
    hide,
    offset,
    shift,
} from "@floating-ui/dom";
import Alpine from "alpinejs";
import "simplebar";
import "./bootstrap";

window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.plugin(persist);
// You will need a ResizeObserver polyfill for browsers that don't support it! (iOS Safari, Edge, ...)
import ResizeObserver from "resize-observer-polyfill";
window.ResizeObserver = ResizeObserver;

(function () {
    // theme config
    const $themeConfig = {
        locale: "en", // en, da, de, el, es, fr, hu, it, ja, pl, pt, ru, sv, tr, zh
        theme: "light", // light, dark, system
        rtlClass: "ltr", // rtl, ltr
        menu: "vertical", // vertical, horizontal
        layout: "full", // full, boxed-layout
        animation: "animate__fadeIn", // animate__fadeIn, animate__fadeInDown, animate__fadeInUp, animate__fadeInLeft, animate__fadeInRight, animate__slideInDown, animate__slideInLeft, animate__slideInRight, animate__zoomIn
        navbar: "navbar-fixed", // navbar-static, navbar-fixed, navbar-hidden
        footer: "footer-static", // footer-static, footer-fixed, footer-hidden
        semiDark: false,
        sidebar: false,
    };

    // theme config persist with alpinejs
    Alpine.store("app", {
        name: "TwilightUI",
        // theme
        theme: Alpine.$persist($themeConfig.theme),
        toggleTheme(val) {
            let theme = $themeConfig.theme; // light|dark|system
            if (val) {
                theme = val;
            } else {
                if (this.theme === "dark") {
                    theme = "light";
                } else {
                    theme = "dark";
                }
            }
            if (theme == "dark") {
                this.semiDark = false;
            }

            this.theme = theme;
        },
        // sidebar
        sidebar: Alpine.$persist($themeConfig.sidebar),
        toggleVMenu() {
            this.sidebar = !this.sidebar;
        },
        sidebarCollapsed: "compact", // expanded, compact, collapsed
        collapsibleMenu() {
            console.log("collapsibleMenu");
        },

        // window full screen
        fullscreen: false,
        toggleFullscreen() {
            if (this.fullscreen) {
                document.exitFullscreen();
            } else {
                document.documentElement.requestFullscreen();
            }
            this.fullscreen = !this.fullscreen;
        },

        // navigation menu
        menu: Alpine.$persist($themeConfig.menu),
        toggleMenu(val) {
            if (!val) {
                val = this.menu || $themeConfig.menu; // vertical, collapsible, horizontal
            }
            this.menu = val;
        },

        // layout
        layout: Alpine.$persist($themeConfig.layout),
        toggleLayout(val) {
            if (!val) {
                val = this.layout || $themeConfig.layout; // full, boxed-layout
            }

            this.layout = val;
        },

        // rtl support
        rtlClass: Alpine.$persist($themeConfig.rtlClass),
        toggleRTL(val) {
            if (!val) {
                val = this.rtlClass || $themeConfig.rtlClass; // rtl, ltr
            }

            this.rtlClass = val;
            this.setRTLLayout();
        },

        setRTLLayout() {
            document
                .querySelector("html")
                .setAttribute("dir", this.rtlClass || $themeConfig.rtlClass);
        },

        // animation
        animation: Alpine.$persist($themeConfig.animation),
        toggleAnimation(val) {
            if (!val) {
                val = this.animation || $themeConfig.animation;
            }
            val = val?.trim();

            this.animation = val;
        },

        // navbar type
        navbar: Alpine.$persist($themeConfig.navbar),
        toggleNavbar(val) {
            if (!val) {
                val = this.navbar || $themeConfig.navbar;
            }

            this.navbar = val;
        },
        // footer type
        footer: Alpine.$persist($themeConfig.footer),
        toggleFooter(val) {
            if (!val) {
                val = this.footer || $themeConfig.footer;
            }

            this.footer = val;
        },

        // semi dark
        semiDark: Alpine.$persist($themeConfig.semiDark),

        // multi language
        locale: Alpine.$persist($themeConfig.locale),
        toggleLocale(val) {
            if (!val) {
                val = this.locale || $themeConfig.locale;
            }

            this.locale = val;
        },
    });

    //? alpine data
    Alpine.data("twilightTheme", () => ({
        showCustomizer: false,
        init() {
            this.$store.app.setRTLLayout();
            // watch showCustomizer
            this.$watch("showCustomizer", (value) => {
                if (value) {
                    document.body.classList.add("overflow-hidden");
                } else {
                    document.body.classList.remove("overflow-hidden");
                }
            });
        },
        toggleCustomizer() {
            this.showCustomizer = !this.showCustomizer;
        },
        get appConfig() {
            const app = this.$store.app;
            let theme = app.theme;
            if (theme == "system") {
                theme = !!window.matchMedia("(prefers-color-scheme: dark)")
                    .matches
                    ? "dark"
                    : "light";
            }
            return [theme, app.menu, app.layout].filter(Boolean);
        },
        get isFullscreen() {
            return this.$store.app.fullscreen
                ? "fullscreen_exit"
                : "fullscreen";
        },
        get themeIcon() {
            return this.$store.app.theme == "system"
                ? "brightness_auto"
                : `${this.$store.app.theme}_mode`;
        },
    }));

    Alpine.data("collapse", () => ({
        collapse: false,

        collapseSidebar() {
            this.collapse = !this.collapse;
        },
    }));

    // Magic: $tooltip
    Alpine.magic("tooltip", (el) => (message, placement) => {
        let instance = tippy(el, {
            content: message,
            trigger: "manual",
            placement: placement || undefined,
            allowHTML: true,
        });

        instance.show();
    });

    Alpine.directive("d-tooltip", (el, { expression }, { evaluate }) => {
        let string = evaluate(expression);
        tippy(el, {
            content: string.charAt(0).toUpperCase() + string.slice(1),
        });
    });

    // Directive: x-tooltip
    Alpine.directive("tooltip", (el, { expression }) => {
        tippy(el, {
            content: expression,
            placement: el.getAttribute("data-placement") || undefined,
            allowHTML: true,
            delay: el.getAttribute("data-delay") || 0,
            animation: el.getAttribute("data-animation") || "fade",
            theme: el.getAttribute("data-theme") || "",
        });
    });

    // Magic: $popovers
    Alpine.magic("popovers", (el) => (message, placement) => {
        let instance = tippy(el, {
            content: message,
            placement: placement || undefined,
            interactive: true,
            allowHTML: true,
            delay: el.getAttribute("data-delay") || 0,
            animation: el.getAttribute("data-animation") || "fade",
            theme: el.getAttribute("data-theme") || "",
            trigger: el.getAttribute("data-trigger") || "click",
        });

        instance.show();
    });

    Alpine.start();

    // window scroll
    window.addEventListener("scroll", () => {
        const header = document.querySelector(".navbar-nav");
        if (
            document.body.scrollTop > 0 ||
            document.documentElement.scrollTop > 0
        ) {
            // add class to header
            header.classList.add("scrollable");
        } else {
            // remove class from header
            header.classList.remove("scrollable");
        }
    });

    // set current year in footer
    const yearEle = document.querySelector("#footer-year");
    if (yearEle) {
        yearEle.innerHTML = new Date().getFullYear();
    }
    document.addEventListener("DOMContentLoaded", function () {
        // screen loader
        setTimeout(() => {
            const loading = document.querySelector(".loading");
            loading.remove();
        }, 200);

        // nav-tabs
        document.querySelectorAll(".nav-tabs").forEach(function (elem) {
            elem.querySelectorAll('[data-tw-toggle="tab"]').forEach(function (
                item
            ) {
                item.addEventListener("click", function () {
                    var tabID = item.getAttribute("data-tw-target");
                    var tabContents = elem.querySelectorAll(
                        ".tab-content > .tab-pane"
                    );

                    var activeElem = elem.querySelector(
                        '[data-tw-toggle="tab"].active'
                    );
                    if (activeElem) activeElem.classList.remove("active");

                    // clear value
                    for (let i = 0; i < tabContents.length; i++) {
                        tabContents[i].classList.add("hidden");
                        tabContents[i].classList.remove("block");
                    }

                    // change value
                    item.classList.add("active");
                    document.getElementById(tabID).classList.remove("hidden");
                    document.getElementById(tabID).classList.add("block");
                });
            });
        });
    });
})();

/**
 * Vertical Menus
 * @version 1.0.0
 * @description A simple vertical menus plugin for TwilightUI
 * @license MIT
 */

(function () {
    const verticalMenu = document.querySelector(".vertical-menu");
    const content = document.querySelector(".tw-nav-menu");
    const menuItems = document.querySelectorAll(".tw-menu-link");
    const wrapper = document.querySelector(".twilight-body");
    const sidebarToggle = document.querySelectorAll(".toggle-sidebar");
    const overlay = document.querySelector(".menu-shadow");

    function toggleHeight(element, height) {
        if (element.style.height === "0px" || element.style.height === "") {
            element.style.height = `${height}px`;
        } else {
            element.style.height = "0px";
        }
    }

    function initMenuItems() {
        if (menuItems.length) {
            menuItems.forEach((menuItem) => {
                const parent = menuItem.parentElement;
                const dropdown = parent.querySelector(".tw-dropdown-menu");
                const arrow = menuItem.querySelector(".tw-dropdown-arrow");

                if (dropdown) {
                    menuItem.addEventListener("click", (e) => {
                        e.preventDefault();
                        toggleHeight(dropdown, dropdown.scrollHeight);
                        menuItem.classList.toggle("active");
                    });
                }

                if (dropdown && menuItem.classList.contains("active")) {
                    toggleHeight(dropdown, dropdown.scrollHeight);
                    arrow.classList.toggle("rotate");
                }
            });
        }
    }

    function initSidebarToggle() {
        if (sidebarToggle) {
            sidebarToggle.forEach((toggle) => {
                toggle.addEventListener("click", () => toggleSidebar());
            });
        }
        if (overlay) {
            overlay.addEventListener("click", () => toggleSidebar());
        }
    }

    function toggleSidebar() {
        const windowWidth = window.innerWidth;
        if (windowWidth < 1024) {
            verticalMenu.classList.toggle("expanded");
            overlay.classList.toggle("hidden");
        } else {
            verticalMenu.classList.toggle("collapsed");
            wrapper.classList.toggle("expanded");
        }
    }

    function initWrapper() {
        if (verticalMenu) {
            if (verticalMenu.classList.contains("collapsed")) {
                wrapper.classList.add("expanded");
            } else {
                wrapper.classList.remove("expanded");
            }
        }
    }

    function handleWindowResize() {
        if (verticalMenu) {
            window.addEventListener("resize", () => {
                if (window.innerWidth < 1024) {
                    verticalMenu.classList.remove("collapsed");
                } else {
                    verticalMenu.classList.remove("expanded");
                }
            });
        }
    }

    function initScrollBar() {
        window.addEventListener("load", () => {
            let pathName = window.location.pathname;
            if (pathName == "/") pathName = "/index.html";

            const menuItem = document.querySelector(
                `ul.tw-nav-menu a[href="${pathName}"]`
            );
            const dropdownMenu = menuItem?.closest("ul.tw-dropdown-menu");

            if (menuItem) {
                menuItem.classList.add("active");
                if (dropdownMenu) {
                    let elements = dropdownMenu
                        .closest("li.tw-menu-item")
                        .querySelectorAll(".tw-menu-link");
                    if (elements) {
                        elements = elements[0];
                        setTimeout(() => {
                            elements.click();
                        });
                    }
                }
            }
            const activeMenu = content?.querySelector(".tw-menu-link.active");
            const activeSubmenu = content?.querySelector(
                ".tw-dropdown-link.active"
            );
            if (activeSubmenu) {
                activeSubmenu.scrollIntoView({
                    block: "center",
                    behavior: "smooth",
                });
            } else if (activeMenu) {
                activeMenu.scrollIntoView({
                    block: "center",
                    behavior: "smooth",
                });
            }
        });
    }

    initWrapper();
    initMenuItems();
    initScrollBar();
    initSidebarToggle();
    handleWindowResize();
})();

/**
 * Drawer
 * @version 1.0.0
 * @description A simple drawer plugin for TwilightUI
 * @license MIT
 */
class Drawer {
    constructor(target, options = {}) {
        //Store the target element
        this.target = null;

        //Store drawer element
        this.drawer = null;

        //Store drawer toggle
        this.toggle = null;

        //Store drawer transition in miliseconds.
        this.transition = 500;

        //Store drawer dismisses
        this.dismisses = null;

        //Store the drawer options
        this.options = {
            keyboard: true, //Boolean. Default is true
            backdrop: true, //Boolean | 'static'. Default is true
            ...options,
        };

        this.documentOnKeydown = (e) => this.hideOnKeydown({ e, drawer: this });

        if (typeof target === "string") {
            this.target = document.querySelector(target);
        } else if (target instanceof HTMLElement) {
            this.target = target;
        } else {
            throw new Error("No target element found");
        }

        if (this.target.classList.contains("drawer")) {
            this.drawer = this.target;
        } else {
            this.toggle = this.target;
            this.drawer = document.querySelector(this.toggle.dataset.target);

            this.toggle.addEventListener("click", () => {
                const openDrawers = document.querySelectorAll(".drawer.show");

                if (openDrawers.length) {
                    [...openDrawers].forEach((drawer) => this.hide(drawer));
                } else {
                    this.show();
                }
            });
        }

        this.dismisses = this.drawer.querySelectorAll(
            '[data-dismiss="drawer"]'
        );

        if (this.dismisses.length) {
            [...this.dismisses].forEach((dismiss) => {
                dismiss.addEventListener("click", () => this.hide());
            });
        }
    }

    show(element = null) {
        const drawer = element ? element : this.drawer;

        if (!drawer.classList.contains("showing")) {
            drawer.classList.add("showing");

            if (this.options.backdrop) {
                document.body.appendChild(this.createBackdrop());
            }

            setTimeout(() => {
                const drawerBackdrop =
                    document.querySelector(".drawer-backdrop");
                drawer.classList.replace("showing", "show");

                if (drawerBackdrop) {
                    drawerBackdrop.classList.add("show");

                    drawerBackdrop.addEventListener("click", () => {
                        if (this.options.backdrop !== "static") {
                            this.hide();
                        }
                    });
                }

                if (this.options.keyboard) {
                    document.addEventListener(
                        "keydown",
                        this.documentOnKeydown
                    );
                }
            }, 15);
        }
    }

    hide(element = null) {
        const drawer = element ? element : this.drawer;

        if (
            drawer.classList.contains("show") &&
            !drawer.classList.contains("hiding")
        ) {
            const drawerBackdrop = document.querySelector(".drawer-backdrop");

            drawer.classList.add("hiding");

            if (drawerBackdrop) {
                drawerBackdrop.classList.remove("show");
            }

            setTimeout(() => {
                drawer.classList.remove("show");
                drawer.classList.remove("hiding");

                if (drawerBackdrop) {
                    drawerBackdrop.remove();
                }

                if (this.options.keyboard) {
                    document.removeEventListener(
                        "keydown",
                        this.documentOnKeydown
                    );
                }
            }, this.transition);
        }
    }

    hideOnKeydown(args) {
        const { e, drawer } = args;

        if (e.key === "Escape" && drawer.options.keyboard) {
            drawer.hide();
        }
    }

    createBackdrop() {
        if (document.querySelector(".drawer-backdrop")) {
            document.querySelector(".drawer-backdrop").remove();
        }

        const backdrop = document.createElement("div");
        backdrop.setAttribute("class", "drawer-backdrop");

        return backdrop;
    }
}

function querySelectors(selectors) {
    let output = [];

    if (selectors) {
        output = [...document.querySelectorAll(selectors)].filter(
            (selectorElement) => {
                // Return all the elements except .code-viewer-source children elements
                return !selectorElement.parentElement.classList.contains(
                    "code-viewer-source"
                );
            }
        );
    }

    return output;
}

window.createDrawer = function (target, options = {}) {
    return new Drawer(target, options);
};

(function () {
    const toggles = querySelectors('[data-toggle="drawer"]');

    if (toggles.length) {
        toggles.forEach((toggle) => {
            const targetId = toggle.dataset.target;

            if (targetId) {
                const target = document.querySelector(targetId);
                const options = {
                    keyboard:
                        target.dataset.keyboard === "false" ? false : true,
                    backdrop: (() => {
                        let output = true;

                        if (target.dataset.backdrop === "static") {
                            output = "static";
                        }

                        if (target.dataset.backdrop === "false") {
                            output = false;
                        }

                        return output;
                    })(),
                };

                new Drawer(toggle, options);
            }
        });
    }
})();

/**
 * dropdown
 * @version 1.0.0
 * @description A simple dropdown plugin for TwilightUI
 * @license MIT
 */

class Dropdown {
    constructor(target, options = {}) {
        if (typeof target === "string") {
            this.target = document.querySelector(target);
        }

        if (target instanceof HTMLElement) {
            this.target = target;
        }

        if (!this.target) {
            throw new Error("No target element found");
        }

        this.toggle = this.target.querySelector(".dropdown-toggle");
        this.content = this.target.querySelector(".dropdown-menu");

        if (!this.toggle) {
            throw new Error("No toggle element found");
        }

        if (!this.content) {
            throw new Error("No content element found");
        }

        this.options = options;
        this.init();
    }

    init() {
        const outsideClickListener = (e) => {
            if (!this.target.contains(e.target)) {
                this.content.classList.remove("show");
                this.content.classList.remove("animate-fade-in-up");
                removeClickListener();
            }
        };

        const removeClickListener = () => {
            this.cleanup();
            document.removeEventListener("click", outsideClickListener);
        };

        this.toggle.addEventListener("click", () => {
            this.updatePosition();
            this.content.classList.toggle("show");
            this.content.classList.toggle("animate-fade-in-up");
            document.addEventListener("click", outsideClickListener);
        });
    }

    computePosition() {
        if (this.options.strategy === "fixed") {
            this.content.style.position = "fixed";
        }
        computePosition(this.target, this.content, {
            placement: this.options.placement || "bottom-start",
            strategy: this.options.strategy || "fixed",
            middleware: [flip(), shift(), offset(6), hide()],
        }).then((position) => {
            const { referenceHidden } = position.middlewareData.hide;
            Object.assign(this.content.style, {
                visibility: referenceHidden ? "hidden" : "visible",
                // left: `${position.x}px`,
                top: `${position.y}px`,
            });
        });
    }

    updatePosition() {
        const cleanup = autoUpdate(
            this.target,
            this.content,
            this.computePosition.bind(this)
        );
        this.cleanup = cleanup;
    }
}

(function () {
    window.addEventListener("load", () => {
        const dropdowns = document.querySelectorAll(".dropdown");
        dropdowns.forEach((dropdown) => {
            new Dropdown(dropdown, dropdown.dataset);
        });
    });

    // watch dom changes for new dropdowns
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                if (node.classList && node.classList.contains("dropdown")) {
                    new Dropdown(node, node.dataset);
                }
            });
        });
    });
    observer.observe(document.body, { childList: true, subtree: true });
})();

/**
 * Modal
 * @version 1.0.0
 * @description A simple modal plugin for TwilightUI
 * @license MIT
 */

class Modal {
    constructor(target, options = {}) {
        //Store the target element
        this.target = null;

        //Store modal element
        this.modal = null;

        //Store modal toggle
        this.toggle = null;

        //Store drawer dismisses
        this.dismisses = null;

        //Store modal transition in miliseconds.
        this.transition = 500;

        //Store the modal options
        this.options = {
            keyboard: true, //Boolean. Default is true
            backdrop: true, //Boolean | 'static'. Default is true
            autofucus: true, //Boolean. Default is true (focus the first input)
            ...options,
        };

        this.documentOnKeydown = (e) => this.hideOnKeydown({ e, modal: this });

        if (typeof target === "string") {
            this.target = document.querySelector(target);
        } else if (target instanceof HTMLElement) {
            this.target = target;
        } else {
            throw new Error("No target element found");
        }

        if (this.target.classList.contains("modal")) {
            this.modal = this.target;
        } else {
            this.toggle = this.target;
            this.modal = document.querySelector(this.toggle.dataset.target);

            this.toggle.addEventListener("click", () => this.show());
        }

        this.dismisses = this.modal.querySelectorAll('[data-dismiss="modal"]');

        if (this.dismisses.length) {
            [...this.dismisses].forEach((dismiss) => {
                dismiss.addEventListener("click", () => this.hide());
            });
        }
    }

    show() {
        const modal = this.modal;

        if (!modal.classList.contains("show")) {
            modal.style.display = "flex";

            modal.appendChild(this.createBackdrop());

            // Focus the first input
            if (this.options.autofucus) {
                const input = modal.querySelector("input");
                input && input.focus();
            }

            setTimeout(() => {
                const modalBackdrop = modal.querySelector(".modal-backdrop");
                modal.classList.add("show");

                if (modalBackdrop) {
                    modalBackdrop.classList.add("show");

                    modalBackdrop.addEventListener("click", () => {
                        if (
                            this.options.backdrop &&
                            this.options.backdrop !== "static"
                        ) {
                            this.hide();
                        }
                    });
                }

                if (this.options.keyboard) {
                    document.addEventListener(
                        "keydown",
                        this.documentOnKeydown
                    );
                }
            }, 15);
        }
    }

    hide() {
        const modal = this.modal;

        if (modal.classList.contains("show")) {
            const modalBackdrop = modal.querySelector(".modal-backdrop");
            modal.classList.remove("show");

            if (modalBackdrop) {
                modalBackdrop.classList.remove("show");
            }

            setTimeout(() => {
                modal.removeAttribute("style");

                modalBackdrop.remove();

                document.removeEventListener("keydown", this.documentOnKeydown);
            }, this.transition);
        }
    }

    hideOnKeydown(args) {
        const { e, modal } = args;

        if (e.key === "Escape" && modal.options.keyboard) {
            modal.hide();
        }
    }

    createBackdrop() {
        if (this.modal.querySelector(".modal-backdrop")) {
            this.modal.querySelector(".modal-backdrop").remove();
        }

        const backdrop = document.createElement("div");
        backdrop.setAttribute("class", "modal-backdrop");

        return backdrop;
    }
}

window.createModal = function (target, options = {}) {
    return new Modal(target, options);
};

(function () {
    const toggles = querySelectors('[data-toggle="modal"]');

    function modalToggle(toggle) {
        const targetId = toggle.dataset.target;

        if (targetId) {
            const target = document.querySelector(targetId);
            const options = {
                keyboard: target.dataset?.keyboard === "false" ? false : true,
                backdrop: (() => {
                    let output = true;

                    if (target.dataset?.backdrop === "static") {
                        output = "static";
                    }

                    if (target.dataset?.backdrop === "false") {
                        output = false;
                    }

                    return output;
                })(),
            };

            new Modal(toggle, options);
        }
    }

    if (toggles.length) {
        toggles.forEach(modalToggle);
    }

    // watch dom changes for new modal toggles
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                if (node.classList && node.classList.contains("modal")) {
                    const toggles = node.querySelectorAll(
                        '[data-toggle="modal"]'
                    );

                    if (toggles.length) {
                        toggles.forEach(modalToggle);
                    }
                }
            });
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true,
    });
})();

/**
 * Ripples
 * @version 1.0.0
 * @description A simple ripples plugin for TwilightUI
 */

(function () {
    // get all elements with ripple attribute
    const ripples = document.querySelectorAll("[data-ripple]");

    // add event listener to each element
    function debounce(func, delay) {
        let inDebounce;

        return function () {
            let args = arguments;
            let context = this;

            clearTimeout(inDebounce);
            return (inDebounce = setTimeout(() => {
                return func.apply(context, args);
            }, delay));
        };
    }

    // add event listener to each element
    function addRipple(e) {
        console.log("addRipple");
        const rippleContainer = this.querySelector(".ripple--container");

        const size = rippleContainer.offsetWidth;
        const pos = rippleContainer.getBoundingClientRect();
        const rippler = document.createElement("span");
        const x = e.pageX - pos.left - size / 2;
        const y = e.pageY - pos.top - size / 2;
        let style = `top: ${y}px; left: ${x}px; height: ${size}px; width: ${size}px;`;

        // adding optional option for ripple
        if (this.getAttribute("ripple-color")) {
            style += `background-color: ${this.getAttribute("ripple-color")}`;
        }

        if (this.getAttribute("ripple-radius")) {
            style += `border-radius: ${this.getAttribute("ripple-radius")}`;
        }

        rippleContainer.appendChild(rippler);
        rippler.setAttribute("style", style);
    }

    // remove all ripples
    function cleanUp(e) {
        const rippleContainer = this.querySelector(".ripple--container");
        while (rippleContainer.firstChild) {
            rippleContainer.removeChild(rippleContainer.firstChild);
        }
    }
    // add event listener to each element
    ripples.forEach((ripple) => {
        const rippleContainer = document.createElement("div");
        rippleContainer.className = "ripple--container";

        // add ripple on mouse click
        ripple.addEventListener("mousedown", addRipple);
        // remove ripple after mouse click
        ripple.addEventListener("mouseup", debounce(cleanUp, 2000));

        ripple.rippleContainer = rippleContainer;
        ripple.appendChild(rippleContainer);
    });
})();
