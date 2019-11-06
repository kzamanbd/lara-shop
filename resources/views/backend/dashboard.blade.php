@extends('backend.layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="dashboard">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>/ Eshop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
             <!-- Info boxes -->
             <div class="row">
                 <div class="col-md-4 col-sm-6 col-xs-12">
                     <div class="info-box">
                         <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                         <div class="info-box-content">
                             <span class="info-box-text">Total Sale</span>
                             <span class="info-box-number">{{number_format(App\Models\Order::all()->sum('sub_total'),2,'.',',')}}<small> ৳</small></span>
                         </div>
                         <!-- /.info-box-content -->
                     </div>
                     <!-- /.info-box -->
                 </div>

                 <!-- fix for small devices only -->
                 <div class="clearfix visible-sm-block"></div>

                 <div class="col-md-4 col-sm-6 col-xs-12">
                     <div class="info-box">
                         <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                         <div class="info-box-content">
                             <span class="info-box-text">Sales</span>
                             <span class="info-box-number">{{App\Models\Order::all()->count()}}</span>
                         </div>
                         <!-- /.info-box-content -->
                     </div>
                     <!-- /.info-box -->
                 </div>
                 <!-- /.col -->
                 <div class="col-md-4 col-sm-6 col-xs-12">
                     <div class="info-box">
                         <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                         <div class="info-box-content">
                             <span class="info-box-text">Total Customers</span>
                             <span class="info-box-number">{{App\Customer::all()->count()}}</span>
                         </div>
                         <!-- /.info-box-content -->
                     </div>
                     <!-- /.info-box -->
                 </div>
                 <!-- /.col -->
             </div>
             <!-- /.row -->
         </section>
    </div>
@endsection
