@extends('layouts/admin')
@section('content')
<div class="content">
    <div class="grid__full-width">
        <div class="grid__row">
            <div class="menu grid__col-2">
                @include('admin.components.menu')
            </div>
            <div class="edit__page">
                <form class="edit__page-wrapper" action="" method="">
                    <div class="edit__page-input-wrapper">
                        <div class="edit__input-group-wrapper">
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">ID</label>
                                <input type="text" class="edit__input-text" disabled value="{{$user['id']}}">
                            </div>
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">PHONE</label>
                                <input type="number" class="edit__input-text" disabled value="{{$user['phone']}}">
                            </div>
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">Register date</label>
                                <input type="date" class="edit__input-text" disabled value="{{$user['created_at'][0]}}">
                            </div>
                        </div>
                        <div class="edit__input-group-wrapper">
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">Name <span
                                        class="edit__input-require">*</span></label>
                                <input type="text" class="edit__input-text" required value="{{$user['name']}}">
                            </div>
                            <div class="edit__input-group">
                                <label for="" class="edit__input-label">Group <span
                                        class="edit__input-require">*</span></label>
                                <select name="" id="" class="edit__input-text" required>
                                    <option value="">{{$type}}</option>
                                    @if($type == 'Customer')
                                    <option value="">Admin</option>
                                    @else
                                    <option value="">Customer</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="edit__input-group">
                            <label for="" class="edit__input-label">Mail</label>
                            <input type="email" class="edit__input-text" disabled value="{{$user['email']}}">
                        </div>
                        <div class="edit__input-group input-group--inactive">
                            <label for="" class="edit__input-label">Category name <span class="edit__input-require">*</span></label>
                            <input type="text" class="edit__input-text" required>
                        </div>
                        <div class="edit__input-group">
                            <label for="" class="edit__input-label">Facebook</label>
                            <input type="text" class="edit__input-text" name="" id=""></input>
                        </div>
                        <div class="edit__btn-wrapper">
                            <input class="edit__btn" type="submit" value="Save">
                            <a href="index.php?action=userManager&query=null" class="edit__btn cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            @include('admin.components.main')
        </div>
    </div>
</div>
</div>
@endsection
