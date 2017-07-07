<?php

namespace App\Business;

class DatePayment
{
    private $date;
    private $month;
    private $year;

    public function __construct( $date )
    {
        $this->date  = $date;
        $this->month = date("m",strtotime($date));
        $this->year  = date("Y",strtotime($date));
    }

    public function getMonth() {
        return $this->month;
    }

    public function getYear() {
        return $this->year;
    }

    public function getDate() {
        return $this->date;
    }
}