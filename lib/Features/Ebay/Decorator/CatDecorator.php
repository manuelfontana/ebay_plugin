<?php
/**
 * Created by PhpStorm.
 * User: fregini
 * Date: 1/30/16
 * Time: 8:33 AM
 */

namespace Features\Ebay\Decorator;

use AbstractDecorator;
use Constants_TranslationStatus;
use Features\Ebay\Utils\Routes;


class CatDecorator extends \AbstractDecorator {

    /**
     * @var \catController
     */
    protected $controller;

    protected $statuses;

    protected $metadata ;

    /**
     * @var \PHPTALWithAppend
     */
    protected $template ;

    public function decorate() {

        $this->template->append('footer_js', Routes::staticBuild('ebay.js') );

        $this->metadata = $this->controller->getJob()->getProject()->getMetadataAsKeyValue();
        $this->statuses = new SegmentStatuses(
                $this->controller->getJob()->getProject()
        );

        $this->template->searchable_statuses = $this->statuses->getSearchableStatuses();
        $this->template->project_type = $this->metadata['project_type'];

        $this->template->status_labels = json_encode( $this->statuses->getLabelsMap() );

    }

}
