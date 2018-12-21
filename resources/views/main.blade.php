<html lang="en">
<header>
    @include('partials._head')
</header>
<body>
      @include('partials._nav')
   <div class="container">
      @include('partials._messages')
       @yield('content')

        @include('partials._footer')
   </div>

      @include('partials._javascript')
      @yield('scripts')

</body>
</html>