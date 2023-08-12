<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Session;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = User::orderBy('role_id')->whereNull('deleted_at')->paginate(6);
        Session::put('admin_url', request()->fullUrl());
        return view('admin.account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $accounts = User::find($id);
        $roles = Role::all();
        return view('admin.account.edit', compact('accounts','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $accounts = User::find($id);
    
            if (!$accounts) {
                return redirect()->back()->with('error', 'User not found');
            }
    
            $input = $request->all();
            // Perform validation on $input here
    
            unset($input['_token']);
    
           $accounts->role_id =  $input['role_id']; // Update and store the success status
            $success = $accounts->save();
            if ($success) {
                if (Session::get('admin_url')) {
                    return redirect(session('admin_url'))->with('success', 'Đã sửa vai trò thành công');
                } else {
                   
                    return redirect()->back()->with('success', 'Đã sửa vai trò thành công');
                }
            } else {
                return redirect()->back()->with('error', 'Không thể cập nhật thông tin');
            }
        } catch (Exception $e) {
            dd($e);
            // Log the exception or handle it in a way that suits your application
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accounts = User::find($id);
        $infomation = Information::where('user_id', $id)->first();
        $infomation->delete();
        $accounts->delete();
        if (Session::get('admin_url')) {
            return redirect(session('admin_url'))->with('success', 'Đã xóa mềm User thành công');
        }
    }

     // Phần restore 
     public function viewRestore(){
        $restores = User::onlyTrashed()->paginate(6);
        return view('admin.account.restore', compact('restores'));
    }

    public function restore($id){
        User::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'Đã restore user thành công');
    }  

    // public function delete($id){
    //     $deletedUsers = User::onlyTrashed()->get();
    //     if($deletedUsers){
    //         dd()
    //         return back()->with('success', 'Đã xóa user thành công');
    //     }
    //     else{
    //         dd("co loi");
    //     }
    // }
    public function delete($id){
        try {
            $user = User::find($id);
    
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }
    
            $user->delete(); // Soft delete the user
            
            return back()->with('success', 'Đã xóa user thành công');
        } catch (Exception $e) {
            // Log the exception or handle it in a way that suits your application
            return redirect()->back()->with('error', 'Đã xảy ra lỗi');
        }
    }
}
