<?php

Yii::import('zii.widgets.CListView');

class ExtendedCListView extends CListView
{

    public $class = 'btn-info';
    
    /**
     * render buttons to style clistviewitems, like square or list
     */
    public function renderItemstyle()
    {
        
        echo '<div class="btn-group">';
        $class = '';
        if (Yii::app()->session->get('view', 'list') == 'list')
        {
            $class = $this->class;
        }
        echo CHtml::ajaxLink(
                '<button type="button" class="btn btn-default ' . $class . '" id="list"><i class="fa fa-bars"></i></button>', Yii::app()->createUrl('ajax/changeView'), array(
            'data' => array('type' => 'list'),
            'method' => 'POST',
            'complete' => 'function() {
          $.fn.yiiListView.update("catalog-products");
          $("#list").addClass("btn-info");
          $("#square").removeClass("btn-info");
        }')
        );
        
        $class = '';
        if (Yii::app()->session->get('view', 'list') == 'square')
        {
            $class = $this->class;
        }
        echo CHtml::ajaxLink(
                '<button type="button" class="btn btn-default ' . $class . '" id="square"><i class="fa fa-th"></i></button>', Yii::app()->createUrl('ajax/changeView'), array(
            'data' => array('type' => 'square'),
            'method' => 'POST',
            'complete' => 'function() {
          $.fn.yiiListView.update("catalog-products");
          $("#square").addClass("btn-info");
          $("#list").removeClass("btn-info");
        }')
        );
        echo '</div>';
    }
    /**
	 * Renders the empty message when there is no data.
	 */
	public function renderEmptyText()
	{
		$emptyText=$this->emptyText===null ? Yii::t('zii','No results found.') : $this->emptyText;
                if(Yii::app()->session->get('view', 'list') == 'list')
                {
                    echo '<div class="row">';
                }
		echo CHtml::tag($this->emptyTagName, array('class'=>$this->emptyCssClass), 
                        '<div class="alert alert-dismissable alert-warning">'.$emptyText.'</div>');
                if(Yii::app()->session->get('view', 'list') == 'list')
                {
                    echo '</div>';
                }
	}
    
//    /**
//	 * Renders the sorter.
//	 */
//	public function renderSorter()
//	{
//		if($this->dataProvider->getItemCount()<=0 || !$this->enableSorting || empty($this->sortableAttributes))
//			return;
//		
//                echo '<a class="dropdown-toggle" data-toggle="dropdown"><button type="button" class="btn btn-default">';
//		echo $this->sorterHeader===null ? Yii::t('zii','Sort by: ') : $this->sorterHeader;
//                echo '</button></a>'."\n";
//		echo '<ul class="dropdown-menu">'."\n";
//		$sort=$this->dataProvider->getSort();
//		foreach($this->sortableAttributes as $name=>$label)
//		{
//			echo "<li>";
//			if(is_integer($name))
//				echo $sort->link($label);
//			else
//				echo $sort->link($name,$label);
//			echo "</li>\n";
//		}
//		echo "</ul>";
//		echo $this->sorterFooter;
//
//
//	}

}
