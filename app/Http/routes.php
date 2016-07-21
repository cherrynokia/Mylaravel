<?php
use App\Task;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
//    return view('welcome');
    $dbTask = Task::orderBy("created_at", "asc")->get();//從資料庫撈出來的資料(陣列) 屬於ORM物件
    
    return view("tasks",["taskSets"=>$dbTask]);
});

Route::get('/task', function () {
    return "網址列輸入ㄉ網址";
});


//接收表單,來增加新的任務  $request適從瀏覽器ㄉ表單來  $task->name 是資料庫的欄位 SAVE儲存在資料庫
 //驗証 tasks.blade.php 傳來資料
Route::post('/task', function (Request $request){
    
    $validator = Validator::make($request->all(),
                                 ["name"=>"required|max:2"]
                                 );
     if($validator->fails())
    {
        return redirect("/")
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();
    return redirect("/");
});

//刪除任務
Route::delete('/task/{task}', function (Task $task) {
    //
});



