<?php

/**
 * @property integer $entryId
 * @property integer $categoryId
 */
class CategoryHasEntry extends CActiveRecord
{

    /**
     * @param int $id
     * @return CategoryHasEntry
     */
    public function entryId($id)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => sprintf('%s.entryId = :entryId', $this->getTableAlias()),
            'params' => array(':entryId' => $id),
        ));

        return $this;
    }


    /**
     * @param string $className
     * @return CategoryHasEntry
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    /**
     * @return string
     */
    public function tableName()
    {
        return 'category_has_entry';
    }


    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('entryId, categoryId', 'required'),
            array('entryId, categoryId', 'numerical', 'integerOnly' => true),
        );
    }


    /**
     * @return array
     */
    public function relations()
    {
        return array();
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'entryId'    => 'Entry',
            'categoryId' => 'Category',
        );
    }

}