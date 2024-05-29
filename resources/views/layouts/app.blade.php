@include('app.admin.includes._header')
@include('app.admin.includes._sidebar')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        @yield('content')
    </div>
</div>
@yield('scripts')
@include('app.admin.includes._footer')