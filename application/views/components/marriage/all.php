<script type="text/javaScript" src="<?php echo site_url('private/js/ng-controller/allProductsController.js'); ?>"></script>
<style>
    .bootstrap-select.btn-group .dropdown-menu li {max-width: 420px;}
    .btn {
        padding-right: 12px;
        padding-left: 12px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Record</h1>
                </div>
            </div>
            <div class="panel-body" ng-controller="allProductsController">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[id]" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected disabled>Select Candidate</option>
                                    <?php 
                                        $all_candidate = readTable('marriage', [], ['select'=>'id, name, mobile']);
                                        if($all_candidate) foreach ($all_candidate as $key => $value) {
                                            echo "<option value='{$value->id}'>{$value->name}-{$value->mobile}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[gender]" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[marital_status]" class="form-control selectpicker" data-live-search="true" >
                                    <option value="">Select Status</option>
                                    <option value="unmarried">Unmarried</option>
                                    <option value="married">Married</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <input type="submit" class="btn btn-info" value="Filter">
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <?php msg(); ?>
                <table class="table table-bordered">
                    <tr>
                        <th width="40">SL</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th width="150" class="text-right">Action</th>
                    </tr>

                    <?php if(!empty($all_record)){ foreach($all_record as $key => $row){ ?>
                    <tr>
                        <td><?=(++$key)?></td>
                        <td><img src="<?=site_url($row->photo)?>" height="30"></td>
                        <td><?=($row->name)?></td>
                        <td><?=($row->age)?></td>
                        <td><?=filter($row->gender)?></td>
                        <td><?=($row->mobile)?></td>
                        <td><?=($row->address)?></td>
                        <td><?=filter($row->marital_status)?></td>
                        <td class="text-right">
                            <?php
                            if($action_menus){
                                foreach($action_menus as $action_menu){
                                    if($user_data['privilege']=='president' xor (!empty($aside_action_menu_array) && in_array($action_menu->id,$aside_action_menu_array) && $user_data['privilege']!=='president')){
                                    if(strtolower($action_menu->name) == "delete" ){?>
                                        <a class="btn btn-<?php echo $action_menu->type;?>" onclick="return confirm('Are your sure to proccess this action ?')"  href="<?php echo get_url($action_menu->controller_path."/".$row->id); ?>"><i class="<?php echo $action_menu->icon;?>" aria-hidden="true"></i></a>
                                    <?php }else{ ?>
                                        <a class="btn btn-<?php echo $action_menu->type;?>"  href="<?php echo get_url($action_menu->controller_path."/".$row->id) ;?>"><i class="<?php echo $action_menu->icon;?>" aria-hidden="true"></i></a>
                                <?php }}}
                            }?>
                        </td>
                    </tr>
                    <?php }} else { ?>
                    	<tr>
                    		<th colspan="11" class="text-center">Nothing Found</th>
                    	</tr>
                    <?php } ?>
                </table>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
