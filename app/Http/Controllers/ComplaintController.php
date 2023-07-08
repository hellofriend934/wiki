<?php

namespace App\Http\Controllers;

use App\Mail\ComplaintMail;
use App\Models\Complaint;
use App\Models\ComplaintReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    public function index()
    {
        $reasons = ComplaintReason::all();
        return view('Articles.complaint', compact('reasons'));
    }

    public function store(Request $request, string $slug)
    {

       $complaint =  Complaint::query()->create(['complaint_reason_id'=>$request->input('reason'), 'info'=>$request->input('info'), 'article_slug'=>$slug]);
       $res =  Mail::send(new ComplaintMail($complaint->reasonName->reason, $complaint->article_slug));
       dd($res);
        return redirect()->back();
    }
}
