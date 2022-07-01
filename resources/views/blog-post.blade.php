<x-home-master>

    @section('content')


    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="#">{{$post->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted {{$post->created_at->diffForHumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{$post->post_image}}" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead">
          {{$post->body}}
        </p>

        <hr>

        <!-- Comments Form -->
        <form action="{{route('comment.create',$post->id)}}">
          <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <form>
                <div class="form-group">
                  <textarea class="form-control" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </form>


        <!-- Single Comment -->
        @foreach($comments as $comment)
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">{{$comment->user->name}}</h5>
              {{$comment->comment}}
            </div>
            @can('view', $comment)
              <form method="post" action="{{route('comment.destroy', $comment->id)}}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
              </form>
            @endcan

            @can('view', $comment)
            <form method="get" action="{{route('comment.edit', $comment->id)}}">
              @csrf
              <button class="btn btn-primary">Edit</button>
            </form>
          @endcan
          </div>
        @endforeach

      </div>
    </div>
    <!-- /.row -->
    @endsection

</x-home-master>
