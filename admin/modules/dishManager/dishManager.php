<div class="manager-site__wrapper">
    <div class="manager-site__header">
        <div class="manager-site__search-wrapper">
            <div class="manager-site__search-box">
                <input type="text" class="manager-site__search-input" placeholder="Search ...">
                <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
            </div>
            <button name="addDish" class="manager-site__add-btn btn">+ ADD</button>
        </div>
        <div class="manager-site__category-wrapper">
            <div class="manager-site__category">
                <button class="manager-site__category-btn btn manager-site__category-btn--active">All</button>
                <button class="manager-site__category-btn btn">Beefsteak</button>
                <button class="manager-site__category-btn btn">Pizza</button>
                <button class="manager-site__category-btn btn">Pasta</button>
                <button class="manager-site__category-btn btn">Salad</button>
                <button class="manager-site__category-btn btn">Desert</button>
                <button class="manager-site__category-btn btn">Drink</button>
                <button class="manager-site__category-btn btn">Other</button>
            </div>
            <button name="delete" class="manager-site__category-delete-btn btn">
                <i class="manager-site__btn-icon fa-solid fa-trash"></i>
            </button>
        </div>
    </div>
    <div class="manager-site__body">
        <table class="manager-site__manager">
            <tr class="manager-site__manager-row">
                <th class="manager-site__manager-header">ID</th>
                <th class="manager-site__manager-header">NAME</th>
                <th class="manager-site__manager-header">IMG</th>
                <th class="manager-site__manager-header">GROUP</th>
                <th class="manager-site__manager-header">PRICE</th>
                <th class="manager-site__manager-header">DESCRIBE</th>
                <th class="manager-site__manager-header">DELETE</th>
                <th class="manager-site__manager-header">EDIT</th>
            </tr>
            <tr class="manager-site__manager-row">
                <td class="manager-site__manager-data">001</td>
                <td class="manager-site__manager-data">Beef Wellington</td>
                <td class="manager-site__manager-data">
                    <img class="data__img" src="../assets/img/item11.jpg" alt="">
                </td>
                <td class="manager-site__manager-data">Beefsteak</td>
                <td class="manager-site__manager-data">149,000 VND</td>
                <td class="manager-site__manager-data">
                    <p class="data__desc">
                        Our Beef Wellington is made with the finest ingredients, including prime beef tenderloin, wild mushrooms, and imported puff pastry. The steak is seasoned to ...
                    </p>
                </td>
                <td class="manager-site__manager-data">
                    <input class="data__checkbox" type="checkbox" name="" id="">
                </td>
                <td class="manager-site__manager-data">
                    <a href="?action=dishManager&query=edit" name="editDish" class="data__edit-btn btn">EDIT</a>
                </td>
            </tr>
            <tr class="manager-site__manager-row">
                <td class="manager-site__manager-data">002</td>
                <td class="manager-site__manager-data">Pizza</td>
                <td class="manager-site__manager-data">
                    <img class="data__img" src="../assets/img/item21.jpg" alt="">
                </td>
                <td class="manager-site__manager-data">Pizza</td>
                <td class="manager-site__manager-data">149,000 VND</td>
                <td class="manager-site__manager-data">
                    <p class="data__desc">
                        Our Beef Wellington is made with the finest ingredients, including prime beef tenderloin, wild mushrooms, and imported puff pastry. The steak is seasoned to ...
                    </p>
                </td>
                <td class="manager-site__manager-data">
                    <input class="data__checkbox" type="checkbox" name="" id="">
                </td>
                <td class="manager-site__manager-data">
                    <a href="?action=dishManager&query=edit" name="editDish" class="data__edit-btn btn">EDIT</a>
                </td>
            </tr>
        </table>
    </div>
</div>