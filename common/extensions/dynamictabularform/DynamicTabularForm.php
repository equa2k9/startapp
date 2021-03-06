<?php

Yii::import('booster.widgets.TbActiveForm');

/**
 * Allows the user to create tabular forms with a javascript "+" button
 * uses partial views for each row
 *
 * @author Ezekiel Fernandez <ezekiel_p_fernandez@yahoo.com>
 */
class DynamicTabularForm extends TbActiveForm
{

    const UPDATE_TYPE_CREATE = 'create';
    const UPDATE_TYPE_DELETE = 'delete';
    const UPDATE_TYPE_UPDATE = 'update';

    /**
     *
     * @var string url of the ajax render partial
     */
    public $rowUrl;

    /**
     *
     * @var string view file that is going to be used for initialization
     */
    public $defaultRowView = '_rowForm';
    public $rowViewCounter = 0;

    public function init()
    {
        parent::init();
        if ($this->rowUrl == null)
            $this->rowUrl = $this->controller->createUrl('getRowForm');
    }

    /**
     * generates the Initial row and the "+" button
     * @param array $models the array of models that will be used
     * @param array $htmlOptions
     */
    public function updateTypeField($model, $key, $attribute, $htmlOptions = array())
    {
        if ($model->isNewRecord)
            $model->{$attribute} = self::UPDATE_TYPE_CREATE;
        else
            $model->{$attribute} = self::UPDATE_TYPE_UPDATE;

        $htmlOptions = array_merge($htmlOptions, array('id' => get_class($model) . '_updateType_' . $htmlOptions['key']));

        return parent::hiddenField($model, "[$key]" . $attribute, $htmlOptions);
    }

    /**
     * @param CModel[] $models
     * @param array $htmlOptions
     */
    public function rowForm($models = array(), $rowView = null, $htmlOptions = array())
    {
        if ($rowView == null)
            $rowView = $this->defaultRowView;

        $htmlOptions = array_merge(array('id' => 'row-' . $this->rowViewCounter), $htmlOptions);
        $id = $htmlOptions['id'];

        echo CHtml::openTag('div', $htmlOptions);

        foreach ($models as $key => $model)
        {
            $this->controller->renderPartial($rowView, array('key' => $key, 'model' => $model, 'form' => $this));
        }
        

        echo "</div>";
        echo "<div class='row'>";
        $buttonId = 'addButton-' . $this->rowViewCounter;
        $this->widget(
                'bootstrap.widgets.TbButton', array(
            'label' => '+',
            'context' => 'info',
            'htmlOptions' => array(
                'id' => $buttonId,
            )
                )
        );
        echo "</div>";
        $cs = Yii::app()->clientScript;

        echo '<script>
        function getPassengers(key,passengers_id)
        {
            var clients_id = {};
            clients_id[key] = $("#TripsPassengers_"+key+"_clients_id").val();
                $.ajax({
                    url: "' . Yii::app()->controller->createUrl("getPassengers") . '",
                    data: "clients_id=" + clients_id[key],
                    type: "POST",
                    success: function (data) 
                    {
                        $("#TripsPassengers_"+key+"_passengers_id").html(data);
                        if(passengers_id!=0)
                        {
                            $("#TripsPassengers_"+key+"_passengers_id").prop("value", passengers_id);
                        }
                    }
                    });
        }
        </script>';
        $cs->registerScript("DynamicForm", "
            var counter = " . sizeof($models) . ";
            function addRow(){
                counter = counter + 1;
                $.ajax({
                    url:'" . $this->rowUrl . "',
                    data:{
                        key:counter,
                    },
                    success:function(data){appendRow(data);
                    initialize(counter);
                    },
                });

            }
            function appendRow(html){
               $('#" . $id . "').append(html);
               $('.delete-row-button').on('click',deleteRow);

            }
            //for adding rows
            $('#" . $buttonId . "').click(function(e){addRow()});

            //for deleting rows
            $('.delete-row-button').on('click',deleteRow);
            function deleteRow(e){
                var key = $(this).attr('data-key');
                var row_id = $(this).attr('data-delete');
                var updateTypeField = $('#'+ '" . get_class($model) . '_updateType_' . "'+key);

                //this indicates that the row is a new entry and therefore can be removed
                //immediately from the HTML body
                if(updateTypeField.val() == '" . self::UPDATE_TYPE_CREATE . "'){
                    $('#'+row_id).remove();
                }
                //this indicates that the row is to be deleted here in the HTML
                // body and also from the database and therefore we will temporarily
                //hide the row and change the update type to delete to determine
                //what items in the controller are to be deleted
                else{
                    updateTypeField.val('" . self::UPDATE_TYPE_DELETE . "');
                    $('#'+row_id).hide();
                    }

            }

        ");

        $this->rowViewCounter = $this->rowViewCounter + 1;
    }

    public function deleteRowButton($row_id, $key, $label = 'X', $htmlOptions = array())
    {
        if (array_key_exists('class', $htmlOptions))
            $htmlOptions['class'] = $htmlOptions['class'] . ' ' . 'delete-row-button';
        else
            $htmlOptions = array_merge($htmlOptions, array('class' => 'delete-row-button'));

        $htmlOptions = array_merge($htmlOptions, array('data-delete' => $row_id, 'data-key' => $key));

//        echo CHtml::button($label, $htmlOptions);
        $this->widget(
                'bootstrap.widgets.TbButton', array(
            'label' => $label,
            'context' => 'danger',
            'htmlOptions' => $htmlOptions
                )
        );
    }

}

?>
