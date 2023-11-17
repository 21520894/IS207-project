<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
    </head>
    <body>
        <form
            action="{{route('admin.login')}}"
            method="POST"
            style="display: block"
        >
            <div>
                @csrf
                <input
                    type="text"
                    name="Username"
                    placeholder="Tên đăng nhập"
                />
            </div>
            <div>
                <input
                    type="password"
                    name="Password"
                    placeholder="Mật khẩu"
                />
            </div>
            <input type="submit" value="Đăng nhập" />
        </form>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    </body>
</html>
