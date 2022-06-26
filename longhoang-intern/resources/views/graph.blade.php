<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" />
    <title>Document</title>
</head>
<body>
    @extends('shopify-app::layouts.default')

@section('content')
    <!-- You are: (shop domain name) -->
    <p>You are: {{  Auth::user()->name }}</p>
@endsection

@section('scripts')
    @parent

    <script>
        var AppBridge = window['app-bridge'];
        var actions=AppBridge.actions;
        var TitleBar=actions.TitleBar;
        var Button =actions.Button;
        var Redirect=actions.Redirect;
        var titleBarOptions={
            title:'Welcome',
        };
        var myTitleBar=TitleBar.create(app,titleBarOptions);
    </script>
@endsection

<main>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <a class="btn btn-outline-primary" href="{{ url('/') }}" role="button">API</a>
                <a class="btn btn-outline-danger" href="{{ url('/graph123') }}" role="button">GRAPHQL</a>
                <br><br>



                <div class="form-group">
                  <button class="button btn btn-info prev" data-rel="previous"  data-info="" data-rel="previous" data-id="20" data-type="" data-val="">Previous</button>
                  <button class="button btn btn-info next" data-rel="next" data-info="<?php echo $nextpage; ?>" data-id="20" data-type="" data-val="">Next</button>
                </div>


                

                    <div class="input-group">
                        <input type="text" id="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        <input type="hidden" id="subdomain" name="subdomain" value="">
                        <button type="button" class="btn btn-outline-primary">search</button>
                      </div>
                      <br>

                      <div class="form-group">
                        <label for="exampleInputEmail1">search collections</label>
                        <select id="collect" class="form-select form-horizontal" name="collect" style="width:100%;">
                          <option value="">hãy chọn collections</option>
                          @foreach ($listcollect as $collect)
                         
                           @foreach ($collect as $key1=>$value1)
                  
                           <option value="{{$value1['id']}}" name="{{ $value1['title'] }}" data-id2="{{$value1['id']}}" >{{$value1['title']}}</option>
                  
                  
                           @endforeach
                           @endforeach
                          
                  
                      </select>
                  
                      </div>
                      <br>


                      <div class="form-group">
                        <label for="exampleInputEmail1">search vendor</label>
                        <select id="vendor" class="form-select form-horizontal" name1="vendor" style="width:100%;">
                          <option value="">hãy chọn vendor</option>
                          @foreach ($listvendor as $vendor)
                         
                           {{-- @foreach ($vendor as $key2=>$value2) --}}
                  
                           {{-- <option  name="{{ $value2['node'] }}" data-id3="{{$value2['node']}}" >{{$value2['node']}}</option> --}}
                           <option name1="{{ $vendor['node'] }}" data-id3="{{$vendor['node']}}">{{ $vendor['node'] }}</option> 
                  
                  
                           {{-- @endforeach --}}
                           @endforeach
                          
                  
                      </select>
                  
                      </div>
                      <br>

                      {{-- <div class="form-group">
                        <label for="exampleInputEmail1">search tag</label>
                        <select id="tags" class="form-select form-horizontal" name2="tags" style="width:100%;">
                          <option value="">hãy chọn tag</option>
                          @foreach ($listtags as $tag)
                         
                          
                           <option name2="{{ $tag['node'] }}" data-id4="{{$tag['node']}}">{{ $tag['node'] }}</option> 
                  
                  
                        
                           @endforeach
                          
                  
                      </select>
                  
                      </div>
                      <br> --}}

