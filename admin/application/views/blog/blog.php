<?php $this->load->view('layouts/header');?>
<?php $this->load->view('layouts/sidebar');?>
<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Blogs</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
								 Blogs
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <?php if($this->session->flashdata('success')){ ?>
										<div class="alert alert-success" role="alert">
									     
											<?= $this->session->flashdata('success') ?>
										
									     </div>
                                         <?php } ?>
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
												<tr>
                                               <td colspan="6" align="right"><a href="<?php echo base_url();?>BlogController/add" class="btn btn-info">Add</button></td>
												</tr>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Title</th>
													<th>Slug</th>
													<th>Image</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php foreach($blogs as $key=>$value){?>
                                                <tr class="odd gradeX">
                                                    <td><?= $key+1; ?></td>
                                                    <td><?=$value['title']; ?></td>
													<td><?=$value['slug']; ?></td>
													<td><img src="<?php echo  base_url(); ?>assets/uploads/<?php echo $value['image']; ?>" height="70px" width="70px"></td>
													
                                                    <td class="center"><?=$value['description']; ?></td>
													<td class="center">
													<a href="#" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
													<a href="<?php echo base_url(); ?>BlogController/deleteblog/<?= $value['id'] ?>" onclick='return confirm("Are You Sure want to delete this blog?")' class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                                </tr>
												<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                 
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                
                    <!-- /.row -->
                
                    <!-- /.row -->
                 
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
			</div>
			<?php $this->load->view('layouts/footer');?>
			
			<script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
           </script>
