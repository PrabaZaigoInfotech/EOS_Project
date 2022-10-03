<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Http\Requests\InstitutionRequest;
use App\Http\Requests\InstitutionUpdateRequest;

use IntlChar;

class InstitutionController extends Controller
{
    public function index(Request $request)
    {
        $institution = Institution::all();
        return view('institution.index', compact('institution'));
    }

    public function create(Request $request)
    {

        $institution = Institution::all();
        return view('institution.create', compact('institution'));
    }


    public function store(InstitutionRequest $request)
    {
        $institution = new Institution;
        $institution->institution_name = $request->institution_name;

        if ($request->logo != 'undefined') {
            $fileName = '';
            if (!empty($request->logo)) {
                if (file_exists(storage_path('public/upload/institution/logo' . $institution->logo))) {
                    Storage::delete(storage_path('public/upload/institution/logo' . $institution->logo));
                }
                $fileExtension = $request->file('logo')
                    ->getClientOriginalExtension();
                $timeStamp = 'logo_' . time() . '_' . uniqid();
                $fileName = $timeStamp . '.' . $fileExtension;
                $request->logo->storeAs('public/upload/institution/logo', $fileName);
                $institution->logo = $fileName;
            }
        }

        if ($request->signature != 'undefined') {
            $fileName = '';
            if (!empty($request->signature)) {
                if (file_exists(storage_path('public/upload/institution/signature' . $institution->signature))) {
                    Storage::delete(storage_path('public/upload/institution/signature' . $institution->signature));
                }
                $fileExtension = $request->file('signature')
                    ->getClientOriginalExtension();
                $timeStamp = 'signature_' . time() . '_' . uniqid();
                $fileName = $timeStamp . '.' . $fileExtension;
                $request->signature->storeAs('public/upload/institution/signature', $fileName);
                $institution->signature = $fileName;
            }
        }

        $institution->save();
        return redirect()->route('institution.index')->with('Success', 'Created Successfully');
    }

    public function edit(Request $request, $id)
    {

        $institution = Institution::find($id);

        return view('institution.edit', compact('institution'));
    }


    public function update(InstitutionUpdateRequest $request, $id)
    {

        $institution = Institution::find($id);
        $institution->institution_name = $request->institution_name;

        if ($request->logo != 'undefined') {
            $fileName = '';
            if (!empty($request->logo)) {
                if (file_exists(storage_path('public/upload/institution/logo' . $institution->logo))) {
                    Storage::delete(storage_path('public/upload/institution/logo' . $institution->logo));
                }
                $fileExtension = $request->file('logo')
                    ->getClientOriginalExtension();
                $timeStamp = 'logo_' . time() . '_' . uniqid();
                $fileName = $timeStamp . '.' . $fileExtension;
                $request->logo->storeAs('public/upload/institution/logo', $fileName);
                $institution->logo = $fileName;
            }
        }
        if ($request->signature != 'undefined') {
            $fileName = '';
            if (!empty($request->signature)) {
                if (file_exists(storage_path('public/upload/institution/signature' . $institution->signature))) {
                    Storage::delete(storage_path('public/upload/institution/signature' . $institution->signature));
                }
                $fileExtension = $request->file('signature')
                    ->getClientOriginalExtension();
                $timeStamp = 'signature_' . time() . '_' . uniqid();
                $fileName = $timeStamp . '.' . $fileExtension;
                $request->signature->storeAs('public/upload/institution/signature', $fileName);
                $institution->signature = $fileName;
            }
        }
        $institution->update();
        return redirect()->route('institution.index')->withSuccess('Updated Successfully.');
    }

    public function show(Request $request, $id)
    {
        $institution = Institution::find($id);
        return view('institution.show', compact('institution'));
    }


    public function delete($id)
    {

        $institution = Institution::where('id', $id)->first();
        if ($institution) {
            $institution->delete();
            return redirect()->route('institution.index')->withSuccess('Delete Successfully.');
        }
    }

    public function sample_certificate()
{

    return view('sample_certificate');
}
}
