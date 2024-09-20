<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()){
            $articles= Article::with('GetCategory')->latest()->get();
            
            return DataTables::of($articles)
        //   custom kolom
            ->addColumn('category_id', function ($articles){
                return $articles->GetCategory->name;
            })
            ->addColumn('status', function ($articles){
                if ($articles->status == 0){
                    return '<span class="badge bg-danger">Draft</span>';
                }else{
                    return '<span class="badge bg-success">Publish</span>';
                }
                
            })
            ->addColumn('button', function ($articles){
                return '<div class="text-center">
                            <a href="" class="btn btn-secondary">detail</a>
                            <a href="" class="btn btn-primary">edit</a>
                            <a href="" class="btn btn-danger">delete</a>
                        </div>';
            })
            // panggil kustom kolom
            ->rawColumns(['category_id', 'status','button'])
            ->make();
        }

        // return $articles;
        return view('Back.article.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('Back.article.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
