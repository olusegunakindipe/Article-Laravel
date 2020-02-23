<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Articlee extends Model
{
    Use Sortable;
    // protected $table = "article";
    protected $fillable = [
        'title','content','published_at','order_index'
    ];
    public $sortable = ['id','title', 'content', 'published_at','created_at','updated_at'];
    protected $dates = [
        'published_at'
    ];

    public function scopePublished($query) {

        return $query->where('published_at', '<=', now());
    }

    public function scopeSearched($query) { //scope for search query

        $search = request()->query('search');

        if(!$search) { //incaxe no search return only articles that are published
            return $query->published();
        }

        return $query->published()->where('title', 'LIKE', "%{$search}%");
        //incase search, return only articles that are publish and perform search
    }

    // public function scopeRow($id,$order) {

    //     $currentId = Articlee::where('id')->first();

    //     $downId = Articlee::orderBy('order_index', 'asc')->where('order_index','>',$id)->first();
    //     $upId = Articlee::orderBy('order_index', 'desc')->where('order_index','>',$id)->first();

    //     if ($order == 'up'){
    //         Articlee::where('order_index', $upId->order_index)
    //             ->update(['order_index'=>$currentId->order_index]);

    //         Articlee::where('id', $currentId->id)
    //             ->update(['order_index'=>$upId->order_index]);
    //     }
    //     if ($order == 'down'){
    //         Articlee::where('order_index', $downId->order_index)
    //             ->update(['order_index'=>$currentId->order_index]);

    //         Articlee::where('id', $currentId->id)
    //             ->update(['order_index'=>$downId->order_index]);
    //     }

    //     return redirect(route('articlees.index'));
    // }
    
}


