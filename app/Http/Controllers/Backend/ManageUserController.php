<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\VendorShopProfileRepositoryInterface;
use App\Mail\AccountCreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ManageUserController extends Controller
{
    public function index()
    {
        return view('admin.manage-user.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);

        if($request->role === 'user'){
            $user = app(UserRepositoryInterface::class)->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'user',
                'status' => 'active',
            ]);

            Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->email, $request->password));

            toastr('Created Successfully!', 'success', 'success');
            return redirect()->back();
        }elseif ($request->role === 'vendor'){
            $user = app(UserRepositoryInterface::class)->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'vendor',
                'status' => 'active',
            ]);

            app(VendorShopProfileRepositoryInterface::class)->create([
                'banner' => 'uploads/1343.jpg',
                'shop_name' => $request->name.' Shop',
                'phone' => '12321312',
                'email' => 'test@gmail.com',
                'address' => 'Usa',
                'description' => 'shop description',
                'user_id' => $user->id,
                'status' => 1,
            ]);

            Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->email, $request->password));

            toastr('Created Successfully!', 'success', 'success');
            return redirect()->back();
        }elseif($request->role === 'admin'){
            $user = app(UserRepositoryInterface::class)->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'admin',
                'status' => 'active',
            ]);

            app(VendorShopProfileRepositoryInterface::class)->create([
                'banner' => 'uploads/1343.jpg',
                'shop_name' => $request->name.' Shop',
                'phone' => '12321312',
                'email' => 'test@gmail.com',
                'address' => 'Usa',
                'description' => 'shop description',
                'user_id' => $user->id,
                'status' => 1,
            ]);

            Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->email, $request->password));

            toastr('Created Successfully!', 'success', 'success');
            return redirect()->back();
        }
    }
}
