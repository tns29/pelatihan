<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
        $filename = 'category';
        $filename_script = getContentScript(true, $filename);

        $code = Auth::guard('admin')->user();
        $data = Category::get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Master Kategori',
            'auth_user' => $code,
            'dataCategory' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $code = Auth::guard('admin')->user();
        return view('admin-page.add_m_category', [
            'title' => 'Profile',
            'auth_user' => $code
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = Category::create(['name' => $request['name']]);
        if($result) {
            $request->session()->flash('success', 'Kategori berhasil dibuat');
        } else {
            $request->session()->flash('success', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/category');
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id);
        $result = Category::find($id)->update($request->all());
        if($result) {
            $request->session()->flash('success', 'Kategori berhasil diubah');
        } else {
            $request->session()->flash('success', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd($id);
        $result = Category::find($id)->delete();
        if($result) {
            $request->session()->flash('success', 'Kategori berhasil diubah');
        } else {
            $request->session()->flash('success', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/category');
    }
}
