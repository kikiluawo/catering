<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="__alpine_init_data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ env('APP_NAME') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      @include('admin.layouts.sidebar')
      
      <div class="flex flex-col flex-1 w-full">
        @include('admin.layouts.header')
        <main class="h-full overflow-y-auto">
            @yield('content')
        </main>
      </div>
    </div>
  </body>
</html>
