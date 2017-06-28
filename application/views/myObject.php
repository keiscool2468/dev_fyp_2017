<style>
    .modal-bodyX {
        display: inline-flex;
    }
</style>

<div class="container">
    <div class="page-header">
		<center>
			<h1>Yours stuff</h1>
		</center>
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
<script type="text/javascript">
    var aa = <?php echo json_encode($objects); ?>;
    var sub = <?php echo json_encode($user); ?>;
    console.log(aa[0]);
    console.log(sub);
</script>