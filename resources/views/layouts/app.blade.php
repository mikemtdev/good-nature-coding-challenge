<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
                <div class="flex w-full min-h-screen ">
                    <!-- Sidebar -->
                    <aside class="w-56 shadow-lg min-h-screen  bg-white dark:bg-gray-800">
                        <div class="p-4 border-b">
                            <h1 class="text-2xl font-bold dark:text-white text-gray-800">Good Nature</h1>
                        </div>
                        <nav class="p-4  bg-white dark:bg-gray-800">
                            <ul>
                                <li>
                                    <a
                                        href="/dashboard"
                                        class="flex items-center px-4 py-2 dark:text-white
                                         text-gray-700 rounded hover:bg-gray-200"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 mr-2"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 10h18M9 21H3a1 1 0 01-1-1V3a1 1 0 011-1h18a1 1 0 011 1v8"
                                            />
                                        </svg>
                                        Overview
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="/farmers"
                                        class="flex items-center px-4 py-2 mt-2 dark:text-white text-gray-700 rounded hover:bg-gray-200"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 mr-2"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 3h12M6 8h12M6 13h6"
                                            />
                                        </svg>
                                        Farmers
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="/loans"
                                        class="flex items-center px-4 py-2 mt-2 dark:text-white text-gray-700 rounded hover:bg-gray-200"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 mr-2"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 17l4-4-4-4m4 4H4m14 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                        Loans
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="/modules"
                                        class="flex items-center px-4 py-2 mt-2 dark:text-white text-gray-700 rounded hover:bg-gray-200"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 mr-2"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 11l4-4 4 4m4-4v12a1 1 0 01-1 1H6a1 1 0 01-1-1V7"
                                            />
                                        </svg>
                                        Modules
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="/reports"
                                        class="flex items-center px-4 py-2 dark:text-white mt-2 text-gray-700 rounded hover:bg-gray-200"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 mr-2"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 17v-4m0-4v-4m12 8a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1v-6a1 1 0 011-1h6zm-6 4h6"
                                            />
                                        </svg>
                                        Reports
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </aside>

                    <!-- Main Content -->
                    <main class="flex-1 p-6">
                        {{ $slot }}
                    </main>
                </div>


        </div>
    </body>
</html>
