<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminOperatingScheduleController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "operating_schedule";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Branch Id","name"=>"branch_id","join"=>"branch,branch_name"];
			$this->col[] = ["label"=>"Day","name"=>"day"];
			$this->col[] = ["label"=>"Time","name"=>"time"];
			$this->col[] = ["label"=>"Status","name"=>"status"];
			$this->col[] = ["label"=>"Created By","name"=>"created_by"];
			$this->col[] = ["label"=>"Updated By","name"=>"updated_by"];
			$this->col[] = ["label"=>"Created At","name"=>"created_at"];
			$this->col[] = ["label"=>"Updated At","name"=>"updated_at"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = []; 
			if(in_array(CRUDBooster::getCurrentMethod(), ['getAdd','postAddSave']))
			{
			    $this->form[] = ['label'=>'Branch','name'=>'branch_id','type'=>'select2','validation'=>'required|min:1|max:255','datatable'=>'branch,branch_name','datatable_where'=>"branch_status='ACTIVE'",'width'=>'col-sm-6'];
                $this->form[] = ['label'=>'Day','name'=>'day','type'=>'select','validation'=>'required','width'=>'col-sm-6','dataenum'=>'Sunday;Monday;Tuesday;Wednesday;Thursday;Friday;Saturday'];
			    $this->form[] = ['label'=>'Time','name'=>'time','type'=>'time','validation'=>'required','width'=>'col-sm-6'];
			    $this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required','width'=>'col-sm-6','dataenum'=>'ACTIVE;INACTIVE'];
			}else{
			    $this->form[] = ['label'=>'Branch','name'=>'branch_id','type'=>'hidden','width'=>'col-sm-6'];
			    $this->form[] = ['label'=>'Branch','name'=>'branch_id','type'=>'select2','disabled' => true,'validation'=>'required|min:1|max:255','datatable'=>'branch,branch_name','datatable_where'=>"branch_status='ACTIVE'",'width'=>'col-sm-6'];
                $this->form[] = ['label'=>'Day','name'=>'day','type'=>'text','readonly' => true,'validation'=>'required','width'=>'col-sm-6'];
			    $this->form[] = ['label'=>'Time','name'=>'time','type'=>'text','readonly' => true,'validation'=>'required','width'=>'col-sm-6'];
			    $this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required','width'=>'col-sm-6','dataenum'=>'ACTIVE;INACTIVE'];
			}
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Branch Id","name"=>"branch_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"branch,branch_name"];
			//$this->form[] = ["label"=>"Days","name"=>"days","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Start Time","name"=>"start_time","type"=>"time","required"=>TRUE,"validation"=>"required|date_format:H:i:s"];
			//$this->form[] = ["label"=>"End Time","name"=>"end_time","type"=>"time","required"=>TRUE,"validation"=>"required|date_format:H:i:s"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Created By","name"=>"created_by","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Updated By","name"=>"updated_by","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();

	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();

	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();
	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();

	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();

	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;

            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	        $query->orderBy('operating_schedule.branch_id')->orderBy('operating_schedule.day')->orderBy('operating_schedule.time'); 
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
			if($column_index == 4){
				if($column_value == 'INACTIVE'){
					$column_value = '<span style="color: #F93154"><strong>'.$column_value.'</strong></span>';
				}elseif($column_value == 'ACTIVE'){
					$column_value = '<span style="color: #00B74A"><strong>'.$column_value.'</strong></span>';
				}
			}
			
			if($column_index == 5 || $column_index == 6){
				$name = DB::table('cms_users')->where('id',$column_value)->value('name');
				$column_value = $name;
			}
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here
			$schedule = DB::table('operating_schedule')->where('branch_id',$postdata['branch_id'])->where('day',$postdata['day'])->where('time',$postdata['time'])->get();
	        if(0 != count($schedule)){
	            CRUDBooster::redirectBack("Please fill out the form correctly : The time and date has already been taken.","warning");
	        }
	        $postdata['created_by'] = CRUDBooster::myId();
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) 
	    {       
	       // //Your code here
	        $schedule = DB::table('operating_schedule')->where('id',$id)->first();   
	        if(!empty($schedule)){
	            DB::connection('mysql2')->table(env('DB_DATABASE_FRONT_END').'.operating_schedule')->insert([
              	    'id'         => $id,
    			    'branch_id'  => $schedule->branch_id,
    			    'day'        => $schedule->day,
    			    'time'       => $schedule->time,
    			    'status'     => $schedule->status,
    			    'created_by' => CRUDBooster::myId()
    		    ]);
	        }
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) 
	    {        
	        //Your code here
	        $schedule = DB::table('operating_schedule')->where('branch_id',$postdata['branch_id'])->where('day',$postdata['day'])->where('time',$postdata['time'])->get();
	        if(1 >= count($schedule))
	        {
	           	DB::connection('mysql2')->table(env('DB_DATABASE_FRONT_END').'.operating_schedule')->where('id',$id)->update([
    			    'branch_id'  => $postdata['branch_id'],
    			    'day'        => $postdata['day'],
    			    'time'       => $postdata['time'],
    			    'status'     => $postdata['status'],
    			    'updated_by' => CRUDBooster::myId(),
    			    'updated_at' => $postdata['updated_at']
    		    ]);
		    
		        $postdata['updated_by'] = CRUDBooster::myId();
		        
	        }else{
	            CRUDBooster::redirectBack("Please fill out the form correctly : The time and date has already been taken.","warning");
	        }
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here
            DB::connection('mysql2')->table(env('DB_DATABASE_FRONT_END').'.operating_schedule')->where('id',$id)->delete();
	    }



	    //By the way, you can still create your own method in here... :) 


	}