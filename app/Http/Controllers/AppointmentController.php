<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;
use App\Models\Service;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('dashbord.Appointment.index', compact('appointments'));
    }

    public function create()
    {
        return view('dashbord.Appointment.create');
    }

    public function store(Request $request)
    {
        
        $v = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'service_id' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);



        $appointment = new Appointment();
        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->service_id = $request->service_id;
        $appointment->service = Service::find($request->service_id)->name;
        $appointment->appointment_date = $request->date;
        $appointment->appointment_time = $request->time;
        
        if (auth()->check()) {
            $appointment->user_id = auth()->id();
        }

        $appointment->save();

        // Mail::to($request->email)->send(new AppointmentConfirmation($appointment));

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully! A confirmation email has been sent.');
    }

    public function show(Appointment $appointment)
    {
        return view('dashbord.Appointment.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        return view('dashbord.Appointment.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $appointment->update($request->all());
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    public function trashed()
    {
        $appointments = Appointment::onlyTrashed()->get();
        return view('dashbord.Appointment.trashed', compact('appointments'));
    }

    public function restore($id)
    {
        $appointment = Appointment::onlyTrashed()->findOrFail($id);
        $appointment->restore();
        return redirect()->route('appointments.trashed')->with('success', 'Appointment restored successfully.');
    }

    public function forceDelete($id)
    {
        $appointment = Appointment::onlyTrashed()->findOrFail($id);
        $appointment->forceDelete();
        return redirect()->route('appointments.trashed')->with('success', 'Appointment permanently deleted.');
    }

    public function updateRating(Request $request, Appointment $appointment)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string|max:255',
        ]);

        $appointment->rating = $request->rating;
        $appointment->review = $request->review;

        $appointment->save();

        return response()->json(['message' => 'Rating and review updated successfully!']);
    }
}
