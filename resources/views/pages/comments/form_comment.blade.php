@if(Auth::check() == true)
<div class="leave-comment"><!--leave comment-->
    <h4>Leave a reply</h4>


    <form class="form-horizontal contact-form" role="form" method="post" action="/comment">
        {{csrf_field()}}
        <input type="hidden" name="post_id" value="{{$post->id}}">
        {{-- <div class="form-group">
             <div class="col-md-6">
                 <input type="text" class="form-control" id="name" name="name" placeholder="Name">
             </div>
             <div class="col-md-6">
                 <input type="email" class="form-control" id="email" name="email"
                        placeholder="Email">
             </div>
         </div>

         <div class="form-group">
             <div class="col-md-12">
                 <input type="text" class="form-control" id="subject" name="subject"
                        placeholder="Website url">
             </div>
         </div>--}}
        <div class="form-group">
            <div class="col-md-12">
										<textarea class="form-control" rows="6" name="text"
                                                  placeholder="Write Massage"></textarea>
            </div>
        </div>
        <button class="btn send-btn">Post Comment</button>
    </form>
</div><!--end leave comment-->
@endif
