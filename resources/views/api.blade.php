 @include("components/common/header")
 <main>
     <div class="text-center">
         TODO: Work in Progress
     </div>
</main>

         {{--
 <main>
     <div class="container">
         <div class="text-start row">

             <div class="col-1"><!-- spacer.gif --></div>
 <div class="col-6">

     <div class="row">
         <h1 class="fs-2 fw-bold text-start text-nowrap  mb-4 p-0">Costanza API</h1>
     </div>

     <div class="row pt-5 pb-3">
         <p class="text-startml-0 pl-0 fs-6">Because of course! This is a demo application, so the API workflow is very simple:</p>
         <ol class="list-group-numbered pt-3 pl-8 text-nowrap">
             <li class="list-group-item">Point your REST client @ <small><code>/api/v1/token/create</small></code></small> and provide an email address.</li>
             <li class="list-group-item">Costanza will send an email with a link to verify: click it!</li>
             <li class="list-group-item">Once verified, make another request to <small><code>/api/v1/token/create</small></code></small> to generate an auth token.</li>
             <li class="list-group-item">Use that token to make delicious poetry!</li>
         </ol>
     </div>

     <hr />

     <div class="row pt-5 pb-3">
         <a id="create-token"></a>
         <h1 class="fs-4">Create Token</h1>
         <small>Generates an API token for authentication.</small>
         <p>
             <code><small>POST /api/v1/token/create</small></code>



         <h4 class="pt-3 m-0">Request Body:</h4>
         <pre><code><small>
{
    "email": "you@example.org"
}
                </small></code></pre>

         <h4>Sample Response (after email verification):</h4>
         <pre><code><small>
{
    "success": true,
    "token": "99|ABCDEFGHIJKLMNOPQRSTUVWXYZ"
}
</small></code></pre>

         </p>
     </div>
     <div class="row pt-5 pb-3">
         <a id="create-poem"></a>
         <h1 class="fs-4">Create Poem</h1>
         <small>Provide parameters to create a poem.</small>
         <p>
             <code><small>POST /api/v1/poem/create</small></code>

         <h4 class="pt-3 m-0">Request Body:</h4>
         <pre><code><small>
{
    "result": "success",
        "data": {
            "id": 714
        }
}
</small></code></pre>


         </p>
     </div>
     <div class="row pt-5">
         <a id="get-poem"></a>
         <h1 class="fs-4">Get Poem</h1>
         <small>Retrieve a poem by ID</small>
         <p>
             <code><small>GET /api/v1/poem/{id}</small></code>

         <h4 class="pt-3 m-0">Sample Response:</h4>

         <pre><code><small>
{
    "result": "success",
        "data": {
            "id": 714
        }
}
</small></code></pre>



     </div>

 </div>

 <div class="col-1"><!-- spacer.gif --></div>
 <!-- <div class="col-3 text-start">

                 <h3 class="pb-3 fw-bold fs-5">API Endpoints</h3>
                 <ul class="list-group">

                     <a href="#token-create" class="list-group-item list-group-item-action">Create Token</a>
                     <a href="#poem-create" class="list-group-item list-group-item-action">Create Poem</a>
                     <a href="#poem-get" class="list-group-item list-group-item-action">Get Poem</a>

                 </ul>

             </div> -->
 <div class="col-1"><!-- spacer.gif --></div>

 </div>
 </div>




 </main>
 --}}



         @include("components/common/footer")