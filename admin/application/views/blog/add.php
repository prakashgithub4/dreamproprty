<?php $this->load->view('layouts/header'); ?>
<?php $this->load->view('layouts/sidebar'); ?>


<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Add</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                  Add
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form role="form">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input name="title" class="form-control" placeholder="title">
                                                   
                                                </div>
                                                <div class="form-group">
                                                    <label>Slug</label>
                                                    <input class="form-control" name="slug" placeholder="slug">
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label>File input</label>
                                                    <input type="file" name="image" >
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name = "description" class="form-control" rows="3"></textarea>
												</div> 
												<div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control"  name="status">
														<option value="0">Inactive</option>
														<option value="1">Active</option>
													</select>
                                                </div>
												<button class="btn btn-primary" >Submit</button>
                                               
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
			</div>
			<?php $this->load->view('layouts/footer'); ?>
