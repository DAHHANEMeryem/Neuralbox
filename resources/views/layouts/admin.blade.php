<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
       <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css','resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>


 
@stack('scripts')
<body class="bg-gray-100 font-sans leading-normal tracking-tight">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg fixed h-full">
            <div class="p-6">

            
                <div class="flex items-center mb-8">
                    <div class="bg-indigo-600 h-8 w-8 rounded-md flex items-center justify-center mr-3">
                        <i class="fas fa-chart-line text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-semibold text-gray-800">PlatefOrme</span>
                </div>
                
                <nav>
    <ul class="space-y-1">
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-4 py-3 rounded-md
               {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <i class="fas fa-th-large mr-3 w-5 text-center"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="/admin/utilisateurs"
               class="flex items-center px-4 py-3 rounded-md
               {{ request()->is('admin/utilisateurs*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <i class="fas fa-users mr-3 w-5 text-center"></i>
                <span>Utilisateurs</span>
            </a>
        </li>

        <li>
            <a href="/admin/rendezvous"
               class="flex items-center px-4 py-3 rounded-md
               {{ request()->is('admin/rendezvous*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <i class="fas fa-calendar-alt mr-3 w-5 text-center"></i>
                <span>Rendez-vous</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.paiements') }}"
               class="flex items-center px-4 py-3 rounded-md
               {{ request()->is('admin/paiements*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <i class="fas fa-credit-card mr-3 w-5 text-center"></i>
                <span>Abonnes</span>
            </a>
        </li>
        

        <li>
            <a href="/admin/ressources"
               class="flex items-center px-4 py-3 rounded-md
               {{ request()->is('admin/ressources*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <i class="fas fa-book mr-3 w-5 text-center"></i>
                <span>Ressources</span>
            </a>
        </li>

        <li>
            <a href="/admin/messages"
               class="flex items-center px-4 py-3 rounded-md
               {{ request()->is('admin/messages*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <i class="fas fa-envelope mr-3 w-5 text-center"></i>
                <span>Message</span>
            </a>
        </li>

        <li>
            <a href="/messagerie"
               class="flex items-center px-4 py-3 rounded-md
               {{ request()->is('/messagerie*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
               <i class="fas fa-comment mr-3 w-5 text-center"></i>


                <span>Messagerie</span>
            </a>
        </li>
    </ul>
</nav>


                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="flex items-center justify-center px-4 py-2 rounded-md text-red-600 hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span>{{ __('nav.deconnexion') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </aside>
        
        <!-- Contenu principal -->
        <main class="ml-64 flex-1">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center px-8 py-4">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    </div>
                                        <div class="flex items-center space-x-4">
                        <!-- <div class="relative">
                            <input type="text" placeholder="Rechercher..." class="px-4 py-2 pr-8 rounded-md border border-gray-300 focus:outline-none focus:border-indigo-500">
                            <i class="fas fa-search text-gray-400 absolute right-3 top-2.5"></i>
                        </div> -->
                        <div class=" flex items-center space-x-2">
                            <button    onclick="window.location.href='/profile'"class="relative flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-full bg-indigo-200 flex items-center justify-center text-indigo-700 font-semibold">A</div>
                            <span class="text-sm font-medium text-gray-700">Admin</span>
                            </button>
                        </div>
                        
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>