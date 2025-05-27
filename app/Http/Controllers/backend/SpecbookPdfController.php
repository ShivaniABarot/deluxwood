<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreditcardForm;
use App\Models\SpecbookPdf;
use DB;
use Illuminate\Support\Facades\Auth;


class SpecbookPdfController extends Controller
{
    public function index()
    {
        $pagename = "Specbook Pdf";
        $specbook = SpecbookPdf::select('*')->get();
        $hasRecords = SpecbookPdf::count() > 0;
        
        return view('backend.specbook_pdf.index',compact('pagename','specbook','hasRecords'));
    } 
    public function create()
    {
        $pagename = "Specbook Pdf Create";

        return view('backend.specbook_pdf.create',compact('pagename'));
    }
    public function store(Request $request){
        if($request->ajax()){
            return true;
         }

        $specbook = new SpecbookPdf();

        if($request->hasfile('pdf'))
        {
            $file = $request->file('pdf');
            $extension = $file->getClientOriginalExtension();
            $filename1 = rand().'.'.$extension;
            $file->move('public/img/specbook',$filename1);
            $specbook->pdf=$filename1;

        }
        $specbook->save();

        return redirect('admin/specbook-pdf')->with('success','Specbook Pdf Added Successfully');
           
    }
    public function edit($id)
    {
        $pagename = "Specbook Pdf Edit";
        $specbook = SpecbookPdf::find($id);
        return view('backend.specbook_pdf.edit',compact('pagename','specbook'));
    }
    public function update(Request $request,$id)
    { 
        if($request->ajax())
        {
             return true;
        }

        $specbook = SpecbookPdf::find($id);

        if($request->hasfile('pdf'))
        {
            $file = $request->file('pdf');
            $extension = $file->getClientOriginalExtension();
            $filename1 = rand().'.'.$extension;
            $file->move('public/img/specbook',$filename1);
            $specbook->pdf=$filename1;

        }
        $specbook->save();
 
      return redirect('admin/specbook-pdf')->with('success','Specbook Pdf Updated Successfully');
        
     }

}