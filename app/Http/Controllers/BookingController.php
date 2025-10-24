<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Services\BookingService;
use App\Http\Requests\StoreBookingRequest;

class BookingController extends Controller
{
    //
    protected $bookingService;

    public function __construct(BookingService $bookingService) {
        $this->bookingService = $bookingService;
    }

    public function booking(Ticket $ticket) {
        dd($ticket);
        // return view('front.booking', compact($ticket));
    }

    public function bookingStore(Ticket $ticket, StoreBookingRequest $request) {
        $validated = $request->validated();
        // array data
        
        $totals = $this->bookingService->calculateTotals($ticket->id, $validated['total_participant']);
        
        $this->bookingService->storeBookingInSession($ticket, $validated, $totals);

        return redirect()->route('front.payment');
    }

    public function payment() {
        $data = $this->bookingService->payment();
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
}