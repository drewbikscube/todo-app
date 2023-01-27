<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-secondary">
    <div class="container w-100 w-lg-50 mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Tasks</h3>
                <form action="{{ route('create') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="task" class="form-control" placeholder="Add a new task">
                        <button type="submit" class="btn btn-primary btn-sm px-4 shadow-sm"><i class="fas fa-plus"></i></button>
                    </div>
                </form>
                @if(count($todos))
                <ul class="list-group list-group-flush mt-3">
                    @foreach ($todos as $todo)
                    <li class="list-group-item d-flex">
                        <form class="w-100 d-flex flex-grow-2 align-items-start" action="{{ route('update', $todo->id) }}" method="POST">
                            <div class="w-100">
                                @if($todo->status == 'completed')
                                <del>
                                @endif
                                    <div>{{ $todo->task }}</div>
                                @if($todo->status == 'completed')
                                </del>
                                @endif
                            </div>
                            @csrf
                            @method('patch')
                            @if($todo->status == 'active')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn btn-link btn-md float-end text-success"><i class="fas fa-check"></i></button>
                            @endif
                        </form>
                        <form class="align-items-start" action="{{ route('delete', $todo->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-link btn-md float-end text-danger" onclick='return confirm("Are you sure?");'><i class="fas fa-trash"></i></button>
                        </form>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</body>

</html>