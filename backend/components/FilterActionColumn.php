<?php

namespace backend\components;

use yii\grid\ActionColumn;
use yii\helpers\Html;

/**
 * FilterActionColumn adds a filter property to ActionColumn to allow rendering content in the filter cell.
 */
class FilterActionColumn extends ActionColumn
{
    /**
     * @var string|array|null the HTML code representing the filter content (e.g. a search button).
     */
    public $filter;

    /**
     * {@inheritdoc}
     */
    protected function renderFilterCellContent()
    {
        if ($this->filter !== null && $this->filter !== false) {
            return $this->filter;
        }

        return parent::renderFilterCellContent();
    }
}
