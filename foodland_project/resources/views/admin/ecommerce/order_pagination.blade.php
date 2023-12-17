<table class="manager-site__manager">
    <tr class="manager-site__manager-row">
        <th class="manager-site__manager-header">ID</th>
        <th class="manager-site__manager-header">PHONE</th>
        <th class="manager-site__manager-header">NAME</th>
        <th class="manager-site__manager-header">TOTAL</th>
        <th class="manager-site__manager-header">PAYMENT METHOD</th>
        <th class="manager-site__manager-header">PAYMENT STATUS</th>
        <th class="manager-site__manager-header">ORDER STATUS</th>
        <th class="manager-site__manager-header">ORDER TIME</th>
        <th class="manager-site__manager-header">DELETE</th>
    </tr>
    @if($orders!=null)
        @for($i=0;$i<count($orders);$i++)
            <tr class="manager-site__manager-row" id="order_ids{{$orders[$i]->OrderID}}">
                <td class="manager-site__manager-data">{{$i+1}}</td>
                <td class="manager-site__manager-data">{{$orders[$i]->customer_phone}}</td>
                <td class="manager-site__manager-data">{{$orders[$i]->customer_name}}</td>
                <td class="manager-site__manager-data">{{$orders[$i]->TotalPrice}} VND</td>
                <td class="manager-site__manager-data">{{$orders[$i]->payment_method}}</td>
                <td class="manager-site__manager-data">
                    <a onclick="return false"
                       class="item-status">{{!empty($orders[$i]->payment_method)?'Paid':'Unpaid'}}</a>
                </td>
                <td class="manager-site__manager-data">
                    <button name="viewDetail" class="item-status view-order-detail"
                            data-id="{{$orders[$i]->OrderID}}"
                            data-name="{{$orders[$i]->customer_name}}"
                            data-phone="{{$orders[$i]->customer_phone}}"
                            data-time="{{$orders[$i]->OrderTime}}">{{$orders[$i]->OrderStatus}}
                    </button>
                </td>
                <td class="manager-site__manager-data">{{$orders[$i]->OrderTime}}</td>
                <td class="manager-site__manager-data">
                    <input class="data__checkbox" type="checkbox" name="ids" id=""
                           value="{{$orders[$i]->OrderID}}">
                </td>
            </tr>
        @endfor
    @endif
</table>
<div class="pagination">
    @if(!empty($orders))
        {{$orders->links('vendor.pagination.default') }}
    @endif
</div>
