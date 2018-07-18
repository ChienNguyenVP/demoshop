@extends('layout.layout')
@section('header')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="text/javascript" src="//code.jquery.com/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">	
   	<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
   	<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
   	<link href="{{asset('css/tagify.css')}}" rel="stylesheet">
   	<script src="{{asset('js/jQuery.tagify.js')}}"></script>
   	<script src="{{asset('js/tagify.js')}}"></script>
   	<style type="text/css">
   	.modal-dialog,
	.modal-content {
    /* 80% of window height */
    height: 80%;
	}

	.modal-body {
    /* 100% = dialog height, 120px = header + footer */
    max-height: calc(100% - 120px);
    overflow-y: scroll;
	}
    input[type=file]{
      display: inline;
    }
    #image_preview{
      border: 1px solid black;
      padding: 10px;
    }
    #image_preview img{
      width: 200px;
      /*height: 200px;*/
      padding: 5px;
    }
  </style>
@endsection
@section('content')
	<section>
		<div class="container">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Thêm mới</button>
			<div id="myModal" class="modal fade " role="dialog" >
			<div class="modal-dialog modal-lg container">

		    <!-- Modal content-->
		    <div class="modal-content" >
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h3 class="modal-title">Thêm mới sản phẩm</h3>
		      </div>
		      <div class="modal-body">
		        <form action="" method="POST" role="form" enctype="multipart/form-data" >
		        	 @csrf
			        <div class="row">
			        	<div class="col-sm-6">
			        	<div class="form-group">
			        		<label for="">Tên sản phẩm</label>
			        		<input type="text" class="form-control" id="name" name="name"  placeholder="">    
			        	</div>
			        	<div class="form-group">
			        		<label for="">Mô tả</label>
			        		<input type="texta" name="description" id="description">
			        	</div>
			        	<div class="form-group">
			        		<label for="">Giá nhập</label>
			        		<input type="int" class="form-control" name="origin_prime" id="origin_prime" placeholder="">    
			        	</div>
						<div class="form-group">
			        		<label for="">Giá bán</label>
			        		<input type="text" class="form-control" id="sale_prime" placeholder="">  
			        	</div>
			        	<div class="alert alert-danger print-error-msg" style="display:none">
                                            <ul></ul>
                                        </div>
                                        <div class="alert alert-success print-success-msg" style="display:none">
                                            <ul></ul>
                                        </div>
                                        <div class="table-responsive">  
                                            <table class="table table-bordered" style="border: none;" id="dynamic_field">
                                                <thead> 
                                                    <tr>
                                                        <th>Size</th>
                                                        <th>Color</th>
                                                        <th>Quantity</th>
                                                        <td><button type="button" name="add" id="add" class="btn btn-success">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button></td> 
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr class="dynamic-added" id="row-1" data-number ="1">
                                                        <td>                                
                                                           <select class="form-control size" name="size_id[]" >	      
						                                      @if (count($sizes)>0) 
							                                      @foreach ($sizes as $size)
							                                          <option value="{{ $size->id }}">{{$size->size}}</option>
							                                      @endforeach 
						                                      @endif
						                                  	</select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control color" name="color_id[]" >
			                                      			@if (count($colors)>0)
			                                       				@foreach ($colors as $color)
			                                          		<option value="{{$color->id}}">{{$color->color}}</option>
			                                      @endforeach @endif
			                                  	</select>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="quantity[]" id="quantity" placeholder="Enter your Quantity" class="form-control name_list" />
                                                        </td>
                                                        <td><button type="button" name="remove" class="btn btn-danger btn_remove1" id="remove-tr'+i+'" data-id="'+i+'"><span class="glyphicon glyphicon-minus" id="remove-tr'+i+'"></span></button></td>
                                                    </tr>
                                                </tbody>
                                            </table>  
                                        </div>

			        	</div>
			        	<div class="col-sm-6">	
			        	<div class="form-group">
			        		<label for="">Ảnh</label>
			        		<input type="file" id="uploadFile" name="uploadFile[]" multiple/>
							<div id="image_preview"></div>
			        	</div>
			        		<div class="portlet light bordered">
			                              	<div class="portlet-title">
			                                  	<div class="caption">
			                                      	<i class="fa fa-list font-green" aria-hidden="true"></i>
			                                      	<span class="caption-subject font-green bold"><b>Loại sản phẩm</b></span>
			                                  	</div>
			                              	</div>
			                              	<div class="portlet-body">
			                                  	<select class="form-control kind" name="kind_id" >
			                                  		{{-- <option value=""></option> --}}
			                                      @if (count($kind)>0) @foreach ($kind as $kind)
			                                          <option value="{{$kind->id}}">{{$kind->name}}</option>
			                                      @endforeach @endif
			                                  	</select>
			                             	 </div>
			                          	</div>
			        
			        	<div class="portlet light bordered">
			                              	<div class="portlet-title">
			                                  	<div class="caption">
			                                      	<i class="fa fa-list font-green" aria-hidden="true"></i>
			                                      	<span class="caption-subject font-green bold"><b>Loại sản phẩm</b></span>
			                                  	</div>
			                              	</div>
			                              	<div class="portlet-body">
			                                  	<select class="form-control provider" name="provider_id" >
			                                  		{{-- <option value=""></option> --}}
			                                      @if (count($provider)>0) @foreach ($provider as $provider)
			                                          <option value="{{$provider->id}}">{{$provider->name}}</option>
			                                      @endforeach @endif
			                                  	</select>
			                             	 </div>
			                          	</div>
			        	</div>
			       	</div>
		        </form>
		      </div>
		      <div class="modal-footer">
			       	<button id="add-new" name="submit" type="submit" class="btn btn-primary">Thêm</button>
		      	
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
</div>

			<table class="table table-hover" id="table"> 
				<thead>
					<tr>
						<th>ID</th>
						<th>Mã sản phẩm</th>
						<th>Tên sản phẩm</th>
						<th>Mô tả</th>
						<th>Giá bán</th>
						<th>Tạo</th>
						<th>Cập nhật</th>
						<th>Thao tác</th>
					</tr>
				</thead>
			</table>
		</div>
	</section>

