<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ReceiptRepository;
use App\Http\Repositories\StoreRepository;
use App\Http\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(public StoreRepository $StoreRepository, public UserRepository $userRepository, public ReceiptRepository $receiptRepository)
    {
        
    }

    // Admin panelinin index səhifəsi

    public function index()
    {
        $stores = $this->StoreRepository->all();
        return view('dashboard', compact('stores'));
    }


     public function filter(Request $request)
{
    if ($request->isMethod('get')) {
        $startDate = Carbon::parse(session('start_date'));
        $endDate = Carbon::parse(session('end_date'));
        $storeCode = session('store_code');
    } else {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $storeCode = $request->store_code;

        session([
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'store_code' => $storeCode,
        ]);
    }

    $store = $this->StoreRepository->find('store_code', $storeCode);

    $returnedSales = $store->returnedSales($startDate, $endDate)->paginate(12);
    $nonReturnedSales = $store->nonReturnedSales($startDate, $endDate)->paginate(12);

    return view('dashboard_results', compact('returnedSales', 'nonReturnedSales'));
}


     // Müştərinin alış-veriş tarixçəsinin gətirilməsi

     public function getCustomerDetails($userid)
     {
        $user = $this->userRepository->find($userid);
        $userSaleshistory = $user->receipts()->paginate(12);

        return view('customer_details', compact('userSaleshistory', 'user'));
     }

      // Satışa aid məhsulların gətirilməsi

      public function getReceiptItems($receiptId)
      {
        $receipt = $this->receiptRepository->find($receiptId);
        $items = $receipt->receiptitems()->paginate(12);

        return view('receipt_items', compact('receipt', 'items'));
      }
}
