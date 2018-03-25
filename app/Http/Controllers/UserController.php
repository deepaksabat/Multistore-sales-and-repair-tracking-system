<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Earning;
use App\Invoice;
use App\Payment_request;
use App\Shop;
use App\Store_credit;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use yajra\Datatables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'All Staff List';
        return view('admin.agents', compact('pageTitle'));
    }

    public function indexData()
    {
        $user = Auth::user();

        if($user->isShopAdmin())
        {
            $shop_id = $user->shop->id;
            $agents = User::where('shop_id', $shop_id)->where('user_type', 'user')->orWhere('user_type', 'shop_admin')->select('id', 'referral_id', 'first_name', 'last_name','shop_id', 'created_at')->with('shop');
        } else {
            $agents = User::where('user_type', 'user')->orWhere('user_type', 'shop_admin')->select('id', 'referral_id', 'first_name', 'last_name','shop_id', 'created_at')->with('shop');

        }

        return Datatables::of($agents)
            ->editColumn('first_name', function($agent){
                return $agent->get_fullname();
            })

            ->editColumn('shop_id', function($agent){
                if($agent->shop_id != 0) {
                    return $agent->shop->name;
                }
                return '';
            })
            ->editColumn('created_at', function($agent){
                return $agent->created_at->format('F d, Y');
            })
            ->addColumn('action', function($agent){
                $btn = '';

                $btn .= '<a data-original-title="Edit" href="'.route('edit_agent', $agent->id).'" class="btn btn-info" title="" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>';

                $btn .= '<a data-original-title="Delete" href="javascript:;" class="btn btn-danger deleteBrands" title="" data-toggle="tooltip" data-placement="top" data-id="'.$agent->id.'"><i class="fa fa-trash-o"></i> </a>';

                return $btn;

            })
            ->removeColumn('last_name')
            ->removeColumn('id')
            ->removeColumn('shop')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Add new staff';
        $shops = Shop::where('status', 1)->get();

        return view('admin.agent_create', compact('pageTitle', 'shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'shop'                  => 'required',
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'mobile_number'         => 'required',
            'user_type'             => 'required',
        ];

        //Add special needs if this is Shop Admin
        $shop_id = $request->input('shop');
        $user_type = $request->input('user_type');
        if($user->isShopAdmin())
        {
            $rules = array_except($rules, ['user_type', 'shop']);
            $shop_id = $user->shop->id;
            $user_type = 'user';
        }

        $this->validate($request, $rules);

        $refID = str_random(6);
        // get unique REF ID id
        while( ( User::where('referral_id', $refID)->count() ) > 0)
        {
            $refID = str_random(6);
        }
        $refID = strtoupper($refID);

        $userData = [
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'email'         => $request->input('email'),
            'password'      => Hash::make($request->input('password')),
            'mobile'        => $request->input('mobile_number'),
            'user_type'     => $user_type,
            'active_status' => 1,
            'shop_id'       => $shop_id,
            'referral_id'   => $refID,
        ];

        $userCreate = User::create($userData);
        if($userCreate)
        {
            //$userCreate->joinedShops()->attach($shop_id, ['created_at' => Carbon::now()]);
            return redirect()->back()->with('success', 'Staff added success');
        }
        return redirect()->back()->with('error', 'Something went wrong, please try again');
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
        $pageTitle = 'Edit staff';
        $shops = Shop::where('status', 1)->get();
        $user = User::find($id);

        return view('admin.agent_edit', compact('pageTitle', 'shops', 'user'));

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
        $user = User::find($id);


        $rules = [
            'shop'                  => 'required',
            'first_name'            => 'required',
            'last_name'             => 'required',
            'mobile_number'         => 'required',
        ];

        if ($request->password){
            $rules['password'] = 'required|confirmed';
            $rules['password_confirmation'] = 'required';

            $user->password = Hash::make($request->input('password'));
        }

        //Add special needs if this is Shop Admin
        $shop_id = $request->input('shop');
        $user_type = $request->input('user_type');

        $this->validate($request, $rules);


        $user->shop_id = $shop_id;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->mobile = $request->input('mobile_number');

        $save = $user->save();
        if ($save){
            return redirect()->back()->with('success', 'Update Success');
        }

        return redirect()->back()->with('error', 'Something went wrong, please try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $user_id = $request->input('user_id');
        $response['status'] = 0;
        $user = User::find($user_id);
        $user_name = $user->first_name.' '.$user->last_name;
        $destroy = $user->delete();

        if($destroy)
        {
            $response['status'] = 1;
            $response['msg']    = 'Success';
        }
        Activity::create(['user_id' => $user->id, 'activity' => 'You have deleted '.$user_name]);
        return $response;
    }

    public function dashboard()
    {
        $user = Auth::user();

        $shop = $user->shop;

        $year = date('Y');
        $sales_data = Invoice::where('shop_id', $shop->id)->whereRaw('YEAR(created_at) ='.$year)->selectRaw('MONTHNAME(created_at) as month, sum(total_price) as amount')->groupBy('month')->orderBy('created_at')->get();

        $label = '[';
        $amount = '';
        foreach($sales_data as $data)
        {
            $label .= '"'.$data->month.'", ';
            $amount .= $data->amount.', ';
        }
        $label .= ']';


        return view('user_admin.dashboard', compact('user', 'label', 'amount'));
    }

    public function signIn()
    {
        return view('admin.login');
    }

    public function signInPost(Request $request)
    {

        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required',
        ];

        $this->validate($request, $rules);

        $email = $request->input('email');
        $password = $request->input('password');

        $credential = [
            'email'     => $email,
            'password'  => $password,
            'active_status' => 1
        ];

        $auth = Auth::attempt($credential);

        if($auth)
        {
            $user = Auth::user();
            if($user->isSuperAdmin())
            {
                return redirect()->intended(route('dashboard'));
            }
            return redirect()->intended(route('user_dashboard'));
        }else{
            return redirect()->back()->with('error', 'Incorrect login details');
        }

        //return redirect()->back()->with('error', 'Something went wrong, please try again.');
    }


    public function joinShop(Request $request)
    {
        $user = Auth::user();
        $slug = $request->segment(2);
        $shop = Shop::where('slug', $slug)->first();
        $user->joinedShops()->attach($shop->id, ['user_type'=>'agent', 'created_at' => Carbon::now()]);

        //Send email to Merchant about this joined
        Mail::send('emails.join_confirmation_merchant', ['user' => $user, 'shop' => $shop], function ($m) use ($user, $shop) {
            $m->from('support@buzzrefer.com', 'BuzzRefer.com');
            $m->replyTo($user->email, $user->get_fullname());
            $m->to($shop->email, $shop->name)->subject($user->get_fullname().' joined your referral program');
        });

        //Send email to Merchant about this joined
        Mail::send('emails.join_confirmation_user', ['user' => $user, 'shop' => $shop], function ($m) use ($user, $shop) {
            $m->from('support@buzzrefer.com', 'BuzzRefer.com');
            $m->replyTo($shop->email, $shop->name);
            $m->to($user->email, $user->get_fullname())->subject($shop->name.' referral program joined confirmation');
        });


        return redirect(route('shop_single', $shop->slug))->with('join_success', 'Congratulation '.$user->get_fullname().', You are now an agent of '. $shop->name);
    }


    public function profile()
    {
        $pageTitle = 'Profile';
        return view('user_admin.profile', compact('pageTitle'));
    }

    public function profileEdit()
    {

        $pageTitle = 'Profile Edit';
        return view('user_admin.profile_edit', compact('pageTitle'));
    }

    public function adminProfile()
    {
        $pageTitle = 'Profile';
        return view('admin.profile', compact('pageTitle'));
    }

    public function adminProfileEdit()
    {

        $pageTitle = 'Profile Edit';
        return view($this->logged_user_view.'profile_edit', compact('pageTitle'));
    }

    public function profileEditPost(Request $request)
    {
        $rules = [
            'mobile'    => 'required'
        ];
        $this->validate($request, $rules);

        $user = Auth::user();
        $user->mobile = $request->input('mobile');

        //Profile Thumb
        $directory = public_path('uploads/photo/');

        if (!file_exists($directory)) mkdir($directory, 0775, true);
        //File unique name
        $photoName = strtolower(str_slug($user->get_fullname()).'-'.str_random(7) . substr(time(), 4));

        //Verifying File Presence
        if ($request->hasFile('profile_photo')) {
            //verifying file is valid
            if ($request->file('profile_photo')->isValid()) {
                $ext = $request->file('profile_photo')->getClientOriginalExtension();
                $imgNewName = $photoName . '.' . $ext;
                $is_upload = $request->file('profile_photo')->move($directory, $imgNewName);

                if ($is_upload) {
                    //delete previous one
                    if(file_exists($user->photo != '' && $directory.$user->photo)) unlink($directory.$user->photo);
                    //Saved in earning table
                    $user->photo = $imgNewName;
                } //is file upload
            }
        }

        $user->save();
        return redirect()->back()->with('success', 'Profile edit success');
    }



    public function logout()
    {
        Auth::logout();
        return redirect(route('sign_in'));
    }

}
