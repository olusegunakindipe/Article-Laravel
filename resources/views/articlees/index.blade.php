@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-end mb-5">
    <a href="{{route('articlees.create')}}" class="btn btn-success btn-lg"> Create Article</a>
</div>

<form class="input-group" action="{{route('articlees.index')}}" method="GET">
    <input type="text" style="margin-left:85%" class=" form-control mb-5" name="search" placeholder="Search Articles" value="{{request()->query('search')}}">
   
</form>
<div class="card card-default" >

    <div class="card-header justify-center"> Articles</div>
    
    <div class="card-body">
        @if($articlees->count() > 0)
        
            <table class="card-table table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th> @sortablelink('id') </th>
                        <th> @sortablelink('title') </th>
                        <th> @sortablelink('content') </th>
                        <th>Order_Index</th>
                        <th> @sortablelink('published_at') </th>
                        <th> @sortablelink('created_at') </th>
                        <th> @sortablelink('updated_at') </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($articlees as $article)
                    <tr>
                        <td>{{$article->id}} </td>
                        <td>{{$article->title}}</td>
                        <td>{!! htmlspecialchars_decode($article->content) !!}</td>
                        <td>
                         
                            <a href="{{route('articlees-sorted',[$article->order_index,'up'])}}">
                                <i class="fa fa-arrow-up ml-3" style="font-size:24px" ></i>
                            </a>
            
                            <a href="{{route('articlees-sorted',[$article->order_index, 'down'])}}">
                                <i class="fa fa-arrow-down mr-4" style="font-size:24px"></i>
                            </a>

                        </td>
                        <td>{{$article->published_at}}</td>
                        <td>{{$article->created_at}}</td>
                        <td>{{$article->updated_at}}</td>
                        <td style="white-space:nowrap"> 
                        
                            <a href="{{route('articlees.edit', $article->id)}}" class="btn btn-info btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                        
                            <button onclick="handleDelete({{ $article->id }})" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i>
                            </button>
                        
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method("DELETE")
                        
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Article</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-bold">
                                Are you sure you want to delete this article?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Back</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                        
                </div>
            </div>
        @else
            <h3 class="text-center">
                No Articles Displayed
            </h3>
        @endif
       
    </div>
    
</div>
{{ $articlees->appends(['search' => request()->query('search') ])->links() }}
@endsection


@section('scripts')
<script>
function handleDelete(id){
    
    var form = document.getElementById('deleteForm')
        form.action = "/articlees/" + id
        $('#deleteModal').modal('show')

    }
</script>
    
@endsection

