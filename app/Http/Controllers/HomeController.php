<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Requisition;
use App\Sale;
use App\StockTake;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sales=Charts::database(Sale::all(),'bar','highcharts')
            ->title('Total Sales')
            ->colors(['#302b63','#CAC531','#b20a2c','#0f9b0f','#F7F8F8','#48b1bf','#E100FF','#ffa751','#7F00FF','#536976','#94716B','#667db6','#00F260','#667db6','#fbc7d4','#9796f0','#AA076B','#f7b733','#71B280','#fc4a1a'])
            ->responsive(true)
            ->ElementLabel('total number of items sold')
            ->groupBy('sold_by');

        $products=Charts::database(Product::all(),'bar','highcharts')
            ->title('Products')
            ->colors(['#302b63','#CAC531','#b20a2c','#0f9b0f','#F7F8F8','#48b1bf','#E100FF','#ffa751','#7F00FF','#536976','#94716B','#667db6','#00F260','#667db6','#fbc7d4','#9796f0','#AA076B','#f7b733','#71B280','#fc4a1a'])
            ->responsive(true)
            ->ElementLabel('Maintained Products')
           ->groupBy('product_name');

        $allRequests=Requisition::all()->count();
        $unauth=Requisition::query()->where('status',0)->count();
        $auth=Requisition::query()->where('status',1)->count();
        $reject=Requisition::query()->where('status',2)->count();
        $expenses=Charts::create('donut', 'highcharts')
            ->title('Expense Requisition Statistics')
            ->elementLabel('Total Count')
            ->labels(['Total Requests','Authorised', 'Un-Authorised', 'Declined'])
            ->values([$allRequests,$auth,$unauth,$reject])
            ->colors(['#0f9b0f','#536976','#ffa751','#b20a2c','#CAC531','#48b1bf','#94716B','#E100FF','#9796f0','#f7b733','#7F00FF','#667db6','#667db6','#fbc7d4','#71B280','#fc4a1a','#302b63','#AA076B'])
            ->responsive(true);
        return view('home',compact('sales','expenses','products'));
    }
}
