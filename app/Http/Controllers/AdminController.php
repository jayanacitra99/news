<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ReadLogModel;
use App\Models\NewsModel;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index(){
        $data = [
            'category'  => CategoryModel::get(),
            'catLog'    => ReadLogModel::get(),
        ];
        return view('admin/dashboard',$data);
    }

    public function newsList(){
        $data = [
            'news'  => NewsModel::get(),
        ];
        return view('admin/newsList',$data);
    }

    public function insertNews(){
        $data = [
            'category'  => CategoryModel::get(),
        ];
        return view('admin/insertNews',$data);
    }

    public function addNewCat(){
        Request()->validate([
            'category'   => 'required|unique:categories,category'
        ]);

        $data = [
            'category'  => Request()->category,
        ];
        CategoryModel::create($data);
    }

    public function postNews(){
        Request()->validate([
            'title'     => 'required|unique:contents,title',
            'category'  => 'required',
            'image'     => 'required',
            'content'   => 'required',
        ]);

        $category = \serialize(Request()->category);

        

        $data = [
            'title'     => Request()->title,
            'category'  => $category,
            'image'     => NULL,
            'content'   => Request()->content,
        ];

        NewsModel::create($data);

        $last = NewsModel::orderBy('id','desc')->first();

        $file = Request()->file('image');
        $filename = $last->id.'.'.$file->extension();
        $file->move(public_path(''),$filename);

        $image = [
            'image' => $filename,
        ];

        NewsModel::where('id',$last->id)->update($image);

        Request()->session()->flash('success','Post Success!');
        return redirect('insertNews');
    }

    public function deletePost($newsID){
        $new = NewsModel::where('id',$newsID)->first();
        unlink(public_path($new->image));

        NewsModel::where('id',$newsID)->delete();
        Request()->session()->flash('success','Delete Post Success!');
        return redirect('newsList');
    }

    public function editPost($newsID){
        $data = [
            'news'  => NewsModel::where('id',$newsID)->first(),
            'category'  => CategoryModel::get(),
        ];
        return view('admin/editPost',$data);
    }

    public function editThisPost($newsID){
        $new = NewsModel::where('id',$newsID)->first();
        Request()->validate([
            'title'     => $new->title === Request()->title ? 'required':'required|unique:contents,title',
            'category'  => 'required',
            'content'   => 'required',
        ]);

        $category = \serialize(Request()->category);


        if (Request()->file('image') != NULL) {
            $file = Request()->file('image');
            $filename = $newsID.'.'.$file->extension();
            $file->move(public_path(''),$filename);

            $data = [
                'title'     => Request()->title,
                'category'  => $category,
                'image'     => $filename,
                'content'   => Request()->content,
            ];
        } else {
            $data = [
                'title'     => Request()->title,
                'category'  => $category,
                'content'   => Request()->content,
            ];
        }

        NewsModel::where('id',$newsID)->update($data);

        Request()->session()->flash('success','Edit Post Success!');
        return redirect('newsList');
    }
}
