@extends('larasnap::layouts.app', ['class' => 'user-index'])
@section('title','Certificate Management')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Certificates</h1>
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
                  <div class="col-md-12 cc-right">
                     @canAccess('admin.certificates.create')
                     <a href="{{route('admin.certificates.create1')}}" title="Add New Admin" class="btn btn-primary purple-btn btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Add New Certificate
                     </a>
                     @endcanAccess
                  </div>
                   </div>
                   </div>

                   <style type="text/css">
                      .certify-sec {
   width: 100%;
}
.certify-image {
   background: #ccc;
   
   width: 100%;
   display: inline-block;
}
                   </style>

                  <div class="certify-sec">
                     
                     <div class="row">
                        @foreach($images as $image)
                        <div class="col-md-4" style="padding-bottom: 17px;">
                           <div class="certify-image">
                               <img data-enlargeable src="{{ asset('images_uploads/'.$image->getFilename()) }}"   style="cursor: zoom-in ;width:100%; " alt =""/>
                               
                           </div>
                        </div>

                        @endforeach
                 
                     </div>

                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">$('img[data-enlargeable]').addClass('img-enlargeable').click(function() {
  var src = $(this).attr('src');
  var modal;

  function removeModal() {
    modal.remove();
    $('body').off('keyup.modal-close');
  }
  modal = $('<div>').css({
    background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
    backgroundSize: 'contain',
    width: '100%',
    height: '100%',
    position: 'fixed',
    zIndex: '10000',
    top: '0',
    left: '0',
    cursor: 'zoom-out'
  }).click(function() {
    removeModal();
  }).appendTo('body');
  //handling ESC
  $('body').on('keyup.modal-close', function(e) {
    if (e.key === 'Escape') {
      removeModal();
    }
  });
});</script>
<!-- Page Content End-->				  
@endsection


