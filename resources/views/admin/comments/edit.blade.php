<x-home-master>

    @section('content')
        <h1> edit a comment </h1>
        <form method="post" action="{{route('comment.update', $comment->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <textarea name="body" class="form-control" id="body" cols="30" rows="10" >{{$comment->comment}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"> Submit </button>
        </form>
    @endsection

</x-home-master>