<!DOCTYPE html>
<html lang="en">

<head>
    @include("layouts.head")
    @livewireStyles
    <title>DHS</title>
</head>

<body>
    <!--  Body Wrapper -->
    @auth
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include("layouts.sidebar")
        <!--  Main wrapper -->
        <div class="body-wrapper">
            @include("layouts.header")
            @yield("content")
        </div>
    </div>
    @endauth
    @yield("content")
    @include("layouts.foot")
    @livewireScripts
</body>

</html>