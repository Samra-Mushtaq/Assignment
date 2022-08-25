@extends('layouts.backend.auth_app')
@section('content')

<!-- @vite(['resources/js/backend/register.js']) -->
<div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
    <div class="absolute-top-right d-lg-none p-3 p-sm-5">
        <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
    </div>
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <a href="html/index.html" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="{{ asset('images/logo.png') }}" srcset="./images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('images/logo-dark.png') }}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
            </a>
        </div>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Register</h5>
                <div class="nk-block-des">
                    <p>Create New Dashlite Account</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="name">Name</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter your name">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg" name="email" id="email" placeholder="Enter your email address or username">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Mobile No </label>
                <div class="form-control-wrap">
                    <input type="number" max="11" class="form-control form-control-lg" name="mobile_no" id="mobile_no" placeholder="Enter your mobile no">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Passcode</label>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your passcode">
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-control-xs custom-checkbox">
                    <p id="success_msg" style="color: #45b945"></p>
                </div>
            </div>
            <div class="form-group">
                <button type="button" id="signup" class="btn btn-lg btn-primary btn-block">Register</button>
            </div>
        </form><!-- form -->
        <div class="form-note-s2 pt-4"> Already have an account ? <a href="{{ asset('/login') }}"><strong>Sign in instead</strong></a>
        </div>
        <div class="text-center pt-4 pb-3">
            <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
        </div>
        <ul class="nav justify-center gx-8">
            <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Google</a></li>
        </ul>
    </div><!-- .nk-block -->
    <div class="nk-block nk-auth-footer">
        <div class="nk-block-between">
            <ul class="nav nav-sm">
                <li class="nav-item">
                    <a class="nav-link" href="#">Terms &amp; Condition</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
                <li class="nav-item dropup active current-page">
                    <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-toggle="dropdown" data-offset="0,10"><small>English</small></a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="language-list">
                            <li>
                                <a href="#" class="language-item">
                                    <img src="{{ asset('images/flags/english.png') }}" alt="" class="language-flag">
                                    <span class="language-name">English</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="language-item">
                                    <img src="{{ asset('images/flags/spanish.png') }}" alt="" class="language-flag">
                                    <span class="language-name">Español</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="language-item">
                                    <img src="{{ asset('images/flags/french.png') }}" alt="" class="language-flag">
                                    <span class="language-name">Français</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="language-item">
                                    <img src="{{ asset('images/flags/turkey.png') }}" alt="" class="language-flag">
                                    <span class="language-name">Türkçe</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul><!-- nav -->
        </div>
        <div class="mt-3">
            <p>© 2022 DashLite. All Rights Reserved.</p>
        </div>
    </div><!-- nk-block -->
</div>
<script>
    var APP_URL = {!! json_encode(url('/')) !!};
    jQuery(document).ready(function () {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(document).on("click", "#signup", function(event) { 
        $("#success_msg").html("");
        var err_res = 0;
        var name = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var phone_no = $("#mobile_no").val();

        if (name == '' || name == null) {
            $('#name').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#name').css("border-color", "#dfdfdf");
        }
        if (email == '' || email == null) {
            $('#email').css("border-color", "red");
            err_res = 1;
        }else{
            var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
            if(!pattern.test(email)){
                $('#email').css("border-color", "red");
                err_res = 1;
            }else{
                $('#email').css("border-color", "#dfdfdf"); 
            }
        }

        if (password == '' || password == null) {
            $('#password').css("border-color", "red");
            err_res = 1;
        }else{
            $('#password').css("border-color", "#dfdfdf");
        }
        // console.log(phone_no.length);
        if (phone_no == '' || phone_no == null || phone_no.length != 11) {
            $('#mobile_no').css("border-color", "red");
            err_res = 1;
        }else{
            $('#mobile_no').css("border-color", "#dfdfdf");
        }

        

        if(err_res == 0){
            jQuery.ajax({
                type: "POST",
                url: APP_URL + "/api/register",
                data: {
                    email : email, name : name, password : password, phone_no: phone_no
                },
                success: function (response) {
                    $("#success_msg").html("User Successfully Created, You Can Sign Into Your Account");
                    $("#name").val("");
                    $("#email").val("");
                    $("#password").val("");
                    $("#mobile_no").val("");
                },
                error: function (response) {
                    $('#email').css("border-color", "red");
                }
            });
        }
    });

</script>
@endsection