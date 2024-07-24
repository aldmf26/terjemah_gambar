@if (empty($books))
    <h5 class="card-title fw-semibold my-4 text-danger">Buku tidak ditemukan</h5>
    <p class="text-danger">{{ $msg ?? '' }}</p>
@else
    <h5 class="card-title fw-semibold my-4">Hasil pencarian buku</h5>
    <table class="table table-hover table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Sampul</th>
                <th scope="col">Judul</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Kategori</th>
                <th scope="col">Rak</th>
                <th scope="col">Stok tersisa</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @php $i = 1; @endphp
            @foreach ($books as $book)
                @if (!$book->deleted_at)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>
                            <div class="d-flex justify-content-center" style="max-width: 150px; height: 120px;">

                                <img class="mx-auto mh-100"
                                    src="{{ asset('uploads/book_cover/' . $book->book_cover ?? 'default.jpg') }}"
                                    alt="{{ $book->title }}">
                            </div>
                        </td>
                        <td>
                            <p><b>{{ "{$book->title} ({$book->year})" }}</b></p>
                            <p class="text-body">{{ "Author: {$book->author}" }}</p>
                        </td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->category }}</td>
                        <td>{{ $book->rack }}</td>
                        <td>{{ $book->stock }}</td>
                        <td style="width: 120px;" class="text-center">
                            @if (intval($book->stock ?? 0) > 0)
                                @php $rndm = md5(rand(0, 10000)); @endphp
                                <button type="button" class="btn btn-secondary"
                                    onclick="onChange{{ $book->id . $rndm }}()">
                                    <div class="form-check">
                                        <input
                                            :checked="selected.some(b => b.id === {{ $book->book_id }})"
                                            @click="pilih(
                                                {{ $book->book_id }},
                                                '{{ $book->book_cover }}', 
                                                '{{ $book->title }} ({{ $book->year }})', 
                                                {{ $book->stock }})"
                                            class="form-check-input" type="checkbox">
                                        <label class="form-check-label" for="book{{ $book->slug }}">
                                            Pilih
                                        </label>
                                    </div>
                                </button>
                            @else
                                <button class="d-block btn btn-dark w-100 mb-2" disabled>
                                    Stok habis
                                </button>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <script>
        function check(element) {
            element.checked = !element.checked;
        }

        function select(checked, book) {
            if (checked) {
                selectBook(book);
            } else {
                unselectBook(book.slug);
            }
        }
    </script>
@endif
