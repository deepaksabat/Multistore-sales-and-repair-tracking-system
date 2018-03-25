<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Brand;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'All Brands';
        return view('admin.brand_index', compact('pageTitle'));
    }


    public function indexData()
    {
        $brands = Brand::orderBy('id', 'desc')->select('id','brand_name', 'created_at');
        return Datatables::of($brands)
            ->editColumn('created_at', function($brand){
                return '<span title="'.$brand->created_at->format('F d, Y').'" data-toggle="tooltip" data-placement="top"> '.$brand->created_at->diffForHumans().' </span>';
            })
            ->addColumn('actions', function($brand){
                $button = '<a href="'.route('edit_brand', $brand->id).'" class="btn btn-info" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>';
                $button .= '<a href="javascript:;" class="btn btn-danger deleteBrands" title="Delete" data-toggle="tooltip" data-placement="top" data-id="'.$brand->id.'"><i class="fa fa-trash-o"></i> </a>';
                return $button;
            })
            ->removeColumn('id')
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Brands';
        return view('admin.brand_create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user= Auth::user();
        $rules = [
            'brand_name' => 'required'
        ];
        $this->validate($request, $rules);
        $brand_name = $request->input('brand_name');
        $data = [
            'brand_name' => $brand_name,
            'user_id' => $user->id,
        ];

        $create = Brand::create($data);
        if($create)
        {
            Activity::create(['user_id' => $user->id, 'activity' => 'You have added '.$brand_name. '  brand']);

            return redirect()->back()->with('success', 'Brands create success');
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
        $pageTitle = 'Create Brands';
        $brand = Brand::find($id);
        return view('admin.brand_edit', compact('pageTitle', 'brand'));

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
        $rules = [
            'brand_name' => 'required'
        ];
        $this->validate($request, $rules);

        $user = Auth::user();

        $brand_name = $request->input('brand_name');

        $brand = Brand::find($id);
        $brand->brand_name = $brand_name;
        $update = $brand->save();

        if($update)
        {
            Activity::create(['user_id' => $user->id, 'activity' => 'You have added '.$brand->brand_name. '  Brand']);

            return redirect()->back()->with('success', 'Brand update success');
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
        $brand_id = $request->input('brand_id');
        $response['status'] = 0;
        $brand = Brand::find($brand_id);
        $brand_name = $brand->brand_name;
        $destroy = $brand->delete();

        if($destroy)
        {
            $response['status'] = 1;
            $response['msg']    = 'Success';
        }
        Activity::create(['user_id' => $user->id, 'activity' => 'You have deleted '.$brand_name. '  Brand']);
        return $response;
    }
}
