
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
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


              {{-- <div class="col-md-2">
                <!-- Section: Sidebar -->
                <section>
                  <!-- Section: Filters -->
                  <section id="filters" data-auto-filter="true">
                    <h5>Filters</h5>
    
                    <!-- Section: Condition -->
                    <section class="mb-4" data-filter="condition">
                      <h6 class="font-weight-bold mb-3">Condition</h6>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value="new"
                          id="condition-checkbox"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="condition-checkbox"
                        >
                          New
                        </label>
                      </div>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value="used"
                          id="condition-checkbox2"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="condition-checkbox2"
                        >
                          Used
                        </label>
                      </div>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value="collectible"
                          id="condition-checkbox3"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="condition-checkbox3"
                        >
                          Collectible
                        </label>
                      </div>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value="renewed"
                          id="condition-checkbox4"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="condition-checkbox4"
                        >
                          Renewed
                        </label>
                      </div>
                    </section>
                    <!-- Section: Condition -->
    
                  
    
                    <!-- Section: Price -->
                    <section class="mb-4">
                      <h6 class="font-weight-bold mb-3">Price</h6>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="flexRadioDefault"
                          id="price-radio"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="price-radio"
                        >
                          Under $25
                        </label>
                      </div>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="flexRadioDefault"
                          id="price-radio2"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="price-radio2"
                        >
                          $25 to $50
                        </label>
                      </div>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="flexRadioDefault"
                          id="price-radio3"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="price-radio3"
                        >
                          $50 to $100
                        </label>
                      </div>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="flexRadioDefault"
                          id="price-radio4"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="price-radio4"
                        >
                          $100 to $200
                        </label>
                      </div>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="flexRadioDefault"
                          id="price-radio5"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="price-radio5"
                        >
                          $200 & above
                        </label>
                      </div>
                    </section>
                    <!-- Section: Price -->
    
                    <!-- Section: Size -->
                    <section class="mb-4" data-filter="size">
                      <h6 class="font-weight-bold mb-3">Size</h6>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value="34"
                          id="price-checkbox"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="price-checkbox"
                        >
                          34
                        </label>
                      </div>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value="36"
                          id="price-checkbox2"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="price-checkbox2"
                        >
                          36
                        </label>
                      </div>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value="38"
                          id="price-checkbox3"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="price-checkbox3"
                        >
                          38
                        </label>
                      </div>
    
                      <div class="form-check mb-3">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value="40"
                          id="price-checkbox4"
                        />
                        <label
                          class="form-check-label text-uppercase small text-muted"
                          for="price-checkbox4"
                        >
                          40
                        </label>
                      </div>
                    </section>
                    <!-- Section: Size -->
    
                  
                  </section>
                  <!-- Section: Filters -->
                </section>
                <!-- Section: Sidebar -->
              </div> --}}



              <?php $shop="longhoang-api" ?>
             

              <div class="col-md-12">
                <a class="btn btn-outline-primary" href="{{ url('/') }}" role="button">API</a>
                <a class="btn btn-outline-danger" href="{{ url('/graph123') }}" role="button">GRAPHQL</a>
                <br><br>

                <div class="input-group">
                  <input type="text" id="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                  <input type="hidden" id="subdomain" name="subdomain" value="<?php echo $shop ?>">
                  <button type="button" class="btn btn-outline-primary">search</button>
                </div>
                <br><br>

                {{-- <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Product Type
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    
                    @foreach($listcollect as $collect)
                    @foreach($collect as $key1=>$value1)
                    <button class="dropdown-item" data-id2="{{$value1['id']}}" name="{{ $value1['id'] }}" type="button">{{ $value1['title'] }}</button>
                    @endforeach
                    @endforeach
                  
                  </div>
                </div> --}}

                <div class="form-group">
                  <label for="exampleInputEmail1">search input</label>
                  <select id="collect" class="form-select form-horizontal" name="collect" style="width:100%;">
                    <option value="">hãy chọn số sản phẩm muốn hiện</option>
                    @foreach ($listcollect as $collect)
                    {{-- @php
                    // dd($headers['headers']);
                    extract($value);
                     @endphp --}}
                     @foreach ($collect as $key1=>$value1)
            
                     <option value="{{$value1['id']}}" data-id2="{{$value1['id']}}" >{{$value1['title']}}</option>
            
            
                     @endforeach
                     @endforeach
                    
            
                </select>
            
                </div>
                <br><br>
                
                {{-- <div class="card"> --}}
                    <select id="type" class="form-select" name="type" style="width:100%;">
                        <option value="">hãy chọn số sản phẩm muốn hiện</option>
                        <option value="5" data-id2="5" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>" >5</option>
                        <option value="10" data-id2="10" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>" >10</option>
                        <option value="20" data-id2="20" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>">20</option>
                        <option value="50" data-id2="50" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>">50</option>
                        <option value="100" data-id2="100" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>">100</option>
                        <option value="150" data-id2="150" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>">150</option>
                        <option value="200" data-id2="200" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>">200</option>
                  </select>
                    <button class="button btn btn-info btn-sm"  data-info="" data-rel="previous" data-id="5" data-store="<?php echo $shop_url; ?>">Previous</button>
                    <input type="hidden" id="shopurl" value="<?php echo $shop_url; ?>">
                    <button class="button btn btn-info btn-sm" data-info="<?php echo $page_info; ?>" data-id="5" data-rel="next" data-store="<?php echo $shop_url; ?>">Next</button>
                    <div class="card" >
                    <table>
                        <thead>
                            <tr>
                                <th >Product</th>
                                <th>Name</th>
                                <th>Product Type</th>
                                <th>Action</th>
                                <th>price</th>
                            </tr>
                        </thead>
                        <tbody id="products">
                            @foreach ($list as $product)
                 
                            @foreach ($product as $key=>$value)
                   @php
                   $image='';
                    if(count($value['images'])>0) {
                      $image=$value['images'][0]['src'];
                    }
                   @endphp
                            <div id="accordion">
                                    <tr>
                                        <td><img width="100" height="100" src="{{ $image }}" alt=""></td>
                                        <td>{{ $value['title'] }}</td>
                                        <td>{{ $value['product_type'] }}</td>
                                        <td>
                                          
                                        
                                          @if (count($value['variants'])==1)
                                              <td>${{ $value['variants'][0]['price'] }}</td>
                                          @else
                                               <a class="btn btn-primary" data-toggle="collapse" href="#{{ $value['id'] }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Link with href
                                            </a>
                                            <div class="collapse" id="{{ $value['id'] }}">
                                                <div class="card card-body">
                                                    
                                                     <table class="table">
                                                        <thead>
                                                          <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Image</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">compare price</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($value['variants'] as $key =>$var)
                                                            <?php $src1=''; ?>
                                                                @foreach($value['images'] as $key1 =>$img)
                                                                    @if($img['id']==$var['image_id'])
                                                                        <?php 
                                                                       
                                                                        $src1=$img['src'];
                                                                         ?>
                                                                    @endif
                                                                @endforeach
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td><img width="50" height="50" src="{{ $src1 }}" alt=""></td>
                                                                    <td>{{ $var['title'] }}</td>
                                                                    <td>${{ $var['price'] }}</td>
                                                                    <td>${{ $var['compare_at_price'] }}</td>
                                                                </tr>
                                                          @endforeach
                                                        </tbody>
                                                       
                                                      </table>
                                                </div>
                                            </div>
                                          
                                          @endif
                                            {{-- <a class="btn btn-primary" data-toggle="collapse" href="#{{ $value['id'] }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Link with href
                                            </a>
                                            <div class="collapse" id="{{ $value['id'] }}">
                                                <div class="card card-body">
                                                    
                                                     <table class="table">
                                                        <thead>
                                                          <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Image</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">compare price</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($value['variants'] as $key =>$var)
                                                                @foreach($value['images'] as $key1 =>$img)
                                                                    @if($img['id']==$var['image_id'])
                                                                        <?php $src=$img['src']; ?>
                                                                    @endif
                                                                @endforeach
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td><img width="50" height="50" src="{{ $src }}" alt=""></td>
                                                                    <td>{{ $var['title'] }}</td>
                                                                    <td>${{ $var['price'] }}</td>
                                                                    <td>${{ $var['compare_at_price'] }}</td>
                                                                </tr>
                                                          @endforeach
                                                        </tbody>
                                                       
                                                      </table>
                                                </div>
                                            </div> --}}
                                        </td>
                                       
                                    </tr>
                                   
                                </div>
                                @endforeach
            
                            @endforeach
        
        
                        </tbody>
                    </table>
                </div>
              </div>
             
            </div>
          </div>
        {{-- <div class="card">
            <select id="type" class="form-select" name="type" style="width:100%;">
                <option value="">hãy chọn số sản phẩm muốn hiện</option>
                <option value="5" data-id2="5" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>" >5</option>
                <option value="10" data-id2="10" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>" >10</option>
                <option value="20" data-id2="20" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>">20</option>
                <option value="50" data-id2="50" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>">50</option>
                <option value="100" data-id2="100" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>">100</option>
                <option value="150" data-id2="150" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>">150</option>
                <option value="200" data-id2="200" data-info="<?php echo $page_info; ?>" data-rel="next" data-store="<?php echo $shop_url; ?>">200</option>
          </select>
            <button class="button btn btn-info"  data-info="" data-rel="previous" data-id="5" data-store="<?php echo $shop_url; ?>">Previous</button>
            <button class="button btn btn-info" data-info="<?php echo $page_info; ?>" data-id="5" data-rel="next" data-store="<?php echo $shop_url; ?>">Next</button>
            
            <table>
                <thead>
                    <tr>
                        <th >Product</th>
                        <th>Name</th>
                        <th>Product Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="product_table1">
                    @foreach ($list as $product)
         
                    @foreach ($product as $key=>$value)
           @php
           $image='';
            if(count($value['images'])>0) {
              $image=$value['images'][0]['src'];
            }
           @endphp
                    <div id="accordion">
                            <tr>
                                <td><img width="100" height="100" src="{{ $image }}" alt=""></td>
                                <td>{{ $value['title'] }}</td>
                                <td>{{ $value['product_type'] }}</td>
                                <td>
                                    <a class="btn btn-primary" data-toggle="collapse" href="#{{ $value['id'] }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Link with href
                                    </a>
                                    <div class="collapse" id="{{ $value['id'] }}">
                                        <div class="card card-body">
                                            
                                             <table class="table">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">compare price</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($value['variants'] as $key =>$var)
                                                        @foreach($value['images'] as $key1 =>$img)
                                                            @if($img['id']==$var['image_id'])
                                                                <?php $src=$img['src']; ?>
                                                            @endif
                                                        @endforeach
                                                        <tr>
                                                            <th scope="row"></th>
                                                            <td><img width="50" height="50" src="{{ $src }}" alt=""></td>
                                                            <td>{{ $var['title'] }}</td>
                                                            <td>${{ $var['price'] }}</td>
                                                            <td>${{ $var['compare_at_price'] }}</td>
                                                        </tr>
                                                  @endforeach
                                                </tbody>
                                               
                                              </table>
                                        </div>
                                    </div>
                                </td>
                               
                            </tr>
                           
                        </div>
                        @endforeach
    
                    @endforeach


                </tbody>
            </table>
        </div> --}}
    </section>
