<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = new Kategori();
        return view('kategori.form', compact('kategori'));
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
          'kategori' => 'required'
        ]);
        $kategori = Kategori::create($request->all());
        return $kategori;

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
        $kategori = Kategori::findOrFail($id);
        return view('kategori.form', compact('kategori'));
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
             'kategori' => 'required'
         ]);
         $kategori = Kategori::findOrFail($id);
         $kategori->update($request->all());
         return $kategori;
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $kategori = Kategori::findOrFail($id);
       $kategori->delete();
    }

    public function dataTable()
    {
        $kategori = Kategori::query();
        return DataTables::of($kategori)
            ->addColumn('action', function ($kategori) {
                return view('kategori._action', [
                    'kategori' => $kategori,
                    'url_edit' => route('kategori.edit', $kategori->id),
                    'url_destroy' => route('kategori.destroy', $kategori->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
