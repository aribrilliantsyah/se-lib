@extends('admin.parent')

@section('title', 'Library')

@section('styles')
    
@endsection

@section('breadcrum')
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-white d-inline-block mb-0">Library</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="ni ni-books"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Library</li>
      </ol>
    </nav>
  </div>
@endsection

@section('page')
  <div class="row">
    <div class="col-xl-12 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0"><i class="fas fa-search"></i> Search Members</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div class="input-group mb-3">
              <select class="form-control" id="member" name="member_id" readonly></select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0"><i class="fas fa-user"></i> Member Information</h3>
            </div>
          </div>
        </div>
        <div class="card-body" id="profile-information">
          <div class="alert alert-info"><strong>Please</strong> select one of any members!</div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0"><i class="fas fa-book"></i> Detail Books</h3>
            </div>
            <div class="col-4 text-right">
              <a href="" class="btn btn-sm btn-primary" id="borrow_button" style="display: none;"><i class="ni ni-fat-add"></i> Borrow</a>
            </div>
          </div>
        </div>
        <div class="card-body">        
          @include('admin.alert')
          <div class="table-responsive py-4">
            <table class="table dt_table table-flush table-vertical-align" id="borrowed_books">
              <thead class="thead-light">
                <tr>
                  <th>Cover</th>
                  <th>Book</th>
                  <th>Borrowed At</th>
                  <th>Returned?</th>
                  <th>Return Estimate</th>
                  <th>Late Back?</th>
                  <th>Action</th>
                </tr>
            </thead>
              <tbody>
              
              </tbody>
              <tfoot>
                <tr>
                  <th>Cover</th>
                  <th>Book</th>
                  <th>Borrowed At</th>
                  <th>Returned?</th>
                  <th>Return Estimate</th>
                  <th>Late Back?</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  var table_log = '';
  var g_member_id = '';
  $(() => {
    setTimeout(() => {
      $('#member').attr('readonly', false);
      setTimeout(() => {
        initSelect2Member()
        $('#member').on('change', () => {
          on_member_change()
        })
      }, 500);
    }, 3000);
    
    @if(isset($member_id))
      get_info_member({{$member_id}})
      get_borrowed_books({{$member_id}})
    @endif

    table_log = $('#borrowed_books').DataTable({
      "columns": [
        { 
          "data": "book.cover", 
          "render": function(data, meta, row) {
            return `<img onerror="this.src='${base_url}assets/img/theme/team-3.jpg'" src="${data}" class="book-cover">`;
          }
        },
        { 
          "data": "book.book", 
          "render": function(data, meta, row) {
            return data;
          }
        },
        { 
          "data": "created_at", 
          "render": function(data, meta, row) {
            return moment(data, "YYYY-MM-DD H:mm:ss").format('DD/MM/YYYY HH:mm:ss');
          }
        },
        { 
          "data": "updated_at", 
          "render": function(data, meta, row) {
            if(row.is_returned == '1'){
              return moment(data, "YYYY-MM-DD H:mm:ss").format('DD/MM/YYYY HH:mm:ss');
            }

            return '<span class="badge badge-danger">not yet</span>';
          }
        },
        { 
          "data": "return_estimate", 
          "render": function(data, meta, row) {
            return moment(data, "YYYY-MM-DD H:mm:ss").format('DD/MM/YYYY');
          }
        },
        { 
          "data": "return_estimate", 
          "render": function(data, meta, row) {
            if(row.is_returned == '0'){
              return '';
            }else{
              let date1 = moment(row.updated_at, 'YYYY-MM-DD HH:mm:ss');
              let date2 = moment(data, 'YYYY-MM-DD HH:mm:ss');
              
              return date1.isAfter(date2) ? '<span class="badge badge-danger"> YES </span>' : '<span class="badge badge-success"> NO </span>';
            }
          }
        },
        { 
          "data": "id", 
          "render": function(data, meta, row) {
            if(row.is_returned == '0'){
              return `<a href="${base_url}admin/borrow_log/on_return/${g_member_id}/${row.book_id}/${row.id}" class="btn btn-sm btn-primary"><i class="fas fa-undo"></i> Return</a>`;
            }else{
              return '';
            }
          }
        },
      ]
    }); 
  })

  function get_info_member(member_id){
    let url = `${base_url}admin/borrow_log/member_detail/${member_id}`;
    $.getJSON(url).done((res) => {
      if(res.status != undefined && res.status){
        let html = '<div class="alert alert-info"><strong>Please</strong> select one of any members!</div>'
        if(res.data != '' || res.data.length > 0){
          html = `<table class="table table-bordered">
            <tr>
              <td>Code</td>
              <th>${res.data.code}</th>
            </tr>
            <tr>
              <td>Full Name</td>
              <th>${res.data.full_name}</th>
            </tr>
            <tr>
              <td>Address</td>
              <th>${res.data.address}</th>
            </tr>
            <tr>
              <td>Gender</td>
              <th>${res.data.gender}</th>
            </tr>
            <tr>
              <td>Photo</td>
              <th><img onerror="this.src='${base_url}assets/img/theme/team-3.jpg'" src="${res.data.photo}" class="avatar rounded-circle"></th>
            </tr>
            <tr>
              <td>Profession</td>
              <th>${res.data.profession}</th>
            </tr>
          </table>`;
        }
        g_member_id = member_id;
        $('#profile-information').html(html)
      }
    }).fail((xhr) => {
      console.log(res)
      alert('Server is busy!')
    })
  }

  function get_borrowed_books(member_id){
    let url = `${base_url}admin/borrow_log/borrowed_books/${member_id}`;
    $.getJSON(url).done((res) => {
      console.log(res)
      $('#borrow_button').hide();
      if(res.status != undefined && res.status){
        $('#borrow_button').show();
        $('#borrow_button').attr('href', `${base_url}admin/borrow_log/borrow/${member_id}`);
        if(res.data != '' || res.data.length > 0){
          for(let i = 0; i < res.data.length; i++){
            table_log.row.add(res.data[i])
          }
          table_log.draw();
        }
      }
    }).fail((xhr) => {
      console.log(res)
      alert('Server is busy!')
    })
  }

  function on_member_change(){
    let member_id = $('#member').val();
    console.log(member_id)
    get_info_member(member_id)
    get_borrowed_books(member_id)
  }

  function initSelect2Member(){
    $('#member').select2({
      placeholder: "Search Members Name",
      ajax: {
        url: `${base_url}admin/borrow_log/member_list`,
        dataType: 'json',
        delay: 250,
        data: function (data) {
          return {
            searchTerm: data.term // search term
          };
        },
        processResults: function (response) {
          console.log(response)
          return {
            results: response
          };
        },
        cache: true
      },
      escapeMarkup: function(markup) {
        return markup;
      },
      templateResult: function(data) {
        return data.html;
      },
      templateSelection: function(data) {
        return data.text;
      },
      minimumInputLength: 1,
    })
  }
</script>
@endsection