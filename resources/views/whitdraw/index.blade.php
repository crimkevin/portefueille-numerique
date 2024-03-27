@extends('layouts.app')

@section('content')

        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                        
                    <div class="card" >
                        <div class="">
                          <div class="">
                            <div class="modal-header border-bottom-0">
                              <h4 class="modal-title" id="exampleModalLabel">Crediter le compte</h4>
                            </div>
                            <div class="modal-body">
                              <form action="{{route('withdraw.store')}}" method="post">
                                @csrf
                                @method('post')
                                <div class="row">
                                  <div class="col-lg-6 mb-4 pb-2">
                                    <div class="form-group">
                                      <label for="amountTransaction" class="form-label">Amount</label>
                                      <input type="number" name="amountTransaction" class="form-control shadow-none" id="amountTransaction" placeholder="ex: 25000">
                                    </div>
                                  </div>
                                  {{-- <div class="col-lg-6 mb-4 pb-2">
                                    <div class="form-group">
                                      <label for="loan_how_long_for" class="form-label">How long for?</label>
                                      <input type="number" class="form-control shadow-none" id="loan_how_long_for" placeholder="ex: 12">
                                    </div>
                                  </div> --}}
                                  {{-- <div class="col-lg-12 mb-4 pb-2">
                                    <div class="form-group">
                                      <label for="loan_repayment" class="form-label">Repayment</label>
                                      <input type="number" class="form-control shadow-none" id="loan_repayment" disabled>
                                    </div>
                                  </div> --}}
                                  <div class="col-lg-6 mb-4 pb-2">
                                    <div class="form-group">
                                      <label for="loan_full_name" class="form-label">PaymentMethod</label>
                                      <input type="text" class="form-control shadow-none" name="PaymentMethod" id="PaymentMethod">
                                    </div>
                                  </div>
                                  {{-- <div class="col-lg-6 mb-4 pb-2">
                                    <div class="form-group">
                                      <label for="loan_email_address" class="form-label">Email address</label>
                                      <input type="email" class="form-control shadow-none" id="loan_email_address">
                                    </div>
                                  </div> --}}
                                  <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary w-100">Envoyer</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
  
                </div>
            </div>
        </div>
@endsection


