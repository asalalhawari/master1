<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{public function index()
    {
        // Your regular stats
        $stats = [
            'total_users' => User::count(),
            'new_users' => User::whereDate('created_at', '>=', now()->subMonth())->count(),
            'total_appointments' => Appointment::count(),
            'completed_appointments' => Appointment::where('status', 'completed')->count(),
            'total_services' => Service::count(),
        ];
    
        // Appointment stats
        $appointmentStats = [
            'by_status' => Appointment::groupBy('status')
                ->select('status', DB::raw('count(*) as count'))
                ->get()
                ->pluck('count', 'status'),
            
            'monthly_trend' => Appointment::select(
                DB::raw('MONTH(appointment_date) as month'),
                DB::raw('YEAR(appointment_date) as year'),
                DB::raw('count(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get(),
        ];
    
        // Pass both $stats and $appointmentStats to the view
        return view('dashboard.layout.dashboard', compact('stats', 'appointmentStats'));
    }
    
}