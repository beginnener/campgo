<!DOCTYPE html>
<html lang="en">
    @include('adminlayout.admin-header')
  <body>
    {{-- <div class="wrapper"> --}}
        @include('adminlayout.admin-nav')

        <div class="container">
          <div class="page-inner" style="padding-top: 130px">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Hello, {{ Auth::user()->name }}</h3>
                <h6 class="op-7 mb-2">Semangat Kerjanya Hari Ini!</h6>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        {{-- <div --}}
                          {{-- class="icon-big text-center icon-success bubble-shadow-small" --}}
                        {{-- > --}}
                          {{-- <i class="fas fa-luggage-cart"></i> --}}
                        {{-- </div> --}}
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Sales</p>
                          <h4 class="card-title">$ 1,345</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        {{-- <div
                          class="icon-big text-center icon-secondary bubble-shadow-small"
                        > --}}
                          {{-- <i class="far fa-check-circle"></i> --}}
                        {{-- </div> --}}
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Order</p>
                          <h4 class="card-title">576</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                {{-- <div class="card card-round">
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
                            <th scope="col">Payment Number</th>
                            <th scope="col" class="text-end">Date & Time</th>
                            <th scope="col" class="text-end">Amount</th>
                            <th scope="col" class="text-end">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">
                              <button
                                class="btn btn-icon btn-round btn-success btn-sm me-2"
                              >
                                <i class="fa fa-check"></i>
                              </button>
                              Payment from #10231
                            </th>
                            <td class="text-end">Mar 19, 2020, 2.45pm</td>
                            <td class="text-end">$250.00</td>
                            <td class="text-end">
                              <span class="badge badge-success">Completed</span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div> --}}
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
                          @foreach ($transactions as $transaction)
                          <tr>
                            <th scope="row">
                              {{ $transaction['id_user'] }}
                            </th>
                            <td class="text-end">{{ $transaction['created_at'] }}</td>
                            <td class="text-end">Rp{{ number_format($transaction['total_transaksi']) }}</td>
                            <td class="text-end">{{ $transaction['metode_transaksi'] }}</td>
                            <td class="text-end">{{ $transaction['status_transaksi'] }}</td>
                            <td class="text-end">
                              @if( $transaction['status_transaksi']=='completed' )
                                <span class="badge badge-success">Completed</span>
                              @else 
                                <a href="{{ url('acc_transaction', $transaction->id) }}" class="badge badge-success">Accept</a>
                              @endif
                            </td>
                          </tr>
                          @endforeach
                          {{-- <a class="page-link" href="http://your-app-url?page=2" rel="next" aria-label="Next &raquo;">&rsaquo;</a> --}}
                        
                        </tbody>
                      </table>
                        
                      {{-- untuk paginasi --}}
                      <div class="d-flex justify-content-center">
                          {{ $transactions->links() }}
                      </div>
                     <!-- Custom Next Page Button -->
                      <div class="d-flex justify-content-center mt-3 mb-3">
                          @if ($transactions->hasMorePages())
                              <a href="{{ $transactions->nextPageUrl() }}" class="btn btn-primary">Next Page</a>
                          @else
                              <button class="btn btn-primary" disabled>No More Pages</button>
                          @endif
                      </div>

                    </div>
                  </div>
                </div>
              </div>
                <div class="col-md-4">
                  <div class="card card-round">
                    <div class="card-body">
                      <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Top Customers</div>
                        <div class="card-tools">
                        </div>
                      </div>
                      <div class="card-list py-4">
                        <div class="item-list">
                          <div class="avatar">
                            <span
                              class="avatar-title rounded-circle border border-white bg-secondary"
                              >F</span
                            >
                          </div>
                          <div class="info-user ms-3">
                            <div class="username">Farrah</div>
                            <div class="status">Marketing</div>
                          </div>
                          {{-- <button class="btn btn-icon btn-link op-8 me-1">
                            <i class="far fa-envelope"></i>
                          </button>
                          <button class="btn btn-icon btn-link btn-danger op-8">
                            <i class="fas fa-ban"></i>
                          </button> --}}
                        </div>
                      </div>
                    </div>
                </div>
                
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                
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

      <!-- Custom template | don't include it in your project! -->
      {{-- <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
          <div class="switcher">
            <div class="switch-block">
              <h4>Logo Header</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="selected changeLogoHeaderColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="blue"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="purple"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="light-blue"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="green"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="orange"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="red"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="white"
                ></button>
                <br />
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="dark2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="blue2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="purple2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="light-blue2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="green2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="orange2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="red2"
                ></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Navbar Header</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="blue"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="purple"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="light-blue"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="green"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="orange"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="red"
                ></button>
                <button
                  type="button"
                  class="selected changeTopBarColor"
                  data-color="white"
                ></button>
                <br />
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="dark2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="blue2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="purple2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="light-blue2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="green2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="orange2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="red2"
                ></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Sidebar</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="changeSideBarColor"
                  data-color="white"
                ></button>
                <button
                  type="button"
                  class="selected changeSideBarColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeSideBarColor"
                  data-color="dark2"
                ></button>
              </div>
            </div>
          </div>
        </div>
        <div class="custom-toggle">
          <i class="icon-settings"></i>
        </div>
      </div>
      <!-- End Custom template -->
    </div> --}}
    @include('adminlayout.footer')
  </body>
</html>
