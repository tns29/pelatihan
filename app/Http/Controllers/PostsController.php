<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PicturePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        ]);
        
        if($request->image) {
            $validatedImage = $request->validate([
                'image.*'   => 'image|mimes:jpeg,png,jpg,gif|max:1024', // Adjust file types and size as needed
            ]);
        }

        $validatedData['title'] = ucwords($validatedData['title']);
        $validatedData['created_at'] = date('Y-m-d H:i:s');
        $validatedData['created_by'] = Auth::guard('admin')->user()->username;
        
        $result = Post::create($validatedData);
        // $newRecordId = DB::table('posts')->insertGetId($validatedData);
        $dataResult = json_decode($result, true);

        $post_id = $dataResult['id'];
        
        foreach ($request->file('image') as $image) {
            $image_name = $image->store('post-images');
            $dataPostImage = [
                'post_id' => $post_id,
                'image' => $image_name
            ];
            PicturePost::create($dataPostImage);
        }
        
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
        $dataimage = PicturePost::where(['post_id' => $id])->get();
        if(!$data) return redirect('/posts');

        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Edit Data Berita',
            'auth_user' => $user,
            'post' => $data,
            'dataimage' => $dataimage
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
        ]);
        
        if($request->image) {
            $validatedImage = $request->validate([
                'image.*'   => 'image|mimes:jpeg,png,jpg,gif|max:1024', // Adjust file types and size as needed
            ]);
        }

        $validatedData['title'] = ucwords($validatedData['title']);
        $validatedData['updated_at'] = date('Y-m-d H:i:s');
        $validatedData['updated_by'] = Auth::guard('admin')->user()->username;
        
        $result = Post::where(['id' => $id])->update($validatedData);

        $post_id = $id;

        if($request->file('image')) {
            $dataPicturePost = PicturePost::where(['post_id' => $post_id])->get();
            // dd($dataPicturePost);
            foreach ($dataPicturePost as $item) {
                if($item->image) {
                    Storage::delete($item->image);
                }
            }
            // dd($request->file('image'));
            PicturePost::where(['post_id' => $post_id])->delete();
            foreach ($request->file('image') as $image) {
                $image_name = $image->store('post-images');
                $dataPostImage = [
                    'post_id' => $post_id,
                    'image' => $image_name
                ];
                PicturePost::create($dataPostImage);
            }
        }
        

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
        
        if($data->image) {
            Storage::delete($data->image);
        }

        $result = $data->delete();
        
        if($result) {
            $request->session()->flash('success', 'Berita berhasil diubah');
        } else {
            $request->session()->flash('success', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/posts');
    }
}
