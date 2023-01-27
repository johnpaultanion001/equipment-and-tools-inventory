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
        <h1 class="h3 mb-0 text-gray-800">Budgets</h1>
       
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg- mx-auto mt-3">
            <div class="row">
                @foreach($events as $event)
                <div class="card-row shadow ml-2 col-md-3 detail" detail="{{$event->event_id}}">
                    <div class="my-1">
                        <div class="text-center">
                            <p class="label mb-4">{{$event->title ?? ''}}</p>
                            <p class="label mb-4">Total Bugget: {{ number_format($event->budget ?? '' , 0, '.', ',') }}</p>
                            
                            @php
                                $budget = $event->budget;
                                $budgetPartition = $event->budgets()->count();
                                if($budgetPartition == 0){
                                    $budgetPartition = 1;
                                }
                                $budgetPerAct = $budget / $budgetPartition;
                            @endphp
                            @foreach($event->budgets()->get() as $budget)
                                <p class="label ">TITLE: {{$budget->title ?? ''}}  <br>
                                                    BUDGET: {{ number_format($budgetPerAct ?? '' , 0, '.', ',') }}</p> <br>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<form method="post" id="myForm" class="contact-form">
    @csrf
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-uppercase">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >Title</label>
                            <h3 id="title">Title</h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label text-uppercase" >Budgets <span class="text-danger">*</span></label>
                                <div id="section_budgets" style="height:400px; overflow-y: auto; overflow-x: hidden;">
                                    <div class="parentContainer">
                                        <div class="row childrenContainer">
                                            <div class="col-8">
                                                <input type="text"  name="budget[]" class="form-control" required/>
                                            </div>
                                            <div class="col-4">
                                                    <button type="button" name="addParent" id="addParent" class="addParent btn btn-success">            
                                                        <i class="fas fa-plus-circle"></i>        
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
          </div>
          <input type="hidden" id="event_id" name="event_id">
          <div class="modal-footer ">
            <input type="submit" name="action_button" id="action_button" class="btn btn-primary text-uppercase" value="Submit" />
          </div>
        </div>
      </div>
    </div>
</form>

@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $(document).on('click', '.addParent', function () {
        var html = '';
        html += '<div class="parentContainer mt-2">';
            html += '<div class="row childrenContainer">';
                html += '<div class="col-8">';
                html += '<input type="text" name="budget[]" class="form-control" required/>';
                html += '</div>';
                html += '<div class="col-4">';
                    html += '<button type="button" class="btn btn-danger removeParent">';
                        html += '<i class="fa fa-minus-circle" aria-hidden="true"></i>';
                    html += '</button>';
                html += '</div>';
            html += '</div>';
        html += '</div>';
        $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .append(html);
    
    });
    $(document).on('click', '.removeParent', function () {
        $(this).closest('#inputFormRow').remove();
        $(this).parent().parent().parent().remove();
    });

    $(document).on('click', '.detail', function(){
        $('#formModal').modal('show');
        $('.modal-title').text('Budget Detail');
      
        var id = $(this).attr('detail');
        $('#event_id').val(id);

        $.ajax({
          url :"/admin/budgets/"+id+"/edit",
          dataType:"json",
          beforeSend:function(){
          },
          success:function(data){
              $('#title').text(data.title);
              var budgets = "";
              if(data.budgets){
                $.each(data.budgets, function(key,value){
                    budgets += '<div class="parentContainer mt-2">';
                        budgets += '<div class="row childrenContainer">';
                            budgets += '<div class="col-8">';
                            budgets += '<input type="text" name="budget[]" class="form-control" value="'+value.title+'" required/>';
                            budgets += '</div>';
                            budgets += '<div class="col-4">';
                                if (key === 0) {
                                    budgets +=  '<button type="button" name="addParent" id="addParent" class="addParent btn btn-success">';            
                                        budgets +=  '<i class="fas fa-plus-circle"></i>';     
                                    budgets +=  '</button>';
                                }else{
                                    budgets += '<button type="button" class="btn btn-danger removeParent">';
                                        budgets += '<i class="fa fa-minus-circle" aria-hidden="true"></i>';
                                    budgets += '</button>';
                                }
                            budgets += '</div>';
                        budgets += '</div>';
                    budgets += '</div>';
                });
                $('#section_budgets').empty().append(budgets);
            } 
          }
      })

    });

    $('#myForm').on('submit', function(event){
        event.preventDefault();
        $('.form-control').removeClass('is-invalid')
        var url = "/admin/budgets";
        var method = "POST";

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            dataType:"json",
            beforeSend:function(){
                $("#action_button").attr("disabled", true);
                $("#action_button").val("Submitting");
            },
            success:function(data){
                $("#action_button").attr("disabled", false);
                $("#action_button").val("Submit");

            if(data.success){
                    $.confirm({
                        title: data.success,
                        content: "",
                        type: 'green',
                        buttons: {
                            confirm: {
                                text: '',
                                btnClass: 'btn-green',
                                keys: ['enter', 'shift'],
                                action: function(){
                                    location.reload();
                                }
                            },
                        }
                    });
                }
            
            }
        });
    });
});
</script>
@endsection