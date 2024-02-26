@extends('layouts.admin')
@section('sub-title','Dashboard')
@section('styles')
<style>
    .detail{
        cursor: pointer;
    }
   .detail:hover{
        border: solid 1px #4e73df;
   }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Select a equipment/tools to check record of maintainance </h1>

    </div>
    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="row">
                <div class="form-outline col-md-6" data-mdb-input-init>
                    <small class="font-weight-bold">
                        Search a equipment/tools
                    </small>
                    <input type="search" id="search" class="form-control" placeholder="Type query" aria-label="Search" />
                </div>
                <div class="col-md-3">
                    <small class="font-weight-bold">Filter by brand</small>
                    <select name="filter_brand" id="filter_brand" class="form-control">
                        <option value="">-- Filter by brand --</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->brand}}">{{$brand->brand}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <small class="font-weight-bold">Filter by color</small>
                    <select name="filter_color" id="filter_color" class="form-control">
                        <option value="">-- Filter by color --</option>
                        @foreach($colors as $color)
                            <option value="{{$color->color}}">{{$color->color}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


        </div>
        <div class="col-md-12 mx-auto mt-3">
            <div class="row justify-content-md-center" id="equipments_section">

            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
$(document).ready(function(){

    var search = "",filter_brand = "", filter_color = "";
    function search_function(search,filter_brand,filter_color){
        $.ajax({
          url :"/admin/equipments-all",
          data: {search:search, filter_brand:filter_brand, filter_color:filter_color},
          dataType:"json",
          beforeSend:function(){
            $('#overlay').fadeIn();
          },
          success:function(data){
              console.log(data.data)
              console.log(search,filter_brand,filter_color)
              var equipments = "";
              $.each(data.data, function(key,value){
                equipments +=  `
                <div class="card-row shadow ml-2 col-md-3 detail" detail="`+value.id+`">
                    <div class="d-flex justify-content-between">
                        <span class="badge badge-warning h5">ID CODE: `+value.id+`</span>
                        <div>
                            <button class="btn btn-sm btn-success"><i class="fas fa-fw fa-pen"></i></button>
                            <button class="btn btn-sm btn-info"><i class="fas fa-fw fa-eye"></i></button>


                        </div>
                    </div>
                    <div class="my-1">
                        <div class="text-center">
                            <p class="label mb-4 font-weight-bold">`+value.item+` <br> (`+value.brand+` - `+value.color+`)</p>
                        </div>
                    </div>
                    <small>Last Maintainance: Feb 01 , 2024</small>
                    </div>
                `;
                });
                $('#equipments_section').empty().append(equipments);
                $('#overlay').fadeOut();
          }
        })
    }

    search_function(search,filter_brand,filter_color);


    $('#filter_brand').on('change', function() {
        filter_brand  = this.value;
        search_function(search,filter_brand,filter_color);
    });

    $('#filter_color').on('change', function() {
        filter_color  = this.value;
        search_function(search,filter_brand,filter_color);
    });

    $('#search').keypress(function() {
        search = this.value;
        search_function(search,filter_brand,filter_color);
    });

});


</script>
@endsection
