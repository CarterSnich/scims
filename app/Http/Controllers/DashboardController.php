<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barangay;
use App\Models\IdApplication;
use Illuminate\Http\Request;
use App\Models\SeniorCitizen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    // barangays list page
    public function barangays(Request $request)
    {
        if ($search_key = $request['search']) {
            $barangays = Barangay::where('barangay_name', 'LIKE', "%{$search_key}%")
                ->orderBy('barangay_name')->paginate(50);
            return
                view('dashboard.barangays', [
                    'barangays' => $barangays
                ]);
        } else {
            return view('dashboard.barangays', [
                'barangays' => Barangay::orderBy('barangay_name')->paginate(50)
            ]);
        }
    }

    // view barangay
    public function view_barangay(Request $request)
    {
        if ($barangay = Barangay::where('id', '=', $request['id'])->first()) {
            return
                view('dashboard.view_barangay', [
                    'barangay' => $barangay,
                    'citizens' => SeniorCitizen::where('barangay', '=', $request['id'])->paginate(50)
                ]);
        } else {
            return redirect(404);
        }
    }

    // senior citizens list page
    public function citizens(Request $request)
    {
        $where = [
            ['is_delisted', '=', 0]
        ];
        if ($search_key = $request->search) {
            $citizen =
                SeniorCitizen::where($where)
                ->where('lastname', 'LIKE', "%{$search_key}%")
                ->orWhere('firstname', 'LIKE', "%{$search_key}%")
                ->orWhere('middlename', 'LIKE', "%{$search_key}%")
                ->orderBy('lastname')->paginate(50);
        } else {
            $citizen =
                SeniorCitizen::where($where)
                ->orderBy('lastname')
                ->paginate(50);
        }

        return
            view('dashboard.citizens', [
                'citizens' => $citizen
            ]);
    }

    // senior citizen registration page
    public function register_citizen()
    {
        return view('dashboard.register_citizen', [
            'barangays' => Barangay::all()->sortBy('barangay_name')
        ]);
    }

    // update senior citizen page
    public function edit_citizen(SeniorCitizen $citizen)
    {
        $citizen['citizenId'] = date('Y', strtotime($citizen['created_at'])) . '-' . str_pad($citizen['id'], 5, '0', STR_PAD_LEFT);
        return view('dashboard.edit_citizen', [
            'citizen' => $citizen,
            'barangays' => Barangay::orderBy('barangay_name')->get()
        ]);
    }

    // view senior citizen data page
    public function view_citizen(Request $request)
    {
        $citizen = SeniorCitizen::where('senior_citizens.id', '=', $request['id'])->first();
        $citizen['citizen_id'] = date('Y', strtotime($citizen['created_at'])) . '-' . str_pad($citizen['id'], 5, '0', STR_PAD_LEFT);
        if ($citizen) {
            return view('dashboard.view_citizen', [
                'citizen' => $citizen,
                'barangay' => Barangay::where('id', '=', $citizen['barangay'])->first()
            ]);
        } else {
            return redirect(404);
        }
    }

    // pensions page
    public function pensions()
    {
        return view('dashboard.pensions');
    }

    // reports page
    public function reports()
    {
        $citizens = SeniorCitizen::all();
        $barangays = Barangay::orderBy('barangay_name')->get();

        // hideous
        $maleAgeCounts = DB::table('senior_citizens')
            ->select(DB::raw('age, count(age) as count'))
            ->where('gender', '=', 'male')
            ->groupBy('age')
            ->get();
        $femaleAgeCounts = DB::table('senior_citizens')
            ->select(DB::raw('age, count(age) as count'))
            ->where('gender', '=', 'female')
            ->groupBy('age')
            ->get();

        // hideous
        $ageReports = [];
        foreach ($citizens as $citizen) {
            $ageReports["{$citizen->age}"] = [
                'male' => 0,
                'female' => 0,
            ];
        }
        foreach ($maleAgeCounts as $ageCount) {
            $ageReports["{$ageCount->age}"]['male'] = $ageCount->count;
        }
        foreach ($femaleAgeCounts as $ageCount) {
            $ageReports["{$ageCount->age}"]['female'] = $ageCount->count;
        }

        // hideous
        $maleBarangayCounts = DB::select('
            SELECT
                barangays.barangay_name,
                COUNT(barangay) AS count
            FROM
                `senior_citizens`
            INNER JOIN barangays ON senior_citizens.barangay = barangays.id
            WHERE
                gender = "male"
            GROUP BY
                barangay
        ');
        $femaleBarangayCounts = DB::select('
                SELECT
                    barangays.barangay_name,
                    COUNT(barangay) AS count
                FROM
                    `senior_citizens`
                INNER JOIN barangays ON senior_citizens.barangay = barangays.id
                WHERE
                    gender = "female"
                GROUP BY
                    barangay
            ');

        // hideous
        $genderReports = [];
        foreach ($barangays as $barangay) {
            $genderReports["{$barangay->barangay_name}"] = [
                'male' => 0,
                'female' => 0,
            ];
        }
        foreach ($maleBarangayCounts as $barangayCount) {
            $genderReports["{$barangayCount->barangay_name}"]['male'] = $barangayCount->count;
        }
        foreach ($femaleBarangayCounts as $barangayCount) {
            $genderReports["{$barangayCount->barangay_name}"]['female'] = $barangayCount->count;
        }

        return
            view('dashboard.reports', [
                'citizens' => $citizens,
                'barangays' => $barangays,
                'age_reports' => $ageReports,
                'gender_reports' => $genderReports
            ]);
    }

    // user accounts page
    public function users()
    {
        if (Auth::user()->type == 'admin') {
            return view('dashboard.users', [
                'users' => User::all()
            ]);
        } else {
            return
                redirect()
                ->back()
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Unauthorized access to page.'
                    ]
                ]);
        }
    }

    // settings page
    public function settings()
    {
        if (auth()->user()->type == 'admin') {
            return view('dashboard.settings');
        } else {
            return
                back()
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Please, check your inputs.'
                    ]
                ]);
        }
    }

    // delist
    public function delisted()
    {
        if (auth()->user()->type == 'admin') {
            return
                view('dashboard.citizens', [
                    'citizens' => SeniorCitizen::where('is_delisted', '=', 1)->paginate(50)
                ]);
        } else {
            return
                back()
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Unauthorized page access.'
                    ]
                ]);
        }
    }

    // id applicatons
    public function id_applications()
    {
        return
            view('dashboard.id_applications', [
                'applications' => IdApplication::select(
                    'id_applications.*',
                    'citizen.lastname',
                    'citizen.firstname',
                    'citizen.middlename'
                )->leftJoin(
                    'senior_citizens AS citizen',
                    'citizen.id',
                    '=',
                    'id_applications.citizen'
                )->paginate(50)
            ]);
    }

    // id application
    public function id_apply(SeniorCitizen $citizen)
    {
        return
            view('dashboard.id_application', [
                'applicant' => $citizen,
                'citizens' => SeniorCitizen::all()
            ]);
    }

    // view id application
    public function view_id_application(IdApplication $application)
    {
        $citizen = SeniorCitizen::where('id', '=', $application->citizen)->first();
        $barangay = Barangay::where('id', '=', $citizen->barangay)->first();

        return
            view('dashboard.view_id_application', [
                'application' => $application,
                'citizen' => $citizen,
                'barangay' => $barangay
            ]);
    }
}
