<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filename = 'post';
        $filename_script = getContentScript(true, $filename);

        $user = Auth::guard('admin')->user();
        $data = Post::get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Daftar Berita',
            'auth_user' => $user,
            'dataPosts' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filename = 'add_post';
        $filename_script = getContentScript(true, $filename);

        $user = Auth::guard('admin')->user();
        $data = Post::get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Daftar Berita',
            'auth_user' => $user,
            'dataPosts' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'      => 'required|max:100',
            'body'      => 'required',
            'image'     => 'image|file|max:1024'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('service-images');
        }

        $validatedData['created_at'] = date('Y-m-d H:i:s');
        $validatedData['created_by'] = Auth::guard('admin')->user()->username;
        
        $result = Post::create($validatedData);
        if($result) {
            $request->session()->flash('success', 'Berita berhasil dibuat');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/posts');
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
        $filename = 'edit_post';
        $filename_script = getContentScript(true, $filename);

        $user = Auth::guard('admin')->user();
        $data = Post::find($id);
        if(!$data) return redirect('/posts');

        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Edit Data Berita',
            'auth_user' => $user,
            'post' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validatedData = $request->validate([
            'title'      => 'required|max:100',
            'body'      => 'required',
            'image'     => 'image|file|max:1024'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['updated_at'] = date('Y-m-d H:i:s');
        $validatedData['updated_by'] = Auth::guard('admin')->user()->username;
        
        $result = Post::where(['id' => $id])->update($validatedData);
        if($result) {
            $request->session()->flash('success', 'Berita berhasil dibuat');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        $data = Post::find($id);
        $result = $data->delete();
        if($result) {
            $request->session()->flash('success', 'Berita berhasil diubah');
        } else {
            $request->session()->flash('success', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/posts');
    }
}
