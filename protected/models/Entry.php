<?php

/**
 * @property string  $comment
 * @property string  $encryptedPassword
 * @property integer $id
 * @property string  $identifier
 * @property string  $name
 * @property string  $password
 * @property string  $tagList
 * @property Tag[]   $tags
 * @property string  $url
 * @property User    $user
 * @property integer $userId
 * @property string  $username
 * @property int     $viewCount
 *
 * @property Category[] $categories
 * @property int[] $categoryIds
 */
class Entry extends CActiveRecord
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
            'comment'     => 'Comment',
            'categories'  => 'Categories',
            'categoryIds' => 'Categories',
            'id'          => 'ID',
            'name'        => 'Name',
            'password'    => 'Password',
            'tagList'     => 'Tags',
            'url'         => 'URL',
            'userId'      => 'User',
            'username'    => 'Username',
            'viewCount'   => 'View Count'
        );
    }

    /**
     * @return void
     */
    public function afterDelete()
    {
        $this->deleteTags();
        $this->deleteCategories();
        return parent::afterDelete();
    }

    /**
     * @return void
     */
    public function deleteTags()
    {
        // runs only after delete and update
        if (in_array($this->scenario, array('update', 'delete')))
        {
            $relations = EntryHasTag::model()->entryId($this->id)->findAll();

            foreach ($relations as $relation)
            {
                $relation->delete();
            }
        }
    }

    /**
     * @return void
     */
    public function deleteCategories()
    {
        // runs only after delete and update
        if (in_array($this->scenario, array('update', 'delete')))
        {
            $relations = CategoryHasEntry::model()->entryId($this->id)->findAll();

            foreach ($relations as $relation)
            {
                /* @var CategoryHasEntry $relation */
                $relation->delete();
            }
        }
    }

    /**
     * @return void
     */
    public function afterSave()
    {
        // after update & create
        if (in_array($this->scenario, array('update', 'create')))
        {
            // delete all tag relations
            $this->deleteTags();

            // save tags and tag relations
            foreach ($this->tags as $tag)
            {
                // try to receive tag from db
                $model = Tag::model()->name( $tag->name )->userId( Yii::app()->user->id )->find();

                if (!is_object($model))
                {
                    $model = $tag;
                }

                // save tag
                $model->name = $tag->name;
                $model->save();

                // save relation
                $relation = new EntryHasTag();
                $relation->entryId = $this->id;
                $relation->tagId   = $model->id;
                $relation->save();
            }

            // delete all categories
            $this->deleteCategories();

            // save categories
            foreach ($this->categories as $category)
            {
                /* @var Category $category */
                $relation = new CategoryHasEntry();
                $relation->entryId    = $this->id;
                $relation->categoryId = $category->id;
                $relation->save();
            }

            return parent::afterSave();
        }
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        // if model a new record set userId
        if ($this->isNewRecord)
        {
            $this->userId = Yii::app()->user->id;
        }

        return parent::beforeValidate();
    }

    /**
     * @return array
     */
    public function getCategoryIds()
    {
        $ids = array();

        foreach ($this->categories as $category)
        {
            $ids[] = $category->id;
        }

        return $ids;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        if (strlen($this->encryptedPassword) == 0)
        {
            return '';
        }

        return Yii::app()->user->decrypt($this->encryptedPassword);
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        if (strlen($this->name) >  0)
        {
            return $this->name;
        }
        else
        {
            return 'Entry #' . $this->id;
        }
    }

    /**
     * @param boolean $asLinks
     * @return string
     */
    public function getTagList($asLinks = false)
    {
        if (count($this->tags) == 0)
        {
            return '';
        }

        $text = '';

        foreach ($this->tags as $tag)
        {
            if ($asLinks)
            {
                $text .= CHtml::link(CHtml::encode($tag->name), array('entry/index', 'Entry[tagList]' => $tag->name)) . ', ';
            }
            else
            {
                $text .= $tag->name . ', ';
            }
        }

        return substr(trim($text), 0, -1);
    }

    /**
     * @return array
     */
    public function relations()
    {
        return array(
            'user'       => array(self::BELONGS_TO, 'User', 'userId'),
            'tags'       => array(self::MANY_MANY, 'Tag', 'EntryHasTag(entryId, tagId)'),
            'categories' => array(self::MANY_MANY, 'Category', 'category_has_entry(entryId, categoryId)'),
        );
    }

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('comment', 'default', 'value' => NULL),

            array('categoryIds', 'safe'),

            array('id', 'safe', 'on'=>'search'),

            array('name', 'default', 'value' => NULL),
            array('name', 'length', 'max' => 255, 'skipOnError' => true),

            array('password', 'required'),
            array('password', 'length', 'max' => 255, 'skipOnError' => true),

            array('tagList', 'safe'),

            array('url', 'default', 'value' => NULL),
            array('url', 'length', 'max' => 255, 'skipOnError' => true),

            array('userId', 'required'),
            array('userId', 'numerical', 'integerOnly' => true, 'skipOnError' => true),

            array('username', 'default', 'value' => NULL),
            array('username', 'length', 'max' => 255, 'skipOnError' => true),

            array('viewCount', 'default', 'value' => 0),
            array('viewCount', 'numerical', 'integerOnly' => true),
            array('viewCount', 'unsafe'),
        );
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria();
        $alias    = $this->getTableAlias();

        // by search term
        if (Yii::app()->request->getParam('q') != null)
        {
            $term = Yii::app()->request->getParam('q');

            $criteria->distinct = true;
            $criteria->join = 'LEFT JOIN EntryHasTag AS eht ON eht.entryId=' . $alias  .'.id '
                            . 'LEFT JOIN category_has_entry AS che ON che.entryId=' . $alias  .'.id '
                            . 'LEFT JOIN Category ON Category.id=che.categoryId '
                            . 'LEFT JOIN Tag ON Tag.id=eht.tagId';

            $criteria->compare($alias . '.name', $term, true, 'OR');
            $criteria->compare($alias . '.url', $term, true, 'OR');
            $criteria->compare($alias . '.comment', $term, true, 'OR');
            $criteria->compare($alias . '.username', $term, true, 'OR');
            $criteria->compare('Tag.name', $term, true, 'OR');
            $criteria->compare('Category.name', $term, true, 'OR');
        }

        // by detail search
        else
        {
            $criteria->compare($alias . '.name', $this->name, true);
            $criteria->compare($alias . '.url', $this->url, true);
            $criteria->compare($alias . '.comment', $this->comment);
            $criteria->compare($alias . '.username', $this->username);

            if (strlen($this->tagList) > 0)
            {
                $c = new CDbCriteria();
                $c->join = 'INNER JOIN EntryHasTag AS eht ON eht.entryId=' . $alias . '.id '
                         . 'INNER JOIN Tag ON Tag.id=eht.tagId';
                $c->compare('Tag.name', $this->tagList);
                $criteria->mergeWith($c);
            }

            if (count($this->categoryIds) > 0)
            {
                $c = new CDbCriteria();
                $c->join = 'INNER JOIN category_has_entry AS che ON che.entryId=' . $alias . '.id '
                    . 'INNER JOIN Category ON Category.id=che.categoryId';
                $c->addInCondition('Category.id', $this->categoryIds);
                $criteria->mergeWith($c);
            }
        }

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @param string $v
     * @return void
     */
    public function setPassword($v)
    {
        if (strlen($v) > 0)
        {
            $this->encryptedPassword = Yii::app()->user->encrypt($v);
        }
        else
        {
            $this->encryptedPassword = '';
        }
    }

    /**
     * @param int[] $v
     */
    public function setCategoryIds($v)
    {
        if (is_array($v))
        {
            foreach ($v as $id)
            {
                $category = Category::model()->findByPk($id);

                if ($category instanceof Category)
                {
                    $this->categories = array_merge($this->categories, array($category));
                }
            }
        }
    }

    /**
     * @param string $v
     * @return void
     */
    public function setTagList($v)
    {
        $tags  = array();
        $names = explode(',', $v);

        foreach ($names as $name)
        {
            $name = trim($name);

            if (strlen($name) > 0)
            {
                $tag       = new Tag();
                $tag->name = $name;
                $tags[]    = $tag;
            }
        }

        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function tableName()
    {
        return 'entry';
    }

    /**
     * @return void
     */
    public function incrementViewCounter()
    {
        $oldScenario = $this->scenario;
        $this->scenario = 'incrementCounter';
        $this->viewCount++;
        $this->save(true, array('viewCount'));
        $this->scenario = $oldScenario;

    }

}
