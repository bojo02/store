@extends("base")

@section("body")
<main class="mt-4 mb-5">
    <div class="container">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-8 mb-4">
          <!--Section: Post data-mdb-->
          <section class="border-bottom mb-4">
            <img src="{{asset($post->image->path)}}"
              class="img-fluid shadow-2-strong rounded-5 mb-4" alt="" />

            <div class="row align-items-center mb-4">
              <div class="col-lg-6 text-center text-lg-start mb-3 m-lg-0">
                <img src="" class="rounded-5 shadow-1-strong me-2"
                  height="35" alt="" loading="lazy" />
                <span> Публикувано на: <u>{{date('d-m-Y', strtotime($post->created_at))}}</u> от</span>
                <a href="" class="text-dark">{{$post->user->name}}</a>
              </div>
          </section>
          <h2>{{$post->title}}</h2>
          
          <section>
            <p>
            {!! $post->body !!}
            </p>
          </section>

          @include('pages.post.components.comments', ['comments' => $post->comments])

          @include('pages.post.components.leave-a-reply', ['commentable_id' => $post->id, 'commentable_type' => 'App\Models\Post'])
        </div>
    </div>
</main>
    @endsection