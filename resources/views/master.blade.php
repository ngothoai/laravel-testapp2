<!DOCTYPE html >
<html ng-app="app-User">
<head>
<title>Dashboard</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="{{URL::asset('')}}" name="website" />
<link rel="stylesheet" type="text/css" href="<?= asset('assets/bootstrap/css/bootstrap.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?= asset('assets/bootstrap/css/bootstrap-theme.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?= asset('assets/css/style.css')?>">

</head>
<body>
<div ng-controller="mainController">
<main>
<div class="container-fluid">
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-success">
                      <div class="panel-heading">
                            <h1>All user</h1>
                      </div>
                        
                      <div class="panel-body">
                        <div class="creat">
                            <button id="btn-add" ng-click="addtoggle()" class="btn btn-warning ">Create user</button>
                        </div>
                        @if(count($errors)>0)
                        <div class="alert alert-danger">

                                 @foreach($errors->all() as $err)

                                {{$err}}<br>

                            @endforeach

                        </div>
                        @endif
                        <table class="list-user table table-bordered">
                          <thead>
                            <tr>
                              
                              <th>Name</th>
                              <th>Photo</th>
                              <th>Address</th>
                              <th>Age</th>
                              <th>Edit/ Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr ng-repeat="user in users">
                                
                                <td>@{{ user.name}}</td>
                                <td class="avatar"><img ng-src="uploads/users/@{{ user.photo}}" class="img-responsive"></td>
                                <td>@{{user.address}}</td>
                                <td>@{{user.age}}</td>
                                <td>
                                <button class="btn btn-primary btn-sm" ng-click="toggle(user.id)">Edit</button>
                                <button class="btn btn-danger btn-sm click-delete" ng-click="delete(user.id)">Delete</button>
                                </td>
                            </tr>
                            
                           
                          </tbody>
                        </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="myModaladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabeladd" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1><i class="fa fa-bar-chart-o"></i>Add</h1>
                </div>
                <div class="modal-body">
                    <ul ng-class="{'alert alert-danger':  errors }" >
                      <li ng-repeat="(key, value) in errors">
                          @{{ value }}
                      </li>
                  </ul>
                    <form name="userForms"  ng-submit="submitFormadd(userForms.$valid)" novalidate>
                    <?php echo csrf_field() ?>
                        <div class="form-group">
                              <label class="control-label">Name</label>
                              <input type="text" placeholder="Name" value="" ng-model="add.name"  class="form-control col-sm-12" name ="addname"  ng-maxlength = "10" required>
                              <p ng-show="userForms.addname.$error.required" class="help-block">Required</p>
                                <p ng-show="userForms.addname.$error.maxlength" class="help-block">Username is too long.</p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Age</label>
                            <input type="text" class="form-control col-sm-12" ng-model="add.age" name ="addage"  ng-maxlength = "2" ng-pattern="/^(0|[1-9][0-9]*)$/" required placeholder="Age">
                            <p ng-show="userForms.add.age.$error.required" class="help-block">Required</p>
                            <p ng-show="userForms.addage.$error.pattern" class="help-block">Invalid age </p>
                                <p ng-show="userForms.addage.$error.maxlength" class="help-block">Username is too long.
                            </p>
                                
                        </div>
                        <div class="form-group">
                            <label class="control-label">Address</label>
                            <input type="text" placeholder="Address" ng-model="add.address" class="form-control col-sm-12" ng-maxlength = "300" required  name ="addaddress">
                            <p ng-show="userForms.addaddress.$error.required" class="help-block">Required</p>
                                <p ng-show="userForms.addaddress.$error.maxlength" class="help-block">Username is too long.</p>
                             
                        </div>
                        <div class="form-group">
                              <label class="control-label">Photo</label>
                             <input type="file" ngf-select ng-model="add.file" name="fileadd" accept="image/*" ngf-max-size="5MB" required  ngf-model-invalid="errorFile" ng-files="setTheFiles($files)">
                                
                                <img ng-show="userForms.file.$valid" ngf-thumbnail="add.file" class="thumb">
                            <!-- <input type="file" id="file1" ng-files="setTheFiles($files)" id="image_file"  name="photo"> -->
                           
                        </div>
                        <div class="form-group">
                            <button class="btn-sm btn btn-primary" ng-click = "adduser(adduser)" ng-disabled="userForms.$invalid">Add</button>
                        </div>
                    </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1><i class="fa fa-bar-chart-o"></i>Edit</h1>
                </div>
                <ul ng-class="{'alert alert-danger':  errorsedit }" >
                      <li ng-repeat="(key, erredit) in errorsedit">
                          @{{ erredit }}
                      </li>
                  </ul>
                <div class="modal-body">
                    <form name="userForm" id="userForm" enctype="multipart/form-data" ng-submit="submitForm(userForm.$valid)" novalidate>
                     <?php echo csrf_field() ?>
                     
                        <div class="form-group">
                              <label class="control-label">Name</label>
                              <input type="text" placeholder="Name" ng-model="user.name" class="form-control col-sm-12" name ="name"  ng-maxlength = "10" required>
                              <p ng-show="userForm.name.$error.required" class="help-block">Required</p>
                                <p ng-show="userForm.name.$error.maxlength" class="help-block">Username is too long.</p>
                        </div>
                        <div class="form-group">
                              <label class="control-label">Age</label>
                              <input type="text" class="form-control col-sm-12" name ="age"  ng-maxlength = "2" ng-pattern="/^(0|[1-9][0-9]*)$/" required ng-model="user.age" placeholder="Age">
                              <p ng-show="userForm.age.$error.required" class="help-block">Required</p>
                              <p ng-show="userForm.age.$error.pattern" class="help-block">Invalid age </p>
                                <p ng-show="userForm.age.$error.maxlength" class="help-block">Username is too long.</p>
                                
                        </div>
                        <div class="form-group">
                              <label class="control-label">Address</label>
                              <input type="text" placeholder="Address" class="form-control col-sm-12" ng-maxlength = "300" required ng-model="user.address" name ="address">
                              <p ng-show="userForm.address.$error.required" class="help-block">Required</p>
                                <p ng-show="userForm.address.$error.maxlength" class="help-block">Username is too long.</p>
                             
                        </div>
                        <div class="form-group">
                              <label class="control-label">Photo</label>
                                <input type="file" ng-model="user.photo"  name="fileedit"  id="uploadFileInput" ngf-max-size="5MB"    >
                                
                              <!--   <img ng-show="userForms.file.$valid" ng-src="user.photo" class="thumb"> -->
                                <!-- <input type="file" ngf-select ng-model="editfile"  accept="image/*" ngf-max-size="2MB"  name ="photoedit"  ng-files="setTheFilesedit($filesedit)">
                                <img ng-show="userForms.file.$valid" ngf-thumbnail="editfile" class="thumb"> -->
                                <!-- img ng-src="uploads/users/@{{ user.photo}}" class="img-responsive"> -->
                               

                        </div>
                        <div class="form-group">
                            <button class="btn-sm btn btn-primary" ng-click = "save(user.id)" ng-disabled="userForm.$invalid">Save change</button>
                        </div>
                    </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
   


</div>
</main>
</div>

<script type="text/javascript" src="<?= asset('assets/js/jquery-2.2.4.min.js')?>"></script>
<script type="text/javascript" src="<?= asset('app/lib/angular/angular.min.js')?>"></script>

<script type="text/javascript" src="<?= asset('app/lib/angular/angular-route.min.js')?>"></script>
<script type="text/javascript" src="<?= asset('app/lib/angular/ng-file-upload-shim.min.js')?>"></script>
<script type="text/javascript" src="<?= asset('app/lib/angular/ng-file-upload.min.js')?>"></script>


<script type="text/javascript" src="<?= asset('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<!-- <script type="text/javascript" src="<?= asset('app/app.js')?>"></script> -->

<script type="text/javascript" src="<?= asset('app/controllers/usserupdate.js')?>"></script>


</body>
</html>