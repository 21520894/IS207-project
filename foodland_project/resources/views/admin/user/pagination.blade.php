<table class="table manager-site__manager">
    <tr class="manager-site__manager-row">
        <th class="manager-site__manager-header">ID</th>
        <th class="manager-site__manager-header">PHONE</th>
        <th class="manager-site__manager-header">NAME</th>
        <th class="manager-site__manager-header">EMAIL</th>
        <th class="manager-site__manager-header">REGISTER DATE</th>
        <th class="manager-site__manager-header">ACCOUNT TYPE</th>
        <th class="manager-site__manager-header">EDIT</th>
        <th class="manager-site__manager-header">
            <input type="checkbox" name="" id="select_all_ids">
        </th>
    </tr>
    @if($users!=null)
    @for($i=0;$i<count($users);$i++)
    <tr class="manager-site__manager-row" id="user_ids{{$users[$i]->id}}">
        <td class="manager-site__manager-data">{{$users[$i]->id}}</td>
        <td class="manager-site__manager-data">{{$users[$i]->phone}}</td>
        <td class="manager-site__manager-data">{{$users[$i]->name}}</td>
        <td class="manager-site__manager-data">{{$users[$i]->email}}</td>
        <td class="manager-site__manager-data">{{$users[$i]->created_at}}</td>
        <td class="manager-site__manager-data" id="account_type">{{$users[$i]->role==1?'Admin':'Customer'}}</td>
        <td class="manager-site__manager-data">
            <button name="editUser"
                    class="data__edit-btn btn update_user_form"
                    data-id="{{$i+1}}"
                    data-name="{{$users[$i]->name}}"
                    data-phone="{{$users[$i]->phone}}"
                    data-email="{{$users[$i]->email}}"
                    data-created="{{$users[$i]->created_at}}"
                    data-role="{{$users[$i]->role==1}}"
            >EDIT</button>
        </td>
        <td class="manager-site__manager-data">
            <input class="data__checkbox" type="checkbox" name="ids" id="" value="{{$users[$i]->id}}">
        </td>
    </tr>
    @endfor
    @endif
</table>
<div class="pagination">
    @if(!empty($users))
    {{$users->links('vendor.pagination.default') }}
    @endif
</div>
