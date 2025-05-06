<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;

class BookingController extends Controller{

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'service' => 'required|string',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
    ]);

    // Create and save the appointment using mass assignment
    $appointment = Appointment::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'service' => $validated['service'],
        'date' => $validated['date'],
        'time' => $validated['time'],
        'user_id' => auth()->id(), // Save the user ID
    ]);

    // Send confirmation email
    Mail::to($validated['email'])->send(new AppointmentConfirmation($appointment));

    return redirect()->back()->with('status', 'Appointment booked successfully! A confirmation email has been sent.');

}
public function show()
{
$services = Service::all(); // جلب كل الخدمات من الجدول
 return view('public.layout.booking', compact('services'));
}

}
