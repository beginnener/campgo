<!DOCTYPE html>
<html lang="en">
    @include('adminlayout.admin-header')
  <body>
    {{-- <div class="wrapper"> --}}
        @include('layouts.navbar-desktop')

        <div class="container">
          <div class="page-inner" style="padding-top: 130px">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Hello, {{ Auth::user()->name }}</h3>
                <h6 class="op-7 mb-2">Semoga harimu menyenangkan!</h6>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                      <div class="card-title">Booking History</div>
                      <div class="card-tools">
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <!-- Projects table -->
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col" class="text-end">Product</th>
                            <th scope="col" class="text-end">Borrowing Period</th>
                            <th scope="col" class="text-end"></th>
                            <th scope="col" class="text-end">Status</th>
                            <th scope="col" class="text-end"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($booking as $book)
                          <tr>
                            {{-- <th scope="row">halo</th> --}}
                            <td class="text-end">{{ $book->product->nama_produk }}</td>
                            <td class="text-end">{{ $book->start_date }}</td>
                            <td class="text-end">{{ $book->end_date }}</td>
                            <td class="text-end">{{ $book->booking_status }}</td>
                            <td class="text-end">
                              @if( $book->booking_status == 'completed' )
                                <span class="badge badge-success">Completed</span>
                              @elseif( $book->booking_status == 'returning' )
                                <span class="badge badge-warning">returning</span>
                              @else 
                                <a href="{{ url('return', $book->id) }}" class="badge btn-primary">Return</a>
                              @endif
                            </td>
                          </tr>
                          {{-- <a class="page-link" href="http://your-app-url?page=2" rel="next" aria-label="Next &raquo;">&rsaquo;</a> --}}
                          @endforeach
                        
                        </tbody>
                      </table>
                        
                      {{-- untuk paginasi --}}
                      {{-- <div class="d-flex justify-content-center">
                          {{ $transactions->links() }}
                      </div>
                     <!-- Custom Next Page Button -->
                      <div class="d-flex justify-content-center mt-3 mb-3">
                          @if ($transactions->hasMorePages())
                              <a href="{{ $transactions->nextPageUrl() }}" class="btn btn-primary">Next Page</a>
                          @else
                              <button class="btn btn-primary" disabled>No More Pages</button>
                          @endif
                      </div> --}}

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                      <div class="card-title">Transaction History</div>
                      <div class="card-tools">
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <!-- Projects table -->
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">User_id</th>
                            <th scope="col" class="text-end">Date & Time</th>
                            <th scope="col" class="text-end">Amount</th>
                            <th scope="col" class="text-end">Payment Method</th>
                            <th scope="col" class="text-end">Status</th>
                            <th scope="col" class="text-end">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {{-- @foreach ($transactions as $transaction) --}}
                          <tr>
                            <th scope="row">
                              {{-- {{ $transaction['id_user'] }} --}}
                            </th>
                            <td class="text-end"></td>
                            <td class="text-end"></td>
                            <td class="text-end"></td>
                            <td class="text-end"></td>
                            <td class="text-end">
                              {{-- @if( $transaction['status_transaksi']=='completed' )
                                <span class="badge badge-success">Completed</span>
                              @else 
                                <a href="{{ url('acc_transaction', $transaction->id) }}" class="badge badge-success">Accept</a>
                              @endif --}}
                            </td>
                          </tr>
                          {{-- <a class="page-link" href="http://your-app-url?page=2" rel="next" aria-label="Next &raquo;">&rsaquo;</a> --}}
                        
                        </tbody>
                      </table>
                        
                      {{-- untuk paginasi --}}
                      {{-- <div class="d-flex justify-content-center">
                          {{ $transactions->links() }}
                      </div>
                     <!-- Custom Next Page Button -->
                      <div class="d-flex justify-content-center mt-3 mb-3">
                          @if ($transactions->hasMorePages())
                              <a href="{{ $transactions->nextPageUrl() }}" class="btn btn-primary">Next Page</a>
                          @else
                              <button class="btn btn-primary" disabled>No More Pages</button>
                          @endif
                      </div> --}}

                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="http://www.themekita.com">
                    ThemeKita
                  </a>
                </li>
                <li class="nav-item">
                  {{-- <a class="nav-link" href="#"> Help </a> --}}
                </li>
                <li class="nav-item">
                  {{-- <a class="nav-link" href="#"> Licenses </a> --}}
                </li>
              </ul>
            </nav>
            <div class="copyright">
              2024, made with <i class="fa fa-heart heart text-danger"></i> by
              <a href="http://www.themekita.com">ThemeKita</a>
            </div>
            <div>
              Distributed by
              <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
            </div>
          </div>
        </footer>
      {{-- </div> --}}

    @include('adminlayout.footer')
  </body>
</html>
