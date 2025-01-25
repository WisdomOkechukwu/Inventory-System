<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function staff_list()
    {
        $user = Auth::user();
        $staff = User::where('id','!=',$user->id)
            ->where('company_id', $user->company_id)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $total_staff = User::where('id','!=',$user->id)
            ->where('company_id', $user->company_id)
            ->count();

        return view('v1.staff.all_staff', compact('staff','total_staff'));
    }

    public function add_staff()
    {
        $staff = collect();
        $is_create = true;
        return view('v1.staff.show_staff', compact('staff','is_create'));
    }

    public function create_staff(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role ?? 'staff';

        $user->company_id = Auth::user()->company_id;
        $user->save();

        return redirect()->route('staff.list')->with(['success' => 'Staff Created Successfully']);
    }

    public function delete_staff(Request $request)
    {
        $staff = User::find($request->staff_id);
        if($staff){
            $staff->delete();
        }

        return redirect()->route('staff.list')->with(['success' => 'Staff Deleted Successfully']);
    }

    public function show_staff($id)
    {
        $staff =  User::find($id);
        $is_create = false;
        return view('v1.staff.show_staff', compact('staff','is_create'));
    }

    public function update_staff(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
        ]);

        $user =  User::find($request->staff_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role ?? 'staff';
        $user->save();

        return redirect()->route('staff.list')->with(['success' => 'Staff Updated Successfully']);
    }

    public function update_staff_password(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find($request->staff_id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('staff.list')->with(['success' => 'Staff Password Updated Successfully']);
    }
}
