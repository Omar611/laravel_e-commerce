<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function sections()
    {
        $sections = Section::all();
        return view('admin.sections.sections', compact('sections'));
    }

    public function updateSections(Request $request)
    {
        $status = $request->status == "Active" ? 0 : 1;
        Section::find($request->section_id)->update([
            'status' => $status,
        ]);
        return response($status);
    }
}