{{-- 
                      <div class="form-group">
                        <div class="multi_select_box" style="width: 400px; margin:80px auto">
                          <label for="exampleInputEmail1">search collections</label>
                          <select id="collect" name="collect" class="multi_select w-100" style="width: 100%" multiple>
                            <option value="">hãy chọn collections</option>
                           

                            @foreach ($listcollect as $collect)
                         
                           @foreach ($collect as $key1=>$value1)
                  
                           <option value="{{$value1['title']}}" name="{{ $value1['title'] }}" data-id2="{{$value1['id']}}" >{{$value1['title']}}</option>
                  
                  
                           @endforeach
                           @endforeach
                          
                          </select>
                          
                          
                        </div>
                      </div> --}}

                      <div class="form-group">
                        <div class="multi_select_box" style="width: 400px; margin:80px auto">
                          <label for="exampleInputEmail1">search tag</label>
                          <select id="tags" name2="tags" class="multi_select w-100" style="width: 100%" multiple>
                            <option value="">hãy chọn tag</option>
                            @foreach ($listtags as $tag)
                              <option name2="{{ $tag['node'] }}" data-id4="{{$tag['node']}}">{{ $tag['node'] }}</option> 
                            @endforeach
                          
                          </select>
                          
                          
                        </div>
                      </div>
                     

               
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th >Product</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="products">
                   
                        @foreach($product_graph as $key => $product) 
                            <?php $image=$product['node']['images']['edges'][0]['node']['url']; ?>
                            <tr>
                                <td><img width="100" height="100" src="{{$image}}" alt=""></td>
                                <td>{{ $product['node']['title']}}</td>
                                <td>{{$product['node']['description']}}</td>
                                <td>
                                    <a class="btn btn-primary" data-toggle="collapse" href="#{{ $product['node']['id'] }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Link with href
                                    </a>
                                    <div class="collapse" id="{{ $product['node']['id'] }}">
                                        <div class="card card-body">
                                            
                                             <table class="table">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">#</th>
                                                    {{-- <th scope="col">Image</th> --}}
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">compare price</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($product['node']['variants']['edges'] as $key1 =>$var)
                                                        
                                                        <tr>
                                                            <th scope="row"></th>
                                                            
                                                            <td>{{ $var['node']['title'] }}</td>
                                                            <td>${{ $var['node']['price'] }}</td>
                                                            <td>${{ $var['node']['compareAtPrice'] }}</td>
                                                        </tr>
                                                  @endforeach
                                                </tbody>
                                               
                                              </table>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                         

                </tbody>
            </table>
           
     
            
        </div>
        </div>
    </div>
    </div>
    </section>
</main>
</body>
</html>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}

<script stype="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script stype="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.js"></script>
<script stype="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

<script>
  $(document).ready(function(){
   
    $('.multi_select').selectpicker();
//     $('.multi_select').change(function(){
//   var arr = $(this).val();
//   console.log(arr)
// })
  
    
  });

</script>



<script>
    $('#search').keypress(function (e) {
  
  if (e.which == 13) {

      var search = $(this).val();
    //   var shop = $('#subdomain').val();
      //alert(shop);
      
    
  

      $.ajax({
          type: "POST",
          url: "{{route('search_graphql')}}",
          data: {
              term: search,
              
            //   subdomain: shop
          },           
          dataType: "json",               
          success: function(response){                    
              //$('#products').html(response);
              $('button[data-rel="previous"]').attr('data-type', response['type']);
            $('button[data-rel="previous"]').attr('data-val', response['value']);
            if( response['prevstatus'] ==true ) {
              
            $('button[data-rel="previous"]').attr('data-info', response['prev']);

          } else {
            $('button[data-rel="previous"]').attr('data-info', "");
          }

          if( response['nextstatus'] ==true ) {
            $('button[data-rel="next"]').attr('data-info', response['next']);
            $('button[data-rel="next"]').attr('data-type', response['type']);
            $('button[data-rel="next"]').attr('data-val', response['value']);
          } else {
            $('button[data-rel="next"]').attr('data-info', "");
          }

          if( response['html'] != '' ) {
            $('#products').html(response['html']);
          }

             
          }
      });

      return false;
    }
});

