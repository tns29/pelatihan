<?php

namespace App\Http\Controllers\FE;

use App\Models\Registrant;
use App\Models\Participant;
use App\Models\SubDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParticipantController extends Controller
{
    function index() {
        return view('user-page/auth/register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request) {
        
        $validatedData = $request->validate([
            'fullname'      => 'required|max:90',
            'username'      => 'required|max:30|unique:participants',
            'gender'        => 'required',
            'no_telp'       => 'required|numeric',
            'email'         => 'required|email|unique:participants',
            'password'      => 'required|confirmed|min:6|max:255',
            'password_confirmation' => 'required|min:6|max:255'
        ]);
        
        $validatedData['fullname'] = ucwords($validatedData['fullname']);
        $validatedData['number'] = $this->getLasNumber();
        $validatedData['created_at'] = date('Y-m-d H:i:s');
        $validatedData['created_by'] = $validatedData['username'];
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['is_active'] = "Y";
        // dd($validatedData);
        $result = Participant::create($validatedData);
        if($result) {
            $request->session()->flash('success', 'Akun berhasil dibuat');
            return redirect('/login');
        } else {
            $request->session()->flash('success', 'Proses gagal, Hubungi administrator');
            return redirect('/register');
        }
    }

    function login() {
        return view('user-page.auth.login', [
            'title' => 'Login'
        ]);
    }

    public function loginValidation(Request $request) {
        
        $credentials = $request->validate([
            'email'  => 'required',
            'password'  => 'required'
        ]);
        // dd($credentials);
        $resultUser = Participant::where('email', $credentials['email'])->count();
        
        if(!$resultUser) {
            $request->session()->flash('failed', 'Akun tidak terdaftar.');
            return redirect('/login');
        }
        // dd(auth('participant'));
        if (auth('participant')->attempt($credentials)) {
        
            $isActive = Auth::guard('participant')->user()->is_active == "Y";
            if ($isActive == true) { 
                return redirect()->intended('/');
            } else {
                Auth::guard('participant')->logout();
                $request->session()->flash('failed', 'Akun belum aktif, Hubungi Administrator.');
                return redirect('/login');
            }
        }

        return back()->with('failed', 'Username atau Password salah!');
    }

    function getLasNumber() {
        
        $lastNumber = Participant::max('number');

        if($lastNumber) {
            $lastNumber = substr($lastNumber, -4);
            $code_ = sprintf('%04d', $lastNumber+1);
            $numberFix = "UPTD".date('Ymd').$code_;
        } else {
            $numberFix = "UPTD".date('Ymd')."0001";
        }

        return $numberFix;
    }

    // Pelatihan saya //
    function wishlist() {
        
        $filename = 'wishlist';
        $filename_script = getContentScript(false, $filename);

        $number = Auth::guard('participant')->user()->number;

        $registrant = new Registrant;
        $result = $registrant->getWishlist($number);
        // dd($result);
        return view('user-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Daftar Pelatihan saya',
            'wishlist' => $result
        ]);
    }

    // USER PROFILE - PARTICIPANT (PESERTA) //

    function profile() {
        $filename = 'profile';
        $filename_script = getContentScript(false, $filename);
        
        if(!auth('participant')->user()) {
            return redirect('/login');
        }
        
        $participant = new Participant;
        $data = $participant->getUserProfile();

        return view('user-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Profil Saya',
            'auth_user' => $data
        ]);
    }

    function updateProfile() {
        $filename = 'update_profile';
        $filename_script = getContentScript(false, $filename);

        $number = Auth::guard('participant')->user()->number;
        $data = Participant::where('number', $number)->first();  
        
        $subDistrict = SubDistrict::get();
        return view('user-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Profil Saya',
            'auth_user' => $data,
            'subDistrict' => $subDistrict
        ]);
    }

    function updateProfileData(Request $request, string $number) {
        // dd($request);
        $validatedData = $request->validate([
            'no_wa'    => 'required|max:15',
            'place_of_birth'    => 'required|max:30',
            'date_of_birth'    => 'required',
            'address'            => 'required|max:200',
            'height'            => 'required|max:10',
            'religion'          => 'required|max:20',
            'material_status'    => 'required|max:30',
            'last_education'    => 'required|max:30',
            'graduation_year'    => 'required|max:4',
            'sub_district'    => 'required|max:100',
            'village'    => 'required|max:100',
            'image'     => 'image|file|max:1024',
            'id_card'     => 'file|max:1024',
            'ak1'     => 'file|max:1024',
            'ijazah'     => 'file|max:1024',
        ]);

        // dd($validatedData);

        if($request->nik != $request->nik1) {
            $validatedData = $request->validate([
                'nik'    => 'required|max:16|unique:participants',
            ]);
        }

        $getData = Participant::where(['number'=> $number])->first();
        
        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('profile-images');
            $is_valid_image = true;
        } else if ($getData->image) {
            $is_valid_image = true;
        } else {
            $is_valid_image = false;
            $request->session()->flash('image', 'Pas Foto belum di upload');
        }
        
        if($request->file('id_card')) {
            $validatedData['id_card'] = $request->file('id_card')->store('doc');
            $is_valid_id_card = true;
        } else if ($getData->id_card) {
            $is_valid_id_card = true;
        } else {
            $is_valid_id_card = false;
            $request->session()->flash('id_card', 'KTP belum di upload');
        }
        
        if($request->file('ak1')) {
            $is_valid_ak1 = true;
            $validatedData['ak1'] = $request->file('ak1')->store('doc');
        } else if ($getData->ak1) {
            $is_valid_ak1 = true;
        } else {
            $is_valid_ak1 = false;
            $request->session()->flash('ak1', 'AK1 belum di upload');
        }
        
        if($request->file('ijazah')) {
            $is_valid_ijazah = true;
            $validatedData['ijazah'] = $request->file('ijazah')->store('doc');
        } else if ($getData->ijazah) {
            $is_valid_ijazah = true;
        } else {
            $is_valid_ijazah = false;
            $request->session()->flash('ijazah', 'Ijazah belum di upload');
        }

        if(!$is_valid_image || !$is_valid_id_card || !$is_valid_ak1 || !$is_valid_ijazah) {
            return redirect('/update-profile');
        }
        
        $result = Participant::where(['number'=> $number])->update($validatedData);
        if($result) {
            $request->session()->flash('success', 'Data Berhasil diperbaharui');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/_profile');
    }

    // LOGOUT PARTICIPANT //
    function logout(Request $request) {
        Auth::guard('participant')->logout();
        
        $request->session()->flash('success', 'Anda berhasil logout');
        return redirect('/login');
    }
}
