<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="font-sans text-gray-900 antialiased selection:bg-indigo-500 selection:text-white">
        <div class="min-h-screen flex">
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900 relative overflow-hidden items-center justify-center">
                <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-40">
                    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-indigo-500 blur-3xl mix-blend-screen"></div>
                    <div class="absolute bottom-12 right-12 w-80 h-80 rounded-full bg-purple-500 blur-3xl mix-blend-screen"></div>
                    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 32px 32px;"></div>
                </div>
                
                <div class="relative z-10 text-center px-12">
                    <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-2xl transform rotate-3">
                        <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h1 class="text-4xl font-black text-white tracking-tight mb-4">Mulai Belanja di ChipiChapa.</h1>
                    <p class="text-lg text-indigo-200">Sistem pendataan inventaris dan belanja online yang cepat, aman, dan dapat diandalkan oleh ribuan pelanggan setia.</p>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12 bg-gray-50">
                <div class="w-full max-w-md">
                    <div class="lg:hidden mb-10 flex justify-center">
                        <a href="/" class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <span class="text-2xl font-black text-gray-900 tracking-tight">ChipiChapa.</span>
                        </a>
                    </div>

                    <div class="bg-white px-8 py-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-3xl border border-gray-100 relative">
                        <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full blur-2xl opacity-20 pointer-events-none"></div>
                        <div class="relative z-10">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
