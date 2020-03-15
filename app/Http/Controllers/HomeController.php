<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
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
        $clients=Charts::database(Product::query()->with('ProductCategory')->get(),'bar','highcharts')
            ->title('Total Products')
            ->colors(['#302b63','#CAC531','#b20a2c','#0f9b0f','#F7F8F8','#48b1bf','#E100FF','#ffa751','#7F00FF','#536976','#94716B','#667db6','#00F260','#667db6','#fbc7d4','#9796f0','#AA076B','#f7b733','#71B280','#fc4a1a'])
            ->responsive(true)
            ->ElementLabel('total number of items')
            ->groupBy('category_id');
        $sales=Charts::database(Sale::all(),'bar','highcharts')
            ->title('Total Sales')
            ->colors(['#302b63','#CAC531','#b20a2c','#0f9b0f','#F7F8F8','#48b1bf','#E100FF','#ffa751','#7F00FF','#536976','#94716B','#667db6','#00F260','#667db6','#fbc7d4','#9796f0','#AA076B','#f7b733','#71B280','#fc4a1a'])
            ->responsive(true)
            ->ElementLabel('total number of items sold')
            ->groupBy('sold_by');
        $stock=Charts::database(StockTake::all(),'pie','highcharts')
            ->title('Items in stock')
            ->colors(['#CAC531','#00F260','#94716B','#667db6','#f7b733','#F7F8F8','#b20a2c','#0f9b0f','#536976','#48b1bf','#E100FF','#7F00FF','#fc4a1a','#302b63','#667db6','#AA076B','#ffa751','#fbc7d4','#9796f0','#71B280'])
            ->responsive(true)
            ->ElementLabel('Total Count')
            ->groupBy('quantity');
        return view('home',compact('clients','sales','stock'));
    }
}
