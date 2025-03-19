<x-app-layout title="Dashboard">
    <x-slot name="header">
        <ol class="breadcrumb-nav">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}"> Dashboard </a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <span class="icon-[mdi--chevron-right] size-4"></span>
                <span class="breadcrumb-item-current"> Overview </span>
            </li>
        </ol>
    </x-slot>

    <div class="dashboard">
        <!-- Main content -->
        <div class="space-y-4">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-3">
                    <div class="card to-primary-100 bg-linear-to-tl from-violet-100/50 via-transparent dark:bg-none">
                        <div class="card-body">
                            <div class="grid grid-cols-12">
                                <div class="col-span-6 pe-0">
                                    <p class="mb-2"><span class="text-[1rem]">Total Sales </span></p>
                                    <p class="mb-2 text-[0.75rem]">
                                        <span class="vertical-bottom mb-0 text-[1.5625rem] leading-none font-semibold">
                                            {{ number_format(App\Models\Order::all()->sum('sub_total'), 2) }}
                                        </span>
                                        <span
                                            class="block text-[0.625rem] font-semibold text-[#8c9097] dark:text-white/50">
                                            THIS MONTH
                                        </span>
                                    </p>
                                    <a href="javascript:void(0);"
                                        class="text-primary mb-0 flex items-center text-[0.75rem]">
                                        Show full stats
                                        <i class="icon-[mdi--chevron-right] ms-1"></i>
                                    </a>
                                </div>
                                <div class="col-span-6">
                                    <p
                                        class="badge bg-success/10 text-success! inline-flex ltr:float-right rtl:float-left">
                                        <i class="icon-[mdi--chevron-up] me-1"></i>42%
                                    </p>
                                    <p class="main-card-icon mb-0">
                                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg"
                                            enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                            width="24px" fill="#000000">
                                            <path d="M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z" opacity=".3">
                                            </path>
                                            <path d="M0,0h24v24H0V0z" fill="none"></path>
                                            <g>
                                                <path
                                                    d="M19.5,3.5L18,2l-1.5,1.5L15,2l-1.5,1.5L12,2l-1.5,1.5L9,2L7.5,3.5L6,2v14H3v3c0,1.66,1.34,3,3,3h12c1.66,0,3-1.34,3-3V2 L19.5,3.5z M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z">
                                                </path>
                                                <rect height="2" width="6" x="9" y="7"></rect>
                                                <rect height="2" width="2" x="16" y="7"></rect>
                                                <rect height="2" width="6" x="9" y="10"></rect>
                                                <rect height="2" width="2" x="16" y="10"></rect>
                                            </g>
                                        </svg>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-3">
                    <div class="card bg-linear-to-tl from-violet-100/50 via-transparent to-purple-100 dark:bg-none">
                        <div class="card-body">
                            <div class="grid grid-cols-12">
                                <div class="col-span-6 pe-0">
                                    <p class="mb-2"><span class="text-[1rem]">Total Orders</span></p>
                                    <p class="mb-2 text-[0.75rem]">
                                        <span class="vertical-bottom mb-0 text-[1.5625rem] leading-none font-semibold">
                                            {{ App\Models\Order::all()->count() }}</span>
                                        <span
                                            class="block text-[0.625rem] font-semibold text-[#8c9097] dark:text-white/50">
                                            THIS MONTH
                                        </span>
                                    </p>
                                    <a href="javascript:void(0);"
                                        class="text-primary! mb-0 flex items-center text-[0.75rem]">
                                        Show full stats
                                        <i class="icon-[mdi--chevron-right] ms-1"></i>
                                    </a>
                                </div>
                                <div class="col-span-6">
                                    <p
                                        class="badge bg-danger/10 text-danger! inline-flex ltr:float-right rtl:float-left">
                                        <i class="icon-[mdi--chevron-down] me-1"></i>12%
                                    </p>
                                    <p class="main-card-icon mb-0">
                                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg"
                                            enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                            width="24px" fill="#000000">
                                            <g>
                                                <rect fill="none" height="24" width="24"></rect>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M12,6c-3.87,0-7,3.13-7,7s3.13,7,7,7s7-3.13,7-7S15.87,6,12,6z M13,14h-2V8h2V14z"
                                                        opacity=".3"></path>
                                                    <rect height="2" width="6" x="9" y="1"></rect>
                                                    <path
                                                        d="M19.03,7.39l1.42-1.42c-0.43-0.51-0.9-0.99-1.41-1.41l-1.42,1.42C16.07,4.74,14.12,4,12,4c-4.97,0-9,4.03-9,9 c0,4.97,4.02,9,9,9s9-4.03,9-9C21,10.88,20.26,8.93,19.03,7.39z M12,20c-3.87,0-7-3.13-7-7s3.13-7,7-7s7,3.13,7,7S15.87,20,12,20z">
                                                    </path>
                                                    <rect height="6" width="2" x="11" y="8"></rect>
                                                </g>
                                            </g>
                                        </svg>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-3">
                    <div class="card to-primary-100 bg-linear-to-tl from-violet-100/50 via-transparent dark:bg-none">
                        <div class="card-body">
                            <div class="grid grid-cols-12">
                                <div class="col-span-6 pe-0">
                                    <p class="mb-2"><span class="text-[1rem]">Total Customers</span></p>
                                    <p class="mb-2 text-[0.75rem]">
                                        <span class="vertical-bottom mb-0 text-[1.5625rem] leading-none font-semibold">
                                            2,146
                                        </span>
                                        <span
                                            class="block text-[0.625rem] font-semibold text-[#8c9097] dark:text-white/50">
                                            THIS MONTH
                                        </span>
                                    </p>
                                    <a href="javascript:void(0);"
                                        class="text-primary mb-0 flex items-center text-[0.75rem]">
                                        Show full stats
                                        <i class="icon-[mdi--chevron-right] ms-1"></i>
                                    </a>
                                </div>
                                <div class="col-span-6">
                                    <p
                                        class="badge bg-success/10 text-success! inline-flex ltr:float-right rtl:float-left">
                                        <i class="icon-[mdi--chevron-up] me-1"></i>27%
                                    </p>
                                    <p class="main-card-icon mb-0">
                                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24px"
                                            viewBox="0 0 24 24" width="24px" fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                                            <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3">
                                            </path>
                                            <path
                                                d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z">
                                            </path>
                                        </svg>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-6 lg:col-span-6 xl:col-span-3">
                    <div class="card bg-linear-to-tl from-violet-100/50 via-transparent to-green-100 dark:bg-none">
                        <div class="card-body">
                            <div class="grid grid-cols-12">
                                <div class="col-span-6 pe-0">
                                    <p class="mb-2"><span class="text-[1rem]">Profit By Sale</span></p>
                                    <p class="mb-2 text-[0.75rem]">
                                        <span class="vertical-bottom mb-0 text-[1.5625rem] leading-none font-semibold">
                                            $653
                                        </span>
                                        <span
                                            class="block text-[0.625rem] font-semibold text-[#8c9097] dark:text-white/50">
                                            THIS MONTH
                                        </span>
                                    </p>
                                    <a href="javascript:void(0);"
                                        class="text-primary mb-0 flex items-center text-[0.75rem]">
                                        Show full stats
                                        <i class="icon-[mdi--chevron-right] ms-1"></i>
                                    </a>
                                </div>
                                <div class="col-span-6">
                                    <p
                                        class="badge bg-success/10 text-success! inline-flex ltr:float-right rtl:float-left">
                                        <i class="icon-[mdi--chevron-up] me-1"></i>32.5%
                                    </p>
                                    <p class="main-card-icon mb-0">
                                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24px"
                                            viewBox="0 0 24 24" width="24px" fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                                            <path
                                                d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1.23 13.33V19H10.9v-1.69c-1.5-.31-2.77-1.28-2.86-2.97h1.71c.09.92.72 1.64 2.32 1.64 1.71 0 2.1-.86 2.1-1.39 0-.73-.39-1.41-2.34-1.87-2.17-.53-3.66-1.42-3.66-3.21 0-1.51 1.22-2.48 2.72-2.81V5h2.34v1.71c1.63.39 2.44 1.63 2.49 2.97h-1.71c-.04-.97-.56-1.64-1.94-1.64-1.31 0-2.1.59-2.1 1.43 0 .73.57 1.22 2.34 1.67 1.77.46 3.66 1.22 3.66 3.42-.01 1.6-1.21 2.48-2.74 2.77z"
                                                opacity=".3"></path>
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z">
                                            </path>
                                        </svg>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <!-- Card -->
                <div class="card card-body flex min-h-[410px] flex-col">
                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm text-gray-500 dark:text-neutral-500">Income</h2>
                            <p class="text-xl font-medium text-gray-800 sm:text-2xl dark:text-neutral-200">
                                $126,238.49
                            </p>
                        </div>

                        <div>
                            <span
                                class="inline-flex items-center gap-x-1 rounded-md bg-teal-100 px-1.5 py-[5px] text-xs font-medium text-teal-800 dark:bg-teal-500/10 dark:text-teal-500">
                                <svg class="inline-block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14" />
                                    <path d="m19 12-7 7-7-7" />
                                </svg>
                                25%
                            </span>
                        </div>
                    </div>
                    <!-- End Header -->
                    <div id="hs-multiple-bar-charts"></div>
                </div>
                <!-- End Card -->
                <!-- Card -->
                <div class="card card-body flex min-h-[410px] flex-col">
                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm text-gray-500 dark:text-neutral-500">Visitors</h2>
                            <p class="text-xl font-medium text-gray-800 sm:text-2xl dark:text-neutral-200">
                                80.3k
                            </p>
                        </div>

                        <div>
                            <span
                                class="inline-flex items-center gap-x-1 rounded-md bg-red-100 px-1.5 py-[5px] text-xs font-medium text-red-800 dark:bg-red-500/10 dark:text-red-500">
                                <svg class="inline-block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14" />
                                    <path d="m19 12-7 7-7-7" />
                                </svg>
                                2%
                            </span>
                        </div>
                    </div>
                    <!-- End Header -->

                    <div id="hs-single-area-chart"></div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
</x-app-layout>
