<script>
    function checkDate()
    {
        if ($("#dateFrom").val() != "" && $("#dateTo").val() != "")
        {
            var from = document.getElementById('dateFrom');
            var to = document.getElementById('dateTo');
            var df = Date.parse(from.value);
            var dt = Date.parse(to.value);
            if (df > dt)
            {
                var tempToValue = to.value;
                to.value = from.value;
                from.value = tempToValue;
            }
        }


    }
    function checkDateO()
    {
        if ($("#dateFromO").val() != "" && $("#dateToO").val() != "")
        {
            var from = document.getElementById('dateFromO');
            var to = document.getElementById('dateToO');
            var df = Date.parse(from.value);
            var dt = Date.parse(to.value);
            if (df > dt)
            {
                var tempToValue = to.value;
                to.value = from.value;
                from.value = tempToValue;
            }
        }
    }
</script>
<div class="page-header">
    <h2>
        Activity
    </h2>
</div>

<?php
$this->widget('booster.widgets.TbExtendedGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'fixedHeader' => false,
    'responsiveTable' => true,
    'type' => 'striped bordered condensed',
    'columns' => array(
        'id'=>array('name'=>'id','htmlOptions'=>array('style'=>'width:5%;'),'headerHtmlOptions'=>array('style'=>'width:5%;')),
        'users_id'=>array('name'=>'users_id','type'=>'raw','value'=> '$data->users->username'),
        'login' => array('name' => 'login',
            'value' => 'date("m/d/Y h:i:s A",$data->login)',
            'type' => 'raw',
            'sortable' => TRUE,
            'filter' => ($this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'id' => 'dateFrom',
                    'attribute' => 'dateFrom',
                    'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'From date'),
                    'options' => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeYear' => true
                    ),
                ), true)) . ($this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'id' => 'dateTo',
                    'attribute' => 'dateTo',
                    'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'To date'),
                    'options' => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeYear' => true
                    ),
                ), true)),
            'htmlOptions' => array('style' => 'bg-color:red;'),
            'headerHtmlOptions' => array('width' => '25%;')
        ),
        'logout' => array('name' => 'logout',
            'value' => '($data->logout != NULL)?date("m/d/Y h:i:s A",$data->logout):""',
            'type' => 'raw',
            'sortable' => TRUE,
            'filter' => ($this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'id' => 'dateFromO',
                    'attribute' => 'dateFromO',
                    'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'From date'),
                    'options' => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeYear' => true
                    ),
                ), true)) . ($this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'id' => 'dateToO',
                    'attribute' => 'dateToO',
                    'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'To date'),
                    'options' => array(
                        'dateFormat' => 'mm/dd/yy',

                        'changeYear' => true
                    ),
                ), true)),
            'htmlOptions' => array('style' => 'bg-color:red;'),
            'headerHtmlOptions' => array('width' => '25%;')
        ),
        array('header'=>'time',
            'type'=>'raw',
            'sortable'=>false,
            'filter'=>FALSE,
            'value'=>function($data, $row)
            {
                $time1 = new DateTime(date('m/d/Y h:i:s A',$data->login));
                $time2 = new DateTime(date('m/d/Y h:i:s A',$data->logout));
                $interval = $time2->diff($time1);
                return ($data->logout!=NULL)?$interval->format('%h hour(s) ').$interval->format('%i minute(s) ').$interval->format('%s second(s)'):"";
            }
        ),
    ),
    'afterAjaxUpdate' => 'function(id,data){
    	    jQuery("#dateTo").datepicker({
        	 dateFormat: "mm/dd/yy",
                 changeYear:true
    	    });
            jQuery("#dateFrom").datepicker({
        	 dateFormat: "mm/dd/yy",
                 changeYear:true
    	    });
           jQuery("#dateToO").datepicker({
        	 dateFormat: "mm/dd/yy",
                 changeYear:true
    	    });
            jQuery("#dateFromO").datepicker({
        	 dateFormat: "mm/dd/yy",
                 changeYear:true
    	    });
        }',
));