@extends('layout.master')
@section('content')
<div id="app">
  <div class="app-content content">
      <div class="content-wrapper">
          <div class="content-body">
              <!-- Basic form layout section start -->
              <section id="basic-form-layouts">
                  <div class="row match-height">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-header">
                                  <h4 class="card-title" id="basic-layout-form">Position Type Information</h4>
                                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                  <div class="heading-elements">
                                      <ul class="list-inline mb-0">
                                          <li><button @click="openModal('#myModal')" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary" data-action="collapse"><i class="ft-view"></i> View New</button></li>
                                      </ul>
                                  </div>
                              </div>
                              <div class="card-content collapse show">
                                  <div class="alert alert-danger print-error-msg" style="display:none">
                                      <ul></ul>
                                  </div>

                                  <div class="card-body">
                                      jaslkdfjlksajdf
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
              <!-- // Basic form layout section end -->
          </div>
      </div>
  </div>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <product-form-component :savebutton="true" :updatebutton="true" modal="#myModal"></product-form-component>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
