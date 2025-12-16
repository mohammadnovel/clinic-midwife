<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Midwife;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Pregnancy;
use App\Models\AncVisit;
use App\Models\Transaction;
use App\Models\PracticeSchedule;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ClinicalSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $midwives = Midwife::all();
        $services = Service::all();

        if ($patients->isEmpty() || $midwives->isEmpty())
            return;

        // 1. Practice Schedules for Midwives
        foreach ($midwives as $midwife) {
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            foreach ($days as $day) {
                PracticeSchedule::create([
                    'midwife_id' => $midwife->id,
                    'day' => $day,
                    'start_time' => '08:00',
                    'end_time' => '16:00',
                ]);
            }
        }

        // ... existing code ...
        // 2. Simulate Data for each Patient
        foreach ($patients as $index => $patient) {

            // Case A: Pregnant Patient (Active) -> Same as before
            if ($index < 3) {
                // ... (Keep existing pregnancy logic) ...
                $pregnancy = Pregnancy::create([
                    'patient_id' => $patient->id,
                    'hpht' => Carbon::now()->subMonths(4),
                    'hpl' => Carbon::now()->addMonths(5),
                    'gravida' => 1,
                    'status' => 'active'
                ]);

                // Create 2 ANC Visits (Past)
                for ($i = 1; $i <= 2; $i++) {
                    $date = Carbon::now()->subMonths(3 - $i);
                    $appt = Appointment::create([
                        'patient_id' => $patient->id,
                        'midwife_id' => $midwives->random()->id,
                        'queue_number' => 'A-00' . $i . $index,
                        'appointment_date' => $date,
                        'service_category' => 'ANC',
                        'status' => 'completed'
                    ]);

                    AncVisit::create([
                        'pregnancy_id' => $pregnancy->id,
                        'appointment_id' => $appt->id,
                        'gestational_age_weeks' => 8 + ($i * 4),
                        'fundal_height' => (10 + $i) . ' cm',
                        'fetal_heart_rate' => '140 bpm',
                        'weight' => '60 kg',
                        'blood_pressure' => '110/70',
                        'complaints' => 'Mual muntah berkurang',
                        'actions' => 'Pemberian vitamin',
                    ]);

                    // Transaction for this visit
                    $trx = Transaction::create([
                        'patient_id' => $patient->id,
                        'code' => 'INV-' . strtoupper(Str::random(6)),
                        'total_amount' => 50000,
                        'paid_amount' => 50000,
                        'payment_status' => 'paid',
                        'payment_method' => 'cash',
                        'created_at' => $date
                    ]);

                    \App\Models\TransactionDetail::create([
                        'transaction_id' => $trx->id,
                        'item_name' => 'Pemeriksaan ANC',
                        'item_type' => 'Service',
                        'quantity' => 1,
                        'price' => 50000,
                        'subtotal' => 50000,
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);
                }
            }

            // Case B: Delivered Patient (History)
            else if ($index >= 3 && $index < 6) {
                $pregnancy = Pregnancy::create([
                    'patient_id' => $patient->id,
                    'hpht' => Carbon::now()->subMonths(10),
                    'hpl' => Carbon::now()->subMonths(1),
                    'gravida' => 2,
                    'partus' => 1,
                    'status' => 'delivered'
                ]);

                // Delivery
                $deliveryDate = Carbon::now()->subMonths(1);
                $deliveryAppt = Appointment::create([
                    'patient_id' => $patient->id,
                    'midwife_id' => $midwives->random()->id,
                    'queue_number' => 'D-00' . $index,
                    'appointment_date' => $deliveryDate,
                    'service_category' => 'Delivery',
                    'status' => 'completed'
                ]);

                $delivery = \App\Models\Delivery::create([
                    'pregnancy_id' => $pregnancy->id,
                    'appointment_id' => $deliveryAppt->id,
                    'delivery_time' => $deliveryDate,
                    'method' => 'Normal',
                    'birth_condition' => 'Healthy',
                    'blood_loss_ml' => 200,
                ]);

                // Baby
                \App\Models\Baby::create([
                    'delivery_id' => $delivery->id,
                    'patient_id' => $patient->id,
                    'name' => 'Bayi ' . $patient->name,
                    'gender' => $index % 2 == 0 ? 'male' : 'female',
                    'birth_weight' => 3.2,
                    'birth_length' => 49,
                    'birth_time' => $deliveryDate->format('H:i'),
                    'birth_condition' => 'Healthy'
                ]);

                // Immunization (BCG)
                $immDate = $deliveryDate->copy()->addDays(7);
                $immAppt = Appointment::create([
                    'patient_id' => $patient->id, // Mother (acting for child)
                    'midwife_id' => $midwives->random()->id,
                    'queue_number' => 'IM-00' . $index,
                    'appointment_date' => $immDate,
                    'service_category' => 'Immunization',
                    'status' => 'completed'
                ]);

                \App\Models\ImmunizationRecord::create([
                    'patient_id' => $patient->id, // Note: Schema links patient_id. Ideally Patient table has child.
                    'appointment_id' => $immAppt->id,
                    'immunization_type_id' => \App\Models\ImmunizationType::where('name', 'BCG')->first()->id ?? \App\Models\ImmunizationType::first()->id,
                    'date_given' => $immAppt->appointment_date,
                    'batch_number' => 'BCG-' . Str::random(4),
                    'notes' => 'Anak ijin menangis'
                ]);
            }

            // Case C: General Visit Today (Queue)
            else if ($index >= 6) {
                Appointment::create([
                    'patient_id' => $patient->id,
                    'midwife_id' => $midwives->random()->id,
                    'queue_number' => 'B-00' . $index,
                    'appointment_date' => Carbon::now(),
                    'service_category' => 'General',
                    'status' => $index == 6 ? 'in_progress' : 'pending'
                ]);
            }
        }
    }
}
