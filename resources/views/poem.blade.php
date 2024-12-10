 @include("components/common/header")

 <main>
     <div class="container">
         <div class="row text-center">


             <div class="col-1"><!-- spacer.gif --></div>
             <div class="col-6 text-start">

                 @if (empty($poem->lineation))
                 <div class="row">
                     <h1 class="fs-2 fw-bold text-start text-nowrap  m-0 mb-3 p-0">Poetry in Progress...</h1>
                 </div>
                 <div class="row">
                     <span class="text-center" style="width: 400px; height: auto">
                         <img src="/img/emotions/waiting.gif" class="img-fluid " />
                     </span>
                 </div>
                 @else

                 <div class="row">
                     <h1 class="fs-1 fw-bold text-start text-capitalize m-0 pb-5 p-0">{{ $poem->title ?? "Untitled Poem" }}</h1>
                 </div>

                 <div class="row">
                     <pre class="text-start m-0 p-0 fs-6">{{ trim($poem->lineation) }}</pre>
                 </div>

                 @endif
             </div>
             <div class="col-1"><!-- spacer.gif --></div>
             <div class="col-3 text-start">
                 <div class="row  pt-5">
                     </d
                         <div class="row">
                     <span class="text-start  pb-3  "><b>Inspirator:</b><br />{{ $poem->user->display_name }} </span>
                 </div>
                 <div class="row">
                     <span class="text-start   pb-3"><b>Created:</b><br />{{ $poem->created_at->format('m/d/Y'); }} </span>
                 </div>

                 @foreach ($poem->features_by_type() as $k => $v)
                 <div class="row">
                     <span class="text-start  text-capitalize pb-3"><b>{{ $k }}:</b><br />{{ $v[0]->label ?? $v[0]->name }}</span>
                 </div>
                 @endforeach
                 @if (!empty($poem->topic))
                 <div class="row">
                     <span class="text-start   pb-3"><b>Topic</b><br /><small>{{ $poem->topic }}</small></span>
                 </div>
                 @endif
                 @if (!empty($poem->authors_note))
                 <div class="row">
                     <span class="text-start   pb-3"><b>Author's Note:</b><br /><small>{{ $poem->authors_note }}</small></span>
                 </div>
                 @endif


             </div>
         </div>
 </main>




 @if (empty($poem->lineation))
 <script>
     /* temporary hack until I can get livewire working */
     function refresh() {
         location.reload();
     }
     setTimeout(refresh, 5000);
 </script>
 @endif


 @include("components/common/footer")