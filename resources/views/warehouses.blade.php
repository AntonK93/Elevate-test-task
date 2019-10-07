<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Warehouses</title>
</head>
<body>
<script src="{{ asset('js/app.js') }}" defer></script>
    <div id="app">
    <div class="panel-body table-responsive">
      <router-view name="CompWarehouses"></router-view>
      <router-view></router-view>
   </div>
    </div>
</body>
</html>