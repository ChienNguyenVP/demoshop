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
@endsection
@section('content')
	<section>
		<div class="container">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Thêm mới</button>
			<div id="myModal" class="modal fade " role="dialog" >
			<div class="modal-dialog modal-sm container">

		    <!-- Modal content-->
		    <div class="modal-content" >
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h3 class="modal-title">Thêm Size</h3>
		      </div>
		      <div class="modal-body">
		        <form action="" method="POST" role="form" enctype="multipart/form-data" >
		        	 @csrf
			        	<div class="form-group">
			        		<label for="">Size</label>
			        		<input type="text" name="size" id="size" class="form-control" id="title" placeholder="">    
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
						<th>Size</th>
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
        ajax: '{!! route('listsize') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'size', name: 'size' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
{{-- <script type="text/javascript">
	CKEDITOR.replace('content');
</script> --}}
<script type="text/javascript">
	$(function(){	
		$.ajaxSetup({
	    	headers: {
	        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	   				}
			});
		$('#add-new').on('click',function(e){
			$.ajax({
				type: 'post',
				url: '{{route('post.size')}}',
				data: {
					size: $('#size').val(),
				},
				success: function (response){
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
              url: '{{asset('')}}admin/size/delete/'+ id,
              type: 'delete',
              success: function (response) {
                toastr.success(' Xóa thành công!');

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
	
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


{{-- <script type="text/javascript">
	// jQuery
		$('[name=tags]').tagify();

		// Vanilla JavaScript
		var input = document.querySelector('input[name=tags]'),
		tagify = new Tagify( input );
		$('[name=tags]').tagify({duplicates : false});

</script> --}}
@endsection