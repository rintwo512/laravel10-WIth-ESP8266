<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ACController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\chartACController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\enerTrackController;
use App\Http\Controllers\UserSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// LOGIN
Route::get('/auth', [LoginController::class, "index"]);
Route::post('/auth', [LoginController::class, 'postLogin']);
Route::post('/logout/{id}', [LoginController::class, 'logout']);


// HOME
Route::get('/home', [HomeController::class, "index"]);


// DATA AC
Route::get('/ac', [ACController::class, "index"]);
Route::get('/ac/delete/{id}', [ACController::class, 'destroy'])->name('delete')->middleware('auth');
Route::delete('/selectedac', [ACController::class, 'deleteCheckedAc'])->name('ac.deleteSelected')->middleware('auth');
Route::get('/ac/trash', [ACController::class, 'trash'])->middleware('auth');
Route::get('/ac/trash/deleteAll', [AcController::class, 'deleteAll'])->middleware('auth');
Route::delete('ac/trash/{id}', [ACController::class, 'restore'])->middleware('auth');
Route::get('/ac/update/{id}', [ACController::class, 'show'])->middleware('auth');
Route::post('/ac/update/{id}', [ACController::class, 'update'])->middleware('auth');
Route::get('/ac/range/{nilai}', [ACController::class, 'queryRangeAc'])->middleware('auth');
Route::get('/ac/dataacbaru/{data}', [ACController::class, 'queryDataAcBaru'])->middleware('auth');
Route::get('/ac/datadetailacbaru/{id}', [ACController::class, 'dataDetailAcBaru'])->middleware('auth');
Route::get('/ac/create', [ACController::class, 'create'])->middleware('auth');
Route::post('/ac/create', [ACController::class, 'store'])->middleware('auth');
Route::get('/ac/export', [ACController::class, 'exportDataAc'])->middleware('auth');
Route::get('/ac/listmainten', [ACController::class, 'listMainten'])->middleware('auth');



// CHART
Route::post('/chart', [HomeController::class, 'getChart'])->middleware('auth');
Route::get('/chart/search', [chartACController::class, "index"]);
Route::post('/chart/create', [chartACController::class, 'tambahDataChart']);
Route::delete('/chart/delete/{id}', [chartACController::class, 'deleteDataChartAc'])->middleware('auth');
Route::post('chart/update', [chartACController::class, 'updateDataChart']);


// MEMBERS
Route::resource('/members', MembersController::class);


// USER SETTING
Route::resource('/usersetting', UserSettingController::class);
Route::post('/usersetting/changepassword/{id}', [UserSettingController::class, "updatePass"]);


//TOOLS
Route::get('/tools/cosine', [ToolsController::class, "cosine"]);
Route::get('/tools/ampertova', [ToolsController::class, "ampertova"]);
Route::get('/tools/watttoamper', [ToolsController::class, "wattToAmper"]);
Route::get('/tools/ampertowatt', [ToolsController::class, "amperTowatt"]);
Route::get('/tools/watttova', [ToolsController::class, "wattTova"]);
Route::get('/tools/kalkulatorenergi', [ToolsController::class, "kalkulatorEnergi"]);
Route::get('/tools/ohmlaw', [ToolsController::class, "ohmLaw"]);
Route::get('/tools/voltdivider', [ToolsController::class, "voltDivider"]);
Route::get('/tools/celfah', [ToolsController::class, "celFah"]);
Route::get('/tools/btuTopk', [ToolsController::class, "btuTopk"]);
Route::get('/tools/wattTobtu', [ToolsController::class, "wattTobtu"]);
Route::get('/tools/btuTowatt', [ToolsController::class, "btuTowatt"]);
Route::get('/tools/wattTokwh', [ToolsController::class, "wattTokwh"]);
Route::get('/tools/joulesTowatt', [ToolsController::class, "joulesTowatt"]);
Route::get('/tools/scrapeLinks', [ToolsController::class, "scrapeLinks"]);
Route::post('/tools/getLinks', [ToolsController::class, "getLinks"]);
Route::get('/tools/json', [ToolsController::class, "json"]);
Route::get('/tools/json2', [ToolsController::class, "json2"]);
Route::get('/tools/colorpick', [ToolsController::class, "colorPick"]);
Route::get('/tools/cropimage', [ToolsController::class, "cropImage"]);
Route::get('/tools/rgbcolor', [ToolsController::class, "rgbColor"]);
Route::get('/tools/jwt', [ToolsController::class, "jwt"]);


// MENU MANAGEMENT
Route::get('/members/{user}/menus', [MenuController::class, 'editMenus'])->name('members.menus');
Route::post('/members/{user}/menus', [MenuController::class, 'updateMenus'])->name('members.update-menus');

// ENERTRACK
Route::get('/enertrack/monitor', [enerTrackController::class, "monitor"]);
Route::get('/enertrack/test', [enerTrackController::class, "test"]);
Route::get('/enertrack/update/{suhu}/{kelembapan}', [enerTrackController::class, 'update']);

Route::get('/enertrack/control', [ControlController::class, "index"]);
Route::post('/enertrack/update-suhudown', [ControlController::class, 'updateSuhudown'])->name('control.updateSuhudown');
Route::get('/enertrack/control/{status}', [ControlController::class, "sendStatus"]);
Route::get('/control/suhu', [ControlController::class, "sendSuhuToMCU"]);
// Route::get('/enertrack/bacarelay', [ControlController::class, "updateData"]);


// CHATBOT
Route::get('/chatbot', [ChatBotController::class, "index"]);
Route::post('/chatbot/send', [ChatBotController::class, "sendChat"]);



// TODO LIST
Route::get('/todolist', [TodoListController::class, 'index']);
Route::post('/todolist/add', [TodoListController::class, 'store']);
Route::put('/todolist/update/{id}', [TodoListController::class, 'updates']);
Route::delete('/todolist/delete/{id}', [TodoListController::class, 'destroy']);


// ACARA
Route::resource('/event', AcaraController::class);
Route::post('/event/update', [AcaraController::class, 'update']);
Route::get('/event/datarangeevent/{data}', [AcaraController::class, 'rangeEvent']);
