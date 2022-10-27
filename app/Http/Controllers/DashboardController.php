<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barangay;
use App\Models\IdApplication;
use Illuminate\Http\Request;
use App\Models\SeniorCitizen;
use App\Models\SocialPension;
use Carbon\Carbon;
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
                view('pages.barangays', [
                    'barangays' => $barangays
                ]);
        } else {
            return view('pages.barangays', [
                'barangays' => Barangay::orderBy('barangay_name')->paginate(50)
            ]);
        }
    }

    // view barangay
    public function view_barangay(Request $request)
    {
        if ($barangay = Barangay::where('id', '=', $request['id'])->first()) {
            return
                view('pages.view_barangay', [
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
        if ($search_key = $request->search) {
            $citizens = SeniorCitizen::orderBy('lastname')->paginate(50);
        } else {
            $citizens = SeniorCitizen::orderBy('lastname')->paginate(50);
        };

        return
            view('pages.citizens', [
                'citizens' => $citizens
            ]);
    }

    // senior citizen registration page
    public function register_citizen()
    {
        return view('pages.register_citizen', [
            'barangays' => Barangay::all()->sortBy('barangay_name'),
            'civil_status_select' => SeniorCitizen::$civil_statuses,
            'educational_attainment_select' => SeniorCitizen::$educational_attainments
        ]);
    }

    // view senior citizen data page
    public function view_citizen(SeniorCitizen $citizen)
    {
        $citizen_id = date('Y', strtotime($citizen['created_at'])) . '-' . str_pad($citizen['id'], 5, '0', STR_PAD_LEFT);
        $educational_attainment = SeniorCitizen::$educational_attainments[$citizen->educational_attainment];
        $family_composition = $citizen->family_composition;

        return view('pages.view_citizen', [
            'citizen' => $citizen,
            'citizen_id' => $citizen_id,
            'educational_attainment' => $educational_attainment,
            'family_composition' => $family_composition
        ]);
    }

    // update senior citizen page
    public function edit_citizen(SeniorCitizen $citizen)
    {
        $citizen['citizenId'] = date('Y', strtotime($citizen['created_at'])) . '-' . str_pad($citizen['id'], 5, '0', STR_PAD_LEFT);
        return view('pages.edit_citizen', [
            'citizen' => $citizen,
            'barangays' => Barangay::orderBy('barangay_name')->get()
        ]);
    }

    // pensions page
    public function pensions()
    {
        return view('pages.pensions', [
            'pensions' => SocialPension::paginate(50),
        ]);
    }

    // view pension
    public function view_pension(SocialPension $pension)
    {
        $age = Carbon::parse($pension->date_of_birth)->age;
        $living_arrangement = SocialPension::LIVING_ARRANGEMENTS[$pension->living_arrangement];
        $pensioner_source = $pension->pensioner_source ? SocialPension::PENSIONER_SOURCES[$pension->pensioner_source] : null;
        $barangay = Barangay::where('id', '=', $pension->barangay)->first();

        return view('pages.view_pension', [
            'pension' => $pension,
            'age' => $age,
            'living_arrangement' => $living_arrangement,
            'pensioner_source' => $pensioner_source,
            'barangay' => $barangay
        ]);
    }

    public function apply_pension()
    {
        return view('pages.apply-social-pension', [
            'civil_status_select' => SeniorCitizen::$civil_statuses,
            'barangays' => Barangay::select(['barangay_name', 'id'])->get(),
            'living_arrangements' => SocialPension::LIVING_ARRANGEMENTS,
            'pensioner_sources' => SocialPension::PENSIONER_SOURCES
        ]);
    }

    // pension intakes
    public function intakes()
    {
        return view('pages.intakes');
    }

    // register intakes
    public function register_intake()
    {
        return view('pages.register-pension-intake', [
            'barangays' => Barangay::all()
        ]);
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
            view('pages.reports', [
                'citizens' => $citizens,
                'barangays' => $barangays,
                'age_reports' => $ageReports,
                'gender_reports' => $genderReports,
                'male_counts' => SeniorCitizen::where('gender', '=', 'male')->get()->count(),
                'female_counts' => SeniorCitizen::where('gender', '=', 'female')->get()->count(),
            ]);
    }

    // user accounts page
    public function users()
    {
        if (Auth::user()->type == 'admin') {
            return view('pages.users', [
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
        return view('pages.settings');
    }

    // delisted
    public function delisted(Request $request)
    {
        if (auth()->user()->type == 'admin') {
            if ($search_key = $request->search) {
                $citizens =
                    SeniorCitizen::where('is_delisted', '=', 1)
                    ->where(function ($query) use ($search_key) {
                        $query->where('lastname', 'LIKE', "%{$search_key}%")
                            ->orWhere('firstname', 'LIKE', "%{$search_key}%")
                            ->orWhere('middlename', 'LIKE', "%{$search_key}%");
                    })
                    ->orderBy('lastname')
                    ->paginate(50);
            } else {
                $citizens =
                    SeniorCitizen::where('is_delisted', '=', 1)
                    ->orderBy('lastname')
                    ->paginate(50);
            };

            return
                view('pages.citizens', [
                    'citizens' => $citizens
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
            view('pages.id_applications', [
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
            view('pages.id_application', [
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
            view('pages.view_id_application', [
                'application' => $application,
                'citizen' => $citizen,
                'barangay' => $barangay
            ]);
    }
}
