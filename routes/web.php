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

Route::get('/payment-gateway/{id}','PayMongoController@CreatePayment'); 
Route::post('/payment-gateway-process/{id}','PayMongoController@CreatePaymentProcess'); 

Route::get('/get-gcash-payment-link/{id}','PayMongoController@GetGcashLink'); 
Route::get('/get-grabpay-payment-link/{id}','PayMongoController@GetGrabpayLink'); 
Route::get('/get-chargeable/{id}','PayMongoController@Chargeable'); 

Route::post('/CheckPaymentIntent','PayMongoController@CheckPaymentIntent')->name('check-payment'); 

Route::group(['middleware' => ['web']], function() {
    
    Route::post('/admin/returns_header/add-transaction-process','AdminReturnsHeaderController@AddTransactionProcess')->name('add-transaction'); // CREATE TRANSACTION
    Route::post('/admin/returns_header/model','AdminReturnsHeaderController@model')->name('selected-model');    // SET IMAGE FOR SELECTED MODEL
    Route::post('/admin/returns_header/comment','AdminReturnsHeaderController@comment')->name('all-comment');   // ADD COMMENT
    Route::post('/admin/pay_diagnostic/DiagnosticPaymentStatus','AdminReturnsHeaderController@DiagnosticPaymentStatus')->name('diagnostic-status');     // SEND DIAGNOSTIC PAYMENT EMAIL AND CHANGE STATUS

    Route::post('/admin/to_diagnose/search_item','AdminReturnsHeaderController@search_item')->name('search-item');     // SEARCH ITEM FOR DIGITS CODE
    // Route::post('/admin/to_diagnose/diagnose-transaction-process/{id}','AdminToDiagnoseController@DiagnoseTransactionProcess');    // PROCESS AFTER SUBMITTING FORM FOR DIAGNOSE PAGE
    
    Route::post('/admin/to_diagnose/addQuotation','AdminToDiagnoseController@AddQuotation')->name('add-quotation');    // ADDING ROW FOR QUOTATION
    Route::post('/admin/to_diagnose/deleteQuotation','AdminToDiagnoseController@DeleteQuotation')->name('delete-quotation');   // DELETE ROW FOR QUOTATION

    Route::post('/admin/to_diagnose/changeTransactionStatus','AdminToDiagnoseController@changeTransactionStatus')->name('change-status');  // CHANGE STATUS OF TRANSACTION
    Route::post('/admin/to_diagnose/CheckGSX','AdminToDiagnoseController@CheckGSX')->name('check-gsx');    
    Route::post('/admin/to_diagnose/SearchSparePartNo','AdminToDiagnoseController@SearchSparePartNo')->name('search-sparepart');    

    Route::post('/admin/pay_diagnostic/edit-transaction-process/{id}','AdminReturnsHeaderController@EditTransactionProcess');
    // Route::post('/admin/to_pay_parts/diagnose-transaction-process/{id}','AdminToDiagnoseController@DiagnoseTransactionProcess');
    // Route::post('/admin/repair_in_process/diagnose-transaction-process/{id}','AdminToDiagnoseController@DiagnoseTransactionProcess');
    // Route::post('/admin/pick_up/diagnose-transaction-process/{id}','AdminToDiagnoseController@DiagnoseTransactionProcess');
    // Route::post('/admin/to_close/diagnose-transaction-process/{id}','AdminToDiagnoseController@DiagnoseTransactionProcess');

    Route::get('/admin/PrintStatus','AdminReturnsHeaderController@PrintStatus')->name('change-print-status');   // CHANGE PRINT STATUS

    //***********************************PRINT FORM*************************************
    //CREATE TRANSACTION
    Route::get('/admin/returns_header/PrintReceivingForm/{id}','AdminReturnsHeaderController@PrintReceivingForm');
    Route::get('/admin/returns_header/PrintTechnicalReport/{id}','AdminReturnsHeaderController@PrintTechnicalReport');
    Route::get('/admin/returns_header/PrintReleaseForm/{id}','AdminReturnsHeaderController@PrintReleaseForm');
    Route::get('/admin/returns_header/PrintSameDayReleaseForm/{id}','AdminReturnsHeaderController@PrintSameDayReleaseForm');

    //TO PAY DIAGNOSTIC
    Route::get('/admin/pay_diagnostic/PrintReceivingForm/{id}','AdminReturnsHeaderController@PrintReceivingForm');
    Route::get('/admin/pay_diagnostic/PrintTechnicalReport/{id}','AdminReturnsHeaderController@PrintTechnicalReport');
    Route::get('/admin/pay_diagnostic/PrintReleaseForm/{id}','AdminReturnsHeaderController@PrintReleaseForm');
    Route::get('/admin/pay_diagnostic/PrintSameDayReleaseForm/{id}','AdminReturnsHeaderController@PrintSameDayReleaseForm');

    //DIAGNOSE
    Route::get('/admin/to_diagnose/PrintReceivingForm/{id}','AdminReturnsHeaderController@PrintReceivingForm');
    Route::get('/admin/to_diagnose/PrintTechnicalReport/{id}','AdminReturnsHeaderController@PrintTechnicalReport');
    Route::get('/admin/to_diagnose/PrintReleaseForm/{id}','AdminReturnsHeaderController@PrintReleaseForm');
    Route::get('/admin/to_diagnose/PrintSameDayReleaseForm/{id}','AdminReturnsHeaderController@PrintSameDayReleaseForm');

    //TO PAY
    Route::get('/admin/to_pay_parts/PrintReceivingForm/{id}','AdminReturnsHeaderController@PrintReceivingForm');
    Route::get('/admin/to_pay_parts/PrintTechnicalReport/{id}','AdminReturnsHeaderController@PrintTechnicalReport');
    Route::get('/admin/to_pay_parts/PrintReleaseForm/{id}','AdminReturnsHeaderController@PrintReleaseForm');
    Route::get('/admin/to_pay_parts/PrintSameDayReleaseForm/{id}','AdminReturnsHeaderController@PrintSameDayReleaseForm');

    //TO REPAIR IN PROCESS
    Route::get('/admin/repair_in_process/PrintReceivingForm/{id}','AdminReturnsHeaderController@PrintReceivingForm');
    Route::get('/admin/repair_in_process/PrintTechnicalReport/{id}','AdminReturnsHeaderController@PrintTechnicalReport');
    Route::get('/admin/repair_in_process/PrintReleaseForm/{id}','AdminReturnsHeaderController@PrintReleaseForm');
    Route::get('/admin/repair_in_process/PrintSameDayReleaseForm/{id}','AdminReturnsHeaderController@PrintSameDayReleaseForm');

    //TO CLOSE
    Route::get('/admin/to_close/PrintReceivingForm/{id}','AdminReturnsHeaderController@PrintReceivingForm');
    Route::get('/admin/to_close/PrintTechnicalReport/{id}','AdminReturnsHeaderController@PrintTechnicalReport');
    Route::get('/admin/to_close/PrintReleaseForm/{id}','AdminReturnsHeaderController@PrintReleaseForm');
    Route::get('/admin/to_close/PrintSameDayReleaseForm/{id}','AdminReturnsHeaderController@PrintSameDayReleaseForm');

    //TO TRANSACTION HISTORY
    Route::get('/admin/transaction_history/PrintReceivingForm/{id}','AdminReturnsHeaderController@PrintReceivingForm');
    Route::get('/admin/transaction_history/PrintTechnicalReport/{id}','AdminReturnsHeaderController@PrintTechnicalReport');
    Route::get('/admin/transaction_history/PrintReleaseForm/{id}','AdminReturnsHeaderController@PrintReleaseForm');
    Route::get('/admin/transaction_history/PrintSameDayReleaseForm/{id}','AdminReturnsHeaderController@PrintSameDayReleaseForm');
    //************************************************************************************

    Route::get('/admin/to_diagnose/AssignedTechnician','AdminTransactionHistoryController@AssignedTechnician');
    Route::get('/admin/to_pay_parts/AssignedTechnician','AdminTransactionHistoryController@AssignedTechnician');
    Route::get('/admin/repair_in_process/AssignedTechnician','AdminTransactionHistoryController@AssignedTechnician');
    Route::get('/admin/transaction_history/AssignedTechnician','AdminTransactionHistoryController@AssignedTechnician');
    
    Route::get('/admin/transaction_history/ExportData','AdminTransactionHistoryController@ExportData');
    Route::get('/admin/returns_appointment/getTime','AdminReturnsAppointmentController@getTime')->name('get_time'); 
    
});