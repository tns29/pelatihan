<?php

namespace App\Http\Controllers;

use view;
use App\Models\Period;
use App\Models\Category;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filename = 'training';
        $filename_script = getContentScript(true, $filename);

        $code = Auth::guard('admin')->user();
        $data = Training::get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Daftar Pelatihan',
            'auth_user' => $code,
            'dataTraining' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filename = 'add_training';
        $filename_script = getContentScript(true, $filename);

        $code = Auth::guard('admin')->user();
        $category = Category::get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Tambah Pelatihan',
            'auth_user' => $code,
            'dataCategory' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'         => 'required|max:90',
            'category_id'   => 'required',
            'duration'      => 'required',
            'min_age'       => 'required|numeric|max:3',
            'max_age'       => 'required|numeric|max:3',
            'image'         => 'image|file|max:1024'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('service-images');
        }

        $active_period = Period::where('is_active', 'Y')->first();

        $validatedData['period_id'] = $active_period->id;
        $validatedData['initials'] = getLasIdTraining().$validatedData['category_id'];
        $validatedData['is_active'] = $request['is_active'] == 'Y' ? 'Y' : "N";
        $validatedData['title'] = ucwords($validatedData['title']);
        $validatedData['description'] = ucwords($request['description']);
        $validatedData['created_at'] = date('Y-m-d H:i:s');
        $validatedData['created_by'] = Auth::guard('admin')->user()->username;

        $result = Training::create($validatedData);
        if($result) {
            $request->session()->flash('success', 'Pelatihan berhasil dibuat');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/service');
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
    public function edit(Request $request, int $id)
    {
        $filename = 'edit_training';
        $filename_script = getContentScript(true, $filename);

        $code = Auth::guard('admin')->user();
        $category = Category::get();
        $data = Training::find($id);
        if(!$data) return redirect('/posts');

        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Edit Pelatihan ',
            'auth_user' => $code,
            'dataCategory' => $category,
            'dataTraining' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title'         => 'required|max:90',
            'duration'      => 'required',
            'category_id'   => 'required',
            'min_age'       => 'required|numeric|max:3',
            'max_age'       => 'required|numeric|max:3',
            'image'         => 'image|file|max:1024'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('service-images');
        }

        $validatedData['initials'] = getLasIdTraining().$validatedData['category_id'];
        $validatedData['is_active'] = $request['is_active'] == 'Y' ? 'Y' : "N";
        $validatedData['title'] = ucwords($validatedData['title']);
        $validatedData['description'] = ucwords($request['description']);
        $validatedData['updated_at'] = date('Y-m-d H:i:s');
        $validatedData['updated_by'] = Auth::guard('admin')->user()->username;

        $dataTraining = Training::find($id);
        if($request->file('image')) {
            if($validatedData['image'] && $dataTraining->image) {
                Storage::delete($dataTraining->image);
            }
        }
        $result = $dataTraining->update($validatedData);
        if($result) {
            $request->session()->flash('success', 'Pelatihan berhasil dibuat');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }

        return redirect('/service');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        $data = Training::find($id);
        if($data->image) {
            Storage::delete($data->image);
        }
        $result = $data->delete();
        if($result) {
            $request->session()->flash('success', 'Data berhasil dihapus');
        } else {
            $request->session()->flash('success', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/service');
    }
}
