@extends('layouts.store')
@push('css')
    {{-- <link rel="stylesheet" href="{{asset("css/notification.css")}}"> --}}
        <!-- Vertical tabs CSS -->
    <link rel="stylesheet" href="{{asset("css/b4vtabs.css")}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/datatables.min.css"/>
    <style>
        table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .9em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
      </style>
@endpush
{{-- {{dd($notifications)}} --}}
 @section('store_content')
<div class="container-fluid p-lg-4">
    <div class="row">
        <div class="col-md-12">
          <hr />
          <h3>Notifications</h3>
          <hr />
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <ul class="nav nav-tabs left-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#lorem-left" data-toggle="tab">Notifications</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#trash" title="Trash" data-toggle="tab">Trash</a>
            </li>
          </ul>
        </div>

        <div class="col-md-10 p-0 m-0">
          <div class="container-fluid p-0 m-0">
            <div class="tab-content p-0">
              <article class="tab-pane container-fluid active p-0" id="lorem-left">
                {{-- <h1>Lorem</h1> --}}
                <div class="card bg-white">
                    <div class="card-body">
                <table class="table table-borderless table-striped table-hover  notifications">
                    <thead>
                        <td>
                            {{-- <div class="d-flex justify-content-lg-between">
                                <div class="div bd-highlight">
                                            <input class="styled-checkbox" id="checkall" type="checkbox">
                                            <label for="styled-checkbox-1"></label>
                                  
                                </div>
                            </div> --}}
                        </td>
                        <tr>
                            <th></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notification_list as $notifications)
                        @if($notifications['type']=="App\Notifications\productRequest")  
                         <tr id="{{$notifications['id']}}">
                             <td>
                                <div class="d-flex bd-highlight">
                                    <div class="p-2 flex-fill bd-highlight">
                                      <a href="javascript:;" onclick="showProdReqNoti('{{$notifications['id']}}','{{$store->id}}')" class="inbox-item">
                                        <h6 class="mb-1 {{is_null($notifications['read_at']) ? 'font-weight-bolder' : ''}}" >Product request</h6>
                                      </a>
                                    </div>
                                    <div class="p-2 flex-fill  bd-highlight">
                                      {{print_r($notifications['title'])}}
                                    </div>
                                </div>
                            </td> 
                            <td>
                              <div class="bd-hightlight p-2">
                                <ul class="ul-item-menu">
                                    <li><a href="javascript:;" onclick="moveToTrash('{{$notifications['id']}}')"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Move to trash" aria-hidden="true"></i></a></li>    
                                    <li ><a href="javascript:;"><i class="fa fa-envelope-open" data-toggle="tooltip" data-placement="top" title="mark read" aria-hidden="true"></i></a></li>    
                                </ul>
                            </div>
                            </td>
                        <td>
                            <p style="margin-top:10px">{{$notifications['date']}}</p>

                        </td> 
                        </tr>
                        @endif
                        @endforeach

                       
                        
                        
                    </tbody>
                     </table>
                    </div>
                </div>
           
                
              </article>
       
              {{-- <article class="tab-pane container" id="llanfairpwllgwyngyll-left">
                <h1>Llanfair­pwllgwyngyll­gogery­chwyrn­drobwll­llan­tysilio­gogo­goch</h1>
                <section>
                  <p><small>From Wikipedia, the free encyclopedia</small></p>
                </section>
                <section>
                  <p>
                    stared
                  </p>
                  <p>
                    <a
                      href="https://en.wikipedia.org/wiki/Llanfairpwllgwyngyll"
                      target="_blank"
                      title="Open Wikipedia article in a new tab."
                      >Full article &gt;</a
                    >
                  </p>
                </section>
              </article> --}}

              <article class="tab-pane container" id="trash">
               
                <div class="card bg-white">
                  <div class="card-body">
              <table class="table table-borderless table-striped table-hover  notifications">
                  <thead>
                      <td>
                          <div class="d-flex justify-content-lg-between">
                              <div class="div bd-highlight">
                                          <input class="styled-checkbox" id="checkall" type="checkbox">
                                          <label for="styled-checkbox-1"></label>
                                
                              </div>
                          </div>
                      </td>
                      <tr>
                          <th></th>
                          <th scope="row"></th>
                          <th scope="row"></th>
                          <th scope="row"></th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($trash as $notifications)
                       <tr id="{{$notifications['id']}}">
                          <td><input type="checkbox" class="checkitem"/></td>
                           <td scope="row">
                              <div class="d-flex justify-content-lg-start">
                                  <div class="bd-hightlight p-2">
                                    <a href="javascript:;" onclick="showNotification('{{$notifications['id']}}','{{$store->id}}')" class="inbox-item">
                                      <h6 class="mb-1 {{is_null($notifications['read_at']) ? 'font-weight-bolder' : ''}}" >Product request</h6>
                                    </a>
                                  </div>
                                  <div class="bd-hightlight p-2 flex-fill">
                                   {{print_r($notifications['title'])}}
                                  </div>
                              </div>
                          </td> 
                          <td>
                            <div class="bd-hightlight p-2">
                              <ul class="ul-item-menu">
                                  <li><a href="javascript:;" onclick="restore('{{$notifications['id']}})"><i data-feather="refresh-cw" data-toggle="tooltip" data-placement="top" title="Restore" aria-hidden="true"></i></a></li>    
                              </ul>
                          </div>
                          </td>
                      <td scope="row">
                          <p style="margin-top:10px">{{$notifications['date']}}</p>

                      </td> 
                      </tr>
                      @endforeach

                     
                      
                      
                  </tbody>
                   </table>
                  </div>
              </div>
              </article>

            </div>
          </div>
        </div>


        
      </div>

</div>



  </div> 


@endsection
@push("scripts")
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/datatables.min.js"></script>
<script>
    $(function() {
      var datatable = $('.notifications').DataTable({
        dom: '<"#positionFilter">t'
    });
    
    $('#positionFilter').html('<input type="text" class="form-control w-100" placeholder="Search Notificatons">');
    
    $(document).on('keyup', '#positionFilter input', function() {
        var value = $(this).val();
        console.log(value);
        datatable.columns(2).search(value).draw();
    });

    $("#checkall").change(function(){
        $('.checkitem').prop("checked",$(this).prop("checked"));
    });
});



function moveToTrash(id,){
$("#"+id).fadeOut("slow").hide().remove();
//ajax
$.get('/move-to-trash/'+id,function(response){
  console.log(response);
})
}

$("#trash").on("load",function(){
  alert("loaded");
});


function restore(id,){
$("#"+id).fadeOut("slow").hide().remove();
//ajax
$.get('/restore-notification/'+id,function(response){
  console.log(response);
})
}

</script>
@endpush