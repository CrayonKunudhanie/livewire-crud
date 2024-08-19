<div class="container">
    @if ($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all as $item)
                    <li>{{$item}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if (session()->has('message'))
        <div class="pt-3">
            <div class="alert alert-sucsess">
                {{ session('messsage') }}
            </div>
        </div>
    @endif
    <!-- START FORM -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <form>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" wire:model="nama">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" wire:model="email">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" wire:model="alamat">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary" name="submit" wire:click="store">SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END FORM -->

    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h1>Data Pegawai</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-1">Nama</th>
                <th class="col-md-1">Email</th>
                <th class="col-md-1">Alamat</th>
                <th class="col-md-1">Aksi</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Messi</td>
                    <td>messi@gmail.com</td>
                    <td>Buenos Aires</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END DATA -->
</div>
