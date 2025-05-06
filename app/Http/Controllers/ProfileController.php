<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        return view('profile.edit');
    }

   public function update(Request $request)
{
    // التحقق من المدخلات
    $request->validate([
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // السماح بأنواع معينة
    ]);

    $user = Auth::user();

    // التحقق من وجود ملف صورة
    if ($request->hasFile('profile_picture')) {
        // حذف الصورة القديمة إذا كانت موجودة
        if ($user->profile_picture && \Storage::exists('profile_pictures/' . $user->profile_picture)) {
            \Storage::delete('profile_pictures/' . $user->profile_picture);
        }

        // حفظ الصورة الجديدة
        $fileName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->storeAs('profile_pictures', $fileName, 'public');

        // تحديث اسم الصورة في قاعدة البيانات
        $user->profile_picture = $fileName;
    }

    // تحديث بيانات أخرى
    $user->name = $request->input('name', $user->name);
    $user->email = $request->input('email', $user->email);

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully!');
}

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function showProfile()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    /**
     * Show the user's payment history.
     */
    public function showPaymentHistory()
    {
        $user = auth()->user();
        $bookings = $user->bookings;
        return view('profile.payment', compact('user', 'bookings'));
    }

}
