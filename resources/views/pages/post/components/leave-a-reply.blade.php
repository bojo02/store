       @if(Auth::user())
       <section>
            <p class="text-center"><strong>Остави коментар</strong></p>

            <form action="{{route('comment.store')}}" method="POST">
              @csrf
              @method('POST')
              <input type="hidden" name="commentable_id" value="{{$commentable_id}}"> 
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> 

              <input type="hidden" name="commentable_type" value="{{$commentable_type}}"> 
              <!-- Name input -->
   
              <!-- Message input -->
              <div class="form-outline mb-4">
              <label class="form-label" for="form4Example3">Коментар</label>

                <textarea class="form-control"  name="body" id="form4Example3" rows="4"></textarea>
              </div>

              <!-- Checkbox -->
             

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">
                Публикувай
              </button>
            </form>
          </section>
          @else
          <p class="text-center"><strong>Трябва да сте регистрирани за да коментирате.</strong></p>
          @endif