</main>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>


$('#collect').change(function() {
    var id = $(this).find(':selected').attr('data-id2');
      // alert(id)
      var url=$('#shopurl').val();
      $.ajax({
          type: "POST",
          url: "{{route('collec123')}}", 
          data: {
            id: id,
            url: url,
          },           
          dataType: "json",               
          success: function(response) {
            console.log(response);
              $('#products').html(response);

          }
        });

    });

$('#search').keypress(function (e) {
  
		if (e.which == 13) {

		    var search = $(this).val();
		    var shop = $('#subdomain').val();
        

		    $.ajax({
		        type: "POST",
		        url: "{{route('search')}}",
		        data: {
		        	term: search,
		        	subdomain: shop
		        },           
		        dataType: "html",               
		        success: function(response){                    
		            $('#products').html(response);
		        }
		    });
		    return false;
		  }
	});
  </script>
  <script>



    $(document).ready(function() {
      $('#editModal').on('shown.bs.modal', function () {
          $(".modal-backdrop.in").hide();
       })

    $('.button').on('click', function(e) {
      var data_info = $(this).attr('data-info');
      var data_rel = $(this).attr('data-rel');
      var data_store = $(this).attr('data-store');
      var data_id = $(this).attr('data-id');
      if(data_info != '') {
        $.ajax({
          type: "POST",
          url: "{{route('paginate')}}", 
          headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
          data: {
            id: data_id,
            page_info: data_info,
            rel: data_rel,
            url: data_store
          },           
          dataType: "json",               
          success: function(response) {
            console.log(response['number']);

            if( response['prev'] != '' ) {
              $('button[data-rel="previous"]').attr('data-info', response['prev']);
            } else {
              $('button[data-rel="previous"]').attr('data-info', "");
            }

            if( response['next'] != '' ) {
              $('button[data-rel="next"]').attr('data-info', response['next']);
            } else {
              $('button[data-rel="next"]').attr('data-info', "");
            }

            if( response['html'] != '' ) {
              $('#products').html(response['html']);
            }
          }
        });
      }

    });

    $('#type').change(function() {
    var id = $(this).find(':selected').attr('data-id2');

    var data_info = $(this).find(':selected').attr('data-info');
    var data_rel = $(this).find(':selected').attr('data-rel');
    var data_store = $(this).find(':selected').attr('data-store');
    //  alert(data_info)

     $.ajax({
          type: "POST",
          url: "{{route('paginate')}}", 
          data: {
            id: id,
            page_info: data_info,
            rel: data_rel,
            url: data_store
          },           
          dataType: "json",               
          success: function(response) {
            console.log(response);
            if( response['prev'] != '' ) {
              $('button[data-rel="previous"]').attr('data-info', response['prev']);
              $('button[data-rel="previous"]').attr('data-id', response['number']);
            } else {
              $('button[data-rel="previous"]').attr('data-info', "");
            }

            if( response['next'] != '' ) {
              $('button[data-rel="next"]').attr('data-info', response['next']);
              $('button[data-rel="next"]').attr('data-id', response['number']);
            } else {
              $('button[data-rel="next"]').attr('data-info', "");
            }
              $('#products').html(response['html']);
        
          }
        });
 
    });
  })
</script>