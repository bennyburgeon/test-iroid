<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Session;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Company::all();
     
    return view('company.view', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.index');
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
        'contact_number' => 'required',
        'annual_turnover' => 'required',
        'description' => 'required',
    ]);
        $data = new Company();
        if ($request->file('image')) {
          $file = $request->file('image');
          $filename = date('YmdHi') . $file->getClientOriginalName();
          $file->move(public_path('image/company/'), $filename);
          $data->logo = $filename;
        }
        $data->name = $request->name;
        $data->contact_number = $request->contact_number;
        $data->annual_turnover = $request->annual_turnover;
        $data->description = $request->description;
        $data->created_by = Auth::user()->admin_id;

        $data->save();
        return redirect()->route('admin.company.index');
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
        $data = Company::find($id);
        return view('company.edit', compact('data'));
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
      $validated = $request->validate([
        'name' => 'required',
        'contact_number' => 'required',
        'annual_turnover' => 'required',
        'description' => 'required',
    ]);
      $data = Company::find($id);
  
      if ($req->file('image')) {
        $file = $req->file('image');
        $filename = date('YmdHi') . $file->getClientOriginalName();
  
        $file->move(public_path('image/company/'), $filename);
        $image_path=public_path('image/company/' . $data->image);
        if(file_exists($image_path)){
          unlink($image_path);
      }
        $data->image = $filename;
      }
      $data->name = $request->name;
        $data->contact_number = $request->contact_number;
        $data->annual_turnover = $request->annual_turnover;
        $data->description = $request->about;
      $data->update();
      return redirect()->route('admin.company.index');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $employee = Employee::where('company',decrypt($id))->get();
      if(count($employee)==0){
          $data = Company::find(decrypt($id));
          $image_path=public_path('image/company/' . $data->logo);
                
          if(file_exists($image_path)){
              unlink($image_path);
          }
            $data->delete();
            return redirect()->route('admin.company.index');
        }else{
          return redirect()->route('admin.company.index')->with('message', 'Employees exist');;
        }
    }
}
