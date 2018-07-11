<?php
class TodoTag extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'todo_tags';

    /**
     * Soft delete
     *
     * @var bool
     */
    protected $softDelete = true;

    public static $unguarded = true;



    /**
     * get all tags
     *
     * @return araay
     */
    public static function getTags()
    {
        return self::select('id','todo_tag')->get();
    }
 
}
