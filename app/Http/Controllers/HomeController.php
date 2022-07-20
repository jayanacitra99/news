<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\NewsModel;
use App\Models\ReadLogModel;

class HomeController extends Controller
{
    //
    public function index(){
        $data = [
            'category'  => CategoryModel::paginate(7),
            'recent'    => NewsModel::orderBy('id','desc')->first(),
            'latest'    => NewsModel::orderBy('id','desc')->paginate(3),
            'view'      => NewsModel::orderBy('viewed','desc')->paginate(3),
            'allCat'    => CategoryModel::get(),
            'content'   => NewsModel::orderBy('id','desc')->get(),
        ];
        return view('news',$data);
    }

    public function read($newsID){
        $data = [
            'read'  => NewsModel::where('id',$newsID)->first(),
            'category'  => CategoryModel::paginate(7),
            'latest'    => NewsModel::orderBy('id','desc')->paginate(3),
            'allCat'    => CategoryModel::get(),
            'content'   => NewsModel::orderBy('id','desc')->get(),
        ];

        $news = NewsModel::where('id',$newsID)->first();

        $update = [
            'viewed'    => $news->viewed + 1,
        ];
        NewsModel::where('id',$newsID)->update($update);
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        foreach (unserialize($news->category) as $cat) {
            $readLog = [
                'contentID' => $newsID,
                'category'  => $cat,
                'time'      => $timestamp,
            ];   
            ReadLogModel::insert($readLog);
        }
        return view('read',$data);
    }
}
