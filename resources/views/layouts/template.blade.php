<!doctype html>
<html lang="en">

@include('layouts.head')

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">

    <!--  Sidebar -->
    @include('layouts.sidebar')
    <!--  End Sidebar -->

    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!-- Header -->
        @include('layouts.header')
        <!-- End Header -->
        <div class="container-fluid">
            <!--  Content -->
            @yield('content')
            <!-- End Content -->

            <!--  Footer -->
            @include('layouts.footer')
            <!-- End Footer -->
        </div>
    </div>
    <!-- End Main wrapper -->
</div>

@include('layouts.script')

</body>

</html>
