<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Users Routes
Route::get('/users','UserController@index')->name('users');
Route::get('/createUser','UserController@create')->name('createUser');
Route::post('/saveUser','UserController@store')->name('saveUser');
Route::get('/editUser/{user}','UserController@edit')->name('editUser');
Route::put('/updateUser/{user}','UserController@update')->name('updateUser');
Route::get('/removeUser/{user}','UserController@destroy')->name('removeUser');
//Product categories routes
Route::get('/categories','ProductCategoryController@index')->name('categories');
Route::get('/createCategory','ProductCategoryController@create')->name('createCategory');
Route::post('/saveCategory','ProductCategoryController@store')->name('saveCategory');
Route::get('/showCategory/{productCategory}','ProductCategoryController@show')->name('showCategory');
Route::get('/deleteCategory/{productCategory}','ProductCategoryController@destroy')->name('deleteCategory');
//Unit of Measure routes
Route::get('/units','UnitOfMeasureController@index')->name('units');
Route::get('/createUnit','UnitOfMeasureController@create')->name('createUnit');
Route::post('/saveUnit','UnitOfMeasureController@store')->name('saveUnit');
Route::get('/editUnit/{unitOfMeasure}','UnitOfMeasureController@edit')->name('editUnit');
Route::get('/deleteUnit/{unitOfMeasure}','UnitOfMeasureController@destroy')->name('deleteUnit');
//Currency routes
Route::get('/currencies','CurrencyController@index')->name('currencies');
Route::get('/createCurrency','CurrencyController@create')->name('createCurrency');
Route::post('/saveCurrency','CurrencyController@store')->name('saveCurrency');
Route::get('/editCurrency/{currency}','CurrencyController@edit')->name('editCurrency');
Route::get('/deleteCurrency/{currency}','CurrencyController@destroy')->name('deleteCurrency');
Route::get('/searchCurrency/{currency}','CurrencyController@searchCurrency')->name('searchCurrency');
//Exchange Rates routes
Route::get('/rates','ExchangeRateController@index')->name('rates');
Route::get('/createRate','ExchangeRateController@create')->name('createRate');
Route::post('/saveRate','ExchangeRateController@store')->name('saveRate');
Route::get('/editRate/{exchangeRate}','ExchangeRateController@edit')->name('editRate');
Route::put('/updateRate/{exchangeRate}','ExchangeRateController@update')->name('updateRate');
Route::get('/deleteRate/{exchangeRate}','ExchangeRateController@destroy')->name('deleteRate');
//Product routes
Route::get('/products','ProductController@index')->name('products');
Route::get('/createProduct','ProductController@create')->name('createProduct');
Route::post('/saveProduct','ProductController@store')->name('saveProduct');
Route::get('/editProduct/{product}','ProductController@edit')->name('editProduct');
Route::put('/updateProduct/{product}','ProductController@update')->name('updateProduct');
Route::get('/deleteProduct/{product}','ProductController@destroy')->name('deleteProduct');

Route::get('/products/{code}/view','ProductController@view');
Route::get('/products/search','ProductController@search');

