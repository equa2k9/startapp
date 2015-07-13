<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::import('booster.widgets.TbMenu');

class ExtendedMenu extends TbMenu
{       
   
        protected function renderMenu($items) {
		
		$n = count($items);

		if ($n > 0) {
                    
			echo CHtml::openTag('ul') . "\n";

			$count = 0;
			foreach ($items as $item) {
				$count++;

				if (isset($item['divider'])) {
					echo "<li class=\"{$this->getDividerCssClass()}\"></li>\n";
				} else {
					$options = isset($item['itemOptions']) ? $item['itemOptions'] : array();
					$classes = array();

					if ($item['active'] && $this->activeCssClass != '') {
						$classes[] = $this->activeCssClass;
					}

					if ($count === 1 && $this->firstItemCssClass !== null) {
						$classes[] = $this->firstItemCssClass;
					}

					if ($count === $n && $this->lastItemCssClass !== null) {
						$classes[] = $this->lastItemCssClass;
					}

					if ($this->itemCssClass !== null) {
						$classes[] = $this->itemCssClass;
					}

					if (isset($item['items'])) {
						$classes[] = $this->getDropdownCssClass();
					}

					if (isset($item['disabled'])) {
						$classes[] = 'disabled';
					}

					if (!empty($classes)) {
						$classes = implode(' ', $classes);
						if (!empty($options['class'])) {
							$options['class'] .= ' ' . $classes;
						} else {
							$options['class'] = $classes;
						}
					}

					echo CHtml::openTag('li', $options) . "\n";

					$menu = $this->renderMenuItem($item);

					if (isset($this->itemTemplate) || isset($item['template'])) {
						$template = isset($item['template']) ? $item['template'] : $this->itemTemplate;
						echo strtr($template, array('{menu}' => $menu));
					} else {
						echo $menu;
					}

					if (isset($item['items']) && !empty($item['items'])) {
						$dropdownOptions = array(
							'encodeLabel' => $this->encodeLabel,
							'htmlOptions' => isset($item['submenuOptions']) ? $item['submenuOptions']
								: $this->submenuHtmlOptions,
							'items' => $item['items'],
						);
						$dropdownOptions['id'] = isset($dropdownOptions['htmlOptions']['id']) ? 
							$dropdownOptions['htmlOptions']['id'] : null;
						$this->controller->widget('booster.widgets.TbDropdown', $dropdownOptions);
					}

					echo "</li>\n";
				}
			}

			echo "</ul>\n";
		}
	}
}
