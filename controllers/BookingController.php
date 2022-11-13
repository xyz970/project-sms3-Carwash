<?php

class BookingController extends BaseController
{

    private $booking;
    public function __construct()
    {
        $this->booking = new Booking();
    }

    public function getIndex()
    {
        $status = $this->booking->rawQuery("SELECT COUNT(*) from bookings WHERE is_valid = 'true'")->get();
        // $status = $this->booking->mysql()->query("SELECT COUNT('id') as count from bookings WHERE is_valid = 'true'");
        // print_r($status->fetch_row());
        return $this->view('booking', array('status' => $status->fetch_row()));
    }
}
