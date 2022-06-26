<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class GraphController extends Controller
{
    
    public function index()
    {
    
    }
    public function search_graph()
    {
        $html = '';
        $search_term = $_POST['term'];
        

        
       
        $shop=Auth::user();
       
        $query='{
            products (first:11, query: "title:*'.$search_term.'*") {
                edges {
                  node {
                    id
                    title
                    description
                    images(first: 1){
                      edges{
                        node{
                          id
                          url
                        }
                      }
                    }
                  }
                }
                pageInfo{
                  hasNextPage
                  endCursor
                  hasPreviousPage
                  startCursor
                }
              }
          }';
        $result = $shop->api()->graph($query);
       
        $product_graph=$result['body']->container['data']['products']['edges'];
        $nextpage=$result['body']['container']['data']['products']['pageInfo']['endCursor'];
        $nextstatus=$result['body']['container']['data']['products']['pageInfo']['hasNextPage'];
        $prevpage=$result['body']['container']['data']['products']['pageInfo']['startCursor'];
        $prevstatus=$result['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];
        if(count($product_graph)>0)
        {
        
        foreach ($product_graph as $key => $product) {
            $image=$product['node']['images']['edges'][0]['node']['url'];
           
            $html.='
           
            <tr>
                <td><img width="100" height="100" src="'.$image.'" alt=""></td>
                <td>'.$product['node']['title'].'</td>
                <td>'.$product['node']['description'].'</td>

            </tr>
           
            ';

           
            
            
        }
      }
      else
      {
        
        $html.="Hãy nhập từ khóa bạn muốn tìm kiếm cho sản phẩm và bài viết. <a href='".url('/graph123')."'>vào đây</a> Hoặc nhấn để tiếp tục mua hàng .";
      }
    
       
       //echo $html;
       echo json_encode(  array( 'prev' => $prevpage, 'next' => $nextpage,'prevstatus' => $prevstatus,'nextstatus' => $nextstatus ,'html' => $html,'type'=>'search','value'=>$search_term));

      

    
     

       //dd($product_graph);
                        
                        
        
    }
    public function view_graphql()
    {
       
       
        
        $shop=Auth::user();




        $result3 = $shop->api()->graph('{
          products (first: 10) {
              edges {
                  cursor
                  node {
                      
                  id
                  title
                  description
                  variants(first:10)
                  {
                    edges{
                      node{
                        
                        title
                        price
                        compareAtPrice
                        image {
                    
                          url
                        }
                        
                        
                        
                        
                      }
                    }
                  }
                  images(first: 1){
                      edges{
                          node{
                                  id
                                  url
                              }
                          }
                      }
                  },
              },
              pageInfo {
                endCursor
                hasNextPage
                hasPreviousPage
                startCursor
              }
              
          }
      }');
      // return $result;
      //dd($result3);
      $product_graph=$result3['body']->container['data']['products']['edges'];
      //dd($product_graph);







        $query='{
            collections(first:250) {
                edges {
                  node {
                     id,
                     handle,
                     title,
                     description,
                     productsCount
                  }
                }
              }  
          }';
        $result = $shop->api()->graph($query);
        $listcollect=$result['body']->container['data']['collections']['edges'];



        $query1='
        {
          shop {
            productVendors(first: 250) {
              edges {
                node
              }
            }
          }
        }
        ';
      $result1 = $shop->api()->graph($query1);
     

      $listvendor=$result1['body']->container['data']['shop']['productVendors']['edges'];


      $query2='
      {
        shop{
          productTags(first: 250){
            pageInfo{
              hasNextPage
            }
            edges{
              node
              cursor
            }
          }
        }
      }

      ';
      $result2 = $shop->api()->graph($query2);
     

      $listtags=$result2['body']->container['data']['shop']['productTags']['edges'];
      $nextpage=$result3['body']['container']['data']['products']['pageInfo']['endCursor'];
      //dd($nextpage);

      //dd($listtags);


      return view('graph',compact('listcollect','listvendor','listtags','product_graph','nextpage'));

    }
    public function search_vendor()
    {
      $html = '';
      $name_vendor = $_POST['name1'];
      //$name='longhoang-api';
      
        
      $shop=Auth::user();
      $query='
          query {
            products(first:5, query:"vendor:'.$name_vendor.'") {
              pageInfo {
                hasNextPage
                endCursor
                hasPreviousPage
                startCursor
              }
              edges {
                cursor
                node {
                  id
                  title
                  description
                    images(first: 1){
                      edges{
                        node{
                          id
                          url
                        }
                      }
                    }
                  tags
                }
              }
            }
          }
      
      ';

      $result = $shop->api()->graph($query);
      $product_graph=$result['body']->container['data']['products']['edges'];

      $nextpage=$result['body']['container']['data']['products']['pageInfo']['endCursor'];
      $nextstatus=$result['body']['container']['data']['products']['pageInfo']['hasNextPage'];
      $prevpage=$result['body']['container']['data']['products']['pageInfo']['startCursor'];
      $prevstatus=$result['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];
       
     //dd($product_graph);
     foreach ($product_graph as $key => $product) {
      $image=$product['node']['images']['edges'][0]['node']['url'];
     
      $html.='
     
      <tr>
          <td><img width="100" height="100" src="'.$image.'" alt=""></td>
          <td>'.$product['node']['title'].'</td>
          <td>'.$product['node']['description'].'</td>

      </tr>
    
      ';

     
      
      
  }
  //echo $html;
  echo json_encode(  array( 'prev' => $prevpage, 'next' => $nextpage,'prevstatus' => $prevstatus,'nextstatus' => $nextstatus ,'html' => $html,'type'=>'vendors','value'=>$name_vendor));




    }
    public function search_tags()
    {
      $html = '';
      $tags = $_POST['name2'];
      //$name='01/13';
      //$tags = json_encode($_POST['name2']);
     
      //$tags =$tags.join(',');
      
      


     $tag1="tag:[$tags]";
      
        
      $shop=Auth::user();
      // $query='
      // query {
      //   products(first:10, query:"tag:'.$name_tag.'") {
      //     pageInfo {
      //       hasNextPage
      //     }
      //     edges {
      //       cursor
      //       node {
      //         id
      //         title
      //         description
      //               images(first: 1){
      //                 edges{
      //                   node{
      //                     id
      //                     url
      //                   }
      //                 }
      //               }
      //         tags
      //       }
      //     }
      //   }
      // }
      
      // ';
      $query='
      query {
        products(first:5, query:"'.$tag1.'") {
          pageInfo {
            hasNextPage
            endCursor
            hasPreviousPage
            startCursor
          }
          edges {
            cursor
            node {
              id
              title
              description
                    images(first: 1){
                      edges{
                        node{
                          id
                          url
                        }
                      }
                    }
              tags
            }
          }
        }
      }
      
      ';

      $result = $shop->api()->graph($query);
      $product_graph=$result['body']->container['data']['products']['edges'];
      $nextpage=$result['body']['container']['data']['products']['pageInfo']['endCursor'];
      $nextstatus=$result['body']['container']['data']['products']['pageInfo']['hasNextPage'];
      $prevpage=$result['body']['container']['data']['products']['pageInfo']['startCursor'];
      $prevstatus=$result['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];

       
     //dd($product_graph);
     foreach ($product_graph as $key => $product) {
      $image=$product['node']['images']['edges'][0]['node']['url'];
     
      $html.='
     
      <tr>
          <td><img width="100" height="100" src="'.$image.'" alt=""></td>
          <td>'.$product['node']['title'].'</td>
          <td>'.$product['node']['description'].'</td>

      </tr>
    
      ';

     
      
      
  }
  echo json_encode(  array( 'prev' => $prevpage, 'next' => $nextpage,'prevstatus' => $prevstatus,'nextstatus' => $nextstatus ,'html' => $html,'type'=>'tags','value'=>$tag1));
  //echo $html;
  //echo $query;
  //echo $tags;
    }
    public function search_collections()
    {
        $html = '';
        $name_collection = $_POST['name'];
        //$name="frontpage";
        
        $shop=Auth::user();
        $query='{
            
                collectionByHandle(handle: "'.$name_collection.'") {
                  products(first: 5) {
                    pageInfo {
                      hasNextPage
                      endCursor
                      hasPreviousPage
                      startCursor
                    }
                      edges {
                      node {
                        id
                        title
                        description
                        handle
                        images(first: 1){
                                    edges{
                                      node{
                                        id
                                        url
                                      }
                                    }
                                  }
                      }
                    }
                  }
                }
              
          }';
        $result = $shop->api()->graph($query);
        $product_graph=$result['body']->container['data']['collectionByHandle']['products']['edges'];
        $prevpage= $result['body']['container']['data']['collectionByHandle']['products']['pageInfo']['startCursor'];
        $nextpage= $result['body']['container']['data']['collectionByHandle']['products']['pageInfo']['endCursor'];
        $nextstatus= $result['body']['container']['data']['collectionByHandle']['products']['pageInfo']['hasNextPage'];
        $prevstatus= $result['body']['container']['data']['collectionByHandle']['products']['pageInfo']['hasPreviousPage'];
       
        //dd($product_graph);

        foreach ($product_graph as $key => $product) {
            $image=$product['node']['images']['edges'][0]['node']['url'];
           
            $html.='
           
            <tr>
                <td><img width="100" height="100" src="'.$image.'" alt=""></td>
                <td>'.$product['node']['title'].'</td>
                <td>'.$product['node']['description'].'</td>

            </tr>
          
            ';

           
            
            
        }
        //echo $html;
        echo json_encode(  array( 'prev' => $prevpage, 'next' => $nextpage,'prevstatus' => $prevstatus,'nextstatus' => $nextstatus ,'html' => $html,'type'=>'collections','value'=>$name_collection));
       
    }
    public function Productget(){
      $shop=Auth::user();
      $num=$_POST['id'];
      $next=$_POST['page_info'];
      $type=$_POST['type'];
      $value=$_POST['value'];
      if(isset($next)){
        if($type=='')
        {
          $query='{  products(first:'.$num.' , after:"'.$next.'" )
              {
                edges{
                  node{
                    id
                    title
                    description
                    variants(first:10)
                    {
                      edges{
                        node{
                          id
                          title
                          compareAtPrice
                        }
                      }
                    }
                    images(first:1)
                    {
                      edges{
                        node{
                          id
                          url
                        }
                      }
                    }
                  }
                }
                pageInfo{
                  hasNextPage
                  endCursor
                  hasPreviousPage
                  startCursor
                }
             } 
            }
          ';
          $product=$shop->api()->graph($query);
          //dd($product['body']['container']['data']['products']['pageInfo']['endCursor']);
          $prevpage=$product['body']['container']['data']['products']['pageInfo']['startCursor'];
          $nextpage=$product['body']['container']['data']['products']['pageInfo']['endCursor'];
          $nextstatus=$product['body']['container']['data']['products']['pageInfo']['hasNextPage'];
          $prevstatus=$product['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];
          $list=$product['body']['container']['data']['products']['edges'];
        }
        else if($type=='vendors')
        {
          $query='
          query {
            products(first:10, query:"vendor:'.$value.'",after:"'.$next.'") {
              pageInfo {
                hasNextPage
                endCursor
                hasPreviousPage
                startCursor
              }
              edges {
                cursor
                node {
                  id
                  title
                   variants(first:10)
                  {
                    edges{
                      node{
                        id
                        title
                        price
                        compareAtPrice
                      }
                    }
                  }
                  description
                        images(first: 1){
                          edges{
                            node{
                              id
                              url
                            }
                          }
                        }
                  tags
                }
              }
            }
          }
          ';
          $product=$shop->api()->graph($query);
          // dd($product['body']['container']['data']['products']['pageInfo']['endCursor']);
      
          $list=$product['body']['container']['data']['products']['edges'];
          $nextpage=$product['body']['container']['data']['products']['pageInfo']['endCursor'];
          $nextstatus=$product['body']['container']['data']['products']['pageInfo']['hasNextPage'];
          $prevpage=$product['body']['container']['data']['products']['pageInfo']['startCursor'];
          $prevstatus=$product['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];
        }else if($type=='collections')
        {
          $query='{
            
            collectionByHandle(handle: "'.$value.'") {
           products(first:5 , after:"'.$next.'" )
            {
              edges{
                node{
                  id
                  title
                  description
                  variants(first:10)
                  {
                    edges{
                      node{
                        id
                        title
                        price
                        compareAtPrice
                      }
                    }
                  }
                  images(first:1)
                  {
                    edges{
                      node{
                        id
                        url
                      }
                    }
                  }
                }
              }
              pageInfo{
                hasNextPage
                endCursor
                hasPreviousPage
                startCursor
              }
           } 
            }
          
      }';
      $product=$shop->api()->graph($query);
     
      $list=$product['body']->container['data']['collectionByHandle']['products']['edges'];
        $prevpage= $product['body']['container']['data']['collectionByHandle']['products']['pageInfo']['startCursor'];
        $nextpage= $product['body']['container']['data']['collectionByHandle']['products']['pageInfo']['endCursor'];
        $nextstatus= $product['body']['container']['data']['collectionByHandle']['products']['pageInfo']['hasNextPage'];
        $prevstatus= $product['body']['container']['data']['collectionByHandle']['products']['pageInfo']['hasPreviousPage'];

  

        }
        else if($type=='tags')
        {
          $query='
          query {
            products(first:5, query:"'.$value.'", after:"'.$next.'") {
              pageInfo {
                hasNextPage
                endCursor
                hasPreviousPage
                startCursor
              }
              edges {
                cursor
                node {
                  id
                  title
                  description
                  variants(first:10)
                  {
                    edges{
                      node{
                        id
                        title
                        price
                        compareAtPrice
                      }
                    }
                  }
                        images(first: 1){
                          edges{
                            node{
                              id
                              url
                            }
                          }
                        }
                  tags
                }
              }
            }
          }
          
          ';
    
          $result = $shop->api()->graph($query);

          $list=$result['body']->container['data']['products']['edges'];
          $nextpage=$result['body']['container']['data']['products']['pageInfo']['endCursor'];
          $nextstatus=$result['body']['container']['data']['products']['pageInfo']['hasNextPage'];
          $prevpage=$result['body']['container']['data']['products']['pageInfo']['startCursor'];
          $prevstatus=$result['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];
        }
        else if($type=='search')
    {
      $query='{
        products (first:5, query: "title:*'.$value.'*",after:"'.$next.'") {
            edges {
              node {
                id
                title
                description
                variants(first:10)
                {
                  edges{
                    node{
                      id
                      title
                      price
                      compareAtPrice
                    }
                  }
                }
                images(first: 1){
                  edges{
                    node{
                      id
                      url
                    }
                  }
                }
              }
            }
            pageInfo{
              hasNextPage
              endCursor
              hasPreviousPage
              startCursor
            }
          }
      }';
    $result = $shop->api()->graph($query);
   
    $list=$result['body']->container['data']['products']['edges'];
    $nextpage=$result['body']['container']['data']['products']['pageInfo']['endCursor'];
    $nextstatus=$result['body']['container']['data']['products']['pageInfo']['hasNextPage'];
    $prevpage=$result['body']['container']['data']['products']['pageInfo']['startCursor'];
    $prevstatus=$result['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];

    }
  

        }
          
          $html = '';
          foreach($list as $num=>$product){

            $listvariant=$product['node']['variants']['edges'];
            $variant='';
            $compareAtPrice='';
              foreach($listvariant as $key){
                if($key['node']['compareAtPrice']==null)
                {
                  $compareAtPrice="0";
                }
                else
                {
                  $compareAtPrice=$key['node']['compareAtPrice'];
                }
                  $variant.='
                  <tr>
                    <td>'.$key['node']['id'].'</td>
                    <td>'.$key['node']['title'].'$</td>

                    <td>'.$key['node']['compareAtPrice'].'$</td>
                    <td>'. $compareAtPrice.'$</td>
                  </tr>
                  ';
              }



            $image=$product['node']['images']['edges'][0]['node']['url'];

           
            $html.='
           
            <tr>
                <td><img width="100" height="100" src="'.$image.'" alt=""></td>
                <td>'.$product['node']['title'].'</td>
                <td>'.$product['node']['description'].'</td>
                <td>
              <a class="btn btn-primary" data-toggle="collapse" href="#'. $product['node']['id'] .'" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Link with href
              </a>
              <div class="collapse" id="'.$product['node']['id'] .'">
                  <div class="card card-body">
                      
                       <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                           
                              <th scope="col">Title</th>
                             
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
          
            ';
  
  
          }
  
  
          
          echo json_encode( array( 'prev' => $prevpage, 'next' => $nextpage,'prevstatus' => $prevstatus,'nextstatus' => $nextstatus ,'html' => $html) );
      }
     
      
  

  public function Productget123()
  {
    $shop=Auth::user();
    $num=$_POST['id'];
    $next=$_POST['page_info'];
    $type=$_POST['type'];
    $value=$_POST['value'];
    if($type=='')
    {
    $query='{  products(last:'.$num.' , before:"'.$next.'" )
        {
          edges{
            node{
              id
              title
              description
              variants(first:10)
              {
                edges{
                  node{
                    id
                    title
                    compareAtPrice
                  }
                }
              }
              images(first:1)
              {
                edges{
                  node{
                    id
                    url
                  }
                }
              }
            }
          }
          pageInfo{
            hasNextPage
            endCursor
            hasPreviousPage
            startCursor
          }
       } 
      }
    ';
    $product=$shop->api()->graph($query);
    // dd($product['body']['container']['data']['products']['pageInfo']['endCursor']);
    $prevpage=$product['body']['container']['data']['products']['pageInfo']['startCursor'];
    $nextpage=$product['body']['container']['data']['products']['pageInfo']['endCursor'];
    $nextstatus=$product['body']['container']['data']['products']['pageInfo']['hasNextPage'];
    $prevstatus=$product['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];
    $list=$product['body']['container']['data']['products']['edges'];
    }else if($type=='vendors')
    {
      $query='
      query {
        products(last:5, query:"vendor:'.$value.'",before:"'.$next.'") {
          pageInfo {
            hasNextPage
            endCursor
            hasPreviousPage
            startCursor
          }
          edges {
            cursor
            node {
              id
              title
               variants(first:10)
              {
                edges{
                  node{
                    id
                    title
                    price
                    compareAtPrice
                  }
                }
              }
              description
                    images(first: 1){
                      edges{
                        node{
                          id
                          url
                        }
                      }
                    }
              tags
            }
          }
        }
      }
      ';
      $product=$shop->api()->graph($query);
      // dd($product['body']['container']['data']['products']['pageInfo']['endCursor']);
  
      $list=$product['body']['container']['data']['products']['edges'];
      $nextpage=$product['body']['container']['data']['products']['pageInfo']['endCursor'];
      $nextstatus=$product['body']['container']['data']['products']['pageInfo']['hasNextPage'];
      $prevpage=$product['body']['container']['data']['products']['pageInfo']['startCursor'];
      $prevstatus=$product['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];
    
    }else if($type=='collections')
    {

      $query='{
            
        collectionByHandle(handle: "'.$value.'") {
       products(last:5 , before:"'.$next.'" )
        {
          edges{
            node{
              id
              title
              description
              variants(first:10)
              {
                edges{
                  node{
                    id
                    title
                    price
                    compareAtPrice
                  }
                }
              }
              images(first:1)
              {
                edges{
                  node{
                    id
                    url
                  }
                }
              }
            }
          }
          pageInfo{
            hasNextPage
            endCursor
            hasPreviousPage
            startCursor
          }
       } 
        }
      
  }';
  $product=$shop->api()->graph($query);
 

    $list=$product['body']->container['data']['collectionByHandle']['products']['edges'];
    $prevpage= $product['body']['container']['data']['collectionByHandle']['products']['pageInfo']['startCursor'];
    $nextpage= $product['body']['container']['data']['collectionByHandle']['products']['pageInfo']['endCursor'];
    $nextstatus= $product['body']['container']['data']['collectionByHandle']['products']['pageInfo']['hasNextPage'];
    $prevstatus= $product['body']['container']['data']['collectionByHandle']['products']['pageInfo']['hasPreviousPage'];


    }else if($type=='tags')
    {
      $query='
          query {
            products(last:5, query:"'.$value.'",before:"'.$next.'") {
              pageInfo {
                hasNextPage
                endCursor
                hasPreviousPage
                startCursor
              }
              edges {
                cursor
                node {
                  id
                  title
                  description
                  variants(first:10)
                  {
                    edges{
                      node{
                        id
                        title
                        price
                        compareAtPrice
                      }
                    }
                  }
                        images(first: 1){
                          edges{
                            node{
                              id
                              url
                            }
                          }
                        }
                  tags
                }
              }
            }
          }
          
          ';
    
          $result = $shop->api()->graph($query);
          $list=$result['body']->container['data']['products']['edges'];
          $nextpage=$result['body']['container']['data']['products']['pageInfo']['endCursor'];
          $nextstatus=$result['body']['container']['data']['products']['pageInfo']['hasNextPage'];
          $prevpage=$result['body']['container']['data']['products']['pageInfo']['startCursor'];
          $prevstatus=$result['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];

    }
    else if($type=='search')
    {
      $query='{
        products (last:5, query: "title:*'.$value.'*",before:"'.$next.'") {
            edges {
              node {
                id
                title
                description
                variants(first:10)
                {
                  edges{
                    node{
                      id
                      title
                      price
                      compareAtPrice
                    }
                  }
                }
                images(first: 1){
                  edges{
                    node{
                      id
                      url
                    }
                  }
                }
              }
            }
            pageInfo{
              hasNextPage
              endCursor
              hasPreviousPage
              startCursor
            }
          }
      }';
    $result = $shop->api()->graph($query);
   
    $list=$result['body']->container['data']['products']['edges'];
    $nextpage=$result['body']['container']['data']['products']['pageInfo']['endCursor'];
    $nextstatus=$result['body']['container']['data']['products']['pageInfo']['hasNextPage'];
    $prevpage=$result['body']['container']['data']['products']['pageInfo']['startCursor'];
    $prevstatus=$result['body']['container']['data']['products']['pageInfo']['hasPreviousPage'];

    }
    
    $html = '';
    foreach($list as $num=>$product){
      $listvariant=$product['node']['variants']['edges'];
            $variant='';
              foreach($listvariant as $key){
                  $variant.='
                  <tr>
                    <td>'.$key['node']['id'].'</td>
                    <td>'.$key['node']['title'].'$</td>
                    <td>'.$key['node']['compareAtPrice'].'$</td>
                  </tr>
                  ';
              }

      $image=$product['node']['images']['edges'][0]['node']['url'];
           
      $html.='
     
      <tr>
          <td><img width="100" height="100" src="'.$image.'" alt=""></td>
          <td>'.$product['node']['title'].'</td>
          <td>'.$product['node']['description'].'</td>
          <td>
          <a class="btn btn-primary" data-toggle="collapse" href="#'. $product['node']['id'] .'" role="button" aria-expanded="false" aria-controls="collapseExample">
              Link with href
          </a>
          <div class="collapse" id="'.$product['node']['id'] .'">
              <div class="card card-body">
                  
                   <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                       
                          <th scope="col">Title</th>
                         
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
    
      ';



    }


    
    echo json_encode( array( 'prev' => $prevpage, 'next' => $nextpage,'prevstatus' => $prevstatus,'nextstatus' => $nextstatus ,'html' => $html) );
  }
}


