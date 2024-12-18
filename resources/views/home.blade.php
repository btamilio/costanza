 @include("components/common/header")


 <main>


     <div class="container">
         <div class="row text-center">

             <div class="col-2 text-center text-wrap fs-6 fst-italic">
                 <img src="/img/costanza_logo.png" alt="Costanza" id="logo" /><br />
                 <hr class="mb-3  " />
                 <b>CO<u>S</u>TANZA</b> is an AI agent seeking inspiration from <b>you</b> to create <s>{{ $inspiration_adjective ?? "amazing" }}</s> uncanny poetry.
                 <hr class="mt-3   " />
             </div>
             <div class="col-1"><!-- spacer.gif --></div>
             <div class="col-6 text-nowrap">
                 <div class="row">
                     <h2 class="fs-2 fw-bold text-start text-capitalize text-nowrap font-capitalize m-0 mb-3 p-0">{{ $prompt_prompt ?? "Let's Make a Poem!" }}</h2>
                 </div>





                 @include("components.make-poem")


                 <div class="row">
                     <div class="col-3"><!-- spacer.gif --></div>
                     <div class="col-9 fs-6 text-center mt-2"><small><b>ProTip&trade;: </b><i>keep ¯\_(ツ)_/¯ selected to use default or improvised values.</i></small></div>
                 </div>
             </div>
             <div class="col"><!-- spacer.gif --></div>
         </div>

 </main>


 @include("components/common/footer")