<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Create Category';
        return view('admin.category_index', compact('pageTitle'));
    }


    public function indexData()
    {
        $categories = Category::orderBy('id', 'desc')->select('id','category_name', 'created_at');
        return Datatables::of($categories)
            ->editColumn('created_at', function($category){
                return '<span title="'.$category->created_at->format('F d, Y').'" data-toggle="tooltip" data-placement="top"> '.$category->created_at->diffForHumans().' </span>';
            })
            ->addColumn('actions', function($category){
                $button = '<a href="'.route('edit_category', $category->id).'" class="btn btn-info" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>';
                $button .= '<a href="javascript:;" class="btn btn-danger deleteCategory" title="Delete" data-toggle="tooltip" data-placement="top" data-id="'.$category->id.'"><i class="fa fa-trash-o"></i> </a>';
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
        $pageTitle = 'Create Category';
        return view('admin.category_create', compact('pageTitle'));
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
            'category_name' => 'required'
        ];
        $this->validate($request, $rules);
        $category_name = $request->input('category_name');
        $data = [
            'category_name' => $category_name,
            'user_id' => $user->id,
        ];

        $create = Category::create($data);
        if($create)
        {
            Activity::create(['user_id' => $user->id, 'activity' => 'You have added '.$category_name. '  category']);

            return redirect()->back()->with('success', 'Category create success');
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
        $pageTitle = 'Create Category';
        $category = Category::find($id);
        return view('admin.category_edit', compact('pageTitle', 'category'));

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
            'category_name' => 'required'
        ];
        $this->validate($request, $rules);

        $user = Auth::user();

        $category_name = $request->input('category_name');

        $category = Category::find($id);
        $category->category_name = $category_name;
        $update = $category->save();

        if($update)
        {
            Activity::create(['user_id' => $user->id, 'activity' => 'You have added '.$category->category_name. '  category']);

            return redirect()->back()->with('success', 'Category update success');
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
        $category_id = $request->input('category_id');
        $response['status'] = 0;
        $category = Category::find($category_id);
        $category_name = $category->category_name;
        $destroy = $category->delete();

        if($destroy)
        {
            $response['status'] = 1;
            $response['msg']    = 'Success';
        }
        Activity::create(['user_id' => $user->id, 'activity' => 'You have deleted '.$category_name. '  category']);
        return $response;
    }
}
