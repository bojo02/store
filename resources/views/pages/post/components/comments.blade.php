<section class="border-bottom mb-3">
            <p class="text-center"><strong>Коментари: {{count($comments)}}</strong></p>

            @foreach ($post->comments as $comment)
            <hr>
            <div class="row mb-4">
              <div class="col-2">
                <img src="{{asset($comment->user->photo)}}"
                  class="img-fluid shadow-1-strong rounded-5" alt="" />
              </div>

              <div class="col-10">
                <p class="mb-2"><strong>{{$comment->user->name}}</strong></p>
                <p>
                {{$comment->body}}
                </p>
                @if(Auth::user())
                  @foreach (Auth::user()->userRole as $userRole)
                    @if($userRole->role->slug == 'administrator')
                    <form action="{{route('comment.destroy', ['comment' => $comment->id])}}" method="POST">
                      @csrf
                      @method('DELETE')


                      <button class="btn btn-danger" type="submit">Изтрий</button>
                    </form>
                    @endif
                  @endforeach
                @endif
              </div>
            </div> 
            
            @endforeach
</section>