<?php
use Carbon\Carbon;

function getDateFromMonth($month)
{
    return Carbon::parse(Carbon::now()->format("Y")."-$month-01")->format('Y-m-d');
}