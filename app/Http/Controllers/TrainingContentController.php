<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingDetail;
use Illuminate\Support\Facades\Auth;

class TrainingContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $filename = 'training_detail';
        $filename_script = getContentScript(true, $filename);
        
        $code = Auth::guard('admin')->user();
        $data = TrainingDetail::get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Daftar Layanan Konten',
            'auth_user' => $code,
            'dataTrainingDetail' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
