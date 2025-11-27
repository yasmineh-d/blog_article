<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog') - My Awesome Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto max-w-6xl px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition">
                <i class="fas fa-blog mr-2"></i>MyBlog
            </a>
            
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 font-medium transition {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">Home</a>
                <a href="{{ route('articles.index') }}" class="text-gray-600 hover:text-blue-600 font-medium transition {{ request()->routeIs('articles.*') ? 'text-blue-600' : '' }}">Articles</a>
            </nav>

            <div class="flex items-center space-x-4">
                <form action="{{ route('search') }}" method="GET" class="hidden md:block">
                    <div class="relative">
                        <input type="text" name="q" placeholder="Search..." class="pl-8 pr-4 py-1 rounded-full border border-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm w-48 transition-all focus:w-64">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
                    </div>
                </form>
                <a href="{{ route('admin.articles.index') }}" class="text-sm text-gray-500 hover:text-gray-800">Admin</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto max-w-6xl px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="container mx-auto max-w-6xl px-4 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <span class="text-xl font-bold text-gray-800">MyBlog</span>
                    <p class="text-sm text-gray-500 mt-1">Sharing knowledge and ideas.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-blue-600 transition"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-blue-800 transition"><i class="fab fa-facebook text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-gray-800 transition"><i class="fab fa-github text-xl"></i></a>
                </div>
            </div>
            <div class="border-t border-gray-100 mt-6 pt-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} MyBlog. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
