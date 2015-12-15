@extends('template')

@section('skeleton')

    <div id="wrap">

    <div class="container-fluid top">
        <div class="welcome">
            <ul>
                @if(\Auth::user())
                    <li><b>Welcome {{ \Auth::user()->first_name }}</b></li>
                    @if(\Auth::user()->isAdmin())
                        <li><a href="{{ action('ProductController@create') }}">New Product</a></li>
                    @endif
                    <li><a href="{{ action('OrderController@showActive') }}">
                        My Basket
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                    </a></li>
                    <li><a href="{{ url('auth/logout') }}">
                        Logout
                        <span class="glyphicon glyphicon-log-out"></span>
                    </a></li>
                @else
                    <li><a href="{{ url('auth/register') }}">
                        Register
                        <span class="glyphicon glyphicon-registration-mark"></span>
                    </a></li>
                    <li><a href="{{ url('auth/login') }}">
                        Sign In
                        <span class="glyphicon glyphicon-log-in"></span>
                    </a></li>
                @endif
            </ul>
        </div>
    </div>

    @include('_navbar')

    <div class="container">
    	<div class="row">

            @yield('content')

            <div class="row text-center">
                @yield('pagination')
            </div>

        </div>
    </div>

    </div>

@stop