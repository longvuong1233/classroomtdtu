<div class="row">
    @if(isset($listClassroom))
    @foreach($listClassroom as $classroom)
    <div class="col-md-3 my-3">

        <div class="card">
            <img class="card-img-top" src="{!! url("https://drive.google.com/thumbnail?id={$classroom->img}") !!}"
                alt="Card image">
            <div class="card-body">
                <h4 class="card-title">{{$classroom->nameclass}}</h4>
                <p class="card-text">{{$classroom->title}}</p>
                <a href="{{route('classroom.show',$classroom->id)}}" class="btn btn-primary">Open Class</a>
                @if(Auth::user()->role_user=="student")
                <form action="{{route('peopleAndClass.destroy',Auth::id())}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="id_class" value="{{$classroom->id}}">
                    <button type="submit" title="Delete Class!" class="close">&times;</button>
                </form>
                @endif

            </div>

        </div>
    </div>
    @endforeach
    @endif

</div>