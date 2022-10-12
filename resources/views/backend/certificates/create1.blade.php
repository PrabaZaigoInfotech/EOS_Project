 @extends('larasnap::layouts.app', ['class' => 'user-create'])
 @section('title','Certificate Management')
 @section('content')

 <style type="text/css">
   .cimg img {
     width: 100%;
   }
 </style>
 <div lang="en" ng-app="kitchensink">

   <!-- Page Heading  Start-->
   <div class="d-sm-flex align-items-center justify-content-between mb-0">
     <h1 class="h3 mb-0 mt-0 text-gray-800">Add Certificate</h1>
   </div>
   <!-- Page Heading End-->
   <!-- Page Content Start-->
   <div class="">
     <div class="col-xl-12 p-0">
       <div class="mb-4">
         <div class="card-body pr-0">
           <div class="card-body p-0"> <a href="{{ route('admin.certificates.index') }}" title="Back to Admin List" class="btn btn-primary btn-sm mb-3"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Certificate List </a>
             <form method="POST" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
               @csrf
               <div class="row">
                 <div class="col-md-9">
                   <div class="mb-4">
                     <div class="card-body card">
                    <textarea id="SVGRasterizer" style="display:none"></textarea>
                       <form method="POST">
                         @csrf
                         @method('GET')
                         <!-- select button -->
                         <div class="col-lg-6 relative br-right">
                           <div class="mb-0">
                          
                           
                             <label for="institution_name">Select Institution Name: <small class="text-danger required" checked="">*</small></label>
                             <select onchange="this.form.submit()" name="institution_name" class="form-control" id="institution_name">
                             @if(isset($_POST['institution_name'])){echo $_POST['institution_name'];}
                             @endif
                             
                             <option value="0">Select institute </option>
                               @forelse($institution as $index => $roles)
                               <option value="{{ $roles->id }}"  {!! old('institution')==$roles->id ? 'selected' : 'ssss' !!} >{{ $roles->institution_name }}</option>
                               @empty
                               @endforelse
                             </select>
                             @error('institution_name')
                             <span class="text-danger">{{ $message }}</span>
                             @enderror  
                             
                           </div>
                         </div>
                         <br>
                       </form>
                       @if(isset($_POST['institution_name'])&&!empty($_POST['institution_name']))

                         @forelse($data as $index => $roles)
                         <input type="hidden" value="{{$roles->institution_name}}" name="" id="institution_namen"> 
                         <input type="hidden" value="{{url(Storage::url('app/public/upload/institution/logo/' . $roles->logo));}}" name="" id="institution_logo"> 
                         <input type="hidden" value="{{$roles->signature}}" name="" id="institution_signature">
                 <!--         <tr>
                           <td>Institution name -</td>
                           <td>{{$roles->institution_name}}</td>
                         </tr>
                         <tr>
                           <td>Logo -</td>
                           <td>{{$roles->logo}}</td>
                         </tr>
                         <tr>
                           <td>Signature -</td>
                           <td>{{$roles->signature}}</td>
                         </tr> -->
                         @empty
                         @endforelse
                     
                         @endif

                       <div id="bd-wrapper" ng-controller="CanvasControls">

                         <div style="position:relative;width:715px;" id="canvas-wrapper">
                           <canvas id="canvas" width="715px" height="600"></canvas>
                           <br>
                         </div>
                         <div id="commands" ng-click="maybeLoadShape($event)">
                           <!-- <ul class="nav nav-tabs">
                      <li class="active "><a href="#simple-shapes" data-toggle="tab">Simple</a></li>
                    </ul> -->
                           <div class="">
                             <div class="" id="">


                               <button type="button" class="btn circle" ng-click="addCircle()">Circle</button>
                               <button type="button" class="btn triangle" ng-click="addTriangle()">Triangle</button>
                               <button type="button" class="btn line" ng-click="addLine()">Line</button>
                               <button type="button" class="btn polygon" ng-click="addPolygon()">Ploygon</button>
                               <input type="hidden" value="" id="canvasRasterizer" />
                               <button type="button" class="btn rect" ng-click="addRect()">Rectangle</button>
                               <input type="color" style="width:40px" bind-value-to="fill" class="btn-object-action">
                                   <button type= "button" id="svg" class="btn" ng-click="rasterizeSVG()">SVG</button>
                               <!-- <button id="b" type="button" ng-click="rasterize()" value="Save as Image" ></button> -->
                               <!-- 
                          <button type="button" class="btn" click="addText()">Add text</button>
                          <button type="button" class="btn" ng-click="addIText()">Add Itext</button> -->
                               <button type="button" class="btn" ng-click="addTextbox()">Add Text</button>
                               <!-- <button type="button" class="btn" ng-click="addPatternRect()">Add pattern rect</button> -->

                               <input type="file" id="imgLoader" name="">
                               </p>
                               </ul>
                             </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-12 mt-2 cc-right">
                             <div class="form-group">
                               <input type="button" id="Save" value="Save     " ng-click="rasterize()" class="btn btn-primary purple-btn">
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>

                   </div>
                 </div>
                 <div class="col-md-3">
                   <div class="card shadow mb-4 module-add-form">
                     <div class="card-body">
                       <h1 class="h6 text-gray-800 mb-10 module-form-title">Select Template</h1>

                       <div class="certify-image">

                         <div class="col-md-12 p-0">
                           <div class="cimg mb-3">
                             <button type="button" class="btn rect" onclick="addsText('{student_name}')">Student Name</button> 
                                   <button type="button" class="btn rect" onclick="addsText('{course_name}')">Course Name</button>
                                    <button type="button" class="btn rect" onclick="addsText('{completion_date}')">Completion Date</button>    <button type="button" class="btn rect" onclick="addsText('{total_hours}')">Total Hours</button><button type="button" class="btn rect" onclick="setimgp()">Logo</button><button type="button" class="btn rect" onclick="setimg()">Signature</button>
                           </div>
                           <div class="cimg mb-3">
                             <img src="{{asset('images/3.jpg')}}" onclick="getimage(this)">

                           </div>
                           <div class="cimg mb-3">
                             <img src="{{asset('images/4.jpg')}}" onclick="getimage(this)">
                           </div>
                           <div class="cimg mb-3">
                             <img src="{{asset('images/5.jpg')}}" onclick="getimage(this)">
                           </div>
                         </div>

                       </div>

                       <!-- <form method="POST" action="http://localhost/EOS/block_chain/admin/modules/create" class="form-horizontal" autocomplete="off">
                  <input type="hidden" name="_token" value="fpmViKNDIsGcG75YPDikfQ9fm6VlSZbdAe3BCoxW">                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="label" class="control-label">Label<small class="text-danger required">*</small></label> 
                           <input name="label" type="text" id="module-label" class="form-control" value="">
                            							
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <input type="submit" value="Save" id="module-submit" class="btn btn-primary">
                        </div>
                     </div>
                  </div>
                  </form> -->

                     </div>
                   </div>
                   <div class="card shadow mb-4 module-edit-form">
                     <div class="card-body">
                       <div class="card-body">
                         <h1 class="h3 text-gray-800 mb-10 module-form-title">Edit Module</h1>
                         <form method="POST" action="http://localhost/EOS/block_chain/admin/modules" class="form-horizontal" autocomplete="off">
                           <input type="hidden" name="_token" value="fpmViKNDIsGcG75YPDikfQ9fm6VlSZbdAe3BCoxW"> <input type="hidden" name="_method" value="PUT">
                           <div class="row">
                             <div class="col-md-12">
                               <div class="form-group">
                                 <label for="label" class="control-label">Label<small class="text-danger required">*</small></label>
                                 <input name="label" type="text" id="module-edit-label" class="form-control" value="">
                                 <input name="module_id" type="hidden" id="module-edit-id" value="">

                               </div>
                             </div>
                           </div>
                           <div class="row">
                             <div class="col-md-4">
                               <div class="form-group">
                                 <input type="button" value="Update" id="module-update" class="btn btn-primary">
                               </div>
                             </div>
                           </div>
                         </form>
                       </div>
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
   <script src="{{asset('kitchensink/js/master.js')}}"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.6/angular.min.js"></script>
   <script src="{{asset('kitchensink/lib/fabric.js')}}"></script>
   <script src="{{asset('kitchensink/lib/jquery.js')}}"></script>
   <script src="{{asset('kitchensink/lib/bootstrap.js')}}"></script>
   <script src="{{asset('kitchensink/js/paster.js')}}"></script>
   <link rel="stylesheet" href="{{asset('kitchensink/css/bootstrap.css')}}">
   <link rel="stylesheet" href="{{asset('kitchensink/css/kitchensink.css')}}">
   <script>
     $(document).ready(function() {
       $("#Save").click(function() {

         var canvas = new fabric.Canvas(canvas);
         /*canvas.loadFromJSON(val[i].story); //val has saved canvas
         canvas.toSVG(); //or to dataURL()*/
         var data = $("#canvasRasterizer").val();
        $('#svg').click();
         //alert(data);
         var url = "{{url('admin/certificates/store')}}";
         var svg=$("#SVGRasterizer").val();
         var institution_name=$("#institution_name").val();
 

         $.ajax({
           url: url,
           type: "post",
           data: {
             'canimgbs': data,
             'svg': svg,
             'institution': institution_name,
             _token: '{{csrf_token()}}'
           },
           success: function(result) {

           },
         });
       });
          $("#institution_name").change(function(){
         var institution_name=$("#institution_namen").val();
         var institution_logo=$("#institution_logo").val();
         var institution_signature=$("#institution_signature").val();
         //alert(institution_signature);

     });
          
     });
     function setimg(){
            var signature=$('#institution_signature').val();
             var coord = getRandomLeftTop();

           var image = new fabric.Image.fromURL(signature, function(image) {
           image.set({
             left: coord.left,
             top: coord.top,
             angle: getRandomInt(-10, 10)
           }).scale(getRandomNum(0.1, 0.27))
      .setCoords();
          });
        }    
        function setimgp(){
            var signature=$('#institution_logo').val();
             var coord = getRandomLeftTop();

           var image = new fabric.Image.fromURL(signature, function(image) {
           image.set({
             left: coord.left,
             top: coord.top,
             angle: getRandomInt(-10, 10)
           }).scale(getRandomNum(0.1, 0.27))
      .setCoords();
          });
        }
     var kitchensink = {};
     var canvas = new fabric.Canvas('canvas');
     const context = canvas.getContext('2d');

     function getimage(ele) {
       //alert(ele.src);
       canvas.setBackgroundImage(ele.src, canvas.renderAll.bind(canvas), {
         // Optionally add an opacity lvl to the image
         backgroundImageOpacity: 0.5,
         // should the image be resized to fit the container?
         backgroundImageStretch: false
       });
     }


     context.clearRect(0, 0, canvas.width, canvas.height);
     document.getElementById('imgLoader').onchange = function handleImage(e) {
       var reader = new FileReader();
       var coord = getRandomLeftTop();
       reader.onload = function(event) {
         console.log('fdsf');
         var imgObj = new Image();
         imgObj.src = event.target.result;
         imgObj.onload = function() {
           // start fabricJS stuff

           var image = new fabric.Image(imgObj);
           image.set({
             left: getRandomInt(350, 400),
             top: getRandomInt(350, 400),
             angle: getRandomInt(-10, 10),
             scaleX: 0.5,
             scaleY: 0.5,
             originX: 'left',
             hasRotatingPoint: true,
             centerTransform: true

           });
           //image.scale(getRandomNum(0.1, 0.25)).setCoords();
           canvas.add(image);

           // end fabricJS stuff
         }

       }
       console.log(e.target.files[0]);
       reader.readAsDataURL(e.target.files[0]);
     }
     canvas.renderAll();
   </script>
   <script type="text/javascript">function addsText(textvalue) { 
  var oText = new fabric.Text(textvalue, { 
    left: 100, 
    top: 100 ,
  });

  canvas.add(oText);
  oText.bringToFront();
  canvas.setActiveObject(oText);

}</script>
<script>
var institution_name=<?php
  if(isset($_POST['institution_name'])&&!empty($_POST['institution_name'])){echo $_POST['institution_name'];}else{echo 0;}
  ?>;
$('[name=institution_name]').val(institution_name);
</script>



   <script src="{{asset('kitchensink/js/kitchensink/utils.js')}}"></script>
   <script src="{{asset('kitchensink/js/kitchensink/app_config.js')}}"></script>
   <script src="{{asset('kitchensink/js/kitchensink/controller.js')}}"></script>

   <!-- view-source:http://fabricjs.com/js/kitchensink/utils.js
view-source:http://fabricjs.com/js/kitchensink/controller.js
view-source:http://fabricjs.com/js/kitchensink/app_config.js
 -->
   <!-- Page Content End-->
   @endsection