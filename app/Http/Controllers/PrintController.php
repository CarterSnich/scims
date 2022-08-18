<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;
use App\Models\IdApplication;
use App\Models\SeniorCitizen;
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

        // @ddd($citizens);

        return
            view('print.print_citizens', [
                'citizens' => $citizens
            ]);
    }

    // print citizen
    public function citizen(SeniorCitizen $citizen)
    {
        $citizen['citizenId'] = date('Y', strtotime($citizen['created_at'])) . '-' . str_pad($citizen['id'], 5, '0', STR_PAD_LEFT);
        $citizen['fullname'] = "{$citizen['lastname']}, {$citizen['firstname']} {$citizen['middlename']}";
        return view('print.print_citizen', [
            'citizen' => $citizen,
            'barangay' => Barangay::where('id', '=', $citizen['barangay'])->first()
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

    // print application
    public function id_application(IdApplication $application)
    {
        $application = IdApplication::select(
            'id_applications.*',
            'senior_citizens.*',
            DB::raw(
                "CONCAT(YEAR(senior_citizens.created_at), '-', LPAD(senior_citizens.id, 5, '0')) AS cid"
            ),
            'barangays.barangay_name'
        )->leftJoin(
            'senior_citizens',
            'id_applications.citizen',
            '=',
            'senior_citizens.id'
        )->leftJoin(
            'barangays',
            'senior_citizens.barangay',
            '=',
            'barangays.id'
        )->where(
            'id_applications.id',
            '=',
            $application->id
        )->first();

        return
            view('print.print_application', [
                'application' => $application
            ]);
    }
}
