<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.profile')->with('user', $request->user());
    }

    public function store(Request $request)
    {
        $admin = $request->user();

        $this->validate($request, [
            'name' => 'required|max:60',
            'email' => 'required|email|max:120|unique:admins,email,'.$admin->id,
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.profile')->with('status', trans('admin.status_profile_updated'));
    }

    public function password(Request $request)
    {
        $admin = $request->user();

        $this->validate($request, [
            'password' => 'required|min:6|max:120|confirmed',
        ]);

        $admin->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.profile')->with('status', trans('admin.status_password_updated'));

    }


}
