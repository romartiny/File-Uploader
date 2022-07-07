@extends('layouts.app')
@section('title')
    FileUpload
@endsection
<body>
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <a href="logout" class="logout-link">Logout</a>
                    <h1 class="text-center">FileUpload</h1>
                    <form action="{{route('dashboard')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="action" value="add" required>
                        <div class="block-send">
                            <input class="input-file" type="file" name="file" id="file" onchange="validateSize(this)"
                                   accept=".jpg, .png, .jpeg, .txt" required>
                            <div class="button-block">
                                <button type="submit" value="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                    <div class="block__results">
                        <div class="results">
                            @isset($fileNames)
                                @foreach($fileNames as $file)
                                    <p> {{ $file }}</p>
                                @endforeach
                            @else
                                <p>No files</p>
                            @endif
                        </div>
                        <div class="file__block">
                            <ul class="file__block-list">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="/assets/js/main.js"></script>
</body>
