@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Profile {{ Auth::user()->name }} </h1>
@stop
@section('css')
<link rel="stylesheet" href="./asset/all.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

        .profile {
            margin: auto;
            text-align: center;
            /* justify-items: center; */

        }

        body{
            font-family: 'Poppins';
        }

        .snip1336 {
            font-family: 'Poppins';
            position: relative;
            overflow: hidden;
            margin: 10px;
            /* min-width: 670px; */
            /* max-width: 315px; */
            width: 100%;
            color: #000000;
            text-align: center;
            line-height: 1.4em;
            /* background-color: #ffffff; */
        }

        .snip1336 * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }

        .snip1336 img {
            max-width: 100%;
            vertical-align: top;
            opacity: 0.85;
        }

        .snip1336 figcaption {
            width: 100%;
            background-color: #ffffff;
            padding: 25px;
            position: relative;
        }

        .snip1336 figcaption:before {
            position: absolute;
            content: '';
            bottom: 100%;
            left: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 55px 0 0 400px;
            border-color: transparent transparent transparent #141414;
        }

        .snip1336 figcaption a {
            padding: 5px;
            border: 1px solid #ffffff;
            color: #ffffff;
            font-size: 0.7em;
            text-transform: uppercase;
            margin: 10px 0;
            display: inline-block;
            opacity: 0.65;
            width: 47%;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .snip1336 figcaption a:hover {
            opacity: 1;
        }

        .snip1336 .profile {
            border-radius: 50%;
            position: absolute;
            bottom: 100%;
            left: 25px;
            z-index: 1;
            max-width: 90px;
            opacity: 1;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .snip1336 .follow {
            margin-right: 4%;
            border-color: #2980b9;
            color: #2980b9;
        }

        .snip1336 h2 {
            font-weight: bolder;
        }

        .snip1336 h2 span {
            display: block;
            font-size: 0.5em;
            color: #2980b9;
            font-weight: normal;
            font-style: italic;

        }

        .snip1336 p {
            margin: 0 0 10px;
            font-size: 0.8em;
            letter-spacing: 1px;
            opacity: 0.8;
        }

        #profile {
            max-width: 100px;
            /* Maksimum lebar gambar adalah 100% dari kontainer */
            max-height: 200px;
            /* Maksimum tinggi gambar adalah 300px */
            border: 2px solid #ccc;
            /* Border dengan ketebalan 2px dan warna #ccc */

        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body ">
                    <div class="text-center">
                        <img class="profile img-fluid img-circle"
                            src="{{ asset('image/profile/' . Auth::user()->profile_image) }}" alt="User profile"
                            style="width: 150px; height: 150px; align-items:center;">
                    </div>
                    <h3 class="profile-username text-center"></h3>
                    <p class="text-muted text-center">Member since {{ Auth::user()->created_at->format('l / H-F-Y') }}</p>
                    <figure class="snip1336">
                        <h2>{{ Auth::user()->name }}<span>{{ Auth::user()->role->name }}</span></h2><br>
                        <a href="/login" style="color:red; margin-right:10px; ">Log Out</a>
                        </form>
                        <a href="{{ route('user.index') }}" class="info">More Info</a>
                    </figure>

                </div>
            </div>
        </div>


        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.updateData') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ Auth::user()->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                        </div>
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="new_password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        /* Demo purposes only */
        $(".hover").mouseleave(
            function() {
                $(this).removeClass("hover");
            }
        );
    </script>
@stop
