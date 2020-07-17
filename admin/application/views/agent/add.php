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
								<?php echo validation_errors(); ?>

                                <form action="<?php echo base_url();?>AgentController/blogaddprocess" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
										<input type="hidden" name="id" value="<?php echo (!empty($blog[0]['id']))?$blog[0]['id']:''; ?>"/>
                                        <label>name<small style="color:red">*</small></label>
                                        <input name="name" id="name" class="form-control" placeholder="name"
                                            onkeyup="slugs(this.value)" value="<?php echo (!empty($blog[0]['name']))?$blog[0]['name']:''; ?>">
                                        <span id="notitle" style="color:red"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input class="form-control" id="slug" name="slug" value="<?php echo (!empty($blog[0]['slug']))?$blog[0]['slug']:''; ?>" placeholder="slug" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" id="image">
                                        <label id="perview" style="display:<?php echo(!empty(@$blog[0]['image']))?'block':'none'; ?>"><img src="<?php echo base_url() ?>assets/uploads/agent/<?php echo (!empty($blog[0]['image']))?$blog[0]['image']:''; ?>" id="previewHolder" width="70px"
                                                height="70px" /></label>
                                    </div>
                                   
                                    <button type="button" id="button" class="btn btn-primary">Submit</button>

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



<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#previewHolder').attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#image").change(function() {

    readURL(this);
    $("#perview").css({
        "display": "block"
    });
});

function slugs(text) {
    var lower = text.toLowerCase().split(/[\. ',:-\\|\//]+/g).join('-');
    $("#slug").val(lower);
}
</script>

<script>
$(document).ready(function() {
    $("button").click(function() {
        var fields = $("form").serializeArray();
        $.each(fields, function(index, value) {
            if ((value.name == "name") && (value.value == "")) {
                $("#" + value.name).addClass("error");
                $("#notitle").text("name is required");
				return false;
            } else {
                $("form")[0].submit();
                $("#" + value.name).removeClass("error");

            }
        });


    });
});
</script>
