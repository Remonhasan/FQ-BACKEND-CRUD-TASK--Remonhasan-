<?php

namespace App\Http\Controllers\Api;
use App\Book;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(auth()->user()->books()->with('creator')->latest()->paginate(4));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // data create part
      $request->validate([
         'title' => 'required|max:255'
     ]);

     $input = $request->all();

     if ($request->has('giveback')) {
                 $input['giveback'] = Carbon::parse($request->giveback)->toDateTimeString();
             }
     $book = auth()->user()->books()->create($input);

     return new BookResource($book->load('creator'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book))
    {
         return new BookResource($book->load('creator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
      $request->validate([
         'title' => 'required|max:255'
     ]);

     $input = $request->all();

     if ($request->has('giveback')) {
         $input['giveback'] = Carbon::parse($request->giveback)->toDateTimeString();
     }

     $task->update($input);

     return new BookResource($task->load('creator'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $task->delete();
      return response(['message' => 'Deleted!']);
    }
}
