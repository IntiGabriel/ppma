<?php

/**
 * @property Entry[] $entries
 * @property string  $id
 * @property string  $name
 * @property User    $user
 * @property int     $userId
 */
class Tag extends CActiveRecord
{

    /**
     * @param string $className
     * @return CActiveRecord
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id'     => 'ID',
            'name'   => 'Name',
            'userId' => 'User ID'
        );
    }

    /**
     * @return void
     */
    public function afterDelete()
    {
        // remove Entry relations
        EntryHasTag::model()->deleteAllByAttributes(array('tagId' => $this->id));

        return parent::afterDelete();
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        $this->name   = trim($this->name);
        $this->userId = Yii::app()->user->id;

        return parent::beforeValidate();
    }

    /**
     * @return array
     */
    public function defaultScope()
    {
        return array(
            'order' => 'name ASC',
        );
    }

    /**
     * @return int
     */
    public function getEntryCounter()
    {
        return count($this->entries);
    }

    /**
     * Scope
     *
     * @param string $v
     * @return Tag
     */
    public function name($v)
    {
        $alias = $this->getTableAlias();

        $this->getDbCriteria()->mergeWith(array(
            'condition' => $alias . '.name=:tname',
            'params'    => array(':tname' => $v),
        ));

        return $this;
    }

    /**
     * @return array
     */
    public function relations()
    {
        return array(
            'entries' => array(self::MANY_MANY, 'Entry', 'EntryHasTag(tagId, entryId)'),
            'user'    => array(self::BELONGS_TO, 'User', 'userId'),
        );
    }

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max' => 255, 'skipOnError' => true),
            array('name', 'unique', 'criteria' => array('condition' => 'userId=' . Yii::app()->user->id), 'skipOnError' => true),
            
            array('userId', 'required'),
            array('userId', 'exist', 'className' => 'User', 'attributeName' => 'id'),
            array('userId', 'unsafe'),

            array('id, name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('userId', $this->userId, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return string
     */
    public function tableName()
    {
        return 'tag';
    }

    /**
     * Scope
     *
     * @param integer $id
     * @return Tag
     */
    public function userId($id)
    {
        $alias = $this->getTableAlias();

        $this->getDbCriteria()->mergeWith(array(
            'condition' => $alias . '.userId=:userId',
            'params'    => array(':userId' => $id),
        ));

        return $this;
    }

}