<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients Record - MacArthur RHU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#1a4332] text-white flex flex-col">
        <div class="p-6 flex items-center gap-3">
            <div class="w-10 h-10">
                <img src="{{ asset('images/mac.png') }}" class="rounded-full">
            </div>
            <div>
                <h1 class="text-sm font-bold">PATIENTS RECORD</h1>
                <p class="text-[10px] opacity-70">MacArthur RHU</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">

            <a href="{{ route('dashboard') }}"
               class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
               <i class="fas fa-home w-5"></i> Dashboard
            </a>

            <a href="{{ route('families.index') }}"
               class="sidebar-link {{ request()->routeIs('families.*') ? 'active' : '' }}">
               <i class="fas fa-folder w-5"></i> Family Records
            </a>

            <a href="{{ route('families.create') }}" class="sidebar-link">
               <i class="fas fa-user-plus w-5"></i> Add Family
            </a>

            <a href="{{ route('patients.create') }}" class="sidebar-link">
               <i class="fas fa-user w-5"></i> Add Patient
            </a>

            <a href="{{ route('barangays.index') }}"
               class="sidebar-link {{ request()->routeIs('barangays.*') ? 'active' : '' }}">
               <i class="fas fa-map-marker-alt w-5"></i> Barangays
            </a>

        </nav>

        <div class="px-4 pb-6 border-t border-white border-opacity-20">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="sidebar-link w-full justify-start hover:bg-red-600">
                    <i class="fas fa-sign-out-alt w-5"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 flex flex-col overflow-y-auto">

        <!-- HEADER -->
        <header class="bg-white h-16 flex items-center justify-between px-8 shadow-sm">
            <div></div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-800">MacHealth</p>
                    <p class="text-xs text-gray-500">Records Staff</p>
                </div>
                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <div class="p-8 space-y-8">
            @yield('content')
        </div>

    </main>
</div>

<style>
.sidebar-link{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px;
    border-radius:8px;
    transition:0.2s;
}

.sidebar-link:hover{
    background:rgba(255,255,255,0.08);
}

.active{
    background:rgba(255,255,255,0.15);
    border-left:4px solid white;
}
</style>

</body>
</html>