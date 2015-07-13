<?php

Yii::import('zii.widgets.CListView');

class ExtendedCListView extends CListView
{

    public $class = 'active';

    /**
     * render buttons to style clistviewitems, like square or list
     */
    public function renderItemstyle()
    {

        
        $class = '';
        if (Yii::app()->session->get('view', 'list') == 'list')
        {
            $class = $this->class;
        }
        echo CHtml::ajaxLink(
                '<i class="prod_cards_style"></i>', Yii::app()->createUrl('ajax/changeView'), array(
            'data' => array('type' => 'list'),
            'method' => 'POST',
            'complete' => 'function() {
          $.fn.yiiListView.update("catalog-products");
          $("#list").addClass("active");
          $("#square").removeClass("active");
        }'),array('class'=>$class,'id'=>'list')
        );

        $class = '';
        if (Yii::app()->session->get('view', 'list') == 'square')
        {
            $class = $this->class;
        }
        echo CHtml::ajaxLink(
                '<i class="prod_list_style"></i>', Yii::app()->createUrl('ajax/changeView'), array(
            'data' => array('type' => 'square'),
            'method' => 'POST',
            'complete' => 'function() {
          $.fn.yiiListView.update("catalog-products");
          $("#square").addClass("active");
          $("#list").removeClass("active");
        }'),array('class'=>$class,'id'=>'square')
        );
       
    }

    /**
     * Renders the empty message when there is no data.
     */
    public function renderEmptyText()
    {
        $emptyText = $this->emptyText === null ? Yii::t('zii', 'No results found.') : $this->emptyText;
        
        echo CHtml::tag($this->emptyTagName, array('class' => $this->emptyCssClass), $emptyText);
        
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
