<!DOCTYPE html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/scheduler.css">

    <script src="/js/app.js"></script>
    <script src="/js/scheduler.js"></script>
</head>

<body>
    <div id="scheduler_here" class="dhx_cal_container"
        style='width:100%; height:800px;'>
        <div class="dhx_cal_navline">
            <div class="dhx_cal_prev_button">&nbsp;</div>
            <div class="dhx_cal_next_button">&nbsp;</div>
            <div class="dhx_cal_today_button"></div>
            <div class="dhx_cal_date"></div>
            <select id="room_filter" onchange='showRooms(this.value)'></select>
        </div>
        <div class="dhx_cal_header">
        </div>
        <div class="dhx_cal_data">
        </div>
    </div>
</body>
