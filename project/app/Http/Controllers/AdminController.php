<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Department;
use DB;


class AdminController extends Controller
{
    public function index()
    {
        $dpm = DB::table('departments')->count();
        $cate = DB::table('categories')->count();
        return view('admin.dashboard', compact('dpm','cate'));
    }

    public function createAccount()
    {
        return view('admin.listAccount.register');
    }

    
    public function listAccount()
    {
        $data = User::all();
        return view('admin.listAccount.index',['users'=>$data]);
    }

    // Crud Category
    public function indexCategory(){
        $categories = Category::all();
        
        return view('admin.category.indexCategory', compact('categories'));
    }
    // public function showCategory($id)
    // {
    //     $data = Category::findOrFail($id);
    //     return view('admin.category.showCategory',compact('data'));
    // }
    
    public function createCategory(){
        return view('admin.category.createCategory');
    }
    public function storeCategory(Request $request){
        // dd($request);
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
        ]);
        $cate = new Category;
        $cate->name = $request->input('name');
        $cate->description = $request->input('description');

        $cate->save();
        return redirect('/admin/category/index')->with('success','Data Saved');

        
    }

    public function editCategory($id){
        //find id to update
        $dataCategory = Category::findOrFail($id);
        return view('admin.category.editCategory', compact('dataCategory'));
    }

    public function updateCategory(Request $request, $id){
        $dataCategory = Category::findOrFail($id);
        // assign information to data variable
        $data = $request -> all();
        $dataCategory->update($data);
        return redirect('admin/category/index');
    }

    public function deleteCategory($id)
    {
        $data = Category::findOrFail($id);
        $data -> delete();
        return redirect('admin/category/index')->with('flash_message', 'Category deleted!');  
    }

    public function edit()
    {
        return view('admin.listAccount.edit');
    }

    // Crud Department

    public function indexDepartment(){
        $departments = Department::all();
        
        return view('admin.department.indexDepartment', compact('departments'));
    }

    public function createDepartment()
    {
        return view('admin.department.createDepartment');
    }

    public function storeDepartment(Request $request){
        // dd($request);
        $this->validate($request,[
            'name' => 'required',
        ]);
        $dpm = new Department;
        $dpm->name = $request->input('name');
        $dpm->save();
        return redirect('/admin/department/index')->with('success','Data Saved');
    }
    public function editDepartment($id){
        $dpm = Category::findOrFail($id);
        return view('admin.category.index', compact('dpm'));
    }

    public function updateDepartment(Request $request, $id){
        $this->validate($request,[
            'name' => 'required',
        ]);
        $dpm = Department::findOrFail($id);
        $dpm->name = $request->input('name');
        $dpm->save();
        return redirect('/admin/department/index')->with('success','Data Update');
    }

    public function deleteDepartment($id)
    {
        $item = Department::findOrFail($id);
        $item -> delete();
        return redirect('admin/department/index')->with('flash_message', 'Department deleted!');  
    }

    // Crud Mission

    

}
