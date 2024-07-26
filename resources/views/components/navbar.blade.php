{{-- <nav class="fixed top-2 z-30 w-full md:top-6">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
        <div
            class="relative flex h-14 items-center justify-between gap-3 rounded-2xl bg-white/90 px-3 shadow-lg shadow-black/[0.03] backdrop-blur-sm before:pointer-events-none before:absolute before:inset-0 before:rounded-[inherit] before:border before:border-transparent before:[background:linear-gradient(theme(colors.gray.100),theme(colors.gray.200))_border-box] before:[mask-composite:exclude_!important] before:[mask:linear-gradient(white_0_0)_padding-box,_linear-gradient(white_0_0)]">
            <div class="flex items-center">
                <a href="/" class="inline-flex">
                    <img src="{{ asset('assets/logo/kg.png') }}" width="50" height="50" alt="Logo Klinik Gunung" />
                </a>
            </div>
            <button id="menu-toggle" class="block md:hidden text-gray-800 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
            <ul id="nav-menu" class="hidden md:flex flex-1 items-center justify-end gap-3">
                <li>
                    <a href="{{ route('about') }}" class="text-gray-800">About Us</a>
                </li>
                <li>
                    <a href="/our-service" class="text-gray-800">Our Service</a>
                </li>
                <li>
                    <a href="/our-product" class="text-gray-800">Our Product</a>
                </li>
                <li>
                    <a href="/blog" class="text-gray-800">Blog</a>
                </li>
                <li>
                    <a href="/contact-us" class="text-gray-800">Contact Us</a>
                </li>
                @if (Request::is('login'))
                @else
                    <li>
                        <a href="{{ route('login') }}" class="btn-sm bg-white text-gray-800 shadow hover:bg-gray-50">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="btn-sm bg-gray-800 text-gray-200 shadow hover:bg-gray-900">Signup</a>
                    </li>
                @endif
            </ul>
        </div>
        <ul id="dropdown-menu" class="hidden md:hidden flex flex-col gap-3 mt-4 bg-white rounded-xl shadow-lg p-4">
            <li>
                <a href="/about-us" class="text-gray-800">About Us</a>
            </li>
            <li>
                <a href="/our-service" class="text-gray-800">Our Service</a>
            </li>
            <li>
                <a href="/our-product" class="text-gray-800">Our Product</a>
            </li>
            <li>
                <a href="/blog" class="text-gray-800">Blog</a>
            </li>
            <li>
                <a href="/contact-us" class="text-gray-800">Contact Us</a>
            </li>
            @if (Request::is('login'))
            @else
                <li>
                    <a href="{{ route('login') }}" class="btn-sm bg-white text-gray-800 shadow hover:bg-gray-50">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="btn-sm bg-gray-800 text-gray-200 shadow hover:bg-gray-900">Signup</a>
                </li>
            @endif
        </ul>
    </div>
</nav> --}}
<nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <a href="/" class="flex items-center">
            <img src="{{ asset('assets/logo/kg.png') }}" class="mr-3 h-10 sm:h-9" alt="Flowbite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"></span>
        </a>
        <div class="flex items-center lg:order-2">
            @guest
                <a href="{{ route('login') }}"
                    class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                    Log in
                </a>
                <a href="{{ route('register') }}"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    Register
                </a>
            @endguest

            @auth
                <div class="flex items-center ml-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            id="user-menu-button-2" aria-expanded="false" data-dropdown-toggle="dropdown-2">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->getProfilePhotoUrl() }}"
                                alt="user photo">
                        </button>
                    </div>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-2">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            @php
                                $role = Auth::user()->role;
                                switch ($role) {
                                    case 'admin':
                                        $dashboardRoute = 'admin.welcome';
                                        break;
                                    case 'dokter':
                                        $dashboardRoute = 'dokter.welcome';
                                        break;
                                    case 'kasir':
                                        $dashboardRoute = 'kasir.welcome';
                                        break;
                                    case 'koordinator':
                                        $dashboardRoute = 'koordinator.welcome';
                                        break;
                                    case 'manajer':
                                        $dashboardRoute = 'manajer.welcome';
                                        break;
                                    case 'paramedis':
                                        $dashboardRoute = 'paramedis.welcome';
                                        break;
                                    case 'pendaki':
                                        $dashboardRoute = 'pendaki.welcome';
                                        break;
                                    default:
                                        $dashboardRoute = 'home';
                                        break;
                                }
                            @endphp
                            <li>
                                <a href="{{ route($dashboardRoute) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Settings</a>
                            </li>
                            <li>
                                <a href=""
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button data-collapse-toggle="mobile-menu-2" type="button"
                class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <x-navlink href='/' :active="request()->is('/')">Home</x-navlink>
                </li>
                <li>
                    <x-navlink href='blog' :active="request()->is('blog')">Blog</x-navlink>
                </li>
                <li>
                    <x-navlink href='contact' :active="request()->is('contact')">Contact Us</x-navlink>
                </li>
                <li>
                    <x-navlink href='services' :active="request()->is('services')">Our Services</x-navlink>
                </li>
                <li>
                    <x-navlink href='about' :active="request()->is('about')">About</x-navlink>
                </li>
                <li>
                    <x-navlink href='products' :active="request()->is('products')">Products</x-navlink>
                </li>
            </ul>
        </div>
    </div>
</nav>