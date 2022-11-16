<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use HasUploader;

    public function index()
    {
        return view('user.profiles.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required|max:20',
            'name' => 'required|max:100',
            'image' => 'nullable|image:max:1024',
        ]);

        $user = User::findOrFail($id);

        if ($request->old_password || $request->new_password) {
            $request->validate([
                'old_password' => 'required|min:4|max:20',
                'new_password' => 'required|min:4|max:20',
            ]);

            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'message' => __('Old password is wrong.')
                ], 402);
            }
        }

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'avatar' => $request->image ? $this->upload($request, 'image') : $user->avatar,
            'password' => $request->new_password ? Hash::make($request->new_password) : $user->password,
        ]);

        return response()->json([
            'message' => __('Profile updated successfully.')
        ]);
    }
}
