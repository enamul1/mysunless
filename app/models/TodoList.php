<?php
class TodoList extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'todo_list';

    /**
     * Soft delete
     *
     * @var bool
     */
    protected $softDelete = true;

    public static $unguarded = true;

	
    /**
     * validate user input
     *
     * @param array $input
     * @return \Illuminate\Validation\Validator
     */
    public static function validator(array $input, $update=false, $changePassword=false)
    {
    	
    	$rules = array(
    			'title' =>  'required',
    			'description' =>  'required',
    			'due_date'	=> 'required'
    	);
    	return Validator::make($input, $rules);
    }
    

    /**
     * add todo
     *
     * @return araay
     */
    public static function add($data)
    {
    	$customerID = Auth::user()->ID;
    	$data['customer_id'] = $customerID;
    	if(isset($data['tags'])) {
    		$tags = implode(',', $data['tags']);
    		$data['tags'] = $tags;
    	}
    	$data['due_date'] = date("Y-m-d", strtotime($data['due_date']));
    	$data['status'] = 1;
   	 	return self::create($data);
    }
    
    public static function getTasksByCustomerId()
    {
    	$customerID = Auth::user()->ID;
    	$tasks = \DB::select(DB::raw("SELECT `id`,  `title`, `description`, `due_date`, `tags` FROM `todo_list` WHERE customer_id = $customerID AND status != 2 AND deleted_at IS NULL ORDER BY due_date DESC"));
    	foreach($tasks as $task) {
    		if($task->tags !='') {
    			$tagsArr = array();
    			$tags = \DB::select(DB::raw("SELECT `todo_tag` FROM `todo_tags` WHERE id IN ($task->tags)"));
    			foreach ($tags as $tag) {
    				$tagsArr[] = $tag->todo_tag;
    			}
    			$task->tags = $tagsArr;
    		}
    		$task->due_date = date('m/d/Y', strtotime($task->due_date));
    	}
    	
    	return $tasks;
    }
    
    public static function getTasksByTaskId($taskId)
    {
    	$customerID = Auth::user()->ID;
    	$tasks = \DB::select(DB::raw("SELECT `id`,  `title`, `description`, `due_date`, `tags` FROM `todo_list` WHERE customer_id = $customerID AND id = $taskId AND deleted_at is NULL"));
    	foreach($tasks as $task) {
    		if($task->tags !='') {
    			$tagsArr = '';
    			$tags = \DB::select(DB::raw("SELECT `todo_tag` FROM `todo_tags` WHERE id IN ($task->tags)"));
    			foreach ($tags as $tag) {
    				$tagsArr .= ' '.$tag->todo_tag;
    			}
    			$task->tags = $tagsArr;
    		}
    		$task->due_date = date('m/d/Y', strtotime($task->due_date));
    	}
    	 
    	return $tasks;
    }
 
}
