<?php

namespace App\Http\Controllers;

use App\Services\HospitalService;
use Illuminate\Http\Request;
use App\Models\Hospital;

class HospitalController extends Controller
{
    protected $hospitalService;

    public function index(Request $request)
    {
        $hospitals = Hospital::paginate($request->query('per_page', 10));
        return response()->json($hospitals);
    }

    public function __construct(HospitalService $hospitalService)
    {
        $this->hospitalService = $hospitalService;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $hospital = $this->hospitalService->createHospital($data);

        return response()->json($hospital, 201);
    }
}