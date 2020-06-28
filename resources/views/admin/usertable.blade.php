@extends('admin_layout')
@section('admin_content')  
<div class="row"> 
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">User Table</h3>
        <a href="{{url('/add_user')}}">
          <span  class="btn btn-info float-right">
              <i class="fas fa-plus"></i> Add User
          </span>
       </a>
      </div>       
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">
          <thead>                  
            <tr>
              <th style="width: 10px">#</th>
              <th>UserId</th>
              <th>UserName</th>
              <th>UserEmail</th>
              <th>Pool Name</th>
              <th>Machine ID</th>
              <th>Level</th>
              <th style="width: 40px">status</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($all_user as $v_user)
            <tr>
              <td></td>
              <td>{{$v_user->id }}</td>
              <td>{{$v_user->name }}</td>
              <td>{{$v_user->email }}</td>
              <td>{{$v_user->pool_name }}</td>
              <td>{{ $v_user->machine_id }}</td>
              <td>
                @if($v_user->userlevel ==1)
                <span class="btn btn-success">Administator</span>
                @else
                  <span class="btn btn-primary">Members</span>
                @endif
              </td>
              <td class="center">
                @if($v_user->allow==1)
                <span class="btn btn-success">Active</span>
                    @else
                    <span class="btn btn-secondary">Unactive</span>
                @endif

            </td>
            <td class="center">
                @if($v_user->userlevel==0)
                    @if($v_user->allow==1)
                      <a class="btn btn-primary btn-sm" href="{{url('/unactive_label/'.$v_user->id)}}">
                            <i class="fas fa-thumbs-down"></i>
                      </a>
                    @else
                      <a class="btn btn-success btn-sm" href="{{url('/active_label/'.$v_user->id)}}">
                          <i class="fas fa-thumbs-up"></i>
                      </a>
                    @endif                                 
                    <span class="btn btn-danger btn-sm" onclick="delete_user(this)" id="{{$v_user->id }}"><i class="fas fa-trash"></i></span>
                @endif
                <span class="btn btn-warning btn-sm"  onclick="update_modal(this)" id="{{$v_user->id }}"><i class="fas fa-edit"></i></span> 
                <a class="btn btn-info btn-sm" href="{{url('/update_userinfo/'.$v_user->id)}}" ><i class="fas fa-plus"></i></a> 
                <label class="container_ck">
                  <input type="checkbox" 
                    @if($v_user->allow_email == 1)
                      checked="checked" 
                    @endif
                    id="ck_{{$v_user->id}}"
                    onclick="allowEmailFunc({{$v_user->id}})">
                  <span class="checkmark"></span>
                </label>
            </td>

            </tr> 
            @endforeach          
            
          </tbody>
        </table>
      </div>
     
    </div>
    <!-- /.card -->
  </div> 
</div>

<script>
  function allowEmailFunc(userId) {
    // Get the checkbox
    var checkBox = document.getElementById("ck_" + userId);
    var checkStatus = 0;
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
      checkStatus = 1;
    } else {
      checkStatus = 0;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/update_allow_email/' + userId + '/' + checkStatus,
        dataType: "JSON",
        success: function (data) {
            console.log(data)
          
        }
  
    }) 
  }
</script>

@endsection