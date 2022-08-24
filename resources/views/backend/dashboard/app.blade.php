<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    @include('backend.partial.head')
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('backend.partial.sidebar')
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('backend.partial.header')
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                @include('backend.dashboard.content')
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                @include('backend.partial.footer')
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