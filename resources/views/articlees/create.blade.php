@extends('layouts.app')



@section('content')

<div class="card card-default">

    <div class="card-header"> 
        {{isset($articlee) ? 'Edit Article':'Create Article'}}
    </div>
    
    <div class="card-body">
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach($errors->all() as $error)

                        <li class="list-group-item text-danger">
                            {{$error}}
                        </li>

                    @endforeach
                
                </ul>
            </div>

        @endif
        <form action="{{isset($articlee) ? route('articlees.update', $articlee->id) : route('articlees.store') }}" method="POST">
            @csrf

            @if(isset($articlee))
                @method('PUT')
            @endif
            
            <div class="form-group">
                <label for="title"> Title</label>

                <input type="text" id="title" class="form-control" name="title" value="{{ isset($articlee)? $articlee->title:''}}">

            </div>
            <div class="form-group">
                <label for="content"> Content</label>
                <input id="content" type="hidden" name="content" value=" {{ isset($articlee)? $articlee->content:''}}">
                <trix-editor input="content"></trix-editor>
            </div>

            <div class="form-group">
                <label for="date">Published</label>

                <input type="text" id="published_at" class="form-control" name="published_at" value="{{ isset($articlee)? $articlee->published_at:''}}">
            </div>
            <div class="form-group">
                <button class="btn btn-success my-5"> {{ isset($articlee)? 'Update Article': 'Add Article' }}</button>

            </div>
        </form>
    
    
    </div>

</div>


@endsection

@section('scripts')

    <script src= "https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true,
            enableSeconds: true
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection