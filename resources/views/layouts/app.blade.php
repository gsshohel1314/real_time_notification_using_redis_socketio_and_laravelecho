<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Time Notification | @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    @if(!Auth::guest())
    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white flex flex-col p-4 space-y-4">
      <h2 class="text-xl font-bold">Dashboard</h2>
      <nav>
          <ul class="space-y-2">
              <li><a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-gray-700">Home</a></li>
              <li><a href="{{ route('posts.index') }}" class="block p-2 rounded hover:bg-gray-700">Posts</a></li>
          </ul>
      </nav>
    </div>
    @endif

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      @if(!Auth::guest())
      <!-- Topbar -->
      <header class="bg-white shadow p-4 flex justify-between items-center">
          <a href="{{ route('dashboard') }}" class="text-xl font-semibold uppercase">Real Time Notification</a>
          <div class="flex items-center space-x-4">
            <span class="font-semibold">{{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Logout</button>
            </form>
        </div>
      </header>
      @endif

      <!-- Dashboard Content -->
      <main class="container mx-auto p-6">
        @yield('content')
      </main>
    </div>
  </div>
</body>
</html>