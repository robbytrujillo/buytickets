<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Services\BookingService;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreCheckBookingRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\BookingTransaction;

class BookingController extends Controller
{
    //
    protected $bookingService;

    public function __construct(BookingService $bookingService) {
        $this->bookingService = $bookingService;
    }

    public function booking(Ticket $ticket) {
        // dd($ticket);
        return view('front.booking', compact('ticket'));
    }

    public function bookingStore(Ticket $ticket, StoreBookingRequest $request) {
        $validated = $request->validated();
        // array data

        // dd($validated);
        
        $totals = $this->bookingService->calculateTotals($ticket->id, $validated['total_participant']);
        
        $this->bookingService->storeBookingInSession($ticket, $validated, $totals);

        //  $booking = session('booking');
        //  dd($booking);

        return redirect()->route('front.payment');
    }

    public function payment() {
        $data = $this->bookingService->payment();
        // dd($data);

        return view('front.payment', $data);
    }

    public function paymentStore(StorePaymentRequest $request) {
        $validated = $request->validated();
        $bookingTransactionId = $this->bookingService->paymentStore($validated);

        if ($bookingTransactionId) {
            return redirect()->route('front.booking_finished', $bookingTransactionId);
        }

        return redirect()->route('front.index')->withErrors(['error' => 'Payment failed. Please try again.']);
    }

    public function bookingFinished(BookingTransaction $bookingTransaction) {
        return view('front.booking_finished', compact('bookingTransaction'));
    }

    public function checkBooking() {
        return view('front.check_booking');
    }

    public function checkBookingDetails(StoreCheckBookingRequest $request) {
        $validated = $request->validated();

        $bookingDetails = $this->bookingService->getBookingDetails($validated);

        // dd($bookingDetails);

        if ($bookingDetails) {
            return view('front.check_booking_details', compact('bookingDetails'));
        }

        return redirect()->route('front.check_booking')->withErrors(['error' => 'Transaction Not Found']);
    }
}