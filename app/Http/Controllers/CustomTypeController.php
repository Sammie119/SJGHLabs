<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Dropdowns;
use App\Models\Investigations;
use App\Models\VWDropdown;

class CustomTypeController extends Controller
{
    public function index()
    {
        $custom = VWDropdown::select('*')->orderBy('category_name')->get();//paginate(7);
        return view('custom-types', compact('custom'));
    }

    public function createCategory()
    {
        return view('category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ],
        [
            'category_name.required' => 'Category Name field is required',
        ]);
        
        $category = new Category;
        
        $category->category_name = $request['category_name'];
        $category->created_by = Session::get('user')['user_id'];
        $category->updated_by = Session::get('user')['user_id'];
        $category->save();

        $request->session()->flash('register', 'New Category '.$category->category_name.' created Successfully!!');

        return Redirect::back();
    }

    public function createDropdown()
    {
        $category = Category::select('*')->orderBy('category_name')->get();
        return view('dropdown', compact('category'));
    }

    public function storeDropdown(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'dropdown_name' => 'required',
        ],
        [
            'category_id.required' => 'Category Name field is required',
            'dropdown_name.required' => 'Dropdown Name field is required',
        ]);
        
        $dropdown = new Dropdowns;
            $dropdown->category_id = $request['category_id'];
            $dropdown->dropdown = $request['dropdown_name'];
            $dropdown->created_by = Session::get('user')['user_id'];
            $dropdown->updated_by = Session::get('user')['user_id'];  
            $dropdown->save();

        if($dropdown){
            $request->session()->flash('register', 'New Dropdown '.$dropdown->dropdown.' created Successfully!!');

            return Redirect::back();
        }
    }

    public function editDropdown($id)
    {
        $dropdown = VWDropdown::where('dropdown_id', $id)->first();
        $category = Category::all();
        return view('edit-dropdown', compact('dropdown', 'category'));
    }

    public function updateDropdown(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'dropdown_name' => 'required',
        ],
        [
            'category_id.required' => 'Category Name field is required',
            'dropdown_name.required' => 'Dropdown Name field is required',
        ]);
        
        $dropdown = Dropdowns::findOrFail($request->id);
        
        if($dropdown){
            $dropdown->category_id = $request['category_id'];
            $dropdown->dropdown = $request['dropdown_name'];
            $dropdown->updated_by = Session::get('user')['user_id'];
            $dropdown->update();

            $request->session()->flash('register', 'Dropdown '.$dropdown->dropdown.' updated Successfully!!');

            return redirect('custom-types');
        }
    }

    public function destroyDropdown($id)
    {
        $dropdown = Dropdowns::findOrFail($id);
        if($dropdown){
            $dropdown->delete();

            Session::flash('register', 'Dropdown '.$dropdown->dropdown.' deleted Successfully!!');

            return Redirect::back();
        }
    }

    public function getLabPrices()
    {
        $labs = Investigations::orderBy('invest_id')->get();
        return view('lab-pricing', ['labs' => $labs]);
    }

    public function saveChangedPrices(Request $request)
    {
        // dd($request->all());
        foreach ($request->alias as $key => $alias) {
            $lab = Investigations::where('alias', $alias)->first();
            $lab->insured_amount = $request->insured[$key];
            $lab->noninsured_amount = $request->noninsured[$key];
            $lab->update();
        }

        return back()->with('success', 'Prices Updated Successfully!!!');
    }
}
