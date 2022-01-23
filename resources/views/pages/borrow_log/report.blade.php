@extends('admin.parent')

@section('title', 'Member')

@section('styles')
    
@endsection

@section('breadcrum')
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-white d-inline-block mb-0">Borrow Log</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-history"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Borrow Log</li>
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
              <h3 class="mb-0">Report</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-info">
                <span class="alert-inner--icon"><i class="fas fa-info-circle"></i></span>
                <span class="alert-inner--text"><strong>Info!</strong> Please don't fill in members to display all members </span>
              </div>
            </div>
            <div class="form-group col-md-4">
              <label>Month</label>
              <select class="form-control select2" id="month">
                <option selected disabled>[ Choose Month ]</option>
                @foreach ($months as $key => $month)
                <option value="{{ $key }}" @if($key == date('m')) selected @endif>{{ $month }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label>Year</label>
              <select class="form-control select2" id="year">
                <option selected disabled>[ Choose Year ]</option>
                @foreach ($years as $key => $year)
                <option value="{{ $year }}" @if($year == date('Y')) selected @endif>{{ $year }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label>Member</label>
              <select class="form-control select2" id="member" multiple>
                @foreach ($members as $member)
                <option value="{{ $member->id }}">{{ $member->code }} - {{ $member->full_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-12">
              <button onclick="on_preview()" class="btn btn-sm btn-primary"><i class="fa fa-filter"></i> PREVIEW</button>
              <button onclick="on_export('pdf')" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf"></i> PDF</button>
              <button onclick="" class="btn btn-sm btn-success"><i class="fa fa-file-excel"></i> EXCEL</button>
            </div>
          </div>
          <div class="table-responsive py-4">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Member</th>
                  <th>Book</th>
                  <th>Borrowed At</th>
                  <th>Returned?</th>
                  <th>Returned At</th>
                  <th>Extended</th>
                  <th>Return Estimate</th>
                  <th>Late Back?</th>
                  <th>Operator (Borrowing)</th>
                  <th>Operator (Return)</th>
                </tr>
              </thead>
              <tbody id="table-box">
                {{-- @foreach ($collection as $item)
                <tr>
                  <td>{{ $item['member'] }}</td>
                  <td>{{ $item['book'] }}</td>
                  <td>{{ date('d/m/Y', strtotime($item['borrowed_at'])) }}</td>
                  <td>{{ date('d/m/Y', strtotime($item['returned_at'])) }}</td>
                  <td>{{ date('d/m/Y', strtotime($item['return_estimate'])) }}</td>
                  <td>
                    <span class='badge badge-{{ $item['late_back'] == 'YES' ? 'success': 'danger' }}'>YES</span>
                  </td>
                </tr>
                @endforeach --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  $(() => {
    on_preview()
  })

  function on_preview(){
    let target = `${base_url}admin/borrow_log/on_preview_report`
    let year = $('#year').val()
    let month = $('#month').val()
    let member = $('#member').val(); 
    let data = {
      year: year,
      month: month,
      member: member,
    }
    console.log(data)

    $.ajax({
      url: target,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: data,
      success: function (response){
        if(response.status){
          let html = '';
          if(response.data.length > 0){
            for(let i = 0; i < response.data.length; i++){
              html += '<tr>'
              html += `<td>${response.data[i].member.full_name}</td>`
              html += `<td>${response.data[i].book.book}</td>`
              html += `<td>${moment(response.data[i].created_at).format('YYY-MM-DD HH:mm:ss')}</td>`
              html += `<td style="text-align: center;">${response.data[i].is_returned?'YES':'NO'}</td>`
              html += `<td>${response.data[i].is_returned?moment(response.data[i].updated_at).format('YYY-MM-DD HH:mm:ss'): ''}</td>`
              html += `<td>${response.data[i].total_extended}</td>`
              html += `<td>${moment(response.data[i].return_estimate).format('YYYY-MM-DD')}</td>`
              let late = '';
              if(response.data[i].return_estimate != ''){
                let date1 = moment(response.data[i].updated_at, 'YYYY-MM-DD HH:mm:ss');
                let date2 = moment(response.data[i].return_estimate, 'YYYY-MM-DD HH:mm:ss');
                
                late =  date1.isAfter(date2) ? '<span class="badge badge-danger"> YES </span>' : '<span class="badge badge-danger"> NO </span>';
              }
              html += `<td>${response.data[i].is_returned ? late : ''}</td>`
              html += `<td>${response.data[i].user_create.name}</td>`
              html += `<td>${response.data[i].user_update.name}</td>`
              html += '</tr>'
            }
          }else{
            html = '<tr><td colspan="9" style="text-align: center;"> No data to display</td></tr>'
          }

          $('#table-box').html(html)
        }
      }
    });
  }

  function on_export(type){
    let target = `${base_url}admin/borrow_log/on_export_report/${type}`
    let year = $('#year').val()
    let month = $('#month').val()
    let member = $('#member').val(); 
    let data = {
      year: year,
      month: month,
      member: member,
    }
    
    $.ajax({
      url: target,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: data,
      xhrFields: {
        responseType: 'blob'
      },
    }).done((response) => {
      var blob = new Blob([response]);
      var link = document.createElement('a');
      link.href = window.URL.createObjectURL(blob);
      link.download = `Borrow_log_${year}_${month}.pdf`;
      link.click();
    });
  }
</script>
@endsection