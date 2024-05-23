<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manager | {{ config('app.name') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
  <x-css-components />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('templates.manager.topbar')
        @include('templates.manager.sidebar')
        <div class="content-wrapper">
         @yield('content')

    @include('templates.admin.footer')
