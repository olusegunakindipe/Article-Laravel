<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Articlee;
use App\Http\Requests\Articlees\CreateArticleeRequest;
use App\Http\Requests\Articlees\UpdateArticleesRequest;


class ArticleesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
         return view('articlees.index')
         ->with('articlees', Articlee::searched()->sortable()->orderBy('order_index', 'asc')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('articlees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleeRequest $request)
    {
        
        Articlee::create([
            'title' => $request->title,
            'content' => $request->content,
        
            'published_at'=> $request->published_at,
            'order_index'=> Articlee::max('id')+1,
            // dd( html_entity_decode($request->content))
        ]);

        session()->flash('success', 'Article Created Successfully');
        return redirect(route('articlees.index'));

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
    public function edit(Articlee $articlee)
    {
        return view('articlees.create')->with('articlee', $articlee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleesRequest $request, Articlee $articlee)
    {
        // $articlee->title = $request->title;
        // $articlee->content = $request->content;
        // $articlee->published_at = $request->published_at;

        // $articlee->save();
        //you can use this method above or use this below

        //or this

        //$data = $request->only(['title','content','published_at])
        //$post->update($data)


        $articlee->update([
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at
        ]);

        session()->flash('success', 'Article Updated Successfully');

        return redirect(route('articlees.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articlee $articlee)
    {
        $articlee->delete();
        
        session()->flash('success', 'Article Deleted Successfully');

        return redirect(route('articlees.index'));

    }
    public function sorted($id, $order) {
            
        $id = (int)$id;
            switch ($order) {
                case 'up':
                    $swap = ($id > 1)? $id-- : 1; 
                    break;

                case 'down':
                    $max = Articlee::all()->count(); //$max = Atricle::articlee()->count();
                    $swap = ($id < $max)? $id++ : $max; 
                    break;

                default:
                    $swap = $id;

            }
            // Articlee::statement(
            //   Articlee::raw(
              $query =  DB::update(
                "UPDATE articlees SET order_index = (CASE order_index WHEN $id
                THEN $swap WHEN $swap THEN $id END) WHERE order_index IN ($id, $swap)"
                );

               
            //     array($id,$swap,$swap,$id,$id,$swap)
            //   ); 
            
            return redirect(route('articlees.index'));


        
        }
}
