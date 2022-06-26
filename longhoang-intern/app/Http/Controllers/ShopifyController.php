<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopifyController extends Controller
{
  public function str_btwn($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
    
    public function rest_api($token, $shop, $api_endpoint, $query = array(), $method = 'GET', $request_headers = array()) {
        $url = "https://" . $shop . $api_endpoint;
        if (!is_null($query) && in_array($method, array('GET', 	'DELETE'))) $url = $url . "?" . http_build_query($query);
      
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, TRUE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
      
        $request_headers[] = "";
        $headers[] = "Content-Type: application/json";
        if (!is_null($token)) $request_headers[] = "X-Shopify-Access-Token: " . $token;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
      
        if ($method != 'GET' && in_array($method, array('POST', 'PUT'))) {
          if (is_array($query)) $query = json_encode($query);
          curl_setopt ($curl, CURLOPT_POSTFIELDS, $query);
        }
          
        $response = curl_exec($curl);
        $error_number = curl_errno($curl);
        $error_message = curl_error($curl);
        curl_close($curl);
      
        if ($error_number) {
          return $error_message;
        } else {
      
          $response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);

          $headers = array();
          $header_data = explode("\n",$response[0]);
          $headers['status'] = $header_data[0];
          array_shift($header_data);
          foreach($header_data as $part) {
            $h = explode(":", $part,2);
            $headers[trim($h[0])] = trim($h[1]);
          }
          return array('headers' => $headers, 'data' => $response[1]);
      
        }
          
    }

    public function shopify_call($token, $shop, $api_endpoint, $query = array(), $method = 'GET', $request_headers = array()) {
    
      // Build URL
      $url = "https://" . $shop . ".myshopify.com" . $api_endpoint;
      if (!is_null($query) && in_array($method, array('GET', 	'DELETE'))) $url = $url . "?" . http_build_query($query);
    
      // Configure cURL
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, TRUE);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 3);
      // curl_setopt($curl, CURLOPT_SSLVERSION, 3);
      curl_setopt($curl, CURLOPT_USERAGENT, 'My New Shopify App v.1');
      curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
      curl_setopt($curl, CURLOPT_TIMEOUT, 30);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    
      // Setup headers
      $request_headers[] = "";
      if (!is_null($token)) $request_headers[] = "X-Shopify-Access-Token: " . $token;
      curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
    
      if ($method != 'GET' && in_array($method, array('POST', 'PUT'))) {
        if (is_array($query)) $query = http_build_query($query);
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $query);
      }
        
      // Send request to Shopify and capture any errors
      $response = curl_exec($curl);
      $error_number = curl_errno($curl);
      $error_message = curl_error($curl);
    
      // Close cURL to be nice
      curl_close($curl);
    
      // Return an error is cURL has a problem
      if ($error_number) {
        return $error_message;
      } else {
    
        // No error, return Shopify's response by parsing out the body and the headers
        $response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);
    
        // Convert headers into an array
        $headers = array();
        $header_data = explode("\n",$response[0]);
        $headers['status'] = $header_data[0]; // Does not contain a key, have to explicitly set
        array_shift($header_data); // Remove status, we've already set it above
        foreach($header_data as $part) {
          $h = explode(":", $part);
          $headers[trim($h[0])] = trim($h[1]);
        }
    
        // Return headers and Shopify's response
        return array('headers' => $headers, 'response' => $response[1]);
    
      }
        
    }

   
    

    public function search_ajax()
    {

     
      $html = '';
      $search_term = $_POST['term'];
      $shop = $_POST['subdomain'];
      $token = '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'; //replace with your access token

      $array = array(
        'fields' => 'id,title,product_type,variants,images'
      );
      
      $products = $this->shopify_call('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', $shop, "/admin/api/2022-04/products.json", $array, 'GET');
      
      $products = json_decode($products['response'], JSON_PRETTY_PRINT);
      $src='';


      foreach ($products as $product) {
        foreach ($product as $key => $value) {
          if( stripos( $value['title'], $search_term ) !== false ) {
            //$html .= '<p>' . $value['title'] . '</p>';
            $image='';
      if(count($value['images'])>0) {
        $image=$value['images'][0]['src'];
      }
      $variant='';
     
     
      foreach($value['variants'] as $key =>$var){

          foreach($value['images'] as $key1 =>$img)
          {
              if($img['id']==$var['image_id'])
                  $src=$img['src'];
                                      
          }
          $variant.='
                    <tr>
                        <th scope="row"></th>
                        <td><img width="50" height="50" src="'.$src.'" alt=""></td>
                        <td>'.$var['title'].'</td>
                        <td>$'.$var['price'].'</td>
                        <td>$'.$var['compare_at_price'].'</td>
                      </tr>';
      }

      $html.='
     
      <tbody id="products">
      <div id="accordion">
      <tr>
          <td><img width="100" height="100" src="'. $image .'" alt=""></td>
          <td>' .$value['title']. '</td>
          <td>'. $value['product_type'] .'</td>
          <td>
              <a class="btn btn-primary" data-toggle="collapse" href="#'. $value['id'] .'" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Link with href
              </a>
              <div class="collapse" id="'. $value['id'] .'">
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

                          '.$variant.'
                          

                          </tbody>
                         
                        </table>
                  </div>
              </div>
          </td>
         
      </tr>
     
  </div>

      ';
      
          }
         
  
        }
       
      }
     

      echo $html;
    }

    public function serachbycollect(){

      $shop_url=$_POST['url'];
      $id=$_POST['id'];
      $html='';
      $token = "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";  //Add your access token here
        $array = array(
          'fields' => 'id,title,product_type,variants,images',
          'limit' => '5',
        );
        $collect=$this->rest_api('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', $shop_url, '/admin/api/2022-04/collections/'.$id.'/products.json',  $array, 'GET');
        $listcollect=json_decode($collect['data'],true);
        //dd($listcollect);


foreach($listcollect as $product) { 
    foreach($product as $key => $value) { 
      $image='';
      if(count($value['images'])>0) {
        $image=$value['images'][0]['src'];
      }

		$html .= '     

    <tr data-toggle="collapse"  class="accordion-toggle" data-target="#demo'.$value['id'].'">
        
        <td><a href="#"><img src="'.$image.'" width="100" height="100" alt=""></a></td>
        <td>'.$value['id'].'</td>
        <td>'.$value['title'].'</td>
        <td>'.$value['product_type'].'</td>
        <td> 
            <a href="#" class="btn btn-default btn-sm">
      <i class="glyphicon glyphicon-cog"></i>
                </a>
        </td>
    </tr>
    
  ';
    }
}
echo json_encode( $html);

      
     }




    public function customerList(){
        $shop=Auth::user(); 
        // $product=$shop->api()->rest('GET','/admin/api/2022-04/products.json',['limit'=>2]);
        // $headers=$product['response'];
        // $list=$product["body"]["container"]["products"];
        $array = array(
          'limit' => 10
        );
        $shop_url=$_GET['shop'];
        $products =$this->rest_api('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', $shop_url, "/admin/api/2022-04/products.json",  $array, 'GET');
        $shop_url= $_GET['shop'];
        $list=json_decode($products['data'],true);
       // dd($list);
        $headers=$products['headers'];

        $nextPageURL = $this->str_btwn($headers['link'], '<', '>');
         $nextPageURLparam = parse_url($nextPageURL); 
         parse_str($nextPageURLparam['query'], $value);
         $page_info = $value['page_info'];

         $collect=$this->rest_api('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', $shop_url, "/admin/api/2022-04/custom_collections.json",  $array, 'GET');
        $listcollect=json_decode($collect['data'],true);
        //dd($listcollect);
        // echo $page_info;
         return view('welcome',compact('list','shop_url','page_info','listcollect'));

    }
    public function customerget(Request $request){
      $shop_url=$_POST['url'];
      $page_info=$_POST['page_info'];
      $rel=$_POST['rel'];
      

      $number=$_POST['id'];
        
      
      $array = array(
        'limit' => $number,
        'page_info'=>$page_info,
        'rel'=>$rel
      );
      $products =$this->rest_api('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', $shop_url, "/admin/api/2022-04/products.json",  $array, 'GET');
//Get the headers
$headers = $products['headers'];

//Create an array for link header
$link_array = array();

//Check if there's more than one links / page infos. Otherwise, get the one and only link provided
if( strpos( $headers['link'], ',' )  !== false ) {
	$link_array = explode(',', $headers['link'] );
} else {
	$link = $headers['link'];
}
//Create variables for the new page infos
$prev_link = '';
$next_link = '';

//Check if the $link_array variable's size is more than one
if( sizeof( $link_array ) > 1 ) {
    $prev_link = $link_array[0];
    $prev_link = $this->str_btwn($prev_link, '<', '>');

    $param = parse_url($prev_link); 
    parse_str($param['query'], $prev_link); 
    $prev_link = $prev_link['page_info'];

    $next_link = $link_array[1];
    $next_link = $this->str_btwn($next_link, '<', '>');

    $param = parse_url($next_link); 
    parse_str($param['query'], $next_link); 

    $next_link = $next_link['page_info'];
} else {
    $rel = explode(";", $headers['link']);
    $rel = $this->str_btwn($rel[1], '"', '"');

    if($rel == "previous") {
        $prev_link = $link;
        $prev_link = $this->str_btwn($prev_link, '<', '>');

        $param = parse_url($prev_link); 
        parse_str($param['query'], $prev_link); 

        $prev_link = $prev_link['page_info'];

        $next_link = "";
    } else {
        $next_link = $link;
        $next_link = $this->str_btwn($next_link, '<', '>');

        $param = parse_url($next_link); 
        parse_str($param['query'], $next_link); 

        $next_link = $next_link['page_info'];

        $prev_link = "";
    }
}

$html = '';

$src='';

$products = json_decode($products['data'], true);

foreach($products as $product) { 
    foreach($product as $key => $value) { 
      $image='';
      if(count($value['images'])>0) {
        $image=$value['images'][0]['src'];
      }
      $variant='';
      foreach($value['variants'] as $key =>$var){

          foreach($value['images'] as $key1 =>$img)
          {
              if($img['id']==$var['image_id'])
                  $src=$img['src'];
                                      
          }
          $variant.='
                    <tr>
                        <th scope="row"></th>
                        <td><img width="50" height="50" src="'.$src.'" alt=""></td>
                        <td>'.$var['title'].'</td>
                        <td>$'.$var['price'].'</td>
                        <td>$'.$var['compare_at_price'].'</td>
                      </tr>';
      }

      $html.='
      <div id="accordion">
      <tr>
          <td><img width="100" height="100" src="'. $image .'" alt=""></td>
          <td>' .$value['title']. '</td>
          <td>'. $value['product_type'] .'</td>
          <td>
              <a class="btn btn-primary" data-toggle="collapse" href="#'. $value['id'] .'" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Link with href
              </a>
              <div class="collapse" id="'. $value['id'] .'">
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

                          '.$variant.'
                          

                          </tbody>
                         
                        </table>
                  </div>
              </div>
          </td>
         
      </tr>
     
  </div>
      ';

    } 
}
echo json_encode( array( 'prev' => $prev_link, 'next' => $next_link, 'html' => $html ,'number'=>$number) );
    }
    
  



}

