<style>
    .modal-bodyX {
        display: inline-flex;
    }
    .list-group-item>.badge {
        float: none;
    }
</style>
<div class="container"><br>
	<button class="add btn btn-info pull-right" data-toggle="modal" 
                data-target="#addObject" aria-hidden="true">
        Post My Stuff
    </button>
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
						<!--<div class="col-sm-12">
							<label for="input_fish_name" class="control-label">Image</label>
							<input type="file" class="form-control" name="img_url"/>
						</div>-->
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

	            		<button type="submit" class="btn btn-info" value="upload">Post it</button>
		            </div>
	           	</form>
	        </div>
	    </div>
	</div>
    <!--End ofAdd Object Modal-->
    <div class="modal fade" id="profile" role="dialog" 
        aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Profile Edit
                    </h4>
                </div>

                <!-- Modal Body -->
                
                <form enctype="multipart/form-data" class="form-horizontal" role="form" 
                    action="profile" method="post" >
                    <div class="modal-body row">
                        <label class="control-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php print_r($user->username); ?>"/>

                        <label class="control-label">Password</label>
                        <input type="password" class="form-control" name="password"/>

                        <label class="control-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="<?php print_r($user->first_name); ?>"/>

                        <label class="control-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="<?php print_r($user->last_name); ?>"/>
                        <div class="col-sm-6">
                            <label class="control-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone" value="<?php print_r($user->phone); ?>"/>    
                        </div>
                        <div class="col-sm-6"> 
                            <label class="control-label">Company(Optional)</label>
                            <input type="text" class="form-control" name="company" value="<?php print_r($user->company); ?>"/>
                        </div>
                    </div>
                
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-info">Edit it</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
    <ul class="list-group">
    <?php if(!empty($objects)){ ?>
        <?php foreach ($objects as $object): ?>
            <?php if(($object->status == 'active')&&($object->user_id != $user->id)){ ?>
                <li class="list-group-item col-sm-3" data-toggle="modal" data-target="#<?php echo $object->id; ?>">
                    <span class="badge" style="z-inde"><?php echo $object->name_en; ?></span>
                    <div class="media">
                        <div class="media-left">
                            <?php if (!empty($object->img_url)) {  ?> <!--return to !-->
                                <!--<img class="media-object img-circle" src="<?php echo '../assets/uploads/objects'. '/' . 'no_object.jpg'; ?>" height="auto" width="auto"/>-->
                                <img class="media-object img-circle" src="<?php echo '../assets/uploads/objects' . '/'. $object->img_url.'.jpg'; ?>" height="100" width="100"/>
                            <?php } else { ?>
                                <img class="media-object img-circle" src="<?php echo '../assets/uploads/objects'. '/' . 'no_object.jpg'; ?>" height="70" width="70"/> 
                            <?php }?>
                        </div>
                        <div class="media-body">
                            <!--<h2 class="media-heading"><br><?php print_r($object->sub_category->name_en); ?></h2>-->
                            <!--<p><?php print_r($object->description); ?></p>-->
                            <!--<span>Post by <?php print_r($object->user->username); ?></span>-->
                        </div>
                    </div>
                </li>
                <!--object modal-->
                <div id="<?php echo $object->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
                                <h4 class="modal-title yellow" id="myModalLabel"><?php print_r($object->name_zh); ?></h4>
                            </div>
                            <div class="modal-bodyX">
                                <?php if (!empty($object->img_url)) {  ?><!--return to !-->
                                    <!--<img class="media-object img-circle" src="<?php echo '../assets/uploads/objects'. '/' . 'no_object.jpg'; ?>" height="70" width="70"/>-->
                                    <!--<img class="media-object img-circle" src="<?php echo '../assets/uploads/objects' . '/'. $object->img_url; ?>" height="70" width="70"/>-->
                                <?php } else { ?>
                                    <!--<img class="media-object img-circle" src="<?php echo '../assets/uploads/objects'. '/' . 'no_object.jpg'; ?>" height="70" width="70"/> -->
                                <?php }?>
                                <table class="table">
                                    <tr>
                                        <th>中文名</th>
                                        <td><?php echo $object->name_zh; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo $object->name_en; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td><?php echo $object->sub_category->name_en; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Decription</th>
                                        <td><?php echo $object->description; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Barter Location</th>
                                        <td><?php echo $object->location->name_en; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <form enctype="multipart/form-data" class="form-horizontal" role="form" 
                                    action="transaction/addTransaction" method="post" >
                                    <input type="hidden" class="form-control" name="user_id" hidden value="<?php print_r($object->user_id); ?>"/>
                                    <input type="hidden" class="form-control" name="object_id" hidden value="<?php print_r($object->id); ?>"/>
                                    <input type="hidden" class="form-control" name="location" hidden value="<?php print_r($object->expected_location_id); ?>"/>
                                    <button type="submit" class="btn btn-info" style="display : block">Let's Barter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end of object modal-->
            <?php } ?>
        <?php endforeach; ?>
    <?php }else{ ?>
        <?php $this->load->view('errors/html/error_none'); ?>
    <?php } ?>
    </ul>
</div>
<script type="text/javascript">
    var objects = <?php echo json_encode($objects); ?>;
    console.log(objects);
</script>