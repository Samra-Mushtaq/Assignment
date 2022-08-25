@extends('layouts.backend.auth_app')
@section('content')

<!-- @vite(['resources/backend/js/login.js']) -->

<div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
    <div class="absolute-top-right d-lg-none p-3 p-sm-5">
        <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
    </div>
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <a href="html/index.html" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="{{ asset('images/logo.png') }}" srcset="./images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('images/logo-dark.png') }}"  srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
            </a>
        </div>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Sign-In</h5>
                <div class="nk-block-des">
                    <p>Access the DashLite panel using your email and passcode.</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <form method="POST" action="{{ route('login') }}" class="form-validate is-alter" autocomplete="off" novalidate="novalidate">
            @csrf
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="email-address">Email </label>
                    <a class="link link-primary link-sm" tabindex="-1" href="#">Need Help?</a>
                </div>
                <div class="form-control-wrap">
                    <input autocomplete="off" type="text" name="email" id="email" class="form-control form-control-lg" required="" id="email-address" name="email" placeholder="Enter your email address ">
                </div>
            </div><!-- .form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="password">Passcode</label>
                    <a class="link link-primary link-sm" tabindex="-1" href="html/pages/auths/auth-reset.html">Forgot Code?</a>
                </div>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input autocomplete="new-password" type="password" id="password" name="password" class="form-control form-control-lg" required="" name="password" id="password" placeholder="Enter your passcode">
                </div>
            </div><!-- .form-group -->
            <div class="form-group">
                <button  class="btn btn-lg btn-primary btn-block">Sign in</button>
            </div>
        </form><!-- form -->
        <div class="form-note-s2 pt-4"> New on our platform? <a href="{{ asset('/register') }}">Create an account</a>
        </div>
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
                                    <img  src="{{ asset('images/flags/spanish.png') }}" alt="" class="language-flag">
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
            </ul><!-- .nav -->
        </div>
        <div class="mt-3">
            <p>© 2022 DashLite. All Rights Reserved.</p>
        </div>
    </div><!-- .nk-block -->
</div>
@endsection

