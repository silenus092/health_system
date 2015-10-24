
@extends('app')

@section('content')
<script type="text/javascript" CHARSET="UTF-8">
/*$(function(){
$.amaran({
'theme'     :'awesome ok',
'content'   :{
title:'Welcome !!',
message:'You are successfully logged in!',
info:'',
icon:'fa fa-check-square-o'
},
'position'          :'top right',
'inEffect'  :'slideTop',
'delay' : 4000
});
});*/
var datas = "" ;
$(document).ready(function() {
   $.ajax({
           type: "get",
           url: "{{ url('/persons_index') }}",
           cache: false,
           success: function(html)
               {
                  console.log(stringify(html));
                  datas = stringify(html) ;
               }
      });

   $('#search_patient-query').typeahead({
      order: "desc",
      minLength: 1,
      hint: true,
      cache: true,
      correlativeTemplate: true,
      source: {
         person: {
          url: {
             type: "get",
             url: "{{ url('/persons_index') }}",
          }
      }
      },
      callback: {
         onClickAfter: function (node, a, item, event) {
         },
         onResult: function (node, query, obj, objCount) {

            var text = "";
            if (query !== "") {
               text = objCount + ' elements matching "' + query + '"';
            }else {
               text ="";
            }
            $('#result-container').text(text);

         },
         fail: function (jqXHR, textStatus, errorThrown) {
            alert("Cannot Search this time");
         },

      }
      });
   });
   </script>
   <div class="container">
      <div class="row">
         <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
               <div class="panel-heading">Home</div>
               <div class="panel-body">

                  @if (Session::has('message'))
                  {!! Amaran::theme('user green')->content([
                  'message'=>Session::get('message'),
                  'user'=>' ICBS',
                  'img'=>URL::asset('images/ICBS.png'),
                  ])
                  ->position('top right')
                  ->inEffect('slideTop')
                  ->create();
                  !!}
                  @endif
                  <var id="result-container" class="result-container"></var>
                  <form action="{{ url('/show_person')}}" method="post">
                     <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                     <div class="typeahead-container">
                        <div class="typeahead-field">
                           <span class="typeahead-query">
                              <input id="search_patient-query"  name="search_patient-query" type="search" placeholder="Search (ชื่อ,นามสกุล,บัตรประชาชน)" autocomplete="off">
                           </span>
                           <span class="typeahead-button">
                              <button type="submit" class="btn btn-primary" >
                                 <i class="typeahead-search-icon"></i>
                              </button>
                           </span>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endsection
