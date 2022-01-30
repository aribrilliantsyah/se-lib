  <table border="1" class="table">
    <thead>
        <tr>
          <td style="100%" colspan="9">
            <h1>REPORT SE-LIB - {{ $month }} {{ $year }}</h1>
          </td>
        </tr>
        <tr>
            <th>MEMBER</th>
            <th>BOOK</th>
            <th>BORROWED AT</th>
            <th>RETURNED?</th>
            <th>RETURNED AT</th>
            <th>EXTENDED</th>
            <th>RETURN ESTIMATE</th>
            {{-- <th>LATE BACK?</th> --}}
            <th>OPERATOR (BORROWING)</th>
            <th>OPERATOR (RETURN)</th>
        </tr>
    </thead>
    <tbody>
        @if(count($borrow_log) > 0 )
        @foreach ($borrow_log as $log)
            <tr>
                <td>{{$log->member->full_name}}</td>
                <td>{{$log->book->book}}</td>
                <td>{{\Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i:s')}}</td>
                <td style="text-align: center;">{{$log->is_returned ? 'YES': 'NO'}}</td>
                <td>{{$log->is_returned ? \Carbon\Carbon::parse($log->updated_at)->format('Y-m-d H:i:s') : ''}}</td>
                <td style="text-align:center;">{{$log->total_extended}}</td>
                <td>{{\Carbon\Carbon::parse($log->return_estimate)->format('Y-m-d')}}</td>
                <td>{{$log->user_create->name}}</td>
                <td>{{$log->user_update->name}}</td>
            </tr>
        @endforeach
        @else
            <tr>
                <td colspan="9" style="text-align: center;">No data to display</td>
            </tr>
        @endif
    </tbody>
  </table>