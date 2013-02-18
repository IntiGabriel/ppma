<?php

/**
 * @property array $categories
 */
class CategoryTest extends CDbTestCase
{

    public $fixtures = array(
        'categories' => 'Category',
    );


    public function testSave()
    {
        // no values
        $model = new Category();
        $this->assertFalse($model->save());

        // mass assignment
        $model->attributes = array(
            'id'       => 4,
            'name'     => 'name1',
            'parentId' => null,
        );
        $this->assertNull($model->id);
        $this->assertNull($model->parentId);
        $this->assertEquals('name1', $model->name);

        // categories
        $model = new Category();
        $model->parentId = 1321;
        $this->assertFalse($model->validate(array('parentId')));
        $model->parentId = null;
        $this->assertTrue($model->validate(array('parentId')));

        // name
        $this->assertFalse($model->validate('name'));
        $model->name = 'blblblbl';
        $this->assertTrue($model->validate(array('name')));

        // save
        $this->assertTrue($model->save());

        // save valid category-relation
        $model2 = new Category();
        $model2->parentId = $model->id;
        $model2->name     = $model->name . 2;
        $this->assertTrue($model2->save());
        $model2 = Category::model()->findByPk($model2->id);
        $this->assertEquals($model->id, $model2->parent->id);

        $model3 = new Category();
        $model3->parent = $model;
        $model3->name   = $model->name . 3;
        $this->assertTrue($model3->save());
        $model3 = Category::model()->findByPk($model3->id);
        $this->assertEquals($model->id, $model3->parent->id);
    }


    public function testDelete()
    {
        $id = $this->categories['cat2']['id'];

        $model = Category::model()->findByPk($id);
        $this->assertTrue($model->delete());

        $model = Category::model()->findByPk($id);
        $this->assertNull($model);

        // ON DELETE CASCADE
        $model = Category::model()->findByPk($this->categories['cat1']['id']);
        $this->assertTrue($model->delete());

        $model = Category::model()->findByPk($this->categories['cat1-1']['id']);
        $this->assertNull($model);
    }

}
