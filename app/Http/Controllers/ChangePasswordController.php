<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|min:8',
        ]);

        $user = Auth::user(); // Lấy thông tin người dùng đã xác thực

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($data['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác']);
        }
        if ($data['new_password'] !== $data['new_password_confirmation']) {
            return redirect()->back()->withErrors(['new_password_confirmation' => 'Xác nhận mật khẩu không khớp']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($data['new_password']);
        $user->save();

        return redirect()->back()->with('status', 'Mật khẩu được cập nhật thành công');
    }
}