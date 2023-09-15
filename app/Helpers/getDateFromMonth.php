<?php
use Carbon\Carbon;

function getDateFromMonth($month)
{
    $date = Carbon::parse(Carbon::now()->format("Y")."-$month-01")->format('Y-m-d');

    return (object)[
        'start' => Carbon::parse($date)->format("Y-m")."-01",
        'end' => Carbon::parse($date)->endOfMonth()->format("Y-m-d")
    ];
}