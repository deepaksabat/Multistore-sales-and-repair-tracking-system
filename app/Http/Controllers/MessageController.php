<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $pageTitle = 'Messages Inbox';

        if($user->isSuperAdmin()) {
            return view('admin.message_inbox', compact('pageTitle'));
        }
        return view('user_admin.message_inbox', compact('pageTitle'));
    }

    public function sent()
    {
        $user = Auth::user();
        $pageTitle = 'Sent Messages';

        if($user->isSuperAdmin()) {
            return view('admin.message_sent', compact('pageTitle'));
        }
        return view('user_admin.message_sent', compact('pageTitle'));
    }


    public function messageInboxData()
    {
        $user = Auth::user();
        if($user->isSuperAdmin())
        {
            $messages = Message::where('message_for', 'admin')->where('parent_id', 0)->select('id','sender_id', 'subject','is_read', 'from','created_at')->orderBy('id', 'desc');

            return Datatables::of($messages)
                ->editColumn('sender_id', function($message){
                    return $message->sender();
                })
                ->editColumn('subject', function($message){
                    if($message->is_read == 0)
                    {
                        return '<strong>'.$message->subject.'</strong>';
                    }
                    return $message->subject;
                })
                ->editColumn('created_at', function($message){
                    return '<span title="'.$message->created_at->format('F d,Y h:i A') .'"> '.$message->created_at->diffForHumans().' </span>';
                })
                ->addColumn('actions', function($message){
                    return '<a href="'.route('admin_message_read', $message->id).'" class="btn btn-primary"><i class="fa fa-eye"></i> </a>';
                })
                ->removeColumn('id')
                ->removeColumn('from')
                ->removeColumn('is_read')
                ->make();
        }
        else
        {
            $messages = $user->messages()->where('parent_id', 0)->select('id','sender_id', 'subject','is_read', 'from', 'created_at')->orderBy('id', 'desc');

            return Datatables::of($messages)
                ->editColumn('sender_id', function($message){
                    return $message->sender();
                })
                ->editColumn('subject', function($message){
                    if($message->is_read == 0)
                    {
                        return '<strong>'.$message->subject.'</strong>';
                    }
                    return $message->subject;
                })
                ->editColumn('created_at', function($message){
                    return '<span title="'.$message->created_at->format('F d,Y h:i A') .'"> '.$message->created_at->diffForHumans().' </span>';
                })
                ->addColumn('actions', function($message){
                    return '<a href="'.route('message_read', $message->id).'" class="btn btn-primary"><i class="fa fa-eye"></i> </a>';
                })
                ->removeColumn('id')
                ->removeColumn('is_read')
                ->removeColumn('from')
                ->make();
        }


    }


    public function messageSentData()
    {
        $user = Auth::user();
        if($user->isSuperAdmin())
        {
            $messages = Message::where('from', 'admin')->where('parent_id', 0)->select('id','user_id', 'subject','is_read', 'from','created_at')->orderBy('id', 'desc');

            return Datatables::of($messages)
                ->editColumn('user_id', function($message){
                    return $message->to();
                })
                ->editColumn('subject', function($message){
                    if($message->is_read == 0)
                    {
                        return '<strong>'.$message->subject.'</strong>';
                    }
                    return $message->subject;
                })
                ->editColumn('created_at', function($message){
                    return '<span title="'.$message->created_at->format('F d,Y h:i A') .'"> '.$message->created_at->diffForHumans().' </span>';
                })
                ->addColumn('actions', function($message){
                    return '<a href="'.route('admin_message_read', $message->id).'" class="btn btn-primary"><i class="fa fa-eye"></i> </a>';
                })
                ->removeColumn('id')
                ->removeColumn('is_read')
                ->removeColumn('from')
                ->make();
        }
        else
        {
            $messages = Message::where('sender_id', $user->id)->where('parent_id', 0)->select('id','user_id', 'subject','is_read', 'from', 'created_at')->orderBy('id', 'desc');

            return Datatables::of($messages)
                ->editColumn('user_id', function($message){
                    return $message->to();
                })
                ->editColumn('subject', function($message){
                    if($message->is_read == 0)
                    {
                        return '<strong>'.$message->subject.'</strong>';
                    }
                    return $message->subject;
                })
                ->editColumn('created_at', function($message){
                    return '<span title="'.$message->created_at->format('F d,Y h:i A') .'"> '.$message->created_at->diffForHumans().' </span>';
                })
                ->addColumn('actions', function($message){
                    return '<a href="'.route('message_read', $message->id).'" class="btn btn-primary"><i class="fa fa-eye"></i> </a>';
                })
                ->removeColumn('id')
                ->removeColumn('is_read')
                ->removeColumn('from')
                ->make();
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $pageTitle = 'Compose Message';

        $users = User::where('active_status', 1)->get();

        if($user->isSuperAdmin()) {
            return view('admin.message_compose', compact('pageTitle', 'users'));
        }
        return view('user_admin/message_compose', compact('pageTitle', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'message_to'    => 'required',
            'subject'    => 'required',
            'message'    => 'required',
        ];
        $this->validate($request, $rules);

        $user = Auth::user();
        $message_to = $request->input('message_to');
        $subject    = $request->input('subject');
        $message    = $request->input('message');

        //if this is Shop
        //$from_shop_id    = $request->input('from_shop_id');

        $from = 'admin';
        $message_for = $message_to;

        $user_id = $message_to;
        $sender_id = $user->id;

        if($user->isSuperAdmin())
        {
            $from = 'admin';
            if($message_to != 'admin') $message_for = 'user';
            $user_id = $message_to;
        }
        else
        {
            $from = 'user';
            if($message_to != 'admin') $message_for = 'user';
            $user_id = $message_to;
        }

        $messageData = [
            'user_id'   => $user_id,
            'sender_id' => $sender_id,
            'subject'   => $subject,
            'message'   => $message,
            'message_for'   => $message_for,
            'from'      => $from,
        ];

        $create = Message::create($messageData);

        if($create)
        {
            return redirect()->back()->with('success', 'Message sent Success');
        }
        return redirect()->back()->with('error', 'Something went wrong, please try again later')->withInput($request->input());


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $pageTitle = 'Message Details';
        $message = Message::find($id);

       if($message->message_for == 'admin') {
            if($user->isSuperAdmin())
            {
                $message->is_read = 1;
            }
       }elseif($user->id == $message->user_id)
       {
           $message->is_read = 1;
       }

        $message->save();

        if($user->isSuperAdmin()) {
            return view('admin.message_read', compact('message', 'pageTitle'));
        }

        return view('user_admin.message_read', compact('message', 'pageTitle'));
    }

    public function reply(Request $request, $id)
    {
        $rules = [
            'message'    => 'required',
        ];
        $this->validate($request, $rules);
        $user = Auth::user();

        $message = Message::find($id);

        $sender_id = $user->id;

        if($user->isSuperAdmin())
        {
            $from = 'admin';
        }
        else
        {
            $from = 'user';
        }

        $messageData = [
            'user_id'   => $message->user_id,
            'sender_id' => $sender_id,
            'subject'   => $message->subject,
            'message'   => $request->input('message'),
            'message_for'   => $message->message_for,
            'from'      => $from,
            'parent_id'      => $message->id,
        ];

        $create = Message::create($messageData);

        if($create)
        {
            return redirect()->back()->with('success', 'Message replied success');
        }
        return redirect()->back()->with('error', 'Something went wrong, please try again later')->withInput($request->input());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