@endsection

@section('footer')
<script>
$(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('listproduct') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'sale_prime', name: 'sale_prime' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
<script type="text/javascript">
	CKEDITOR.replace('description');
</script>
<script type="text/javascript">
		$(function(){	
		$.ajaxSetup({
	    	headers: {
	        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	   				}
			});
		
		
		$('#add-new').on('click',function(e){

		 	var form = new FormData();
		var a = CKEDITOR.instances.description.getData();
		form.append('name',$('#name').val());
		form.append('description',a);
		form.append('origin_prime',$('#origin_prime').val());
		form.append('sale_prime',$('#sale_prime').val());
		form.append('size[]',$(".size option:selected").val());
		form.append('quantity[]',$('#quantity').val());
		form.append('color[]',$(".color option:selected").val());
		form.append('kind',$(".kind option:selected").val());
		form.append('provider',$(".provider option:selected").val());
		var files = document.getElementById('uploadFile').files;
                for (var i = 0; i < files.length; i++) {
                    form.append('uploadFile[]',files[i]);
                }
			$.ajax({
				type: 'post',
				url: '{{route('post.product')}}',
				data: form,
				dataType:'json',
                async:false,
                processData: false,
                contentType: false,
				success: function (response){
					// swal("Đã thêm xong!", {
     //         		 icon: "success",
     //       			 });
					
					$('#myModal').modal('hide');
					var table = $('#table').DataTable();
					table.ajax.reload( function ( json ) {
					    $('#table').val( json.lastInput );
					});
				},
				error : function (error){

				}
			});
		}); 
	});

		$('#table').on('click','.btn-danger' ,function(){

        var id=$(this).data('id'); // gtri id lấy từ button detail trên table. lấy từ gtri data-id
        // var parent = $(this).parent();


        swal({
          title: "Bạn chắc chắc muốn xóa?",
          text: "Bạn sẽ không thể lấy lại những gì đã xóa đi!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
          	$.ajaxSetup({
	    	headers: {
	        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	   				}
			});
            $.ajax({
              url: '{{asset('')}}admin/color/delete/'+ id,
              type: 'delete',
              success: function (response) {
                toastr.success(' Xóa thành công');

                var table = $('#table').DataTable();
					table.ajax.reload( function ( json ) {
					    $('#table').val( json.lastInput );
					});
              }
            }); 
            // parent.slideUp(300, function () {
            //   // parent.closest("tr").remove();
            // });
            swal("Đã xóa xong!", {
              icon: "success",
            });
          } else {
            swal("Hủy xóa!");
          }
        });
      });


</script>
{{-- <script type="text/javascript">
	// jQuery
		$('[name=tags]').tagify();

		// Vanilla JavaScript
		var input = document.querySelector('input[name=tags]'),
		tagify = new Tagify( input );
		$('[name=tags]').tagify({duplicates : false});

</script> --}}
<script type="text/javascript">



  $("#uploadFile").change(function(){

     $('#image_preview').html("");
     var total_file=document.getElementById("uploadFile").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
     }
  });
  // $('form').ajaxForm(function() 
  //  {
  //   alert("Uploaded SuccessFully");
  //  }); 
</script>
 <script type="text/javascript">
        $(document).ready(function(){      
          
          var i=1;  


          $('#add').click(function(){  
               i++;  
               var ht = $('#dynamic_field tbody tr').html();

               $('#dynamic_field tbody').append(' <tr class="dynamic-added" id="row-1" data-number ="1">' + ht + '</tr>');   
          });  
     
            $(document).on('click', '.btn_remove1', function(){  
                $(this).parents('tr').remove();
            });  
          });
    </script>


@endsection