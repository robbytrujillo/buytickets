<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Services\BookingService;

class BookingController extends Controller
{
    //
    protected $bookingService;

    public function __construct(BookingService $bookingService) {
        $this->bookingService = $bookingService;
    }

    public function booking(Ticket $ticket) {
        return view('front.booking', compact($ticket));
    }
}