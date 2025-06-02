<?php

namespace App;

use App\Mail\ExportMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use stdClass;

class ExportClass
{
    private $order_ids;
    public function __construct(){
        $this->order_ids = [];
    }
    public function exportProducts(){
        $exportsPath = 'public/exports';
        $fileName = 'products_' . now()->format('Y_m_d_H_i_s') . '.csv';
        $filePath = "$exportsPath/$fileName";

        if (!Storage::exists($exportsPath)) {
            Storage::makeDirectory($exportsPath);
        }

        $headers = ['no', 'Name', 'Quantity', 'Total', 'Current Stock'];

        $file = fopen(Storage::path($filePath), 'w');
        fputcsv($file, $headers);
        fclose($file);

        $page_no = 1;

        $order_details =  DB::table('order_details')
            ->select('products.name','products.stock', 'order_details.quantity', 'order_details.total')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->whereIn('order_details.order_id', $this->order_ids)
            ->get();

        $file = fopen(Storage::path($filePath), 'a');

        foreach ($order_details as $order) {

            $temp = new stdClass();
            $temp->no = $page_no++;
            $temp->name = $order->name;
            $temp->quantity = $order->quantity;
            $temp->total = $order->total;
            $temp->stock = $order->stock;

            fputcsv($file, (array)$temp);
        }

        fclose($file);

        $headers = ['Total', '-', number_format($order_details->sum('quantity')), number_format($order_details->sum('total'),2), '-'];

        $file = fopen(Storage::path($filePath), 'a');
        fputcsv($file, $headers);
        fclose($file);

        return url(Storage::url($filePath));
    }

    public function exportOrders(){
        $exportsPath = 'public/exports';
        $fileName = 'orders_' . now()->format('Y_m_d_H_i_s') . '.csv';
        $filePath = "$exportsPath/$fileName";
        
        if (!Storage::exists($exportsPath)) {
            Storage::makeDirectory($exportsPath);
        }
        
        $headers = ['no', 'order ID', 'Status', 'Payment Used', 'Total Amount', 'Total Quantity', 'Performed By', 'Performed At'];
        
        $file = fopen(Storage::path($filePath), 'w');
        fputcsv($file, $headers);
        fclose($file);

        $company_id = 3;
        // $company_id = Auth::user()->company_id;
        $page_no = 1;
        $order_ids = [];

        $orders = DB::table('orders')
            ->where('orders.company_id', $company_id)
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', DB::raw('SUM(order_details.total) as total_amount'), DB::raw('SUM(order_details.quantity) as total_quantity'), 'users.name as user_name')
            ->where('orders.created_at', '>=', now()->startOfDay())
            ->where('orders.created_at', '<=', now()->endOfDay())
            ->groupBy('orders.id')
            ->orderBy('orders.created_at', 'DESC')
            ->get();

            $file = fopen(Storage::path($filePath), 'a');

            foreach ($orders as $order) {

                $temp = new stdClass();
                $temp->no = $page_no++;
                $temp->order_id = $order->reference;
                $temp->status = $order->status;
                $temp->payment_used = $order->payment_type;
                $temp->total_amount = $order->total_amount;
                $temp->total_quantity = $order->total_quantity;
                $temp->performed_by = $order->user_name;
                $temp->performed_at = \Carbon\Carbon::parse($order->created_at)->format('d, M, Y. h:iA');

                $order_ids[] = $order->id;

                fputcsv($file, (array)$temp);
            }

            fclose($file);
            $headers = ['Total', '-', '-', '-', number_format($orders->sum('total_amount')), number_format($orders->sum('total_quantity')), '-', '-'];
        
            $file = fopen(Storage::path($filePath), 'a');
            fputcsv($file, $headers);
            fclose($file);

            $this->order_ids = $order_ids;
            return url(Storage::url($filePath));
    }

    public function exportDailyTx()
    {
        try {
            $order_url = $this->exportOrders();
            $product_url = $this->exportProducts();

            $email = 'tangoaltelecoms@gmail.com';
            Mail::to($email)->send(new ExportMail('Daily Export Summary', 'Chief', $order_url, $product_url));
        } catch (\Exception $e) {
            logger($e->getMessage());
        }
    }
}