$('#collect').change(function() {
  // $('.multi_select').change(function(){
    var name = $(this).find(':selected').attr('name');
    alert(name)
       //var name2 = $(this).val();
      //console.log(arr)
      //alert(name2);
      // var mySelections = [];
      //   $('.multi_select option').each(function(i) {
      //           if (this.selected == true) {
      //                   mySelections.push(this.value);
      //           }
      //   });
      //   alert(mySelections.join(','));
        //mySelections=mySelections.join(',');
    
      $.ajax({
          type: "POST",
          url: "{{route('search_collections')}}", 
          data: {
            name: name,
          
          },           
          dataType: "json",               
          success: function(response) {
            // console.log(response);
            //   $('#products').html(response);
            $('button[data-rel="previous"]').attr('data-type', response['type']);
            $('button[data-rel="previous"]').attr('data-val', response['value']);
            if( response['prevstatus'] ==true ) {
              
            $('button[data-rel="previous"]').attr('data-info', response['prev']);

          } else {
            $('button[data-rel="previous"]').attr('data-info', "");
          }

          if( response['nextstatus'] ==true ) {
            $('button[data-rel="next"]').attr('data-info', response['next']);
            $('button[data-rel="next"]').attr('data-type', response['type']);
            $('button[data-rel="next"]').attr('data-val', response['value']);
          } else {
            $('button[data-rel="next"]').attr('data-info', "");
          }

          if( response['html'] != '' ) {
            $('#products').html(response['html']);
          }


          }
        });

    });

    $('#vendor').change(function() {
    var name1 = $(this).find(':selected').attr('name1');
      //alert(name1)
    
      $.ajax({
          type: "POST",
          url: "{{route('search_vendor')}}", 
          data: {
            name1: name1,
          
          },           
          dataType: "json",               
          success: function(response) {
            console.log(response);
              //$('#products').html(response);
              //console.log(response);
            $('button[data-rel="previous"]').attr('data-type', response['type']);
            $('button[data-rel="previous"]').attr('data-val', response['value']);
            if( response['prevstatus'] ==true ) {
              
            $('button[data-rel="previous"]').attr('data-info', response['prev']);

          } else {
            $('button[data-rel="previous"]').attr('data-info', "");
          }

          if( response['nextstatus'] ==true ) {
            $('button[data-rel="next"]').attr('data-info', response['next']);
            $('button[data-rel="next"]').attr('data-type', response['type']);
            $('button[data-rel="next"]').attr('data-val', response['value']);
          } else {
            $('button[data-rel="next"]').attr('data-info', "");
          }

          if( response['html'] != '' ) {
            $('#products').html(response['html']);
          }


          }
        });

    });

    // $('#tags').change(function() {
    $('.multi_select').change(function(){
      //var name2 = $(this).val();
      //console.log(arr)
      //alert(name2);
    
    // var name2 = $(this).find(':selected').attr('name2');
    // alert(name2)
    // var values = $('.multi_select').val();
    // alert(values);
    var mySelections = [];
        $('.multi_select option').each(function(i) {
                if (this.selected == true) {
                        mySelections.push(this.value);
                }
        });
        //alert(mySelections.join(','));
        mySelections=mySelections.join(',');
    
      $.ajax({
          type: "POST",
          url: "{{route('search_tags')}}", 
          data: {
            name2: mySelections,
          
          },           
          dataType: "json",               
          success: function(response) {
            //console.log(response);
              //$('#products').html(response);
              //alert(response);
              $('button[data-rel="previous"]').attr('data-type', response['type']);
            $('button[data-rel="previous"]').attr('data-val', response['value']);
            if( response['prevstatus'] ==true ) {
              
            $('button[data-rel="previous"]').attr('data-info', response['prev']);

          } else {
            $('button[data-rel="previous"]').attr('data-info', "");
          }

          if( response['nextstatus'] ==true ) {
            $('button[data-rel="next"]').attr('data-info', response['next']);
            $('button[data-rel="next"]').attr('data-type', response['type']);
            $('button[data-rel="next"]').attr('data-val', response['value']);
          } else {
            $('button[data-rel="next"]').attr('data-info', "");
          }

          if( response['html'] != '' ) {
            $('#products').html(response['html']);
          }


          }
        });

    });


    $('.next').on('click', function(e) {
      alert('123');
    var data_info = $(this).attr('data-info');
    var data_id = $(this).attr('data-id');
    var data_type = $(this).attr('data-type');
    var value = $(this).attr('data-val');

    if(data_info != '') {
      $.ajax({
        type: "POST",
        url: "{{route('paginate123')}}", 
        headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
        data: {
          id: data_id,
          page_info: data_info,
          type:data_type,
          value:value
        },           
        dataType: "json",               
        success: function(response) {
        //  console.log(response)
   
          if( response['prevstatus'] ==true ) {
            $('button[data-rel="previous"]').attr('data-info', response['prev']);
          } else {
            $('button[data-rel="previous"]').attr('data-info', "");
          }

          if( response['nextstatus'] ==true ) {
            $('button[data-rel="next"]').attr('data-info', response['next']);
          } else {
            $('button[data-rel="next"]').attr('data-info', "");
          }

          if( response['html'] != '' ) {
            $('#products').html(response['html']);
          }
        }
      });
    }else{
    alert('reach limit')
    }
  });


  
  $('.prev').on('click', function(e) {
    var data_info = $(this).attr('data-info');
    var data_id = $(this).attr('data-id');
    var data_type = $(this).attr('data-type');
    var value = $(this).attr('data-val');


    if(data_info != '') {
      $.ajax({
        type: "POST",
        url: "{{route('paginate1233')}}", 
        headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
        data: {
          id: data_id,
          page_info: data_info,
          type:data_type,
          value:value
        },           
        dataType: "json",               
        success: function(response) {
        //  console.log(response)
   
          if( response['prevstatus'] ==true ) {
            $('button[data-rel="previous"]').attr('data-info', response['prev']);
          } else {
            $('button[data-rel="previous"]').attr('data-info', "");
          }

          if( response['nextstatus'] ==true ) {
            $('button[data-rel="next"]').attr('data-info', response['next']);
          } else {
            $('button[data-rel="next"]').attr('data-info', "");
          }

          if( response['html'] != '' ) {
            $('#products').html(response['html']);
          }
        }
      });
    }else{
    alert('reach limit')
    }

   
    

  });



</script>
<script>
</script>