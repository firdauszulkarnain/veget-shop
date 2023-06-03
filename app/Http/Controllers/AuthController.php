<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong',
        ]);


        if (Auth::attempt($credentials)) {
            if (auth()->user()->role == 1) {
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            } else if (auth()->user()->role == 2) {
                $request->session()->regenerate();
                return redirect()->intended('/seller');
            } else if (auth()->user()->role == 3) {
                $request->session()->regenerate();
                return redirect()->intended('/shop');
            }
        }

        return redirect()->back()->with('error', 'Username atau Password Salah!');
    }

    public function logout(Request $request)
    {

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function registrasi(Request $request)
    {

        if ($request->isMethod('POST')) {
            $post = $request->validate(
                [
                    'username' => 'required|unique:users,username',
                    'notelp' => 'required|numeric|min:10',
                    'email' => 'required|unique:users,email|email:rfc,dns',
                    'password' => 'required|min:6',
                ],
                [
                    'username.required' => 'Username Tidak Boleh Kosong',
                    'notelp.required' => 'No.Telp Tidak Boleh Kosong',
                    'notelp.numeric' => 'No.Telp Tidak Valid',
                    'notelp.min' => 'No.Telp Tidak Valid',
                    'email.required' => 'Email Tidak Boleh Kosong',
                    'password.required' => 'Password Tidak Boleh Kosong',
                    'username.unique' => 'Username Sudah Digunakan',
                    'email.unique' => 'Email Sudah Digunakan',
                    'email.email' => 'Email Tidak Valid',
                ]
            );

            $post['password'] = Hash::make($post['password']);

            User::create([
                'username' => $post['username'],
                'notelp' => $post['notelp'],
                'email' => $post['email'],
                'role' => 3,
                'password' => $post['password'],
            ]);

            return redirect()->route('login')->with('success', 'Berhasil Registrasi, Silahkan Login Kembali!');
        }

        $data = [
            'title' => 'Registrasi'
        ];

        return view('auth.registrasi', $data);
    }
}
