<div class="table-data">
    <table class="manager-site__manager">
        <tr class="manager-site__manager-row">
            <th class="manager-site__manager-header">ID</th>
            <th class="manager-site__manager-header">TITLE</th>
            <th class="manager-site__manager-header">CODE</th>
            <th class="manager-site__manager-header">VALUE</th>
            <th class="manager-site__manager-header">EXPIRATION DATE</th>
            <th class="manager-site__manager-header">CONSTRAINT</th>
            <th class="manager-site__manager-header">QUANTITY</th>
            <th class="manager-site__manager-header">DELETE</th>
        </tr>
        @if($promotions!=null)
            @for($i=0;$i<count($promotions);$i++)
                <tr class="manager-site__manager-row">
                    <td class="manager-site__manager-data">{{$promotions[$i]->PromotionID}}</td>
                    <td class="manager-site__manager-data">{{$promotions[$i]->Group}}</td>
                    <td class="manager-site__manager-data">{{$promotions[$i]->CODE}}</td>
                    <td class="manager-site__manager-data">{{$promotions[$i]->Value}}</td>
                    <td class="manager-site__manager-data">{{$promotions[$i]->DateEnd}}</td>
                    <td class="manager-site__manager-data">Over {{$promotions[$i]->Constraint}}</td>
                    <td class="manager-site__manager-data">{{$promotions[$i]->Quantity}}</td>
                    <td class="manager-site__manager-data">
                        <input class="data__checkbox" type="checkbox" name="" id="">
                    </td>
                </tr>
            @endfor
        @endif
    </table>
    <div class="pagination">
        @if(!empty($promotions))
            {{$promotions->links('vendor.pagination.default') }}
        @endif
    </div>
</div>
