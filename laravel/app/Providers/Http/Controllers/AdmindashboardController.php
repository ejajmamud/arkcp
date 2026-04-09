<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Student;
use DB;
use Barryvdh\Debugbar\Facade as DebugBar;

class AdmindashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $sales = Payment::where('payment_status', 'Approved')->get();
        // $sales = Payment::where('payment_status', 'Approved')->selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
        //         ->groupBy('year', 'month')
        //         ->orderBy('year', 'desc')
        //         ->get();
        $labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        Debugbar::info($labels);
        $data = [];
        foreach ($labels as $key => $value) {
            
            $dataUsd[] = Payment::where(\DB::raw("DATE_FORMAT(created_at, '%M')"),$value)->where('payment_gateway', '=', 'paypal')->count();
            $dataRm[] = Payment::where(\DB::raw("DATE_FORMAT(created_at, '%M')"),$value)->where('payment_gateway', '=', 'senangpay')->count();
        }
        Debugbar::info(json_encode($data));
        $usersChartData = [];
        foreach ($labels as $key => $value) {
            $usersChartData[] = Student::where(\DB::raw("DATE_FORMAT(created_at, '%M')"),$value)->count();
        }
        Debugbar::info('$usersChartData'.json_encode($usersChartData));
        
         $testsChartData = [];
        foreach ($labels as $key => $value) {
            $testsChartData[] = Student::where('payment_status', '=', 'approved')->where(\DB::raw("DATE_FORMAT(created_at, '%M')"),$value)->count();
        }
        Debugbar::info('$testsChartData'.json_encode($testsChartData));
        
        // $studentsUnique = DB::table('students')->distinct('email')->count('email');
        $allStudents = DB::table('students')->count();
        
        $testsCompleted = DB::table('students')->where('isTestCompleted', '=', 1)->where('payment_status', '=', 'approved')->get();
        
        $tests = DB::table('students')->where('payment_status', '=', 'approved')->get();
        
        $totalIncome = DB::table('payments')->where('payment_status', '=', 'approved')->where('payment_gateway', '=', 'paypal')->sum('amount');
        $totalIncomeRm = DB::table('payments')->where('payment_status', '=', 'approved')->where('payment_gateway', '=', 'senangpay')->sum('amount');

        // Debugbar::info('$studentsUnique'.$studentsUnique);
        
        return view('dashboard', ['datausd' => json_encode($dataUsd), 'datarm' => json_encode($dataRm), 'users'=>$allStudents, 'incomeRm' => $totalIncomeRm, 'completedTests' => $testsCompleted, 'income'=>$totalIncome, 'usersChartData'=>json_encode($usersChartData), 'testsChartData'=>json_encode($testsChartData)]);
    }
}
