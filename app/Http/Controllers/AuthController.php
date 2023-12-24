<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function proseslogin(Request $request)
   {
      if (Auth::guard('karyawan')->attempt(['nip' => $request->nip, 'password' => $request->password])) {
         return redirect('/dashboard');
      } else {
         return redirect('/')->with(['warning' => 'Employee Code /Password Salah']);
      }
   }

   public function proseslogout()
   {
      if (Auth::guard('karyawan')->check()) {
         Auth::guard('karyawan')->logout();
         return redirect('/');
      }
   }
   public function proseslogoutadmin()
   {

      if (Auth::guard('user')->check()) {
         Auth::guard('user')->logout();
         return redirect('/panel');
      }
   }
   public function prosesloginadmin(Request $request)
   {
      if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
         return redirect('/panel/dashboardadmin');
      } else {
         return redirect('/panel')->with(['warning' => 'Email atau Password Salah']);
      }
   }
}