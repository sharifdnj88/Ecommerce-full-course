<!DOCTYPE html>
<html lang="en">    

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Doccure - Dashboard</title>
		@php
        	$website=DB::table('websites')->first();
    	@endphp
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{url('storage/setting/' .$website->favicon )}}">		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('backend/css/font-awesome.min.css')}}">		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{asset('backend/css/feathericon.min.css')}}">		
		<link rel="stylesheet" href="{{asset('backend/plugins/morris/morris.css')}}">
		<!-- Toastr CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/toastr/toastr.css') }}">
		<!-- DataTables -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css"/>	
		<!-- Photo Preview -->
		<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
		<!-- summernote -->
		<link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
		{{-- Bootstrap switch --}}
		{{-- Select Tag CSS --}}
		<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-tagsinput.css') }}">
		{{-- Bootstrap Switch --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-switch@3.4.0/dist/css/bootstrap3/bootstrap-switch.min.css">
		<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-switch/css/bootstrap-switch.min.js') }}">
		

		 <!-- DataTables -->
		 {{-- <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
		 <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
		 <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> --}}
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
		
</head>
<body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="content container-fluid">
			@guest
			@else
			<!-- Header -->
            @include('layouts.admin_partial.header')
			<!-- /Header -->			
			<!-- Sidebar -->
			@include('layouts.admin_partial.sidebar')
			<!-- /Sidebar -->
			@endguest			
			<!-- Page Wrapper -->
            @yield('admin_content')
			<!-- /Page Wrapper -->		
        	</div>
		</div>
		<!-- /Main Wrapper -->		
		
		<!-- jQuery -->
        <script src="{{asset('backend/js/jquery-3.2.1.min.js')}}"></script>				
		<!-- Bootstrap Core JS -->
        <script src="{{asset('backend/js/popper.min.js')}}"></script>
        <script src="{{asset('backend/js/bootstrap.min.js')}}"></script>		
		<!-- Slimscroll JS -->
        <script src="{{asset('backend/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>		
		<script src="{{asset('backend/plugins/raphael/raphael.min.js')}}"></script>    
		<script src="{{asset('backend/plugins/morris/morris.min.js')}}"></script>  
		<script src="{{asset('backend/js/chart.morris.js')}}"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>		
				
		<script  src="{{asset('backend/js/custom.js')}}"></script>		
		<script  src="{{asset('backend/js/bootstrap-tagsinput.min.js')}}"></script>		
		
		<!-- Toastr Core JS -->
		<script type="text/javascript" src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>		
		<!-- sweetalert Core JS -->
		<script src="{{ asset('backend/plugins/sweetalert/sweetalert.min.js') }}"></script>
		{{-- Select Tag JS --}}
		<script src="{{ asset('backend/js/select2.min.js') }}"></script>		
		<!-- Costome JS Code Write Start -->
		<script>  
			$(document).on("click", "#delete", function(e){
				e.preventDefault();
				var link = $(this).attr("href");
				   swal({
					 title: "Are you Want to delete?",
					 text: "Once Delete, This will be Permanently Delete!",
					 icon: "error",
					 buttons: true,
					 dangerMode: true,
				   })
				   .then((willDelete) => {
					 if (willDelete) {
						  window.location.href = link;
					 } else {
						swal({
							title: "Save Data",
							icon: "success",
				   		})
					 }
				   });
			   });
	   </script>
	  {{-- before  logout showing alert message --}}
		<script>  
			$(document).on("click", "#logout", function(e){
				e.preventDefault();
				var link = $(this).attr("href");
				   swal({
					 title: "Are you Want to logout?",
					 text: "",
					 icon: "warning",
					 buttons: true,
					 dangerMode: true,
				   })
				   .then((willDelete) => {
					 if (willDelete) {
						  window.location.href = link;
					 } else {
						swal({
							title: "Not logout",
							icon: "success",
				   		})
					 }
				   });
			   });
	   </script>
		<!-- Toastr Costome JS Code Write Start -->
		<script>
			@if(Session::has('messege'))
			  var type="{{Session::get('alert-type','info')}}"
			  switch(type){
				  case 'info':
					   toastr.info("{{ Session::get('messege') }}");
					   break;
				  case 'success':
					  toastr.success("{{ Session::get('messege') }}");
					  break;
				  case 'warning':
					 toastr.warning("{{ Session::get('messege') }}");
					  break;
				  case 'error':
					  toastr.error("{{ Session::get('messege') }}");
					  break;
					}
			@endif
		  </script>		
		  
		  <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
		  <script>
			$(function () {
				// Summernote
				$('.textarea').summernote()
			})
		   </script>
		  <!-- Costome JS Code Write End -->

		{{-- <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/jszip/jszip.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/pdfmake/pdfmake.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/pdfmake/vfs_fonts.js"></script>
		<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> --}}

		<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
		<script>
			$('.dropify').dropify();
		</script>
		
		<!-- Custom JS -->		
		<script  src="{{asset('backend/js/script.js')}}"></script>		
		
    </body>

</html>