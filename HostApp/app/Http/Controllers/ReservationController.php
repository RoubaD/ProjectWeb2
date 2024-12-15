<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
class ReservationController extends Controller
{
    public function getUserReservations(DestinationController $destinationController)
    {
        $userId = Auth::id();

        $reservations = Reservation::where('client_id', $userId)->get();

        foreach ($reservations as $reservation) {
            $reservation->destinationDetails = $destinationController->getDestinationById($reservation->destination_id);
        }

        return view('reservations.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        
        
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'destination_id' => 'required|exists:destinations,id',
        ]);

        
        $reservation = Reservation::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'destination_id' => $request->destination_id,
            'client_id' => Auth::id(),
        ]);

        return redirect()->route('reservations.show', $reservation->id)->with('success', 'Reservation successfully created!');
    }

    public function downloadInvoice($reservationId, DestinationController $destinationController)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $reservation->destinationDetails = $destinationController->getDestinationById($reservation->destination_id);

        $pdf = Pdf::loadView('invoices.invoice', compact('reservation'));
        return $pdf->download('invoice_' . $reservation->id . '.pdf');
    }

    public function downloadReceipt($reservationId, DestinationController $destinationController)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $reservation->destinationDetails = $destinationController->getDestinationById($reservation->destination_id);
        $reservation->user = Auth::user()->name;
        $pdf = Pdf::loadView('receipts.receipt', compact('reservation'));

        return $pdf->download('receipt_' . $reservation->id . '.pdf');
    }
}
