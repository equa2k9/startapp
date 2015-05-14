
<strong class="pull-left primary-font"><?php echo $data->leaveComment->username?></strong>
<small class="pull-right text-muted">
    <span class="glyphicon glyphicon-time"></span><?php echo date('m/d/Y h:i:s A', $data->created_at) ?></small>
</br><br>
<?php echo $data->message ?>
<hr>
