<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    @include('backend.partial.head')
</head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
    });
    var APP_URL = {!! json_encode(url('/')) !!};
    
</script>
<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        @yield('content')
                        @include('backend.auth.slider')
                    </div>
                </div>
                <!-- content @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    @vite(['resources/js/bundle.js?ver=2.9.1', 'resources/js/scripts.js?ver=2.9.1'])
</body>

</html>