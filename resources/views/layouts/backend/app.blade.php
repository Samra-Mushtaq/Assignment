<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    @include('layouts.backend.partials.head')
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('layouts.backend.partials.sidebar')
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('layouts.backend.partials.header')
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content  p-4">
                @yield('content')
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                @include('layouts.backend.partials.footer')
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- select region modal -->
    <!-- .modal -->
    <!-- JavaScript -->

    @vite(['resources/js/bundle.js?ver=2.9.1', 'resources/js/scripts.js?ver=2.9.1'])
</body>

</html>