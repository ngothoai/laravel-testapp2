<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap-theme.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
</head>
<body>
<main>
	<div class="container-fluid">
		<ng-view></ng-view>
	</div>
</main>
 <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1><i class="fa fa-bar-chart-o"></i> Create</h1>
                </div>
                <div class="modal-body">
               		<div class="form-group">
						  <label class="control-label">Name</label>
						  <input type="text" class="form-control col-sm-12" name ="name">
					</div>
					<div class="form-group">
						  <label class="control-label">Age</label>
						  <input type="text" class="form-control col-sm-12" name ="age" >
					</div>
					<div class="form-group">
						  <label class="control-label">Address</label>
						  <textarea class="form-control col-sm-12" name ="address"></textarea>
						 
					</div>
					<div class="form-group">
						  <label class="control-label">Photo</label>
						  <input type="file" name="photo" >
						 
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<script type="text/javascript" src="{{ asset('assets/js/jquery-2.2.4.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
	jQuery(function($){
		$('.detail').hide();
			$('.btn-success').click(function() {
			    $('.detail').toggle('slow');
			});
	});
</script>
</body>
</html>