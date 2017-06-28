<style>
    .modal-bodyX {
        display: inline-flex;
    }
</style>

<div class="container">
    <div class="page-header">
		<center>
			<h1>Yours stuff</h1>
            <button class="add btn btn-info pull-right stuff" data-toggle="modal" 
                    data-target="#addObject" aria-hidden="true">
                Post My Stuff
            </button>
		</center>
        <!--Add Object Modal-->
        <div class="modal fade" id="addObject" tabindex="-1" role="dialog" 
            aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            Give us Some Detail
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" 
                    action="object/addObject" method="post" >
                        <div class="modal-body row">
                            <div class="col-sm-12">
                                <label for="input_fish_name" class="control-label">中文名</label>
                                <input type="text" class="form-control" name="name_zh" placeholder="叫什麼?" />
                            </div>
                            <div class="col-sm-12">
                                <label for="input_fish_name" class="control-label">Name</label>
                                <input type="text" class="form-control" name="name_en" placeholder="Name?" />
                            </div>
                            <div class="col-sm-12">
                                <label for="input_fish_name" class="control-label">Category</label>
                                <select name="sub_cate" class="form-control">	
                                    <?php foreach ($sub_cates as $sub_cate): ?>
                                        <option value="<?php echo $sub_cate->id; ?>">
                                            <?php echo $sub_cate->name_en; ?>
                                        </option>
                                    <?php endforeach; ?>	
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label for="input_fish_name" class="control-label">Description</label>
                                <input type="text" class="form-control" name="description" placeholder="Decripte it" />
                            </div>
                            <div class="col-sm-12">
                                <label for="input_fish_name" class="control-label">Image</label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
                                <input type="file" class="form-control" name="img_url" accept="image/*" disabled />
                            </div>
                            <div class="col-sm-12">
                                <label for="input_fish_name" class="control-label">Expecting Location for Barter</label>
                                <select name="location" class="form-control">	
                                    <?php foreach ($locations as $location): ?>
                                        <option value="<?php echo $location->id; ?>">
                                            <?php echo $location->name_en; ?>
                                        </option>
                                    <?php endforeach; ?>	
                                </select>
                            </div>
                        </div>
                    
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-info">Post it</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--End ofAdd Object Modal-->
    </div>
    <ul class="list-group">
    <?php if(!empty($objects)){ ?>
        <?php foreach ($objects as $object): ?>
            <?php if($object->user_id == $user->id){?>
                <br>
                <li class="list-group-item" data-toggle="modal" data-target="#<?php echo $object->id; ?>">
                    <div class="media">
                        <div class="media-left">
                            <?php if (!empty($object->img_url)) {  ?> <!--return to !-->
                                <img class="media-object img-circle" src="<?php echo '../assets/uploads/objects'. '/' . 'no_object.jpg'; ?>" height="70" width="70"/>
                                <!--<img class="media-object img-circle" src="<?php echo '../assets/uploads/objects' . '/'. $object->img_url; ?>" height="70" width="70"/>-->
                            <?php } else { ?>
                                <img class="media-object img-circle" src="<?php echo '../assets/uploads/objects'. '/' . 'no_object.jpg'; ?>" height="70" width="70"/> 
                            <?php }?>
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading"><?php print_r($object->name_zh); ?><br><?php print_r($object->sub_category->name_en); ?></h2>
                            <p><?php print_r($object->description); ?></p>
                        </div>
                    </div>
                </li>
            <?php }?>
        <?php endforeach; ?>
    <?php }else{ ?>
        <?php $this->load->view('errors/html/error_none'); ?>
    <?php } ?>
    </ul>
</div>
<style>
.stuff {
    position: absolute;
    top: 10%;
    right: 5%;
}
</style>
<script type="text/javascript">
    var aa = <?php echo json_encode($objects); ?>;
    var sub = <?php echo json_encode($user); ?>;
    console.log(aa[0]);
    console.log(sub);
</script>