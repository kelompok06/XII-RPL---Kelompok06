<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DataTables;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return view('post.form', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'kategori_id' => 'required',
          'title'       => 'required',
          'content'     => 'required'
        ]);
        $post = Post::create($request->all());
        return $post;
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
        $post = Post::findOrFail($id);
        return view('post.form', compact('post'));
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
        $this->validate($request, [
          'kategori_id' => 'required',
          'title'       => 'required',
          'content'     => 'required'
        ]);
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
    }

    public function dataTable()
    {
        $post = Post::with('post');
        return DataTables::of($post)
            ->addColumn('action', function ($post) {
                return view('post._action', [
                    'post' => $post,
                    'url_edit' => route('post.edit', $post->id),
                    'url_destroy' => route('post.destroy', $post->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function loadKategori(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('kategori')->select('id', 'kategori')->where('kategori', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
        }
    }
}
