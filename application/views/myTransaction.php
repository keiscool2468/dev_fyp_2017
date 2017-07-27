<style>
    .modal-bodyX,
    .button-form {
        display: inline-flex;
    }
</style>

<div class="container">
    <div class="page-header">
		<center>
			<h1>Yours Transaction</h1>
		</center>
        <ul class="list-group">
        <?php if(!empty($transactions)){ ?>
            <?php foreach ($transactions as $transaction): ?>
                <?php if($transaction->status == 'active'){ ?>
                    <?php if(($transaction->user_id_2 == $user->id)
                                // &&(!empty($transaction->object_1))
                                    // &&($transaction->object_1->status == 'active')
                                        &&($transaction->object_2->status == 'active')){ ?> 
                        <br>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading">Request From the others!!</h4>
                                    <?php if((!empty($transaction->object_id_1))&&(empty($transaction->object_id_2))&&($transaction->user_2_accept == 'decline')){ ?>
                                        <form enctype="multipart/form-data" class="form-horizontal button-form" role="form" 
                                            action="transaction/acceptDecline" method="post" >
                                            <input type="hidden" class="form-control" name="transaction_id" hidden value="<?php echo $transaction->id; ?>"/>
                                            <input type="hidden" class="form-control" name="user_2_accept" hidden value="accept"/>
                                            <button type="submit" class="btn btn-success">Accept</button>
                                        </form>
                                        <form enctype="multipart/form-data" class="form-horizontal button-form" role="form" 
                                            action="transaction/acceptDecline" method="post">
                                            <input type="hidden" class="form-control" name="transaction_id" hidden value="<?php echo $transaction->id; ?>"/>
                                            <input type="hidden" class="form-control" name="user_2_accept" hidden value="decline"/>  
                                            <button type="submit" class="btn btn-warning" >Decline</button>
                                        </form>
                                    <?php }else{ ?>
                                        <h4 class="media-heading">Wait for the others!!</h4>
                                    <?php } ?>
                                    <table class="table">
                                        <tr>
                                            <th>
                                                Your Object
                                            </th>
                                            <th>
                                                <big>Other Side :</big><?php print_r($transaction->user_1->username); ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php print_r($transaction->object_2->name_en); ?>
                                            </td>
                                            <td>
                                                <?php print_r($transaction->object_1->name_en); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </li>
                    <?php } elseif($transaction->user_id_1 == $user->id) { ?>
                        <br>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading">Your Request!!</h4>
                                    <?php if((!empty($transaction->object_id_1))&&(!empty($transaction->object_id_2))&&($transaction->user_2_accept == "accept")){ ?>
                                        <form enctype="multipart/form-data" class="form-horizontal button-form" role="form" 
                                            action="transaction/comfirmCancel" method="post" >
                                            <input type="hidden" class="form-control" name="boolean" hidden value="1"/>
                                            <input type="hidden" class="form-control" name="object_id_1" hidden value="<?php echo $transaction->object_id_1; ?>"/>
                                            <input type="hidden" class="form-control" name="object_id_2" hidden value="<?php echo $transaction->object_id_2; ?>"/>
                                            <input type="hidden" class="form-control" name="transaction_id" hidden value="<?php echo $transaction->id; ?>"/>
                                            <button type="submit" class="btn btn-success">Comfirm</button>
                                        </form>
                                    <?php } ?>
                                    <form enctype="multipart/form-data" class="form-horizontal button-form" role="form" 
                                        action="transaction/comfirmCancel" method="post">
                                        <input type="hidden" class="form-control" name="boolean" hidden value="0"/>  
                                        <input type="hidden" class="form-control" name="transaction_id" hidden value="<?php echo $transaction->id; ?>"/>  
                                        <button type="submit" class="btn btn-warning" >Cancel</button>
                                    </form>
                                    <table class="table">
                                        <tr>
                                            <th>
                                                Your Object
                                            </th>
                                            <th>
                                                <big>Other Side :  </big><?php print_r($transaction->user_2->username); ?>
                                            </th>
                                            <th>
                                                Barter Location
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php if(empty($transaction->object_1)){ ?>
                                                    <span data-toggle="modal" data-target="#<?php echo $transaction->id; ?>" style="color: blue">Doesn't Have Anything Yet! Click me to Add somthing</span>
                                                <?php }else{ ?>
                                                    <?php print_r($transaction->object_1->name_en); ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php print_r($transaction->object_2->name_en); ?>
                                            </td>
                                            <td>
                                                <?php print_r($transaction->location->name_en); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </li>
                        <!--object modal-->
                        <div id="<?php echo $transaction->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form enctype="multipart/form-data" class="form-horizontal" role="form" 
                                            action="transaction/selectMine" method="post" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Select Something
                                        </div>
                                        <div class="modal-body form-group">
                                            <select name="object_id" class="form-control">
                                                <?php if(!empty($objects)){ ?>
                                                    <?php foreach ($objects as $object): ?>
                                                        <?php if($object['status'] == 'active'){ ?>
                                                            <option value="<?php echo $object['id']; ?>">
                                                                <?php echo $object['name_en']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" class="form-control" name="transaction_id" value="<?php echo $transaction->id; ?>"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info" style="display : block">I Choose this one</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end of object modal-->
                    <?php } ?>
                <?php } elseif($transaction->status == 'finished'){ ?>
                    <?php if($transaction->user_id_1 == $user->id){ ?>
                        <br>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading">Things you changed!!</h4>
                                    <table class="table">
                                        <tr>
                                            <th>
                                                Your Object
                                            </th>
                                            <th>
                                                <big>Other Side :</big><?php print_r($transaction->user_2->username); ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php print_r($transaction->object_1->name_en); ?>
                                            </td>
                                            <td>
                                                <?php print_r($transaction->object_2->name_en); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </li>
                    <?php }elseif ($transaction->user_id_2 == $user->id) { ?>
                        <br>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading">Things you changed!!</h4>
                                    <table class="table">
                                        <tr>
                                            <th>
                                                Your Object
                                            </th>
                                            <th>
                                                <big>Other Side :</big><?php print_r($transaction->user_1->username); ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php print_r($transaction->object_2->name_en); ?>
                                            </td>
                                            <td>
                                                <?php print_r($transaction->object_1->name_en); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>
            <?php endforeach; ?>
        <?php }else{ ?>
            <?php $this->load->view('errors/html/error_none'); ?>
        <?php } ?>
        </ul>
    </div>
</div>
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
<script type="text/javascript">
    var aa = <?php echo json_encode($transactions); ?>;
    console.log(aa);
</script>