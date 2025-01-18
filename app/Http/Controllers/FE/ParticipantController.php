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
use Illuminate\Support\Facades\Storage;

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
            // 'username'      => 'required|max:30|unique:participants',
            'username'      => 'required|max:30',
            'gender'        => 'required',
            'no_telp'       => 'required|max:15|numeric|unique:participants',
            'email'         => 'required|email|unique:participants',
            'password'      => 'required|confirmed|min:6|max:255',
            'password_confirmation' => 'required|min:6|max:255'
        ]);

        $forLogin['email'] = $validatedData['email'];
        $forLogin['password'] = $validatedData['password'];

        $validatedData['fullname'] = ucwords($validatedData['fullname']);
        $validatedData['number'] = $this->getLasNumber();
        $validatedData['created_at'] = date('Y-m-d H:i:s');
        $validatedData['created_by'] = $validatedData['username'];
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['is_active'] = "Y";
        $validatedData['participant'] = "Y";
        // dd($validatedData);
        $result = Participant::create($validatedData);
        if($result) {
            $request->session()->flash('success', 'Akun berhasil dibuat');
            // return redirect('/login');
            return $this->loginValidation(new Request($forLogin));
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
        // dd(auth('participant')->attempt($credentials));
        if (auth('participant')->attempt($credentials)) {

            $user = Auth::guard('participant')->user();
            if ($user->is_active == "Y") {

                if($user->nik == null OR
                    $user->place_of_birth == null OR
                    $user->date_of_birth == null OR
                    $user->no_telp == null OR
                    $user->no_wa == null OR
                    $user->address == null OR
                    $user->height == null OR
                    $user->religion == null OR
                    $user->material_status == null OR
                    $user->last_education == null OR
                    $user->graduation_year == null OR
                    $user->sub_district == null OR
                    $user->village == null OR
                    $user->image == null
                ) {
                    return redirect()->intended('/update-profile');
                } else {
                    return redirect()->intended('/pelatihan');
                }

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
            'fullname'    => 'required|max:100',
            'username'    => 'required|max:30',
            'email'    => 'required|email|max:100',
            'nik'    => 'required|max:16',
            'no_telp'    => 'required|max:15',
            'no_wa'    => 'required|max:15',
            'place_of_birth'    => 'required|max:30',
            'date_of_birth'    => 'required',
            'size_uniform'    => 'required|max:3',
            'address'            => 'required|max:200',
            'height'            => 'required|max:10',
            'religion'          => 'required|max:20',
            'material_status'    => 'required|max:30',
            'last_education'    => 'required|max:30',
            'graduation_year'    => 'required|max:4',
            'sub_district'    => 'required|max:100',
            'village'    => 'required|max:100',
            'image'     => 'image|file|max:2048',
            'id_card'     => 'image|file|max:2048',
            'ak1'     => 'file|max:2048',
            'ijazah'     => 'file|max:2048',
        ]);

        if($request->nik != $request->nik1) {
            $validatedData = $request->validate([
                'nik'    => 'required|max:16|unique:participants',
            ]);
        }
        if($request->email != $request->email1) {
            $validatedData = $request->validate([
                'email'    => 'required|max:100|email|unique:participants',
            ]);
        }
        if($request->username != $request->username1) {
            $validatedData = $request->validate([
                'username'    => 'required|max:100|unique:participants',
            ]);
        }

        $getData = Participant::find($number);

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
            // $request->session()->flash('ak1', 'AK1 belum di upload');
        }

        if($request->file('ijazah')) {
            $is_valid_ijazah = true;
            $validatedData['ijazah'] = $request->file('ijazah')->store('doc');
        } else if ($getData->ijazah) {
            $is_valid_ijazah = true;
        } else {
            $is_valid_ijazah = false;
            // $request->session()->flash('ijazah', 'Ijazah belum di upload');
        }

        // if(!$is_valid_image || !$is_valid_id_card || !$is_valid_ak1 || !$is_valid_ijazah) {
        if(!$is_valid_image) {
            return redirect('/update-profile');
        }

        if($request->file('id_card')) {
            if($validatedData['id_card'] && $getData->id_card) {
                Storage::delete($getData->id_card);
            }
        }
        if($request->file('ak1')) {
            if($validatedData['ak1'] && $getData->ak1) {
                Storage::delete($getData->ak1);
            }
        }
        if($request->file('ijazah')) {
            if($validatedData['ijazah'] && $getData->ijazah) {
                Storage::delete($getData->ijazah);
            }
        }
        if($request->file('image')) {
            if($validatedData['image'] && $getData->image) {
                Storage::delete($getData->image);
            }
        }
        $validatedData['fullname'] = ucwords($request['fullname']);
        $validatedData['username'] = strtolower($request['username']);
        $validatedData['email'] = strtolower($request['email']);
        $validatedData['nik'] = $request['nik'];
        $validatedData['no_telp'] = $request['no_telp'];
        $validatedData['no_wa'] = $request['no_wa'];
        $validatedData['place_of_birth'] = ucwords($request['place_of_birth']);
        $validatedData['date_of_birth'] = $request['date_of_birth'];
        $validatedData['size_uniform'] = strtoupper($request['size_uniform']);
        $validatedData['address'] = ucwords($request['address']);
        $validatedData['height'] = $request['height'];
        $validatedData['religion'] = $request['religion'];
        $validatedData['material_status'] = $request['material_status'];
        $validatedData['last_education'] = $request['last_education'];
        $validatedData['graduation_year'] = $request['graduation_year'];
        $validatedData['sub_district'] = $request['sub_district'];
        $validatedData['village'] = $request['village'];
        // dd($validatedData);
        $result = Participant::where(['number'=> $number])->update($validatedData);
        if($result) {
            $request->session()->flash('success', 'Data Berhasil diperbaharui');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/pelatihan');
        // return redirect('/_profile');
    }

    // LOGOUT PARTICIPANT //
    function logout(Request $request) {
        Auth::guard('participant')->logout();

        $request->session()->flash('success', 'Anda berhasil logout');
        return redirect('/login');
    }
}
