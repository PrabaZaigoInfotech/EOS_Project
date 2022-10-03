@extends('larasnap::layouts.app', ['class' => 'user-index'])
@section('title','Badge Management')
@section('content')
<style>
    .badge img {
        width: 100% !important;
    }
</style>
<div class="breadcrumb_nav">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user_lists.index') }}">Students</a></li>
            <li class="breadcrumb-item active" aria-current="page">Assign Certificate</li>
        </ol>
    </nav>
</div>
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Assign Certificate List</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body p-0">
                    <form method="POST" action="" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                        @method('POST')
                        @csrf
                        <div class="container-fluid common-filter p-0 mb-3">
                            <div class="row">
                                <!-- list filters -->

                                <!-- list filters -->

                                <div class="col-md-3 cc-right">
                                    <br><br>
                                    <a href="{{route('admin.badges.assigncertificate.create',request()->id)}}" title="Assign Ceritificate" class="btn btn-primary purple-btn btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Assign Certificate
                                    </a>
                                    <br><br>

                                </div>
                                <div class="col-md-3 cc-right">
                                    @canAccess('admin.user_lists.index')
                                    <a href="{{ route('admin.user_lists.index') }}" title="Create Badge" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Students List
                                    </a>
                                    @endcanAccess
                                    <br> <br>
                                </div>

                            </div>


                            <div class="row">

                                @forelse($assign_certificates as $key =>$val)
                                <div class="col-md-3 mb-3" id="batchview">
                                    <div class="badge-box">
                                        <img src="{{asset('storage/images_uploads')}}">

                                        <h4>{{ $val->course_name}}</h4>
                                        <a href="javascript:void(0)" onClick="viewBadge({{$val->id}});">View Details</a>
                                    </div>
                                </div>
                                @empty
                                <div class="col-md-12 cc-center mb-3">
                                    <h4 class="text-center" colspan="12">No badges found!</h4>
                                </div>
                                @endforelse
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

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
                <div class="total_hours"></div>
                <!-- <p>Master Course Completed</p> -->
                <div class="date_completion"></div>
                <div class="course_url">
                    <!DOCTYPE html>
                    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

                    <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">

                        <head>
                            <meta name="viewport" content="width=device-width">
                            <meta charset="utf-8">
                            <meta property="og:url" content="https://twitter.com/intent/tweet?text=PayGiv%20App&url=https://paygiv.app/">
                            <meta property="og:type" content="website">
                            <meta property="og:title" content="I got certified on the NEAR blockchain!">
                            <meta property="og:description" content="View NEAR University certificates of any .near account">

                            <meta property="og:image" content="https://paygiv.org/wp-content/uploads/2021/01/paygiv-logo-h-1024x336.png">
                            <meta property="twitter:site" content="@NEARProtocol">

                            <meta name="twitter:card" content="summary">
                            <meta property="twitter:domain" content="/">


                            <meta property="twitter:url" content="https://paygiv.org/wp-content/uploads/2021/01/paygiv-logo-h-1024x336.png">
                            <meta name="twitter:title" content="I got certified on the NEAR blockchain!">

                            <meta property="linkedin:url" content="https://paygiv.org/wp-content/uploads/2021/01/paygiv-logo-h-1024x336.png">
                            <meta name="linkedin:title" content="I got certified on the NEAR blockchain!">

                            <meta name="twitter:description" content="View NEAR University certificates of any .near account">
                            <meta name="twitter:image" content="https://paygiv.org/wp-content/uploads/2021/01/paygiv-logo-h-1024x336.png">
                            <meta property="og:image:width" content="1080">

                            <meta property="og:image:height" content="1080">
                        </head>

                    </head>

                    <body>

                        <a class="share-btn-twitter" data-dismiss="modal" rel="noopener" target="twitter" href="https://twitter.com/intent/tweet?text=PayGiv App&amp;url=https://paygiv.app/" role="button">
                            Twitter <img class="ShareIcon" src="https://paygiv.app/frontend/images/twitter.svg" alt="">
                        </a>

                        <a class="share-btn-fb" href="https://www.facebook.com/sharer/sharer.php?s=hello&amp;app_id=351703733810094&amp;u=https://paygiv.app/&amp;display=popup&amp;&amp;redirect_uri=https://paygiv.app/" role="button">
                            Facebook <img class="ShareIcon" src="https://paygiv.app/frontend/images/facebook_share.svg" alt="">
                        </a>

                        <a class="share-btn-linkedin" data-dismiss="modal" rel="noopener" target="linkedin" href="https://www.linkedin.com/sharing/share-offsite?text=PayGiv App&amp;url=https://paygiv.app/" role="button">
                            Linkedin <img class="ShareIcon" src="https://paygiv.app/frontend/images/twitter.svg" alt="">
                        </a>


                    </body>

                    </html>
                    <!-- <a target="_blank" id="course_url">Verification URL</a> -->
                    <div class="modal-footer p-0">
                        <div class="row w-100 m-0">
                            <div class="col-md-6 p-0 btn-danger">
                                <div class="delete_action"></div>
                            </div>
                            <div class="col-md-6 p-0 purple-btn">
                                <a target="_blank" id="badge_download_image" class="btn btn-primary">Download</a>
                            </div>
                        </div>
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
                <button onclick="return individualDelete($('.deleteAdmin').val())" type="button" class="btn btn-danger">Yes Confirm</button>
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

        var url = "{{url('assign/certificateshow')}}/" + id;
        $.ajax({
            url: url,
            method: "get",

            success: function(result) {

                // console.log("result", result);
                //  alert("hi");  
                var url1 = "https://www.whatsappimages.in/wp-content/uploads/2021/07/Top-HD-sad-quotes-for-whatsapp-status-in-hindi-Pics-Images-Download-Free.gif";
                var url2 = "https://blockchain.zaigoinfotech.com/certificate/image/";
                $('#badge_download_image').attr("href", url2 + `/` + result.messages);
                var imagePath = `<p><img class="rounded mx-auto d-block" src='${url1}'></p>`;
                $('.badge_image').html(imagePath);
                // var imagePath = `<p><img src="` + url2 + `/` + result.messages.course.badge + `"></p>`;

                $('.delete_action').html('<a href="#" data-toggle="modal"  data-target="#delete"  title="Delete Badge"><button type="button" deleteId=' + result.messages.id + ' class="btn btn-danger badge_delete"> Delete </button></a>');
                $('.date_completion').html('<h6>Date of Completion: <b>' + result.messages.date_completion + '</b></h6>');
                $('.total_hours').html('<p> Total Hours: <b>' + result.messages.total_hours + '</p>');
                $('.course_name').html('<h4> Course Name: <b>' + result.messages.course_name + '</b> <span class="green"><small>Active</small></span></h4>');
                $('#course_url').attr("href", url2 + result.messages.id);

                var list = "{{url('admin/badges/index')}}/" + id;
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