<div class="bread navbar navbar-default" >
    <div class="container">
        <div class="row" id="title">
            <div class="col-md-10 col-xs-8">
                <h3 class="text-muted">
                    <?php
                    $this->widget(
                            'zii.widgets.CBreadcrumbs', array(
                        'homeLink' => false,
                        'links' => $this->breadcrumbs,
                        'htmlOptions' => array(),
                            )
                    );
                    ?>
                </h3>
            </div>
            <div class='col-md-2 col-xs-4 text-right' id="language-select">
               <?php $this->widget('LanguageSwitcherWidget')?>
                </div>
        </div>
    </div>
</div>