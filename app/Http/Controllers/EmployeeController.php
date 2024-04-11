<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Auth;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::all();
    return view('employee.view', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $company = Company::all();
        return view('employee.index', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      $validated = $request->validate([

        'name' => 'required',
        'email' => 'required',
        'company' => 'required',
        'join_date' => 'required',
        'mobile_number' => 'required',
        
    ]);
        $data = new Employee();
        if ($request->file('image')) {
          $file = $request->file('image');
          $filename = date('YmdHi') . $file->getClientOriginalName();
          $file->move(public_path('image/employee/'), $filename);
          $data->image = $filename;
        }
        $data->name = $request->name;
        $data->email = $request->email;
        $data->company = $request->company;
        $data->join_date = $request->join_date;
        $data->mobile_number = $request->mobile_number;
        $data->created_by = Auth::user()->admin_id;
        $data->save();
        return redirect()->route('admin.employee.index');
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
        $data = Employee::find($id);
        return view('employee.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
      $data = Employee::find($id);
  
      if ($req->file('image')) {
        $file = $req->file('image');
        $filename = date('YmdHi') . $file->getClientOriginalName();
  
        $file->move(public_path('image/employee/'), $filename);
        $image_path=public_path('image/employee/' . $data->image);
        if(file_exists($image_path)){
          unlink($image_path);
      }
        $data->image = $filename;
      }
      //dd($filename);
      $data->name = $req->name;
      $data->google = $req->google;
      $data->facebook = $req->facebook;
      $data->about = $req->about;
      $data->opening_hours = $req->hours;
      
  
      $imgArr = [];
      for ($i = 1; $i < 5; $i++) {
        if ($req->has('image' . $i . '')) {
          array_push($imgArr, $i);
        } else {
          array_push($imgArr, "0");
        }
      }
      //dd($imgArr);
  
      $img = implode(',', $imgArr);
      $data->facilities = $img;
  
  
      $data->packages = $req->packages;
      $data->pricelist = $req->pricelist;
      $data->gift = $req->gift;
      $data->map = $req->map;
      $data->appointment = $req->appointment;
      $data->package_link = $req->package_link;
      // dd($data);
      $data->update();
      return redirect()->route('admin.employee.index');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $data = Employee::find(decrypt($id));
     $image_path=public_path('image/employee/' . $data->image);
          
     if(file_exists($image_path)){
         unlink($image_path);
     }
      $data->delete();
      return redirect()->route('admin.employee.index');
    }
}