<!-- Theme customizer -->
<div class="theme-customizer">
    <div x-show="showCustomizer" @click="toggleCustomizer" class="customizer-shadow"></div>

    <nav class="app-drawers theme" :class="{ '!right-0': showCustomizer }">
        <div class="p-4 text-center">
            <button type="button" class="customizer-close" @click="toggleCustomizer">
                <span class="icon-[mdi--close]"></span>
            </button>
            <h4 class="mb-1 dark:text-white">TEMPLATE CUSTOMIZER</h4>
            <p class="text-white-dark">
                Set preferences that will be cookies for your live preview demonstration.
            </p>
        </div>
        <div data-simplebar class="h-[calc(100%_-_110px)] overflow-y-auto overflow-x-hidden p-4">
            <div class="customizer-card">
                <h5 class="customizer-header">Color Scheme</h5>
                <p class="text-white-dark text-xs">Overall light or dark presentation.</p>
                <div class="mt-3 grid grid-cols-3 gap-2">
                    <button type="button" class="btn flex items-center px-4"
                        :class="[$store.app.theme === 'light' ? 'btn-primary' : 'btn-outline-primary']"
                        @click="$store.app.toggleTheme('light')">
                        <span class="icon-[mdi--brightness-6]"></span>
                        Light
                    </button>
                    <button type="button" class="btn flex items-center px-4"
                        :class="[$store.app.theme === 'dark' ? 'btn-primary' : 'btn-outline-primary']"
                        @click="$store.app.toggleTheme('dark')">
                        <span class="icon-[mdi--brightness-2]"></span>
                        Dark
                    </button>
                    <button type="button" class="btn flex items-center px-4"
                        :class="[$store.app.theme === 'system' ? 'btn-primary' : 'btn-outline-primary']"
                        @click="$store.app.toggleTheme('system')">
                        <span class="icon-[mdi--brightness-auto]"></span>
                        System
                    </button>
                </div>
            </div>

            <div class="customizer-card">
                <h5 class="customizer-header">Navigation Position</h5>
                <p class="text-white-dark text-xs">Select the primary navigation paradigm for your app.</p>
                <div class="mt-3 grid grid-cols-3 gap-2">
                    <button type="button" class="btn flex items-center px-4"
                        :class="[$store.app.menu === 'horizontal' ? 'btn-primary' : 'btn-outline-primary']"
                        @click="$store.app.toggleMenu('horizontal')">
                        Horizontal
                    </button>
                    <button type="button" class="btn flex items-center px-4 text-center"
                        :class="[$store.app.menu === 'vertical' ? 'btn-primary' : 'btn-outline-primary']"
                        @click="$store.app.toggleMenu('vertical')">
                        Vertical
                    </button>
                    <button type="button" class="btn flex items-center px-4 text-center"
                        :class="[$store.app.menu === 'collapsible' ? 'btn-primary' : 'btn-outline-primary']"
                        @click="$store.app.toggleMenu('collapsible')">
                        Collapsible
                    </button>
                </div>
                <div class="mt-5 text-primary">
                    <label class="mb-0 inline-flex items-center">
                        <input x-model="$store.app.semiDark" type="checkbox" :value="true"
                            class="form-checkbox" @change="$store.app.toggleSemiDark()" />
                        <span>Semi Dark (Sidebar &amp; Header)</span>
                    </label>
                </div>
            </div>

            <div class="customizer-card">
                <h5 class="customizer-header">Layout Style</h5>
                <p class="text-white-dark text-xs">Select the primary layout style for your app.</p>
                <div class="mt-3 flex gap-2">
                    <button type="button" class="btn flex-auto"
                        :class="[$store.app.layout === 'boxed-layout' ? 'btn-primary' : 'btn-outline-primary']"
                        @click="$store.app.toggleLayout('boxed-layout')">
                        Box
                    </button>
                    <button type="button" class="btn flex-auto"
                        :class="[$store.app.layout === 'full' ? 'btn-primary' : 'btn-outline-primary']"
                        @click="$store.app.toggleLayout('full')">
                        Full
                    </button>
                </div>
            </div>

            <div class="customizer-card">
                <h5 class="customizer-header">Direction</h5>
                <p class="text-white-dark text-xs">Select the direction for your app.</p>
                <div class="mt-3 flex gap-2">
                    <button type="button" class="btn flex-auto"
                        :class="[$store.app.rtlClass === 'ltr' ? 'btn-primary' : 'btn-outline-primary']"
                        @click="$store.app.toggleRTL('ltr')">
                        LTR
                    </button>
                    <button type="button" class="btn flex-auto"
                        :class="[$store.app.rtlClass === 'rtl' ? 'btn-primary' : 'btn-outline-primary']"
                        @click="$store.app.toggleRTL('rtl')">
                        RTL
                    </button>
                </div>
            </div>

            <div class="customizer-card">
                <h5 class="customizer-header">Navbar Type</h5>
                <p class="text-white-dark text-xs">FIxed or Static.</p>
                <div class="mt-3 flex items-center gap-3 text-primary">
                    <label class="mb-0 inline-flex items-center">
                        <input x-model="$store.app.navbar" type="radio" value="navbar-static" class="form-radio"
                            @change="$store.app.toggleNavbar()" name="$store.app.navbar" />
                        <span>Static</span>
                    </label>
                    <label class="mb-0 inline-flex items-center">
                        <input x-model="$store.app.navbar" type="radio" value="navbar-fixed" class="form-radio"
                            @change="$store.app.toggleNavbar()" name="$store.app.navbar" />
                        <span>Fixed</span>
                    </label>
                    <label class="mb-0 inline-flex items-center">
                        <input x-model="$store.app.navbar" type="radio" value="navbar-hidden" class="form-radio"
                            @change="$store.app.toggleNavbar()" name="$store.app.navbar" />
                        <span>Hidden</span>
                    </label>
                </div>
            </div>

            <div class="customizer-card">
                <h5 class="customizer-header">Footer Type</h5>
                <p class="text-white-dark text-xs">FIxed or Static.</p>
                <div class="mt-3 flex items-center gap-3 text-primary">
                    <label class="mb-0 inline-flex items-center">
                        <input x-model="$store.app.footer" type="radio" value="footer-static" class="form-radio"
                            @change="$store.app.toggleFooter()" name="footerType" />
                        <span>Static</span>
                    </label>
                    <label class="mb-0 inline-flex items-center">
                        <input x-model="$store.app.footer" type="radio" value="footer-fixed" class="form-radio"
                            @change="$store.app.toggleFooter()" name="footerType" />
                        <span>Fixed</span>
                    </label>
                    <label class="mb-0 inline-flex items-center">
                        <input x-model="$store.app.footer" type="radio" value="footer-hidden" class="form-radio"
                            @change="$store.app.toggleFooter()" name="footerType" />
                        <span>Hidden</span>
                    </label>
                </div>
            </div>

            <div class="customizer-card flex items-center justify-between">
                <h5 class="customizer-header">Menu Hidden</h5>
                <div class="mt-3 flex items-center gap-3 text-primary">
                    <label class="relative h-6 w-12">
                        <input x-model="$store.app.navbar" type="checkbox" class="hidden-checkbox peer"
                            id="hidden-switch" @change="$store.app.toggleVMenu()" />
                        <span for="hidden-switch" class="hidden-switch"></span>
                    </label>
                </div>
            </div>

            <div class="customizer-card">
                <h5 class="customizer-header">Router Transition</h5>
                <p class="text-white-dark text-xs">Animation of main content.</p>
                <div class="mt-3">
                    <select x-model="$store.app.animation" class="form-select w-full border-primary text-primary"
                        @change="$store.app.toggleAnimation()">
                        <option value>Select Animation</option>
                        <option value="animate__fadeIn">Fade</option>
                        <option value="animate__fadeInDown">Fade Down</option>
                        <option value="animate__fadeInUp">Fade Up</option>
                        <option value="animate__fadeInLeft">Fade Left</option>
                        <option value="animate__fadeInRight">Fade Right</option>
                        <option value="animate__slideInDown">Slide Down</option>
                        <option value="animate__slideInLeft">Slide Left</option>
                        <option value="animate__slideInRight">Slide Right</option>
                        <option value="animate__zoomIn">Zoom In</option>
                    </select>
                </div>
            </div>
        </div>
    </nav>
</div>