//Sale dashboard routes
Route::get('/sales','SaleController@index')->name('sales');
Route::get('/createSale','SaleController@create')->name('createSale');
Route::post('/saveSale','SaleController@store')->name('saveSale');
Route::get('/editSale/{sale}','SaleController@edit')->name('editSale');
Route::put('/updateSale/{sale}','SaleController@update')->name('updateSale');
Route::get('/deleteSale/{sale}','SaleController@destroy')->name('deleteSale');
Route::get('/getRate','SaleController@getRate')->name('getRate');
Route::get('/getUnit','SaleController@getUnit')->name('getUnit');
Route::get('/showReceipt/{receipt}','SaleController@show')->name('showReceipt');
//orders
Route::get('/orders','PurchaseOrdersController@index')->name('orders');
Route::get('/receiveStock','PurchaseOrdersController@create')->name('receiveStock');
Route::post('/saveStock','PurchaseOrdersController@store')->name('saveStock');
Route::get('/deleteOrder/{order}','PurchaseOrdersController@destroy')->name('deleteOrder');
//StockTake
Route::get('/stockTakes','StockTakesController@index')->name('stockTakes');
Route::get('/uploadStockTake','StockTakesController@create')->name('uploadStockTake');
Route::post('/saveStockTake','StockTakesController@store')->name('saveStockTake');
Route::get('/deleteStockTake/{stock_count}','StockTakesController@destroy')->name('deleteStockTake');
//PayRoll
Route::get('/payRolls','PayRollsController@index')->name('payRolls');
Route::get('/uploadPayRoll','PayRollsController@create')->name('uploadPayRoll');
Route::post('/savePayRoll','PayRollsController@store')->name('savePayRoll');
Route::get('/deletePayRoll/{order}','PayRollsController@destroy')->name('deletePayRoll');
Route::get('/authoriseSalary/{salary}','PayRollsController@authoriseSalary')->name('authoriseSalary');
Route::get('/rejectSalary/{salary}','PayRollsController@rejectSalary')->name('rejectSalary');
//HumanResources
Route::get('/employees','HumanResourcesController@index')->name('employees');
Route::get('/addEmployee','HumanResourcesController@create')->name('addEmployee');
Route::post('/saveEmployee','HumanResourcesController@store')->name('saveEmployee');
Route::get('/editEmployee/{employee}/','HumanResourcesController@edit')->name('editEmployee');
Route::get('/deleteEmployee/{employee}','HumanResourcesController@destroy')->name('deleteEmployee');
Route::put('/updateEmployee/{employee}','HumanResourcesController@update')->name('updateEmployee');
Route::get('/showEmployee/{employee}','HumanResourcesController@show')->name('showEmployee');
Route::get('/activate_employee/{employee}/update','HumanResourcesController@activate');
Route::get('/deactivate_employee/{employee}/update','HumanResourcesController@deactivate');
Route::get('/authoriseLeave/{application}','LeaveApplicationsController@acceptLeave')->name('authoriseLeave');
Route::get('/rejectLeave/{application}','LeaveApplicationsController@rejectLeave')->name('rejectLeave');
//Employee positions
Route::get('/employeePositions','PositionsController@index')->name('employeePositions');
Route::get('/addPosition','PositionsController@create')->name('addPosition');
Route::post('/savePosition','PositionsController@store')->name('savePosition');
Route::get('/editPosition/{position}/','PositionsController@edit')->name('editPosition');
Route::get('/deletePosition/{position}','PositionsController@destroy')->name('deletePosition');
Route::put('/updatePosition/{position}','PositionsController@update')->name('updatePosition');
Route::get('/showPosition/{position}','PositionsController@show')->name('showPosition');
//Salary Grades
Route::get('/salaryGrade','SalariesController@index')->name('salaryGrade');
Route::get('/addSalaryGrade','SalariesController@create')->name('addSalaryGrade');
Route::post('/saveSalaryGrade','SalariesController@store')->name('saveSalaryGrade');
Route::get('/editSalaryGrade/{grade}/','SalariesController@edit')->name('SalaryGrade');
Route::get('/deleteSalaryGrade/{grade}','SalariesController@destroy')->name('deleteSalaryGrade');
Route::put('/updateSalaryGrade/{grade}','SalariesController@update')->name('updateSalaryGrade');
Route::get('/showSalaryGrade/{grade}','SalariesController@show')->name('showSalaryGrade');
//leave types
Route::get('/leaves','LeavesController@index')->name('leaves');
Route::get('/addLeave','LeavesController@create')->name('addLeave');
Route::post('/saveLeave','LeavesController@store')->name('saveLeave');
Route::get('/editLeave/{leave}/','LeavesController@edit')->name('editLeave');
Route::get('/deleteLeave/{leave}','LeavesController@destroy')->name('deleteLeave');
Route::put('/updateLeave/{leave}','LeavesController@update')->name('updateLeave');
Route::get('/showLeave/{leave}','LeavesController@show')->name('showLeave');
//leave application
Route::get('/LeaveApplication','LeaveApplicationsController@index')->name('LeaveApplication');
Route::get('/applyLeave/{apply}','LeaveApplicationsController@edit')->name('applyLeave');
Route::post('/saveLeaveApplication','LeaveApplicationsController@store')->name('saveLeaveApplication');
Route::get('/authoriseLeave/{application}','LeaveApplicationsController@acceptLeave')->name('authoriseLeave');
Route::get('/rejectLeave/{application}','LeaveApplicationsController@rejectLeave')->name('rejectLeave');
//Invoice Routes
Route::get('/createInvoice','InvoiceController@create')->name('createInvoice');
Route::post('/saveInvoice','InvoiceController@store')->name('saveInvoice');
Route::get('/invoices','InvoiceController@index')->name('invoices');
Route::get('/showInvoice/{invoice}','InvoiceController@show')->name('showInvoice');
//Quotation Routes
Route::get('/createQuotation','QuotationController@create')->name('createQuotation');
Route::post('/saveQuotation','QuotationController@store')->name('saveQuotation');
Route::get('/quotations','QuotationController@index')->name('quotations');
Route::get('/showQuotation/{quotation}','QuotationController@show')->name('showQuotation');
////Creditors Routes
//Route::get('creditors','CreditorsController@index')->name('creditors');
//Route::get('addCreditor','CreditorsController@create')->name('addCreditor');
//Route::post('saveCreditor','CreditorsController@store')->name('saveCreditor');
//Route::get('editCreditor/{id}','CreditorsController@edit')->name('editCreditor');
//Route::put('updateCreditor/{id}','CreditorsController@update')->name('updateCreditor');
//Route::get('deleteCreditor/{id}','CreditorsController@destroy')->name('deleteCreditor');
////Requisitions Routes
//Route::get('/requisitions','RequisitionsController@index')->name('requisitions');
//Route::get('/addRequisition','RequisitionsController@create')->name('addRequisition');
//Route::post('/saveRequisition','RequisitionsController@store')->name('saveRequisition');
//requisition
Route::get('/requisitions','RequisitionsController@index')->name('requisitions');
Route::get('/addRequisition','RequisitionsController@create')->name('addRequisition');
Route::post('/saveRequisition','RequisitionsController@store')->name('saveRequisition');
Route::get('/editRequisition/{requisition}/','RequisitionsController@edit')->name('editRequisition');
Route::get('/deleteEmployee/{employee}/','RequisitionsController@destroy')->name('deleteEmployee');
Route::put('/updateRequisition/{requisition}/','RequisitionsController@update')->name('updateRequisition');
Route::get('/showEmployee/{employee}/','RequisitionsController@show')->name('showEmployee');
Route::get('/acceptRequisition/{requisition}/update','RequisitionsController@acceptRequisition')->name('acceptRequisition');
Route::get('/rejectRequisition/{requisition}/update','RequisitionsController@rejectRequisition')->name('rejectRequisition');
Route::get('/authorisePayment/{payment}','RequisitionsController@acceptPayment')->name('authorisePayment');
Route::get('/rejectPayment/{payment}','RequisitionsController@rejectPayment')->name('rejectPayment');
//Creditors
Route::get('/creditors','CreditorsController@index')->name('creditors');
Route::get('/addCreditor','CreditorsController@create')->name('addCreditor');
Route::post('/saveCreditor','CreditorsController@store')->name('saveCreditor');
Route::get('/editCreditor/{creditor}/','CreditorsController@edit')->name('editCreditor');
Route::get('/deleteCreditor/{creditor}','CreditorsController@destroy')->name('deleteCreditor');
Route::put('/updateCreditor/{creditor}','CreditorsController@update')->name('updateCreditor');
Route::get('/showEmployee/{creditor}','CreditorsController@show')->name('showCreditor');
//assets
Route::get('/assets','AssetsController@index')->name('assets');
Route::get('/addAsset','AssetsController@create')->name('addAsset');
Route::post('/saveAsset','AssetsController@store')->name('saveAsset');
Route::get('/editAsset/{asset}/','AssetsController@edit')->name('editAsset');
Route::get('/deleteAsset/{asset}','AssetsController@destroy')->name('deleteAsset');
//Profit and Loss Routes
Route::get('/profitAndLoss','ProfitAndLossController@index')->name('profitAndLoss');
Route::post('/searchProfitAndLoss','ProfitAndLossController@search')->name('searchProfitAndLoss');
Route::get('/mySales','SaleController@mySales')->name('mySales');
Route::get('/createRevenue','RevenueController@create')->name('createRevenue');
Route::post('/postRevenue','RevenueController@store')->name('postRevenue');
//Supplier Routes
Route::get('/suppliers','SupplierController@index')->name('suppliers');
Route::get('/createSupplier','SupplierController@create')->name('createSupplier');
Route::post('/saveSupplier','SupplierController@store')->name('saveSupplier');
Route::get('/deleteSupplier/{supplier}','SupplierController@destroy')->name('deleteSupplier');
//Trial Balance
Route::get('/trialBalance','TrialBalanceController@index')->name('trialBalance');
Route::post('/searchTrialBalance','TrialBalanceController@search')->name('searchTrialBalance');
Route::get('/showRevenue/{id}','TrialBalanceController@show')->name('showRevenue');
