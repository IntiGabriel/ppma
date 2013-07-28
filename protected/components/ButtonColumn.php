<?php

class ButtonColumn extends CButtonColumn
{

    /**
     * @var bool|string
     */
    public $deleteButtonImageUrl = false;

    /**
     * @var string
     */
    public $deleteButtonLabel = '<i class="icon-remove"></i>';

    /**
     * @var array
     */
    public $deleteButtonOptions = array('title' => 'Delete');

    /**
     * @var string
     */
    public $deleteButtonUrl = 'array("delete", "id" => $data->id)';

    /**
     * @var string
     */
    public $template = '{view}{update}{delete}';

    /**
     * @var bool|string
     */
    public $updateButtonImageUrl = false;

    /**
     * @var string
     */
    public $updateButtonLabel = '<i class="icon-edit"></i>';

    /**
     * @var array
     */
    public $updateButtonOptions = array( 'title' => 'Update');

    /**
     * @var string
     */
    public $updateButtonUrl = 'array("update", "id" => $data->id)';

    /**
     * @var bool|string
     */
    public $viewButtonImageUrl = false;

    /**
     * @var array
     */
    public $viewButtonOptions = array('title' => 'View');

    /**
     * @var string
     */
    public $viewButtonLabel = '<i class="icon-eye-open"></i>';

    /**
     * @var string
     */
    public $viewButtonUrl = 'array("update", "id" => $data->id)';

}
