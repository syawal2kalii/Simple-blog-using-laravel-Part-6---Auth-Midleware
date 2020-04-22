@section('title','edit title')
@extends("master.master")
@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="card text-left">
                <img class="card-img-top" src="holder.js/100px180/" alt="">
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <form action="{{route("article.update",$article)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input value="{{$article->title}}" name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Title">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                                @if(old('category')==$article->category)
                                    @foreach($cat as $category)
                                        <option value="{{$category}}" selected>{{$category}}</option>
                                    @endforeach
                                @else()
                                    @foreach($cat as $category)
                                        <option value="{{$category}}">{{$category}}</option>
                                    @endforeach
                                @endif()
                            </select>
                            @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Content</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3">{{$article->content}}</textarea>
                            @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Gambar</label>
                            <br>
                            <img width="300px" src="{{asset(Storage::url($article->imgurl))}}" alt="s">
                            <input type="file" class="form-control-file @error('imgurl') is-invalid @enderror" name="imgurl" id="" placeholder=""
                                   aria-describedby="fileHelpId">
                            @error('imgurl')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
