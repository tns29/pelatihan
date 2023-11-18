<?php

namespace App\Http\Controllers;

use view;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;

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
            'title' => 'Daftar Layanan',
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
            'title' => 'Tambah Layanan Baru',
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
            'category_id'      => 'required',
            'title'      => 'required|max:30',
            'image'     => 'image|file|max:1024'
        ]);

        if($request->file('image')) {
            $validatedData['images'] = $request->file('image')->store('service-images');
        }

        $validatedData['initials'] = getLasIdTraining().$validatedData['category_id'];
        $validatedData['is_active'] = $request['is_active'] == 'Y' ? 'Y' : "N";
        $validatedData['title'] = ucwords($validatedData['title']);
        $validatedData['description'] = ucwords($request['description']);
        $validatedData['created_at'] = date('Y-m-d H:i:s');
        $validatedData['created_by'] = Auth::guard('admin')->user()->username;
        
        $result = Training::create($validatedData);
        if($result) {
            $request->session()->flash('success', 'Layanan berhasil dibuat');
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
        $data = Training::find($id);
        
        $filename = 'edit_training';
        $filename_script = getContentScript(true, $filename);

        $code = Auth::guard('admin')->user(); 
        $category = Category::get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Tambah Layanan Baru',
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
            'category_id'      => 'required',
            'title'      => 'required|max:30',
            'image'     => 'image|file|max:1024'
        ]);

        if($request->file('image')) {
            $validatedData['images'] = $request->file('image')->store('service-images');
        }
        
        $validatedData['initials'] = getLasIdTraining().$validatedData['category_id'];
        $validatedData['is_active'] = $request['is_active'] == 'Y' ? 'Y' : "N";
        $validatedData['title'] = ucwords($validatedData['title']);
        $validatedData['description'] = ucwords($request['description']);
        $validatedData['updated_at'] = date('Y-m-d H:i:s');
        $validatedData['updated_by'] = Auth::guard('admin')->user()->username;
        
        $result = Training::where(['id' => $id])->update($validatedData);
        if($result) {
            $request->session()->flash('success', 'Layanan berhasil dibuat');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }

        return redirect('/service');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
