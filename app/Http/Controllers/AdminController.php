<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function profil()
    {
        return view('admin.admin');
    }

    public function edit(Request $request)
    {
        $id = Auth::guard('user')->user()->id;
        $user = DB::table('user')
            ->where('id', $id)
            ->first();
        dd($user);
        return view('admin.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $email = $request->email;
        $password = Hash::make($request->password);
        if ($request->hasFile('foto')) {
            $foto = $email . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $email->foto;
        }
        // Update password
        $updatePassword = DB::table('users')->where('email', $email)->update(['password' => $password, 'foto' => $foto]);

        // Check if password update is successful
        if ($updatePassword) {
            // Image handling
            $image = $request->image;
            $folderPath = "public/uploads/karyawan/";
            $image_parts = explode(";base64,", $image);
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = "profile_image.png";
            $filePath = $folderPath . $fileName;

            // Save image
            Storage::put($filePath, $image_base64);

            return redirect()->back()->with(['success' => 'Password berhasil diperbarui']);
        } else {
            return redirect()->back()->with(['warning' => 'Data Tidak Boleh Kosong']);
        }
    }

}