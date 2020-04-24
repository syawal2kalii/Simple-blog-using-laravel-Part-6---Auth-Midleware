<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">Simple Blog</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{route("article")}}">Article <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("article.form")}}">Add Article</a>
            </li>


        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
{{-- guest == tidak login       --}}
        @guest()
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="{{route('login')}}">login</a></li>
            </ul>
            <a href="">login</a>
        @else

            <ul class="navbar-nav">
                <li class="nav-item mr-2 mt-auto mb-auto">
                    <img style="width: 30px;margin-left: 10px; border-radius: 15px" src="{{asset("assets/image/1.jpg")}}" alt="">
                    <small style="margin: 0px; ">{{Auth::user()->name}}</small>
                </li>
                <li class="nav-item">
                    <form action="{{route('logout')}}"  method="POST">
                        @csrf
                        <button href="{{route('logout')}}" class="nav-link btn btn-link">Logout</button>
                    </form>

                </li>

            </ul>
        @endguest

    </div>
</nav>


