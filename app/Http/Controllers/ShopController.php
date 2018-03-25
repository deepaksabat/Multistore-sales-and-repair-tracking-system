<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Earning;
use App\Http\Helpers\Helpers;
use App\Invoice;
use App\Invoice_items;
use App\Product;
use App\Shop;
use App\Stock;
use App\Subscription_payment;
use App\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use yajra\Datatables\Datatables;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Shop Index';
        //$shops = Shop::all();

        return view('admin.shops', compact('pageTitle', 'shops'));
    }

    public function indexData()
    {
        $shops = Shop::select('id', 'name', 'status');

        return Datatables::of($shops)
            ->editColumn('name', function($shop){
                return '<a href="'. route('admin_shop_view', $shop->id) .'"> <strong>'.$shop->name .'</strong></a>';
            })
            ->editColumn('status', function($shop){
                return $shop->statusText();
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Add new shop';
        //return view('front.shop_signup');
        return view('admin.shop_create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'shop_name' => 'required',
            'shop_email' => 'required',
            'shop_mobile_number' => 'required',
            'shop_address' => 'required',
        ];

        $this->validate($request, $rules);

        $user = Auth::user();

        $shopName = $request->input('shop_name');
        $slug = str_slug($shopName);
        $address = $request->input('shop_address');
        $bank_details = $request->input('bank_details');
        $email = $request->input('shop_email');

        //get unique slug...
        $nSlug = $slug;

        $i = 0;
        while ((Shop::where('slug', '=', $nSlug)->count()) > 0) {
            $i++;
            $nSlug = $slug . '-' . $i;
        }
        if ($i > 0) {
            $newSlug = substr($nSlug, 0, strlen($slug)) . '-' . $i;
        } else {
            $newSlug = $slug;
        }

        $shop           = new Shop();
        $shop->user_id  = $user->id;
        $shop->name     = $shopName;
        $shop->slug     = $newSlug;
        $shop->email    = $email;
        $shop->address  = $address;
        $shop->status   = 1;
        $shop->save();

        //Added this user as This shop/merchant as Admin
        //$userCreate->joinedShops()->attach($shop->id, ['created_at' => Carbon::now(), 'user_type' => 'shop_admin']);
        Activity::create(['user_id' => $user->id, 'activity' => 'You have added '.$shopName. '  as shop']);

        return redirect(route('all_shops'))->with('success', 'Shop added success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);
        $pageTitle = 'Shop Details';


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


        return view('admin.shop_show', compact('shop', 'pageTitle', 'label', 'amount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userShops()
    {
        $pageTitle = 'Shop Index';
        $shops = Auth::user()->joinedShops;

        return view('user_admin.shops', compact('pageTitle', 'shops'));
    }

    public function myMerchants(Request $request)
    {
        $pageTitle = 'My Merchant List';
        return view('user_admin.my_merchants', compact('pageTitle'));
    }


    public function myMerchantsData()
    {
        $shops = Auth::user()->joinedShops()->select('shops.id', 'name');
        return Datatables::of($shops)
            ->editColumn('name', function ($shop) {
                return '<a href="' . route('user_shop_view', $shop->id) . '"> <strong>' . $shop->name . '</strong></a>';
            })
            ->addColumn('total_earn', function ($shop) {
                return $shop->total_earning();
            })
            ->addColumn('total_paid', function ($shop) {
                return 0;
            })
            ->addColumn('total_due', function ($shop) {
                return 0;
            })
            ->make();
    }

    public function changeStatus(Request $request, $id)
    {
        $status = $request->input('shopStatus');
        $shop = Shop::find($id);
        $shop->status = $status;
        $shop->save();
        return redirect()->back()->with('success', $shop->name . ' successfully updated');
    }

    /**
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show merchant for merchant login
     */

    public function showMerchant()
    {
        //$shop = Shop::find($id);

        $shop = Auth::user()->shop;
        $pageTitle = 'Merchant Details';

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

        return view('user_admin.shop_show', compact('shop', 'pageTitle', 'label', 'amount'));
    }

    /**
     * @param $id
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show merchant for User Login
     */

    public function showUser($id)
    {
        $shop = Shop::find($id);

        $pageTitle = 'Merchant Details';
        return view('user_admin.shop_show', compact('shop', 'pageTitle'));
    }

    /**
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Settings for Merchant
     */

    public function settings()
    {
        $pageTitle = 'Settings';
        $shop = Auth::user()->shop;

        return view('user_admin.settings', compact('pageTitle', 'shop'));
    }


    public function settingsUpdate(Request $request)
    {
        $rules = [
            'email' => 'required|email'
        ];
        $this->validate($request, $rules);

        $shop = Auth::user()->shop;

        $address = $request->input('shop_address');
        $bank_details = $request->input('bank_details');
        $commission_type = $request->input('commission_type');
        $commission_amount = $request->input('commission_amount');
        $payment_method = $request->input('payment_method');
        $email = $request->input('email');


        $shop->address = $address;
        $shop->bank_details = $bank_details;
        $shop->commission_type = $commission_type;
        $shop->commission_amount = $commission_amount;
        $shop->payment_method = $payment_method;
        $shop->email = $email;

        //Profile Thumb
        $directory = './uploads/thumb/';
        if (!file_exists($directory)) mkdir($directory, 0777, true);
        //File unique name
        $photoName = str_random(7) . substr(time(), 4);

        //Verifying File Presence
        if ($request->hasFile('profile_photo')) {
            //verifying file is valid
            if ($request->file('profile_photo')->isValid()) {
                $ext = $request->file('profile_photo')->getClientOriginalExtension();
                $imgNewName = $photoName . '-thumb.' . $ext;
                $is_upload = $request->file('profile_photo')->move($directory, $imgNewName);

                if ($is_upload) {
                    //resize for webview for phone and tablet
                    $img = Image::make($directory . $imgNewName);
// resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $img->resize(400, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // finally we save the image as a new file
                    $img->save($directory . $imgNewName);


                    $previousImg = $shop->logo;
                    $shop->logo = $imgNewName;

                    if ($previousImg != '') {
                        unlink($directory . $previousImg);
                    }
                } //is file upload
            }
        }

        $shop->save();

        return redirect()->back()->with('success', 'Profile update success');

    }

    /**
     * Agent List
     */

    public function allAgents()
    {
        $shop = Auth::user()->shop;
        $pageTitle = 'Agent list for ' . $shop->name;

        return view('user_admin.agents', compact('shop', 'pageTitle'));
    }





    public function agentCreate()
    {
        $pageTitle = 'Add new agent';
        return view('user_admin.agent_create', compact('pageTitle'));
    }

    /**
     * Same as user registration in userController
     *
     * @return redirectBack
     */
    public function agentCreatePost(Request $request)
    {

        $rules = [
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'mobile_number'         => 'required',
        ];

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
            'user_type'     => 'user',
            'active_status' => 1,
            'referral_id'   => $refID,
        ];

        $userCreate = User::create($userData);
        if($userCreate)
        {
            $user = $userCreate;

            //Attach Now with Merchant this user
            $shop = Auth::user()->shop;
            $userCreate->joinedShops()->attach($shop->id, ['user_type'=>'agent','created_at' => Carbon::now()]);

            //Send email to newly created user
            Mail::send('emails.signup_confirmation', ['user' => $user], function ($m) use ($user) {
                $m->from('support@buzzrefer.com', 'BuzzRefer.com');
                $m->replyTo('support@buzzrefer.com', 'BuzzRefer.com');
                $m->to($user->email, $user->get_fullname())->subject('Signup confirmation');
            });

            Activity::create(['user_id' => $user->id, 'activity' => 'You have added '.$user->get_fullname(). '  as agent']);

            return redirect()->back()->with('success', 'Agent added success');
        }

    }

    /**
     * @param $id
     *
     * @return Agent Profile
     */

    public function agentProfile($id)
    {
        $agent = User::find($id);
        $pageTitle = $agent->get_fullname() . '\'s profile';
        return view('user_admin.agent_profile_for_merchant', compact('agent', 'pageTitle'));
    }


    public function newSales()
    {
        $pageTitle = 'New Sales';
        $products = Product::all();
        $shops = Shop::where('status', 1)->get();

        return view($this->logged_user_view.'new_sales', compact('pageTitle', 'products', 'shops'));
    }

    public function newSalesPost(Request $request)
    {
        $rules = [
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
        ];

        $user = Auth::user();
        $shop = $user->shop;

        $shop_id = 0;
        if ($user->isSuperAdmin()){
            $rules['shop'] = 'required';
            if ($request->shop){
                $shop_id = $request->shop;
            }
        }else{
            $shop_id = $shop->id;
        }

        $this->validate($request, $rules);
        if(Cart::count() == 0)
        {
            return redirect()->back()->with('error', 'No product')->withInput($request->input());
        }

        if ($shop_id == 0){
            return redirect()->back()->with('error', 'User has not attach with a shop')->withInput($request->input());
        }

        //Generate invoice random id
        $invoice_id = str_random(12);
        // get unique REF ID id
        while ((Invoice::where('invoice_id', $invoice_id)->count()) > 0) {
            $invoice_id = str_random(6);
        }
        $invoice_id = strtoupper($invoice_id);

        $total_price = Cart::total();

        $customer_name      = $request->input('customer_name');
        $customer_email     = $request->input('customer_email');
        $customer_phone     = $request->input('customer_phone');
        $customer_address   = $request->input('customer_address');


        $invoice_data = [
            'shop_id'           => $shop_id,
            'user_id'           => $user->id,
            'invoice_id'        => $invoice_id,
            'total_price'       => $total_price,
            'customer_name'     => $customer_name,
            'customer_email'    => $customer_email,
            'customer_phone'    => $customer_phone,
            'customer_address'  => $customer_address,
        ];

        $invoice_create = Invoice::create($invoice_data);

        //If invoice create success, then insert product items
        if($invoice_create)
        {
            foreach(Cart::content() as $row)
            {
                $invoice_item = [
                    'invoice_id'        => $invoice_create->id,
                    'product_id'        => $row->id,
                    'qty'               => $row->qty,
                    'unit_price'        => $row->price,
                    'unit_price_total'  => $row->subtotal,
                ];
                Invoice_items::create($invoice_item);
            }
            //Now clear cart
            Cart::destroy();
            return redirect()->back()->with('success', 'Product Sale Success');
        }

        return redirect()->back()->with('error', 'Something went wrong, please try again');

    }

    public function addModalProduct(Request $request)
    {
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');

        $repair_cost = $request->input('repair_cost');

        $product = Product::find($product_id);

        //price will be product price, if this is repair product, then price is cost
        $price = $product->unite_price;
        if($repair_cost)
        {
            $price = $repair_cost;
        }

        $addProduct = [
            'id'    => $product->id,
            'name'  => $product->product_name,
            'qty'   => $product_qty,
            'price' => $price,
        ];

        Cart::add($addProduct);
        return ['status'    => 1];
    }


    public function getCartContentProduct()
    {
        return view('ajax.get_cart_content');
    }

    public function removeCartRowProduct(Request $request)
    {
        $rowID = $request->input('rowID');
        Cart::remove($rowID);
        return ['status'    => 1];
    }

    public function updateCartRowProduct(Request $request)
    {
        $rowID = $request->input('rowID');
        $qty = $request->input('qty');
        Cart::update($rowID, ['qty' => $qty]);
        return ['status'    => 1];
    }

    public function shopProducts($id){
        $shop = Shop::find($id);
        $pageTitle = 'Shop Details';

        return view($this->logged_user_view.'shop_products', compact('shop', 'pageTitle'));
    }

    public function shopProductsData($shop_id)
    {
        $products = Product::orderBy('id', 'desc')->select('id', 'product_name', 'product_model', 'brand_id','category_id', 'unite_price', 'created_at')->with('category', 'brand');

        return Datatables::of($products)
            ->editColumn('brand_id', function($product){
                return $product->brand->brand_name;
            })
            ->editColumn('category_id', function($product){
                return $product->category->category_name;
            })
            ->editColumn('created_at', function($product){
                return '<span title="'.$product->created_at->format('F d, Y').'" data-toggle="tooltip" data-placement="top"> '.$product->created_at->diffForHumans().' </span>';
            })
            ->addColumn('stock', function($product)use($shop_id){
                return $product->stock_available($shop_id);
            })
            ->removeColumn('id')
            ->removeColumn('brand')
            ->removeColumn('category')
            ->make();
    }


    public function shopStocks($id)
    {
        $pageTitle = 'Stock List';
        $shop = Shop::find($id);
        return view($this->logged_user_view.'shop_stocks', compact('pageTitle', 'shop'));
    }



    public function shopStocksData($shop_id)
    {

        $stocks = Stock::orderBy('id', 'desc')->select('id', 'product_id', 'shop_id', 'total_product', 'unite_price', 'created_at')->where('shop_id', $shop_id)->with('product', 'shop');

        return Datatables::of($stocks)

            ->editColumn('product_id', function($stock){
                return $stock->product->product_name;
            })
            ->editColumn('shop_id', function($stock){
                if($stock->shop_id == 0)
                {
                    return '<label class="label label-success">In House</label>';
                }
                return '<span class="text-success"> '.$stock->shop->name.' </span>';
            })
            ->editColumn('created_at', function($stock){
                return '<span title="'.$stock->created_at->format('F d, Y').'" data-toggle="tooltip" data-placement="top"> '.$stock->created_at->diffForHumans().' </span>';
            })

            ->removeColumn('id')
            ->removeColumn('product')
            ->removeColumn('shop')
            ->make();
    }

}
