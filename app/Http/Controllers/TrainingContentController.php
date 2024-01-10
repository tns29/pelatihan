<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\TrainingDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $data = TrainingDetail::with('training')
                                ->orderBy('training_id')
                                ->get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Daftar Konten Pelatihan ',
            'auth_user' => $code,
            'dataTrainingDetail' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filename = 'add_training_detail';
        $filename_script = getContentScript(true, $filename);

        $code = Auth::guard('admin')->user(); 
        $training = Training::get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Tambah Kontent Pelatihan',
            'auth_user' => $code, 
            'dataTraining' => $training, 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'training_id'      => 'required',
            'title'      => 'required|max:70',
            'image'     => 'image|file|max:1024'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('service-images');
        }

        $validatedData['training_id'] = $validatedData['training_id'];
        $validatedData['is_active'] = $request['is_active'] == 'Y' ? 'Y' : "N";
        $validatedData['title'] = ucwords($validatedData['title']);
        $validatedData['description'] = ucwords($request['description']);
        $validatedData['created_at'] = date('Y-m-d H:i:s');
        $validatedData['created_by'] = Auth::guard('admin')->user()->username;
        
        $result = TrainingDetail::create($validatedData);
        if($result) {
            $request->session()->flash('success', 'Kontent Pelatihan berhasil dibuat');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/service-detail');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $filename = 'edit_training_detail';
        $filename_script = getContentScript(true, $filename);

        $code = Auth::guard('admin')->user(); 
        $training = Training::get();
        $result = TrainingDetail::find($id);
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Edit Kontent Pelatihan',
            'auth_user' => $code, 
            'dataTraining' => $training, 
            'data' => $result, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'training_id'      => 'required',
            'title'      => 'required|max:70',
            'image'     => 'image|file|max:1024'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('service-images');
        }

        $validatedData['training_id'] = $validatedData['training_id'];
        $validatedData['is_active'] = $request['is_active'] == 'Y' ? 'Y' : "N";
        $validatedData['title'] = ucwords($validatedData['title']);
        $validatedData['description'] = ucwords($request['description']);
        $validatedData['updated_at'] = date('Y-m-d H:i:s');
        $validatedData['updated_by'] = Auth::guard('admin')->user()->username;
        
        $result = TrainingDetail::find($id)->update($validatedData);
        if($result) {
            $request->session()->flash('success', 'Kontent Pelatihan berhasil diubah');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/service-detail');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        $data = TrainingDetail::find($id);
        if($data->image) {
            Storage::delete($data->image);
        }
        $result = $data->delete();
        if($result) {
            $request->session()->flash('success', 'Data berhasil diubah');
        } else {
            $request->session()->flash('success', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/service-detail');
    }
}
