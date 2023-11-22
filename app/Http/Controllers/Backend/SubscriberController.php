<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NewsletterSubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Mail\Newsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function index(NewsletterSubscriberDataTable $dataTable)
    {
        return $dataTable->render('admin.subscriber.index');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'subject' => ['required'],
            'message' => ['required']
        ]);

        $emails = NewsletterSubscriber::where('is_verified', 1)->pluck('email')->toArray();

        // send mail
        Mail::to($emails)->send(new Newsletter($request->subject, $request->message));

        toastr('Mail Succesfully Send to All Subscribers!', 'success', 'success');
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id)->delete();
        return response(['status' => 'success', 'message' => 'Subscriber Deleted Successfully']);
    }
}
