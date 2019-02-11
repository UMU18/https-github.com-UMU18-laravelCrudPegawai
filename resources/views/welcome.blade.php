<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gosantha - Pre Test Programer</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    </head>
    <body>

        <br><br><br><br>
        
      <div class="container">
            <div class="form-group row add">
                <div class="col-md-8">
                    <select id="searchByStatus" class="form-control">
                        <option value="">All</option>
                        <option value="0">Pegawai Kontrak</option>
                        <option value="1">Pegawai Tetap</option>
                        
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit" id="add">
                        <span class="glyphicon glyphicon-plus"></span> ADD
                    </button>
                </div>
            </div>
        {{ csrf_field() }}

        <div class="table-responsive ">
            <table class="table table-borderless" id="table">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $item)               
                <tr class="item{{$item->NIK}}">
                    <td>{{$item->NIK}}</td>
                    <td>{{$item->Nama_Pegawai}}</td>
                    <td>{{$item->unit->Nama_Unit}}</td>
                    <td>{{$item->status->Nama_Status}}</td>
                    <td><button class="edit-modal btn btn-info" data-nik="{{$item->NIK}}"
                            data-nama="{{$item->Nama_Pegawai}}" data-unit="{{$item->ID_Unit}}" data-status="{{$item->ID_Status}}">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                        <button class="delete-modal btn btn-danger"
                            data-nik="{{$item->NIK}}" data-nama="{{$item->Nama_Pegawai}}">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nik">NIK:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="NIK" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nama">Nama:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="Nama">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="unit">Unit:</label>
                            <div class="col-sm-10">
                                <select id="Unit" class="form-control">
                                    <option value="0">Produksi</option>
                                    <option value="1">Pembelian</option> 
                                    <option value="2">Penjualan</option>                       
                                </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="status">Status:</label>
                            <div class="col-sm-10">
                                <select id="Status" class="form-control">
                                    <option value="0">Kontrak</option>
                                    <option value="1">Tetap</option>                      
                                </select> 
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal addpegawai" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2">NIK:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="addNIK">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" >Nama:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="addNama">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2" >Unit:</label>
                            <div class="col-sm-10">
                                <select id="addUnit" class="form-control">
                                    <option value=" ">-- Select Unit --</option>
                                    <option value="0">Produksi</option>
                                    <option value="1">Pembelian</option> 
                                    <option value="2">Penjualan</option>                       
                                </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2">Status:</label>
                            <div class="col-sm-10">
                                <select id="addStatus" class="form-control">
                                    <option value=" ">-- Select Status --</option>
                                    <option value="0">Kontrak</option>
                                    <option value="1">Tetap</option>                      
                                </select> 
                            </div>
                        </div>
                    </form>
                    <div class="deleteContent">
                        Are you Sure you want to delete <span class="deletenama"></span> ? <span
                            class="hidden deletenik"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn actionBtn" data-dismiss="modal">
                            <span id="footer_action_button" class='glyphicon'> </span>
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
          </div>
      <script src="{{ asset('js/app.js') }}"></script>
      <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
