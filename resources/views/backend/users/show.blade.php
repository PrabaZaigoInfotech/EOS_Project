@extends('larasnap::layouts.app', ['class' => 'user-index'])
@section('title','Badge Management')
@section('content')
<style>
   .badge img {
	width: 100% !important;
}
</style>
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Badges</h1>
</div>
<!-- Page Heading End-->				  
<!-- Page Content Start-->				  
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body p-0">
               <form  method="POST" action="" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                  @method('POST')
                  @csrf
                  <div class="container-fluid common-filter p-0 mb-3">
                     <div class="row">
                  <!-- list filters -->
                  
                  <!-- list filters -->
                   </div>
                   <div class="row">
                   @forelse($users->badge as $i => $courses)
                     <div class="col-md-3 mb-3" id="batchview">
                        <div class="badge-box">
                            @if($courses->course != null)
                           <img src="{{asset('storage/images_uploads/'.$courses->course->badge)}}">
                           @endif
                           <h4>{{ $courses->course_name}}</h4>
                           <p>{{ $courses->description }}</p>
                           @if($courses->course != null)
                           <p><a onClick = "viewBadge({{$courses->id}});">View Details</a></p>
                           @endif
                        </div>
                     </div>
                     @empty
                     <div class="col-md-12 cc-center mb-3">
                     <h4 class="text-center" colspan="12">No badges found!</h4>
                     </div>                       
                     @endforelse          
                  </div> 
                   </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- @toastr_render -->
<!-- Page Content End-->				  
<div class="modal fade" id="badge" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header close-btn pb-0 cc-right">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
               </button>
              </div>
              <div class="modal-body delete-modal text-center pt-3 pb-3">
              <!-- <p><img src="{{asset('images/badge1.png')}}"></p> -->
              <div class="badge_image"></div>
                
                 
                 <div class="course_name"></div>
                <!-- <p>Master Course Completed</p> -->
                <div class="nft_id"></div>
                <div class="course_detail"></div>
                <div class="course_id"></div>
                <div class="course_date"></div>
                <div class="course_url">
                <a  target="_blank" id="course_url">Verification URL</a>
                </div>
              </div>
              <div class="modal-footer p-0">
                <div class="row w-100 m-0">
                  <div class="col-md-6 p-0 btn-danger">
                     <div class="delete_action"></div>
                  </div>
                  <div class="col-md-6 p-0 purple-btn">
                  <a  target="_blank" id="badge_download_image" class="btn btn-primary">Download</a>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
   <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body delete-modal text-center">
                <p><img src="{{asset('images/sure.jpg')}}" alt=""></p>
                <h4><b>Are you sure?</b></h4>
                <input type="hidden" value="" class="deleteAdmin"> 
                <p>Do you really want to delete these record? this process cannot be undone.</p>
              </div>
      <div class="modal-footer p-0">
                <button onclick="return individualDelete($('.deleteAdmin').val())" type="button"  class="btn btn-danger">Yes Confirm</button>
              </div>
    </div>
  </div>
</div>

<!-- @toastr_render -->
<!-- Page Content End-->				  

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function viewBadge(id) {
    //alert(id);
    var url = "{{url('admin/badges/show')}}/" + id;
    console.log("reurlsult",url);
   $.ajax({
   url: url,
   method: "get",
    success: function(result) {
       console.log("result",result);
       var url1 = "{{asset('storage/images_uploads')}}";
       var url2 = "https://blockchain.zaigoinfotech.com/admin/image_url/";
       var imagePath = `<p><img src="`+url1+`/`+result.message.course.badge+`"></p>`;
       $('.badge_image').html(imagePath);
       $('#course_url').attr("href",url2+result.message.id);        
       $('#badge_download_image').attr("href",url1+`/`+result.message.course.badge);        
       $('.delete_action').html('<a href="#" data-toggle="modal"  data-target="#delete"  title="Delete Badge"><button type="button" deleteId='+result.message.id+' class="btn btn-danger badge_delete"> Delete </button></a>');
       $('.course_id').html('<h6 class="mt-3">Course ID: <span class="blue"><b>'+result.message.course_id+'</b></span></h6>');
       $('.nft_id').html('<h6 class="mt-3">NFT ID: <span class="blue"><b>'+result.message.nft_value+'</b></span></h6>');
       $('.course_date').html('<h6>Date of Completion: <b>'+result.badgeDate+'</b></h6>');
       $('.course_detail').html('<p>'+result.message.course.description+'</p>');
       $('.course_name').html('<h4><b>'+result.message.course_name+'</b> <span class="green"><small>Active</small></span></h4>');
       var list = "{{route('admin.user_lists.index')}}/" + id;
       var show = list + "#badge";
       $('#badge').modal('show');
      },
   });
}
</script>
<script>
   $(document).on('click', '.badge_delete', function() {
      $('#badge').hide();
      $(".deleteAdmin").val($(this).attr("deleteid"));
   });
</script>

