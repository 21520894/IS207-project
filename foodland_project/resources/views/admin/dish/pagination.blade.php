    <table class="manager-site__manager table">
        <tr class="manager-site__manager-row">
            <th class="manager-site__manager-header">ID</th>
            <th class="manager-site__manager-header">NAME</th>
            <th class="manager-site__manager-header">IMG</th>
            <th class="manager-site__manager-header">GROUP</th>
            <th class="manager-site__manager-header">PRICE</th>
            <th class="manager-site__manager-header">DESCRIBE</th>
            <th class="manager-site__manager-header">STATUS</th>
            <th class="manager-site__manager-header">EDIT</th>
            <th class="manager-site__manager-header">
                <input type="checkbox" name="" id="select_all_ids">
            </th>
        </tr>
        @if(!empty($dishes))
            @php($i=1)
            @foreach($dishes as $item)
                <tr class="manager-site__manager-row" id="product_ids{{$item->ID}}">
                    <td class="manager-site__manager-data">{{$item->ID}}</td>
                    <td class="manager-site__manager-data">{{$item->Name}}</td>
                    <td class="manager-site__manager-data">
                        <img class="data__img" src="../assets/img/item11.jpg" alt="">
                    </td>
                    <td class="manager-site__manager-data">{{$item->category_name}}</td>
                    <td class="manager-site__manager-data">{{$item->Price}} VND</td>
                    <td class="manager-site__manager-data">
                        <p class="data__desc">
                            {{$item->Description}}
                        </p>
                    </td>
                    <td class="manager-site__manager-data">
                        @php( $statusStyle = array('Stocking' => 'green-bg-color','Out of stock' => 'red-bg-color'))
                        <button class="item-status {{$statusStyle[$item->Status]}}">{{$item->Status}}</button>
                    </td>
                    <td class="manager-site__manager-data">
                        <button name="editDish"
                                class="data__edit-btn btn update_dish_form"
                                data-id="{{$item->ID}}"
                                data-name="{{$item->Name}}"
                                data-price="{{$item->Price}}"
                                data-status="{{$item->Status}}"
                                data-description="{{$item->Description}}"
                                data-category="{{$item->category_name}}"
                        >EDIT</button>
                    </td>
                    <td class="manager-site__manager-data">
                        <input class="data__checkbox" type="checkbox" name="ids" id="" value="{{$item->ID}}">
                    </td>
                </tr>
                @php($i+=1)
            @endforeach
        @endif
    </table>
    <div class="pagination">
        @if(!empty($dishes))
            {{$dishes->links('vendor.pagination.default') }}
        @endif
    </div>

