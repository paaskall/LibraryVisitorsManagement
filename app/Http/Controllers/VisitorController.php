<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Http\Requests\VisitorRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $query = Visitor::query();

        if ($request->date) {
            $query->whereDate('check_in', $request->date);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('member_id', 'like', "%{$request->search}%")
                  ->orWhere('purpose', 'like', "%{$request->search}%");
            });
        }

        $visitors = $query->latest('check_in')->paginate(10);

        $todayVisitors = Visitor::whereDate('check_in', Carbon::today())->count();
        $monthlyVisitors = Visitor::whereMonth('check_in', Carbon::now()->month)->count();
        $activeVisitors = Visitor::whereNull('check_out')->count();

        return view('visitors.index', compact(
            'visitors', 
            'todayVisitors', 
            'monthlyVisitors', 
            'activeVisitors'
        ));
    }

    public function create()
    {
        return view('visitors.create');
    }

    // Menggabungkan kedua method store
    public function store(VisitorRequest $request)
    {
        try {
            Visitor::create($request->validated());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Check-in berhasil!'
                ]);
            }
            
            return redirect('/')
                ->with('success', 'Data pengunjung berhasil ditambahkan');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat check-in'
                ], 500);
            }
            throw $e;
        }
    }

    public function edit(Visitor $visitor)
    {
        return view('visitors.edit', compact('visitor'));
    }

    public function update(VisitorRequest $request, Visitor $visitor)
    {
        $visitor->update($request->validated());
        return redirect()->route('visitors.index')
            ->with('success', 'Data pengunjung berhasil diperbarui');
    }

    public function destroy(Visitor $visitor)
    {
        $visitor->delete();
        return redirect()->route('visitors.index')
            ->with('success', 'Data pengunjung berhasil dihapus');
    }

    // Menggabungkan kedua method checkout
    public function checkout(Visitor $visitor)
    {
        try {
            $visitor->update(['check_out' => now()]);
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Check-out berhasil!'
                ]);
            }
            
            return redirect()->route('visitors.index')
                ->with('success', 'Pengunjung berhasil checkout');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat check-out'
                ], 500);
            }
            throw $e;
        }
    }

public function statistics()
{
    $dailyVisitors = DB::table('visitors')
        ->select(DB::raw('DATE(check_in) as date'), DB::raw('COUNT(*) as total'))
        ->where('check_in', '>=', now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $purposeStats = DB::table('visitors')
        ->select('purpose', DB::raw('COUNT(*) as total'))
        ->whereNotNull('purpose')
        ->groupBy('purpose')
        ->get();

    return view('visitors.statistics', [
        'dailyVisitors' => $dailyVisitors,
        'purposeStats' => $purposeStats
    ]);
}

    public function welcome()
    {
        $activeVisit = null;
        if (Auth::check()) {
            $activeVisit = Visitor::whereNull('check_out')
                ->latest('check_in')
                ->first();
        }
        return view('welcome', compact('activeVisit'));
    }
}
