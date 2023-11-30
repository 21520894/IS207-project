<div class="add__modal" name="editUserModal">
    <h1 class="add__modal-header">EDIT USER</h1>
    <div class="grid__full-width">
        <div class="grid__row">
            <div class="edit__page">
                <form class="edit__page-wrapper" action="" method="post" id="edit-user-form">
                    @csrf
                    <div class="edit__page-input-wrapper">
                        <div class="edit__input-group-wrapper">
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">ID</label>
                                <input type="text" class="edit__input-text" disabled name="up-user-id">
                            </div>
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">PHONE</label>
                                <input type="number" class="edit__input-text" disabled name="up-user-phone">
                            </div>
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">Register date</label>
                                <input type="date" class="edit__input-text" disabled name="up-user-created">
                            </div>
                        </div>
                        <div class="edit__input-group-wrapper">
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">Name <span
                                        class="edit__input-require">*</span></label>
                                <input type="text" class="edit__input-text" name="up-user-name">
                                <span style="color: red; font-size: 12px;" class="up_name_error error"></span>
                            </div>
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">Group <span
                                        class="edit__input-require">*</span></label>
                                <select name="up-user-role" id="" class="edit__input-text" >
                                    <option id="up-user-role"></option>
                                    <option id="other-user-role" ></option>
                                </select>
                                <span style="color: red; font-size: 12px;" class="up_role_error error"></span>
                            </div>
                        </div>
                        <div class="edit__input-group">
                            <label for="" class="edit__input-label">Mail</label>
                            <input type="email" class="edit__input-text" disabled name="up-user-email">
                        </div>
                        <div class="edit__input-group input-group--inactive">
                            <label for="" class="edit__input-label">Category name <span class="edit__input-require">*</span></label>
                            <input type="text" class="edit__input-text" >
                        </div>
                        <div class="edit__input-group">
                            <label for="" class="edit__input-label">Facebook</label>
                            <input type="text" class="edit__input-text" name="" id=""></input>
                        </div>
                        <div class="edit__btn-wrapper">
                            <input class="edit__btn" type="submit" value="Save">
                            <a href="" class="edit__btn cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
