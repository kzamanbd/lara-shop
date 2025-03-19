<!-- Theme customizer -->
<div id="theme-customizer">
    <button type="button" class="customizer-icon btn-primary" data-hs-overlay="#customizer-drawer">
        <span class="icon-[mdi--cog]"></span>
    </button>

    <nav id="customizer-drawer" class="hs-overlay tw-drawer customizer-drawer">
        <div class="tw-drawer-header">
            <h4>TEMPLATE CUSTOMIZER</h4>
            <button type="button" class="tw-modal-close" data-hs-overlay="#customizer-drawer">
                <i class="icon-[mdi--close]"></i>
            </button>
        </div>
        <div class="tw-drawer-body p-0">
            <p class="px-4">Set preferences that will be cookies for your live preview demonstration.</p>
            <div data-simplebar class="h-[calc(100vh_-_100px)] overflow-x-hidden overflow-y-auto p-4">
                <div class="customizer-card">
                    <h5 class="customizer-header">Color Scheme</h5>
                    <p class="text-xs">Overall light or dark presentation.</p>
                    <div class="my-3 grid grid-cols-3 gap-2">
                        <button
                            type="button"
                            class="btn flex items-center px-4"
                            :class="[$store.app.theme === 'light' ? 'btn-primary' :'btn-outline-primary']"
                            @click="toggleTheme('light')">
                            <span class="icon-[mdi--brightness-6]"></span>
                            Light
                        </button>
                        <button
                            type="button"
                            class="btn flex items-center px-4"
                            :class="[$store.app.theme === 'dark' ? 'btn-primary' :'btn-outline-primary']"
                            @click="toggleTheme('dark')">
                            <span class="icon-[mdi--brightness-2]"></span>
                            Dark
                        </button>
                        <button
                            type="button"
                            class="btn flex items-center px-4"
                            :class="[$store.app.theme === 'system' ? 'btn-primary' :'btn-outline-primary']"
                            @click="toggleTheme('system')">
                            <span class="icon-[mdi--brightness-auto]"></span>
                            System
                        </button>
                    </div>
                    <p class="mb-2 text-xs">Themes</p>
                    <div class="grid grid-cols-3 gap-2">
                        <button
                            @click="setThemeVariant('default')"
                            :class="getCurrentVariant('default')"
                            class="btn border-indigo-400">
                            Default
                        </button>
                        <button
                            @click="setThemeVariant('amber')"
                            :class="getCurrentVariant('amber')"
                            class="btn border-amber-400">
                            Amber
                        </button>
                        <button
                            @click="setThemeVariant('rose')"
                            :class="getCurrentVariant('rose')"
                            class="btn border-rose-400">
                            Rose
                        </button>
                        <button
                            @click="setThemeVariant('purple')"
                            :class="getCurrentVariant('purple')"
                            class="btn border-purple-400">
                            Purple
                        </button>
                        <button
                            @click="setThemeVariant('sky')"
                            :class="getCurrentVariant('sky')"
                            class="btn border-sky-400">
                            Sky
                        </button>
                        <button
                            @click="setThemeVariant('teal')"
                            :class="getCurrentVariant('teal')"
                            class="btn border-teal-400">
                            Teal
                        </button>
                    </div>
                </div>

                <div class="customizer-card">
                    <h5 class="customizer-header">Navigation Position</h5>
                    <p class="text-xs">Select the primary navigation paradigm for your app.</p>
                    <div class="mt-3 grid grid-cols-3 gap-2">
                        <button
                            type="button"
                            class="btn flex items-center px-4"
                            :class="[$store.app.menu === 'horizontal' ? 'btn-primary' : 'btn-outline-primary']"
                            @click="$store.app.toggleMenu('horizontal')">
                            Horizontal
                        </button>
                        <button
                            type="button"
                            class="btn flex items-center px-4 text-center"
                            :class="[$store.app.menu === 'vertical' ? 'btn-primary' : 'btn-outline-primary']"
                            @click="$store.app.toggleMenu('vertical')">
                            Vertical
                        </button>
                        <button
                            type="button"
                            class="btn flex items-center px-4 text-center"
                            :class="[$store.app.menu === 'collapsible' ? 'btn-primary' :'btn-outline-primary']"
                            @click="$store.app.toggleMenu('collapsible')">
                            Collapsible
                        </button>
                    </div>
                    <div class="text-primary mt-5">
                        <label class="mb-0 inline-flex items-center">
                            <input
                                x-model="$store.app.semiDark"
                                type="checkbox"
                                :value="true"
                                class="form-check-input"
                                @change="$store.app.toggleSemiDark()" />
                            <span class="mx-2">Semi Dark (Sidebar)</span>
                        </label>
                    </div>
                </div>

                <div class="customizer-card">
                    <h5 class="customizer-header">Layout Style</h5>
                    <p class="text-xs">Select the primary layout style for your app.</p>
                    <div class="mt-3 flex gap-2">
                        <button
                            type="button"
                            class="btn flex-auto"
                            :class="[$store.app.layout === 'boxed-layout' ? 'btn-primary' : 'btn-outline-primary']"
                            @click="$store.app.toggleLayout('boxed-layout')">
                            Box
                        </button>
                        <button
                            type="button"
                            class="btn flex-auto"
                            :class="[$store.app.layout === 'full' ? 'btn-primary' : 'btn-outline-primary']"
                            @click="$store.app.toggleLayout('full')">
                            Full
                        </button>
                    </div>
                </div>

                <div class="customizer-card">
                    <h5 class="customizer-header">Direction</h5>
                    <p class="text-xs">Select the direction for your app.</p>
                    <div class="mt-3 flex gap-2">
                        <button
                            type="button"
                            class="btn flex-auto"
                            :class="[$store.app.rtlClass === 'ltr' ? 'btn-primary' : 'btn-outline-primary']"
                            @click="$store.app.toggleRTL('ltr')">
                            LTR
                        </button>
                        <button
                            type="button"
                            class="btn flex-auto"
                            :class="[$store.app.rtlClass === 'rtl' ? 'btn-primary' : 'btn-outline-primary']"
                            @click="$store.app.toggleRTL('rtl')">
                            RTL
                        </button>
                    </div>
                </div>

                <div class="customizer-card">
                    <h5 class="customizer-header">Navbar Type</h5>
                    <p class="text-xs">FIxed or Static.</p>
                    <div class="text-primary mt-3 flex items-center gap-3">
                        <label class="mb-0 inline-flex items-center">
                            <input
                                x-model="$store.app.navbar"
                                type="radio"
                                value="navbar-static"
                                class="form-check-input"
                                name="$store.app.navbar" />
                            <span class="mx-2">Static</span>
                        </label>
                        <label class="mb-0 inline-flex items-center">
                            <input
                                x-model="$store.app.navbar"
                                type="radio"
                                value="navbar-fixed"
                                class="form-check-input"
                                name="$store.app.navbar" />
                            <span class="mx-2">Fixed</span>
                        </label>
                        <label class="mb-0 inline-flex items-center">
                            <input
                                x-model="$store.app.navbar"
                                type="radio"
                                value="navbar-hidden"
                                class="form-check-input"
                                name="$store.app.navbar" />
                            <span class="mx-2">Hidden</span>
                        </label>
                    </div>
                </div>

                <div class="customizer-card">
                    <h5 class="customizer-header">Footer Type</h5>
                    <p class="text-xs">FIxed or Static.</p>
                    <div class="text-primary mt-3 flex items-center gap-3">
                        <label class="mb-0 inline-flex items-center">
                            <input
                                x-model="$store.app.footer"
                                type="radio"
                                value="footer-static"
                                class="form-check-input"
                                name="footerType" />
                            <span class="mx-2">Static</span>
                        </label>
                        <label class="mb-0 inline-flex items-center">
                            <input
                                x-model="$store.app.footer"
                                type="radio"
                                value="footer-fixed"
                                class="form-check-input"
                                name="footerType" />
                            <span class="mx-2">Fixed</span>
                        </label>
                        <label class="mb-0 inline-flex items-center">
                            <input
                                x-model="$store.app.footer"
                                type="radio"
                                value="footer-hidden"
                                class="form-check-input"
                                name="footerType" />
                            <span class="mx-2">Hidden</span>
                        </label>
                    </div>
                </div>

                <div class="customizer-card flex items-center justify-between">
                    <h5 class="customizer-header">Menu Hidden</h5>
                    <div class="text-primary mt-3 flex items-center gap-3">
                        <label class="relative h-6 w-12">
                            <input
                                x-model="$store.app.sidebar"
                                type="checkbox"
                                class="hidden-checkbox peer"
                                id="hidden-switch" />
                            <span for="hidden-switch" class="hidden-switch"></span>
                        </label>
                    </div>
                </div>

                <div class="customizer-card">
                    <h5 class="customizer-header">Router Transition</h5>
                    <p class="text-xs">Animation of main content.</p>
                    <div class="mt-3">
                        <select
                            x-model="$store.app.animation"
                            class="form-control"
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
        </div>
    </nav>
</div>
