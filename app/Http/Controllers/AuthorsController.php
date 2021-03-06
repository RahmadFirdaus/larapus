<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
        $authors = Author::select(['id', 'name']);
        return Datatables::of($authors)->make(true);
    }

    $html = $htmlBuilder
            ->addColumn(['data'=>'name', 'name'=>'name', 'title'=>'Nama']);
    return view('authors.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $author = new Author;
        $author->nama = $request->a;
        $author->save();
        return redirect('authors');
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
        $author = Author::findOrfail($id);
        return view('authors.show', compact('authors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $author = Author::findOrfail($id);
        return view('authors.edit', compact('authors'));
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
        //
        $author = Author::findOrfail($id);
        $author->nama= $request->a;
        $author->save();
        return redirect('authors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $author = Author::findOrfail($id);
        $author->delete();
        return redirect('authors');
    }
}
