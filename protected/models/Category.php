<?php

/**
 * This is the model class for table "Category".
 *
 * The followings are the available columns in table 'Category':
 * @property integer $id
 * @property integer $parentId
 * @property string  $name
 *
 * @property Category[] $childs
 * @property Category   $parent
 * @property-read string $parentName
 */
class Category extends CActiveRecord
{

    const NO_PARENT_STRING = 'no parent category';


    /**
     * ON DELETE CASCADE
     */
    protected  function afterDelete()
    {
        foreach ($this->childs as $child)
        {
            $child->delete();
        }

        parent::afterDelete();
    }


    /**
     * @return bool
     */
    protected function beforeSave()
    {
        if ($this->parent instanceof Category)
        {
            $this->parentId = $this->parent->id;
        }

        return parent::beforeSave();
    }


    /**
     * @return string
     */
    public function getParentName()
    {
        if ($this->parent instanceof Category)
        {
            return $this->parent->name;
        }
        else
        {
            return self::NO_PARENT_STRING;
        }
    }


    /**
     * @param string $className
     * @return CActiveRecord
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
        return 'category';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('parentId', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('parentId', 'exist', 'className' => 'Category', 'attributeName' => 'id', 'skipOnError' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, parentId, name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array
     */
    public function relations()
    {
        return array(
            'childs'  => array(self::HAS_MANY, 'Category', 'parentId'),
            'parent'  => array(self::BELONGS_TO, 'Category', 'parentId'),
            'entries' => array(self::MANY_MANY, 'Category', 'category_has_entry(categoryId, entryId)'),
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id'       => 'ID',
            'parentId' => 'Parent Category',
            'name'     => 'Name',
        );
    }


    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('parentId', $this->parentId);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    /**
     * @return array
     */
    public function scopes()
    {
        $alias = $this->getTableAlias();

        return array(
            'onlyRootLevel' => array(
                'condition' => $alias . '.parentId IS NULL',
            ),
            'orderByNameAsc' => array(
                'order' => $alias . '.name ASC',
            ),
        );
    }


    /**
     * @param int $id
     * @return Category
     */
    public function without($id)
    {
        if ($id === null)
        {
            return $this;
        }

        $this->getDbCriteria()->mergeWith(array(
            'condition' => sprintf('%s.id != :id', $this->getTableAlias()),
            'params'    => array(':id' => $id),
        ));

        return $this;
    }

}