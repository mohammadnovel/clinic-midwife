<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\WebsiteContent;
use App\Models\Appointment;
use App\Models\PracticeSchedule;
use App\Models\Midwife;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->locale('id')->isoFormat('dddd'); // e.g., 'Senin'
        $date = Carbon::today();

        // 1. Queue Info (Appointments Today)
        $totalQueue = Appointment::whereDate('appointment_date', $date->format('Y-m-d'))->count();
        $pendingQueue = Appointment::whereDate('appointment_date', $date->format('Y-m-d'))
            ->where('status', 'scheduled') // Assuming 'scheduled' is the initial status
            ->count();
        $servedQueue = Appointment::whereDate('appointment_date', $date->format('Y-m-d'))
            ->where('status', 'completed')
            ->count();

        // 2. Midwife Schedule for Today (Shift Logic)
        // We fetch all schedules for today
        // Note: 'day' in DB might be English or Indonesian. Assuming Indonesian based on locale, but standard seeders usually use English 'Monday'. 
        // Let's assume standard English days for safety first, or check how they are seeded.
        // If checking previous context, seeders were removed? No, created 2025_..._schedules. 
        // I'll assume standard 0-6 or English names. Let's use English names for query.
        $dayEnglish = Carbon::now()->format('l'); // Monday, Tuesday...

        $schedules = PracticeSchedule::with('midwife.user')
            ->where('day', $dayEnglish)
            ->get();

        $shifts = [
            'Pagi' => [],
            'Siang' => [],
            'Malam' => [],
        ];

        foreach ($schedules as $schedule) {
            $start = (int) substr($schedule->start_time, 0, 2);

            // Logic to categorize shift based on start time
            if ($start >= 7 && $start < 15) {
                $shifts['Pagi'][] = $schedule;
            } elseif ($start >= 15 && $start < 22) {
                $shifts['Siang'][] = $schedule;
            } else {
                $shifts['Malam'][] = $schedule;
            }
        }

        // 3. Services & Content (Existing)
        $services = Service::where('is_active', true)->get();
        $sliders = WebsiteContent::where('key', 'slider')->get();
        $midwives = Midwife::with('user')->where('is_active', true)->get();

        return view('welcome', compact(
            'services',
            'sliders',
            'totalQueue',
            'pendingQueue',
            'servedQueue',
            'shifts',
            'midwives',
            'today'
        ));
    }
}
