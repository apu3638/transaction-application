<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiResponse;
use App\Transaction;
use App\TransactionLog;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function mock(Request $request){
        $isExistMockStatus = $request->header('X-Mock-Status');

        if (!empty($isExistMockStatus)) {
            $responseData = array(
                'message' => "Mock response - $isExistMockStatus!",
            );
            return ApiResponse::format(200, 'X-Mock-Status is exist', 200, $responseData);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $userId = $request->get('user_id');
        $amount = $request->get('amount');

        if (empty($userId) || empty($amount)) {
            return ApiResponse::format(400, 'Please fill up necessary information', 400, 'error');
        }

        if (!ctype_digit($userId) || !ctype_digit($amount)) {
            return ApiResponse::format(400, 'Invalid.Only numerical values are allowed.', 400, "error");
        }

        # Universally Unique Identifier
        $transactionId = Str::uuid();

        DB::beginTransaction();
        try {
            # store transaction request log data
            TransactionLog::store($transactionId, json_encode($request->all()), 'transaction_store_request');

            $transactionData = [
                'transaction_id' => $transactionId,
                'user_id' => $userId,
                'transaction_date' => Carbon::now(),
                'status' => 'success',
            ];

            // call mock api
            $this->mock($request);

            Transaction::create($transactionData);
            // all operations are good
            DB::commit();

            $responseData = [ 'transaction_id' =>  $transactionId ];

            $headers = [ 'Cache-Control' => 'no-cache, must-revalidate' ];

            $apiResponse = ApiResponse::format(200, 'Your transaction is successful', 200, "success",$responseData,$headers);

            # store transaction response log data
            TransactionLog::store($transactionId, json_encode($apiResponse), 'transaction_store_response');

            return $apiResponse;

        } catch (\Exception $exception) {
            DB::rollBack();
            return ApiResponse::format(500, 'Something went wrong.Please try again after some time', 500, "error");
        }
    }


    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'transactionId' => 'required|string',
            'status' => 'required|string',
            'callback_url' => 'required|url',
        ]);

        if ($validator->fails()) {
           echo '<h3 style="text-align:center" >Your request is invalid</h3>';
           return;
        }

        $transactionId = $request->get('transactionId');
        $status        = $request->get('status');
        $callbackUrl   = $request->get('callback_url');

        try {
            if (!in_array($status,['pending','success','reject','on-progress'])) {
                $callbackUrl .= '?error_message=Invalid Status';
                return redirect()->away($callbackUrl);
            }

            $transactionInstance = DB::table('transactions')->where('transaction_id',$transactionId);

            # check transaction is existed
            if (!$transactionInstance->count()){
                $callbackUrl .= '?error_message=transaction not found';
                return redirect()->away($callbackUrl);
            }

            $isUpdate = $transactionInstance->update(['status' =>  $status]);

            if ($isUpdate){
                $callbackUrl .= '?success_message=transaction is updated successfully';
            }else{
                $callbackUrl .= '?error_message=Something went wrong.Please try again';
            }
            return redirect()->away($callbackUrl);

        }catch (\Exception $exception){
            $callbackUrl .= '?error_message='.$exception->getMessage();
            return redirect()->away($callbackUrl);
        }
    }
}
