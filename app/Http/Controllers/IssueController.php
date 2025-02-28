<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueRequest;
use App\Models\Category;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class IssueController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $issues = Issue::whereAdminId(Auth::guard('admin')->id())->latest()->paginate(10);
        $categories = Category::select('id','name')->get();
        return view('pages.Issues.index', compact('issues','categories'));
    }



    /*** store function  ***/
    public function store(IssueRequest $request)
    {
        $issue = new Issue();
        $issue->category_id = $request->category_id;
        $issue->title = $request->title;
        $issue->description = $request->description;
        $issue->priority = $request->priority;
        $issue->type = $request->type;
        $issue->admin_id = auth('admin')->id();
        $issue->active = 1;
        $issue->save();
        return redirect()->back()->with('alert-success','Data is saved successfully');
    }



    /*** update function  ***/
    public function update(IssueRequest $request, Issue $issue)
    {
        $issue->category_id = $request->category_id;
        $issue->title = $request->title;
        $issue->description = $request->description;
        $issue->priority = $request->priority;
        $issue->type = $request->type;
        $issue->admin_id = auth('admin')->id();
        $issue->active = $request->active;
        $issue->update();
        return redirect()->back()->with('alert-info','Data is updated successfully');
    }



    /*** destroy function  ***/
    public function destroy(Issue $issue)
    {
        $issue->delete();
        return redirect()->back()->with('alert-info','Data is deleted successfully');
    }

} //end of class
