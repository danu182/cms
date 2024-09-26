<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


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
            ->addIndexColumn() //untuk nomor urut baris otomatis dari datatable
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
                            <a href="'.route('article.edit', $articles->id).'" class="btn btn-primary">edit</a>
                            <a href="'.route('article.show', $articles->id).'" class="btn btn-secondary">detail</a>    
                            
                            <form class="inline-block" action="' . route('article.destroy', $articles->id) . '" method="POST">
                        <button class="btn btn-danger" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>


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
    public function store(ArticleRequest $request)
    {
        $data=$request->validated();
        
        $file=$request->file('image');
        $data['slug']=STR::slug($data['title']);
        $filename=uniqid().'-'.$data['slug'].'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/back/img', $filename);


        $data['img']=$filename;

        // return $data;

        Article::create($data);

        return redirect()->route('article.index')->with('success', 'data artcle has been created');

    }

    /**
     * Display the specified resource.
     */
    public function show( string $id)
    {
        $article = Article::findOrFail($id);
        // return $article;
        return view('Back.article.show' , compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        $categories= Category::all();
        return view('Back.article.edit', compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, string $id)
    {
        $data=$request->validated();
    
        if ($request->hasFile('img')) {
            // jika ada perubahan gambar 
            $file=$request->file('img');
            $data['slug']=STR::slug($data['title']);
            $filename=uniqid().'-'.$data['slug'].'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/back/img', $filename);
            
            // unlink atua delete file gambar 
            Storage::delete(['public/back/img'. $request->oldImg]);
            $data['img']=$filename;
            
        } else {
            // kalo tida ada gambar baru
            $data['img']=$request->oldImg;
        }
        $data['slug']=Str::slug($data['title']);
        

        Article::find($id)->update($data);

        return redirect()->route('article.index')->with('success', 'data artcle has been Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // Temukan data berdasarkan ID
        $data = Article::findOrFail($id);
        // return $data;
        // $des='public/back/img/'.$data->img;
        // return $des;
        Storage::delete('public/back/img/'.$data->img);
        $data->delete();

        return redirect()->route('article.index')->with('success', 'data article has been Delete successfully');

    }
}
