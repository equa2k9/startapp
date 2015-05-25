<?php $this->renderPartial('_createRouteStatus', array('model' => new RoutesheetStatus()), FALSE); ?>
<?php $this->renderPartial('_createTripsStatus', array('model' => new TripsStatus()), FALSE); ?>
<div class="page-header">
    <h2>
        Statuses
    </h2>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-6">
        <?php
        $this->renderPartial('_routeStatus',array('routeStatus'=>$routeStatus));
        ?>
    </div>
    <div class="col-md-6">
        <?php
        $this->renderPartial('_tripsStatus',array('tripsStatus'=>$tripsStatus));
        ?>
    </div>
</div>