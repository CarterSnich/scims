<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Constants;
use Illuminate\Http\Request;
use App\Models\IdApplication;
use App\Models\SeniorCitizen;
use App\Models\SocialPension;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PrintController extends Controller
{
    // print citizens
    public function citizens()
    {
        $citizens = SeniorCitizen::select(
            'senior_citizens.*',
            'barangays.barangay_name'
        )->leftJoin(
            'barangays',
            'senior_citizens.barangay',
            '=',
            'barangays.id'
        )->get();


        return
            view('print.print_citizens', [
                'citizens' => $citizens
            ]);
    }

    // print citizen
    public function citizen(SeniorCitizen $citizen)
    {
        $citizen_id = date('Y', strtotime($citizen->created_at)) . '-' . str_pad($citizen->id, 5, '0', STR_PAD_LEFT);
        $fullname = "{$citizen['lastname']}, {$citizen['firstname']} {$citizen['middlename']}";
        $age = Carbon::parse($citizen->date_of_birth)->age;
        $educational_attainment = Constants::EDUCATIONAL_ATTAINMENTS[$citizen->educational_attainment];
        $barangay = Barangay::where('id', '=', $citizen->barangay)->first();

        return view('print.print_citizen', [
            'citizen' => $citizen,
            'citizen_id' => $citizen_id,
            'fullname' => $fullname,
            'age' => $age,
            'educational_attainment' => $educational_attainment,
            'barangay' => $barangay
        ]);
    }

    // print barangays
    public function barangays()
    {
        return
            view('print.print_barangays', [
                'barangays' => Barangay::select(
                    'barangays.*'
                )
                    ->selectRaw('COUNT(senior_citizens.id) AS no_of_residents')
                    ->leftJoin('senior_citizens', 'barangays.id', '=', 'senior_citizens.barangay')
                    ->groupBy('barangays.id')
                    ->get()
            ]);
    }

    // print barangays
    public function barangay(Barangay $barangay)
    {
        return
            view('print.print_barangay', [
                'barangay' => $barangay,
                'residents' => SeniorCitizen::where('barangay', '=', $barangay->id)->get()
            ]);
    }

    public function pension(SocialPension $pension)
    {
        return view('print.print_pension', [
            'pension' => $pension
        ]);
    }
}
