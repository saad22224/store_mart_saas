<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleManager;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\RoleAccess;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $getroles = RoleManager::where('vendor_id', $vendor_id)->where('is_deleted', 2)->orderbyDesc('id')->get();
        return view('admin.rolemanager.index', compact('getroles'));
    }
    public function add(Request $request)
    {
        return view('admin.rolemanager.add');
    }
    public function save(Request $request)
    {
        try {
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            $role = Rolemanager::where('role', $request->name)->where('vendor_id', $vendor_id)->where('is_deleted', 2)->first();
            if (!empty($role) || $role != null) {
                return redirect('admin/roles/add')->with('error', trans('messages.already_exist_role'));
            }

            $newrole = new RoleManager;
            $newrole->vendor_id = $vendor_id;
            $newrole->role = $request->name;
            $newrole->module = implode('|', $request->modules);
            $newrole->is_available = 1;
            $newrole->is_deleted = 2;
            $newrole->save();
            $add = $request->add;
            $edit = $request->edit;
            $delete = $request->delete;
            foreach ($request->modules as $module) {
                $roleaccess = new RoleAccess();
                $roleaccess->module_name  = $module;
                $roleaccess->role_id = $newrole->id;
                $roleaccess->vendor_id = $vendor_id;
                $roleaccess->add = $add != null ? (array_key_exists($module, $add) ? 1 : 0) : 0;
                $roleaccess->edit = $edit != null ? (array_key_exists($module, $edit) ? 1 : 0) : 0;
                $roleaccess->delete = $delete != null ? (array_key_exists($module, $delete) ? 1 : 0) : 0;
                $roleaccess->manage = 1;
                $roleaccess->save();
            }
            return redirect('admin/roles')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect('admin/roles')->with('error', trans('messages.wrong'));
        }
    }
    public function edit(Request $request)
    {
        $data = RoleManager::where('id', $request->id)->first();
        return view('admin.rolemanager.edit', compact('data'));
    }
    public function update(Request $request)
    {

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $role = RoleManager::where('id', $request->id)->first();
        $role->vendor_id = $vendor_id;
        $role->role = $request->name;
        $role->module =  implode('|', $request->modules);
        $role->update();
        $add = $request->add;
        $edit = $request->edit;
        $delete = $request->delete;
        $roleaccess = RoleAccess::where('role_id', $request->id)->where('vendor_id', $vendor_id)->get();
        foreach ($roleaccess as $access) {
            $access->delete();
        }

        foreach ($request->modules as $module) {
            $roleaccess = new RoleAccess();
            $roleaccess->vendor_id = $vendor_id;
            $roleaccess->role_id  = $request->id;
            $roleaccess->module_name = $module;
            $roleaccess->add = $add != null ? (array_key_exists($module, $add) ? 1 : 0) : 0;
            $roleaccess->edit = $edit != null ? (array_key_exists($module, $edit) ? 1 : 0) : 0;
            $roleaccess->delete = $delete != null ? (array_key_exists($module, $delete) ? 1 : 0) : 0;
            $roleaccess->manage = 1;
            $roleaccess->save();
        }
        return redirect('admin/roles')->with('success', trans('messages.success'));
    }
    public function status(Request $request)
    {
        $rolemanager = RoleManager::where('id', $request->id)->first();
        $rolemanager->is_available = $request->status;
        $rolemanager->update();
        return redirect('admin/roles')->with('success', trans('messages.success'));
    }
    public function delete(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $deleterole = RoleManager::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        $deleterole->is_deleted = 1;
        $deleterole->update();
        return redirect('admin/roles')->with('success', trans('messages.success'));
    }
    
    public function bulk_delete(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
         foreach ($request->id as $id) {
            $deleterole = RoleManager::where('id', $id)->where('vendor_id', $vendor_id)->first();
            $deleterole->is_deleted = 1;
            $deleterole->update();
         }
          return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
       
    }
    public function employee_index(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $employees = User::where('type', 4)->where('vendor_id', $vendor_id)->orderbyDesc('id')->get();
        return view('admin.employee.index', compact('employees'));
    }
    public function employee_edit(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $editemployee = User::where('id', $request->id)->first();
        $roles = RoleManager::where('vendor_id', $vendor_id)->where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.employee.edit', compact('editemployee', 'roles'));
    }
    public function employee_add(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $roles = RoleManager::where('vendor_id', $vendor_id)->where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.employee.add', compact('roles'));
    }
    public function employee_save(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $validatoremail = Validator::make(['email' => $request->email], [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->whereIn('type', [1, 2, 4])->where('is_deleted', 2),
            ]
        ]);
        if ($validatoremail->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_email'));
        }
        $validatormobile = Validator::make(['mobile' => $request->mobile], [
            'mobile' => [
                'required',
                'numeric',
                Rule::unique('users')->whereIn('type', [1, 2, 4])->where('is_deleted', 2),
            ]
        ]);
        if ($validatormobile->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_mobile'));
        }
        $newemploye = new User;
        $newemploye->name = $request->name;
        $newemploye->mobile = $request->mobile;
        $newemploye->email = $request->email;
        $newemploye->password = Hash::make($request->password);
        $newemploye->role_id = $request->role;
        $newemploye->is_available = '1';
        $newemploye->image = 'default.png';
        $newemploye->slug = '';
        $newemploye->type = '4';
        $newemploye->vendor_id = $vendor_id;
        $newemploye->save();
        return redirect('admin/employees')->with('success', trans('messages.success'));
    }
    public function employee_update(Request $request)
    {
        $validatoremail = Validator::make(['email' => $request->email], [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->whereIn('type', [1, 2, 4])->where('is_deleted', 2)->ignore($request->id),
            ]
        ]);
        if ($validatoremail->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_email'));
        }
        $validatormobile = Validator::make(['mobile' => $request->mobile], [
            'mobile' => [
                'required',
                'numeric',
                Rule::unique('users')->whereIn('type', [1, 2, 4])->where('is_deleted', 2)->ignore($request->id),
            ]
        ]);
        if ($validatormobile->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_mobile'));
        }
        $editemployee = User::where('id', $request->id)->first();
        $editemployee->name = $request->name;
        $editemployee->mobile = $request->mobile;
        $editemployee->email = $request->email;
        $editemployee->role_id = $request->role;
        if ($request->has('profile')) {
            if (file_exists(storage_path('app/public/admin-assets/images/profile/' . $editemployee->image))) {
                unlink(storage_path('app/public/admin-assets/images/profile/' .  $editemployee->image));
            }
            $edit_image = $request->file('profile');
            $profileImage = 'profile-' . uniqid() . "." . $edit_image->getClientOriginalExtension();
            $edit_image->move(storage_path('app/public/admin-assets/images/profile/'), $profileImage);
            $editemployee->image = $profileImage;
        }
        $editemployee->update();
        return redirect('admin/employees')->with('success', trans('messages.success'));
    }
    public function employee_status(Request $request)
    {
        $employee = User::where('id', $request->id)->first();
        $employee->is_available = $request->status;
        $employee->update();
        return redirect('admin/employees')->with('success', trans('messages.success'));
    }
    public function employee_delete(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $employee = User::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        $employee->delete();
        return redirect('admin/employees')->with('success', trans('messages.success'));
    }
    public function employee_bulk_delete(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        foreach ($request->id as $id) {
            $employee = User::where('id', $id)->where('vendor_id', $vendor_id)->first();
            $employee->delete();
        }
          return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
        
    }
}
